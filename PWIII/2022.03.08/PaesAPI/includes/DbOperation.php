<?php
 
class DbOperation
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	
	function createBread($name, $preco, $datafabricacao, $datavalidade){
		$stmt = $this->con->prepare("INSERT INTO bread (name, preco, datafabricacao, datavalidade) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("siii", $name, $preco, $datafabricacao, $datavalidade);
		if($stmt->execute())
			return true; 			
		return false;
	}
	
	function getBread(){
		$stmt = $this->con->prepare("SELECT * FROM bread");
		$stmt->execute();
		$stmt->bind_result($id, $name, $preco, $datafabricacao, $datavalidade);
		
		$breads = array(); 
		
		while($stmt->fetch()){
			$bread  = array();
			$bread['id'] = $id; 
			$bread['name'] = $name; 
			$bread['preco'] = $preco; 
			$bread['datafabricacao'] = $datafabricacao; 
			$bread['datavalidade'] = $datavalidade; 
			
			array_push($breads, $bread); 
		}
		
		return $breads; 
	}
	
	
	function updateBread($id, $name, $preco, $datafabricacao, $datavalidade){
		$stmt = $this->con->prepare("UPDATE bread SET name = ?, preco = ?, datafabricacao = ?, datavalidade = ? WHERE id = ?");
		$stmt->bind_param("siiii", $name, $preco, $datafabricacao, $datavalidade, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteBread($id){
		$stmt = $this->con->prepare("DELETE FROM bread WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
}