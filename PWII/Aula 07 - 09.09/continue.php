<?php
	echo "Impressão de números ímpares com Continue"; 
	echo '</br>';
	for ($x=1; $x <= 100; $x++) {
		if ($x % 2 == 0) {
			continue;
		}
		echo $x." ";
	}

 ?>