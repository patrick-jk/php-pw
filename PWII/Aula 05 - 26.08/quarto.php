<?php 
	print "Usando print para exibir na tela </br>";

	$data = "20 de agosto de 2021";
	$salario = 850.00;
	$cargo = "Estagiário";

	echo "Arquivo criado em $data </br>";

	printf("Salário minímo: R$ %.2f </br>", $salario);

	$texto = sprintf("%s recebe R$ %.2f por mês", $cargo, $salario*2);

	echo $texto;

 ?>