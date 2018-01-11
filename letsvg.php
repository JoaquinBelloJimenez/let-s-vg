<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LETsVG</title>
  </head>
  <body>
<?php
  /*Programa creado por Joaquin Bello
    GITHUB: https://github.com/JoaquinBelloJimenez
  */
    
  //Crear la carpeta en la que se alamcenará el nuevo documento
  if (!file_exists('svg')) {
    mkdir('svg', 0777, true);
  }

  //Obtener todos los *xml de la carpeta como un array escalar
  $file = glob("*.xml");

  foreach ($file as $archivo) {
    //Elimina los dobles puntos, si los hubiese.
    //Usar como string
    $texto = file_get_contents("$archivo", true);
    $re = str_replace(":","",$texto);
    //Guardar el documento editado (Sin los ":")
    $exportado = fopen($archivo, "w");
    fwrite($exportado, $re);

    echo "<h4>- $archivo </h4>"; //Archivo sin doble punto

   $xml = simplexml_load_file($archivo); //Cargar el xml a usar

     //Obtener cada elemento
     $width = $xml['androidwidth'];
     $height = $xml['androidheight'];
     $vHeight = $xml['androidviewportHeight'];
     $vWidth = $xml['androidviewportWidth'];
     $fill = $xml->path['androidfillColor'];
     $path = $xml->path['androidpathData'];

     //Array que almacena los datos a usar posteriormente con la fabricación del nuevo documento
     $datos = array(
       'width'  =>  $width,
       'height' =>  $height,
       'vHeight'=>  $vHeight,
       'vWidth' =>  $vWidth,
       'fill'   =>  $fill,
       'path'   =>  $path
    );

     echo "$archivo ";
     print_r($datos);
     echo "<br>";

    generarSvg($archivo,$datos);
  }
 ?>


<?php
function generarSvg($prenombre,$datos){
  //Obtener el nombre del documento a exportar
  $nombre = "svg/".substr($prenombre,0,strlen($prenombre)-4).".svg";

  $exportado = fopen("$nombre", "w");
  $svg = "<svg height='$datos[height]' viewBox='0 0 $datos[vWidth] $datos[vHeight]' width='$datos[width]'> <path fill='$datos[fill]' d='$datos[path]'/></svg>";

  //Exportar svg
  fwrite($exportado, $svg);
  }

?>
</body>
</html>
