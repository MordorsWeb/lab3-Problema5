SELECT f.film_id AS codigo, 
       f.title AS titulo, 
       f.description, 
       f.release_year AS anio,
       GROUP_CONCAT(c.name SEPARATOR ', ') AS categorias,
       CONCAT(a.first_name, ' ', a.last_name) AS actor_nombre_completo
FROM film f
JOIN film_category fc ON f.film_id = fc.film_id
JOIN category c ON fc.category_id = c.category_id
JOIN film_actor fa ON f.film_id = fa.film_id
JOIN actor a ON fa.actor_id = a.actor_id
GROUP BY f.film_id, f.title, f.description, f.release_year
ORDER BY actor_nombre_completo;

