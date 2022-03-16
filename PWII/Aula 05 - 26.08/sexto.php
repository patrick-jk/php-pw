<?php 

	$ano = 2020; // variável local no script

	//implementação de uma função
	function exibir($parametro) { // variável como parâmetro
		$parametro = $parametro + 4;
		return $parametro;
	}

	echo "Estamos em ".$ano." e daqui a 4 anos estaremos em ".exibir($ano);

	echo "</br>";

	function exibirAno() {
		GLOBAL $ano; // definição de variável global
		$ano++;
		return $ano;
	}
	echo "</br>";
	echo "Função Exibir com variável global";
	echo "</br> Ano: ".$ano;
	echo "</br> Ano: ".exibirAno();
	echo "</br> Ano: ".exibirAno();
	echo "</br> Ano: ".$ano;
 ?>

 <?php 
 	function exibirStatic() {
 		STATIC $ano; // definindo variável estática
 		$ano++;
 		echo "</br>". $ano;
 	}
 	echo "</br>";
 	echo "</br>";
 	echo "Função Exibir com variável static";
 	echo exibirStatic();
 	echo exibirStatic();
 	echo exibirStatic();
  ?>