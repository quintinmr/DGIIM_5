<html>

<body>

<?php

function aniadir_header($titulo)
{
    $cadena='<header><h1>'.$titulo.'</h1></header>';
    return $cadena;
}

function aniadir_footer($ugr,$direccion)
{
    $cadena='<footer><p>'.$ugr.'</p>
    <address>'.$direccion.'
    </address></footer>';
    return $cadena;
}

function aniadir_section($titulo,$contenido)
{
    $cadena='<section> <h1>'.$titulo.'</h1>
    <br/><p>'.$contenido.'</p></section>';
    return $cadena;
}

?>

<?php

$cabecera = aniadir_header("Primer ejercicio - Funciones");
$seccion1 = aniadir_section("Sección - 1", "Esta es la primera sección del ejercicio");
$seccion2 = aniadir_section("Sección - 2", "Esta es la segunda sección del ejercicio");
$seccion3 = aniadir_section("Sección - 3", "Esta es la tercera sección del ejercicio");
$pie      = aniadir_footer("Universidad de Granada", "Cuesta del Hospicio, Granada 18071");

echo $cabecera;
echo "<br/>";
echo $seccion1;
echo "<br/>";
echo $seccion2;
echo "\n";
echo $seccion3;
echo "\n";
echo $pie;
echo "\n";

?>

</body>



</html>