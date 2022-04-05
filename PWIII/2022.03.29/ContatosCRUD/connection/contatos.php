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

            $jsonData = '{"contacts": '.
                '[{"nome":"Junior", "email": "junior@hotmail.com"},'.
                '{"nome":"Lucas", "email": "lucas@hotmail.com"},'.
                '{"nome":"William", "email": "william@hotmail.com"}'.
                '{"nome":"Venilton", "email": "venilton@hotmail.com"}'.
                '{"nome":"Jether", "email": "jether@hotmail.com"}'.
                ']}';

            $data = json_decode($jsonData, true);
            $contatos = $data->contacts;
            
            $result = $db->createContact($_POST['$contatos->nome'], $_POST['$contatos->email']);

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
            isTheseParametersAvailable(array('nome','email','oldemail'));
            $result = $db->updateContact(
                $_POST['nome'],
                $_POST['email'],
                $_POST['oldemail']
            );
            
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

    function createContact($nome, $email){
		$stmt = $this->con->prepare("INSERT INTO tbContatos VALUES (?, ?)");
		$stmt->bind_param("ss", $nome, $email);
		if($stmt->execute())
			return true; 			
		return false;
	}

    function updateContact($nome, $email, $oldemail){
		$stmt = $this->con->prepare("UPDATE tbContatos SET name = ?, email = ? WHERE email = ?");
		$stmt->bind_param("ss", $nome, $email, $oldemail);
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