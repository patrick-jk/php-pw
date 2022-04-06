<?php

$response = array();

$db = new CRUD();

function isTheseParametersAvailable($params) {
	
    $available = true; 
    $missingparams = ""; 
    
    foreach($params as $param){
        if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
            $available = false; 
            $missingparams = $missingparams . ", " . $param; 
        }
    }

    if(!$available){
        $response = array(); 
        $response['error'] = true; 
        $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
        
    
        echo json_encode($response);
        
    
        die();
    }
}

if(isset($_GET['crud'])) {

    switch($_GET['crud']){

        case 'createcontact':

            $data = json_decode(file_get_contents("php://input"));
            foreach ($data as $contato) {
                $db->nome = $contato->nome;
                $db->email = $contato->email;
                $result = $db->createContact();
            }
        


            if($result){
                
                $response['error'] = false; 

                
                $response['message'] = 'Contato adicionado com sucesso';

                
                $response['contacts'] = $db->getContacts();
            }else{

                
                $response['error'] = true; 

            
                $response['message'] = 'Algum erro ocorreu por favor tente novamente';
            }
            
        break; 
        
    
        case 'getcontacts':
            $response['error'] = false; 
            $response['message'] = 'Pedido concluído com sucesso';
            $response['contacts'] = $db->getContacts();
        break; 
        
        
    
        case 'updatecontact':

            $data = json_decode(file_get_contents("php://input"));
            $oldemail = "";
            foreach ($data as $contato) {
                $db->nome = $contato->nome;
                $db->email = $contato->email;
                $oldemail = $contato->oldemail;
                $result = $db->updateContact($oldemail);
            }
            
            if($result){
                $response['error'] = false; 
                $response['message'] = 'Contato atualizado com sucesso';
                $response['contacts'] = $db->getContacts();
            }else{
                $response['error'] = true; 
                $response['message'] = 'Algum erro ocorreu por favor tente novamente';
            }
        break; 
        
        
        case 'deletecontact':

            
            if(isset($_GET['email'])){
                if($db->deleteContact($_GET['email'])){
                    $response['error'] = false; 
                    $response['message'] = 'Contato excluído com sucesso';
                    $response['contacts'] = $db->deleteContact($email);
                } else{
                    $response['error'] = true; 
                    $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                }
            } else{
                $response['error'] = true; 
                $response['message'] = 'Não foi possível deletar, forneça um id por favor';
            }
        break; 
    }
} else {
    $response['contacts'] = $db->getContacts();
  }


echo json_encode($response);

class CRUD {

    private $con;
    public $nome;
    public $email;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }

    function getContacts() {
		$stmt = $this->con->prepare("SELECT * FROM tbContatos");
		$stmt->execute();
		$stmt->bind_result($nome, $email);
		
		$contacts = array(); 
		
		while($stmt->fetch()){
			$contact  = array();
			$contact['nome'] = $nome; 
            $contact['email'] = $email; 
			
			array_push($contacts, $contact); 
		}
		
		return $contacts; 
	}

    function createContact(){
		$stmt = $this->con->prepare("INSERT INTO tbContatos VALUES (?, ?)");
		$stmt->bind_param("ss", $this->nome, $this->email);
		if($stmt->execute())
			return true; 			
		return false;
	}

    function updateContact($oldemail){
		$stmt = $this->con->prepare("UPDATE tbContatos SET nome = ?, email = ? WHERE email = ?");
		$stmt->bind_param("sss", $this->nome, $this->email, $oldemail);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteContact($email){
		$stmt = $this->con->prepare("DELETE FROM tbContatos WHERE email = ? ");
		$stmt->bind_param("s", $email);
		if($stmt->execute())
			return true; 
		return false; 
	}
}


?>