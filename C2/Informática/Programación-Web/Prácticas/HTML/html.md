# HTML

* Hipertexto: texto con hiperenlaces (los enlaces que vemos en un documento HTML)
* Marcado: nos da un conjunto de etiquetas para que organicemos el contenido del documento de una forma fácil de entender. Marcar = poner etiquetas
 
XML es un metalenguaje; permite crear diferentes lnguajes de marcado. HTML ya es un lenguaje predefinido. En definitiva, XML es una generalización de 
XML.

$HTML \subset XML \subset SGML$

HTML se almacena en el servidor y se "ejecuta" en el cliente (navegador; lo visualiza).
Para una mayor visibilidad de un documento HTML, probarlo con todos los navegadores. En nuestro caso, lo vamos a hacer todo con Chrome porque es el 
navegador más avanzado.

**Elemento:** todo lo que está entre la marca de apertura y la marca de cierre

> Todo lo que se abre en HTML se ha de cerrar, salvo:
    - br: nueva línea
    - hr: línea horizontal

**Atributo:** propiedades de los elementos que modiifican el funcionamiento normal de ese elemento. 

> HTML5 nos pide que distingamos entre el contenido de su forma de visualizarlo. Que todas las reglas visuales las pongamos en otro fichero diferente. 

> HTML no es sensible a las mayúsculas, aunque lo normal es que lo hagamos todo en minúscula.

> Sí es sensible a los caracteres '<', '>', las tildes, la ñ, el espacio en blanco, etc.. Para que no haya problemas y se vean los caracteres tal y como son, usamos lo que se conoce como "referenias":

    - &lt = <
    - &gt = >
    - &aacute = á
    - &eacute = é
    - &ntilde

Los comentarios se hacen de esta forma: <!-- texto -->

> NO  puede haber ningun elemento fuera del head y del body.

## Imágenes

> <img src="foto" alt = "Descripción alternativa, por si no se encuentra el archivo src">

## Tablas

En HTML, las tablas son como en excel. La tabla puede tener un encabezado (en fila y columna). 
Podemos unir celdas de una misma fila, o de una misma columna.

Características de una tabla en HTML:

- summary: descripción de lo que contiene la tabla
- caption: título de la tabla
- thead: cabecera de la fila
	- tr: table row (la fila en sí)
		- th: todas las celdas que hay en la cabecera

	si tenemos varias tr sucesivas, signfica que tenemos varias cabeceras
	de fila

- tfoot: última fila de la tabla (se suele usar para totales
	- tr
		- td: table data (todas las celdas debajo de la cabecera y tmb
		    el foot son de este tipo)


#### EJERCICIO
> Hacer nuestro horario de clase usando lo que hemos aprendido de las tablas.

#### EJERCICIO
> Tabla 3x3, un thead, un tbody y un tfoot.


## Elementos semánticos

### Títulos

- $h1>h2>h3>...>h6$ (orden de prioridad)

los navegadores tienen un css por defecto, que aplican cuando el fichero html viene sin css. Por eso los títulos salen de distinto tamaño si ponemos h1, h2, h3,... en nuestro documento html (como hemos hecho en holamundo.html)

### Headers

cabeceras que suele contener el contenido introductorio de la página. 

### Nav

Suele contener enlaces para navegar por la página. Elemento semántico que puedo usar para indicar que lo que tiene dentro sirve para navegar por el sitio. 

### Main

Contiene el contenido de cada documento. 

* *Recomendación*: un tbody tenga solo 3 etiquetas (head, body, foot).

### Secciones

Agrupar contenido con semántica similar.
Ejemplo: en tienda de ordenadores, las secciones sería, "portátiles", "ordenadores de mesa", etc.

### Artículos

Elemento textual con contenido independiente. Siguiendo la analogía, en la tienda de ordenadores los artćulos erían los objetos que se vendan. En definitiva, una sección va a estar llena de artículos. Un artículo puede tener secciones dentro.

**Documento HTML** = head + body (header + foot + main (sections (articles)))

Plan de estudios: cursos (4) --> cuatrimestres --> asignaturas --> temario
¿cómo lo organizamos? 
header (Plan de estudios grado ingeniería informática)
footer (enlace a la ugr, a la etsiit, dirección escuela)
main (cada curso es una sección, dentro de cada curso (sección), los cuatrimestres
serían tmb secciones (dentro de los cuatrimestres tengo asinaturas, que serían artículos))

¿dónde podría poner un aside? becas, ayudas, horarios, tfg, en el lateral derecho.
Un aside a nivel de curso tmb tendría sentido, si encontráramos algo. Lo mismo con las asignaturas (p.ej, las asignaturas relacionadas con ella; los prerrequisitos)