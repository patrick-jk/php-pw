<html>
    <body>

        <?php 
            
            $salarios = array("João" => 2000, "Pedro" => 1000, "Maria" => 500);

            echo "Salário de João é ". $salarios['João'] . '</br>';
            echo "Salário de Pedro é ". $salarios['Pedro'] . '</br>';
            echo "Salário de Maria é ". $salarios['Maria'] . '</br>';

            $salarios['João'] = "Alto";
            $salarios['Pedro'] = "Médio";
            $salarios["Maria"] = "Baixo";

            echo '</br>';

            echo "Salário de João é ". $salarios['João'] . '</br>';
            echo "Salário de Pedro é ". $salarios['Pedro'] . '</br>';
            echo "Salário de Maria é ". $salarios['Maria'] . '</br>';
        ?>
    </body>
</html>