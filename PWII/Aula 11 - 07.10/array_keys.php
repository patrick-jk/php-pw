<?php 

	$nomes = array("MA" => "Maria", "ZE" => "José", "PE" => "Pedro", "AN" => "Ana");
	
	$chaves = array_keys($nomes);

	foreach ($chaves as $nomes) {
		echo "</br>".$nomes;
	}
	echo "</br>";

	// função para exibir dados de um vetor

	print_r($chaves);
 ?>