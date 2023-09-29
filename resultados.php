<!-- Alumno: Santiago Viloria, CID: 30.139.486, Seccion: N1013 -->
<!DOCTYPE html>
<html>
<head>
	<title>Procesamiento de tarjetas de datos - resultados</title> <!-- Este elemento define el titulo de la pagina, que se mostrara en la pestaña del navegador -->
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Enlazamos un archivo CSS externo llamado "style.css" para aplicar estilos al documento HTML -->
</head>
<body>
	<h1>Procesamiento de tarjetas de datos - resultados</h1> <!--  Este elemento define un encabezado de nivel 1 que muestra el mensaje --> 
    <form method="post" action="procesar.php"> <!-- Este elemento define un formulario que enviará los datos ingresados a un archivo PHP llamado "procesar.php" utilizando el metodo POST -->
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {  /*Esta linea verifica si el metodo de solicitud es POST*/ 
			
			/*Esta parte verifica si la cantidad es mayor que cero y se comienza a obtener los datos a traves del metodo POST*/
			$cantidad = intval($_POST["cantidad"]);
			if ($cantidad > 0) {
				$cedula = $_POST["cedula"];
				$nombre = $_POST["nombre"];
				$nota_mat = $_POST["nota_mat"];
				$nota_fis = $_POST["nota_fis"];
				$nota_prog = $_POST["nota_prog"];

				/*En esta parte se comienza a iniciar las variables*/
				$prom_mat = 0;
				$prom_fis = 0;
				$prom_prog = 0;
				$aprov_mat = 0;
				$aprov_fis = 0;
				$aprov_prog = 0;
				$aplaz_mat = 0;
				$aplaz_fis = 0;
				$aplaz_prog = 0;
				$aprov_todas = 0;
				$aprov_una = 0;
				$aprov_dos = 0;
				$max_mat = 0;
				$max_fis = 0;
				$max_prog = 0;

				/*Este bucle for se ejecuta "$cantidad" una cantidad determinada anteriormente de veces y se calculan el promedio
				de las notas de un estudiante y el promedio de las materias*/
				for ($i = 0; $i < $cantidad; $i++) {
					$promedio = ($nota_mat[$i] + $nota_fis[$i] + $nota_prog[$i]) / 3;
					$prom_mat += $nota_mat[$i];
					$prom_fis += $nota_fis[$i];
					$prom_prog += $nota_prog[$i];
					if ($nota_mat[$i] >= 10) {  /*En esta parte se incrementa el contador de aprobados y en caso contrario de aplazados en las materias*/
						$aprov_mat++;
					} else {
						$aplaz_mat++;
					}
					if ($nota_fis[$i] >= 10) {
						$aprov_fis++;
					} else {
						$aplaz_fis++;
					}
					if ($nota_prog[$i] >= 10) {
						$aprov_prog++;
					} else {
						$aplaz_prog++;
					}
					if ($nota_mat[$i] >= 10 && $nota_fis[$i] >= 10 && $nota_prog[$i] >= 10) { /*Esta parte verifica si el estudiante aprobo todas las materias*/
						$aprov_todas++;
					}
					if (($nota_mat[$i] >= 10 && $nota_fis[$i] < 10 && $nota_prog[$i] < 10) || /*Esta parte verifica si el estudiante aprobo una sola materia*/
						($nota_mat[$i] < 10 && $nota_fis[$i] >= 10 && $nota_prog[$i] < 10) ||
						($nota_mat[$i] < 10 && $nota_fis[$i] < 10 && $nota_prog[$i] >= 10)) {
						$aprov_una++;
					}
					if (($nota_mat[$i] >= 10 && $nota_fis[$i] >= 10 && $nota_prog[$i] < 10) || /*Esta parte verifica si el estudiante aprobo dos materias*/
						($nota_mat[$i] >= 10 && $nota_fis[$i] < 10 && $nota_prog[$i] >= 10) ||
						($nota_mat[$i] < 10 && $nota_fis[$i] >= 10 && $nota_prog[$i] >= 10)) {
						$aprov_dos++;
					}
					if ($nota_mat[$i] > $max_mat) {  /*Esta parte actualiza la nota maxima de cada materia*/
						$max_mat = $nota_mat[$i];
					}
					if ($nota_fis[$i] > $max_fis) {
						$max_fis = $nota_fis[$i];
					}
					if ($nota_prog[$i] > $max_prog) {
						$max_prog = $nota_prog[$i];
					}
				}
				$prom_mat /= $cantidad; /*En esta parte se calculan el promedio de calificaciones para las materias*/
				$prom_fis /= $cantidad;
				$prom_prog /= $cantidad;
				/*En esta parte se va estrucutrando el formato en el cual se presentara la informacion*/ 
				echo "<table>";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Materia</th>";
				echo "<th>Promedio</th>";
				echo "<th>Aprobados</th>";
				echo "<th>Aplazados</th>";
				echo "<th>Nota Máxima</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				echo "<tr>";
				echo "<td>Matemáticas</td>";
				echo "<td>" . number_format($prom_mat, 2) . "</td>";
				echo "<td>" . $aprov_mat . "</td>";
				echo "<td>" . $aplaz_mat . "</td>";
				echo "<td>" . $max_mat . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Física</td>";
				echo "<td>" . number_format($prom_fis, 2) . "</td>";
				echo "<td>" . $aprov_fis . "</td>";
				echo "<td>" . $aplaz_fis . "</td>";
				echo "<td>" . $max_fis . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Programación</td>";
				echo "<td>" . number_format($prom_prog, 2) . "</td>";
				echo "<td>" . $aprov_prog . "</td>";
				echo "<td>" . $aplaz_prog . "</td>";
				echo "<td>" . $max_prog . "</td>";
				echo "</tr>";
				echo "</tbody>";
				echo "</table>";
				/*En esta aprte se muestra el resultado de las respectivas operaciones*/
				echo "<p>Alumnos que aprobaron todas las materias: " . $aprov_todas . "</p>";
				echo "<p>Alumnos que aprobaron una sola materia: " . $aprov_una . "</p>";
				echo "<p>Alumnos que aprobaron dos materias: " . $aprov_dos . "</p>";
			} 
		} else { /*Se establecen una serie de validaciones*/ 
			echo "<p>Debe enviar el formulario para procesar los datos.</p>";
		}
	?>
	<br> <!-- Este elemento define un enlace que redirige al usuario a la pagina "index.html" cuando se hace clic en el dicho enlace tiene estilos personalizados definidos -->
    <a href="index.html" style="float: right; background-color: #ff0000; color: #fff; font-size: 16px; font-family: Arial, sans-serif; padding: 9px 15px; border-radius: 5px; text-decoration: none;">Volver</a> 
</body>
</html>