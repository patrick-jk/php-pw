<?php 

	require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
	
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
	
	
	$response = array();
	

	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
	
			case 'createbread':
				
				isTheseParametersAvailable(array('name','preco','datafabricacao','datavalidade'));
				
				$db = new DbOperation();
				
				$result = $db->createBread(
					$_POST['name'],
					$_POST['preco'],
					$_POST['datafabricacao'],
					$_POST['datavalidade']
				);
				

			
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Pão adicionado com sucesso';

					
					$response['bread'] = $db->getBread();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
				
			break; 
			
		
			case 'getBread':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['bread'] = $db->getBread();
			break; 
			
			
		
			case 'updateBread':
				isTheseParametersAvailable(array('id','name','preco','datafabricacao','datavalidade'));
				$db = new DbOperation();
				$result = $db->updateBread(
					$_POST['id'],
					$_POST['name'],
					$_POST['preco'],
					$_POST['datafabricacao'],
					$_POST['datavalidade']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Pão atualizado com sucesso';
					$response['bread'] = $db->getBread();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			
			case 'deleteBread':

				
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->deleteBread($_GET['id'])){
						$response['error'] = false; 
						$response['message'] = 'Pão excluído com sucesso';
						$response['bread'] = $db->getBread();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break; 
		}
		
	}else{
		 
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	

	echo json_encode($response);