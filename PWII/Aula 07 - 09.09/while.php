<?php 

	print("While com Incremento");
	echo '</br>';
	$n = 0;

	while ($n <= 10) {
		
		echo '&nbsp;'.$n;
		$n++;
	}


 ?>

</br>
</br>

<?php 
	print("While com Decremento");
	echo '</br>';
	$n = 10;

	while ($n >= 0) {
		
		echo $n.'&nbsp;';
		$n--;
	}


 ?>

</br>
</br>

 <?php 
 	print("While com Break");
 	echo '</br>';
 	$x=0;
 	while ($x < 100) {
 		echo $x.'&nbsp;';
 		if ($x == 10)
 		break;
 		$x++;
 	}

  ?>