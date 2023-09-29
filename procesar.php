<!-- Alumno: Santiago Viloria, CID: 30.139.486, Seccion: N1013 -->
<!DOCTYPE html>
<html>
<head>
	<title>Procesamiento de tarjetas de datos</title> <!-- Este elemento define el titulo de la pagina, que se mostrara en la pestaña del navegador -->
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Enlazamos un archivo CSS externo llamado "style.css" para aplicar estilos al documento HTML -->
</head>
<body>
	<h1>Introduzca la información para el procesamiento de las tarjetas de datos</h1> <!--  Este elemento define un encabezado de nivel 1 que muestra el mensaje --> 
    <form method="post" action="resultados.php"> <!-- Este elemento define un formulario que enviara los datos ingresados a un archivo PHP llamado "resultados.php" utilizando el metodo POST -->
        <label>Confirme la cantidad de tarjetas a procesar:</label> <!-- Este elemento define una etiqueta de texto que indica al usuario que tipo de informacion debe ingresar -->   
        <input type="number" name="cantidad" min="1" required> <!-- Este elemento define un campo de entrada numerico y el atributo "required" indica que este campo es obligatorio -->
        <?php
            /*Esta parte verifica si el formulario se ha enviado utilizando el metodo POST*/ 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $cantidad = intval($_POST["cantidad"]);  /*Esta linea obtiene el valor ingresado en el campo "cantidad" del formulario y lo convierte en un numero entero utilizando la funcion intval()*/
                if ($cantidad > 0) { /*Verificamos si la cantidad ingresada es mayor que cero y generamos una tabla que se mostrara en la pagina*/
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Número de cédula de identidad</th>";
                    echo "<th>Nombre del alumno</th>";
                    echo "<th>Nota de matemáticas</th>";
                    echo "<th>Nota de física</th>";
                    echo "<th>Nota de programación</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    for ($i = 1; $i <= $cantidad; $i++) { /*Este bucle genera filas de la tabla para cada tarjeta a procesar*/
                        echo "<tr>";
                        echo "<td><input type='text' name='cedula[]' required></td>";
                        echo "<td><input type='text' name='nombre[]' required></td>";
                        echo "<td><input type='number' name='nota_mat[]' min='0' max='20' required></td>";
                        echo "<td><input type='number' name='nota_fis[]' min='0' max='20' required></td>";
                        echo "<td><input type='number' name='nota_prog[]' min='0' max='20' required></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "<button type='submit'>Calcular Resultados</button>"; /*Mostramos un boton de envio que enviara los datos ingresados en el formulario al archivo "resultados.php" cuando se haga clic en el*/
                } 
                /*Establecemos algunas validaciones*/
                else {
                    echo "<p>La cantidad de tarjetas debe ser un número entero positivo.</p>";
                }
            } else {
                echo "<p>Debe enviar el formulario para procesar los datos.</p>";
            }

	?>
    <br>
    <!-- Este elemento define un enlace que redirige al usuario a la pagina "index.html" cuando se hace clic en el dicho enlace tiene estilos personalizados definidos -->
    <a href="index.html" style="float: right; background-color: #ff0000; color: #fff; font-size: 16px; font-family: Arial, sans-serif; padding: 9px 15px; border-radius: 5px; text-decoration: none;">Volver</a> 
    </form>
</body>
</html>

