<html>
    <body>

        <?php 
            
            $num = array(1, 2, 3, 4, 5);

            foreach($num as $valor) {
                echo "Valor é ".$valor.'</br>';
            }
        

            $num[0] = "um";
            $num[1] = "dois";
            $num[2] = "três";
            $num[3] = "quatro";
            $num[4] = "cinco";

            echo '</br>';

            foreach ($num as $valor) {
                echo "Valor é ".$valor.'</br>';
            }
        ?>
    </body>
</html>