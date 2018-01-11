<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LETsVG</title>
  </head>
  <body>
    <h2>LET's'VG</h2>
    <h4>Documentos transformados: </h4><br>
<?php
    /*Programa creado por Joaquin Bello
      GITHUB: https://github.com/JoaquinBelloJimenez */

  //Crear la carpeta en la que se almacenará el nuevo documento
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

   $xml = simplexml_load_file($archivo); //Cargar el xml a usar

     //Obtener cada elemento
     $width = $xml['androidwidth'];
     $height = $xml['androidheight'];
     $vHeight = $xml['androidviewportHeight'];
     $vWidth = $xml['androidviewportWidth'];
     $fill = $xml->path['androidfillColor'];
     $path = $xml->path['androidpathData'];

     //Obtener todos los Path
     foreach ($xml->path as $npath) {
       $paths[] = $npath;
     };

     //Array que almacena los datos a usar posteriormente con la fabricación del nuevo documento
     $datos = array(
       'width'  =>  $width,
       'height' =>  $height,
       'vHeight'=>  $vHeight,
       'vWidth' =>  $vWidth,
    );
    generarSvg($archivo,$datos,$paths);

    //Limpiar arrays
    $paths = array();
    $datos = array();

  } //--Foreach
 ?>

<?php
function generarSvg($prenombre,$datos,$paths){
  //Obtener el nombre del documento a exportar
  $nombre = "svg/".substr($prenombre,0,strlen($prenombre)-4).".svg";

  $exportado = fopen("$nombre", "w");
  $svg = "<svg height='$datos[height]' viewBox='0 0 $datos[vWidth] $datos[vHeight]' width='$datos[width]'>";
  //Insertar cada PATH dentro del documento antes de exportarlo
  foreach ($paths as $path) {
    $svg .= "<path fill='$path[androidfillColor]' d='$path[androidpathData]'/>";
  }
  $svg .= "</svg>";

  //Exportar svg
  fwrite($exportado, $svg);
  echo "".substr($prenombre,0,strlen($prenombre)-4) ."<br>"; //Nombre de documentos exportados
  };
?>
</body>
</html>
