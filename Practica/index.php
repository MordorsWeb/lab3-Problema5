<?php
    
    $servidor  = "localhost";
    $basedatos = "Sakila";
    $usuario   = "root";
    $contra    = "root";

   
    error_reporting(0);

    if (!$conex = mysqli_connect($servidor, $usuario, $contra, $basedatos)) {
        echo "<h3><font color='red'>Error: No se puede conectar al servidor de MySQL.</font></h3>" . "<hr>";
        echo "<strong>Número........:</strong> " . mysqli_connect_errno() . "<br>";
        echo "<strong>Descripción...:</strong> " . mysqli_connect_error() . "<br>";
        exit;
    }

    mysqli_set_charset($conex, "utf8");

   
    header("Content-Type: application/xml");
    echo "<?xml-stylesheet type=\"text/css\" href=\"styles.css\"?>\n";  

    
    echo "<films>\n";

    
    $query = "SELECT film.film_id, film.title, film.description, film.release_year, category.name AS category_name
              FROM film
              JOIN film_category ON film.film_id = film_category.film_id
              JOIN category ON film_category.category_id = category.category_id
              ORDER BY film.title ASC";
    
    $result = mysqli_query($conex, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<film>\n";
        echo "<codigo>" . $row['film_id'] . "</codigo>\n";
        echo "<titulo>" . $row['title'] . "</titulo>\n";
        echo "<descripcion>" . $row['description'] . "</descripcion>\n";
        echo "<anio>" . $row['release_year'] . "</anio>\n";
        echo "<categorias>" . $row['category_name'] . "</categorias>\n";
        echo "</film>\n";
    }

    echo "</films>\n";
?>
