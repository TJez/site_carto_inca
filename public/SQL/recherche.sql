--Recherche sur l'amélioration du moteur de recherche
--($recherche étant à remplacer par l'élément recherché)
SELECT * FROM x_inca_xx
	WHERE LOWER(unaccent(definition)) LIKE LOWER(unaccent('%$recherche%'))
	OR symbologie LIKE LOWER(unaccent('%$recherche%'))
	OR jeu_classe_entite LIKE UPPER(unaccent('%$recherche%'))
	OR classe_entite LIKE LOWER(unaccent('%$recherche%')) LIMIT 10;
	
--Sorties tables existantes
SELECT table_name FROM information_schema.tables
	WHERE table_schema = 'socle_carto_fxx_nico' AND
	table_name LIKE '".$radical."%';
	
--Sortie des coordonnées (9s)
SELECT st_astext(geometrie) FROM socle_carto_fxx_nico.v_vegetation_n0
	ORDER BY RANDOM() LIMIT 1;
--trop long apparemment avec les autres requêtes
	
--Les requête de coordonnées durent trop longtemps, recherche pour accéler la requête
-- sans la fonction st_astext() : (8-10s)
SELECT geometrie FROM socle_carto_fxx_nico.v_vegetation_n0
	ORDER BY RANDOM() LIMIT 1;
--trop long et temps trop aléatoire
	
-- sans le RANDOM() : (0,7s)
SELECT id, st_astext(geometrie) FROM socle_carto_fxx_nico.v_vegetation_n0 LIMIT 1;
--Rapide mais toujours le même objet
--peut-être pour voir comment incrémenter le random dans le php

--exploration de la fonction random
SELECT random();
SELECT random() * 10 + 1 AS RAND_1_11;
SELECT floor(random() * 10 + 1)::int;

--test avec identification (4-5s)
SELECT st_astext(geometrie) FROM socle_carto_fxx_nico.v_vegetation_n0
	WHERE id = (SELECT floor( 36 + random() * 13737471)::int) LIMIT 1;
--Plus rapide mais correspond pas toujours à un identifiant existant

SELECT * FROM socle_carto_fxx_nico.v_vegetation_n0 ORDER BY id DESC LIMIT 10;