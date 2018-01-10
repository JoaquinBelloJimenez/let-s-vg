# let-s-vg
Utiliza el lenguaje de servidor **PHP** para convertir documentos de imagen vectorial en formato XML, usado en la 
creación de aplicaciones Android, a SVG. Este incluye un ejecutable que, usando de fondo el programa [**Inkscape**](https://inkscape.org/en/)
genera documentos pdf que contienen dichos svg.
De esta forma los documentos xml pueden ser exportados a diferentes ámbitos y aplicaciones.
#### ¿Cómo lo hace?

Es un proceso sencillo ya que lo que hace es modificar el nombre de las etiquetas y genera un nuevo documento.
El programa escanea la carpeta en el cual se encuentra y toma los archivos XML que siguen esta estructura:
  ```
<vector xmlns:android="http://schemas.android.com/apk/res/android"
    android:width="24dp"
    android:height="24dp"
    android:viewportHeight="24"
    android:viewportWidth="24">
    <path
        android:fillColor="#323232"
        android:pathData="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
</vector>
<vector>...</vector>

  ```
  Después toma el primero de estos archivos y  genera un nuevo documento SVG. El resultado sería el siguiente:
  ```
  <svg height='24dp' viewBox='0 0 24 24' width='24dp'> 
    <path fill='#323232' d='M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z'/>
  </svg>
  
  ```
### ¿Cómo va el proyecto?
An quedan cosas por implementar, está en una versión muy temprana  y sólo permite el paso de 1 sólo archivo que incluya una sola etiqueta <path>
