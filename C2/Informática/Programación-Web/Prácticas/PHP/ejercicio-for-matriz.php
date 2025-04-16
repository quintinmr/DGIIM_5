<html>
    <head>
        <title>Ejercicio For en PHP</title>
    </head>
<body>
    <h1>Ejercicio con For en PHP</h1>
    
    <?php
        // Definir una matriz de enteros
        $matriz = [[2,3,6],[6,9,10],[0,0,3]];
        
        // recorrer la matriz
        for($i = 0; $i < 3; $i++)
        {
        
            for($j = 0; $j < 3; $j++)
            {
                echo $matriz[$i][$j];
                echo ",\n";
            }
            
        }
        
    
    ?>

</body>
</html>
