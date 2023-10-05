/* comptage champ symbologie en fonction de la table de classe classe d'entité */
SELECT symbo s, COUNT (*)
				FROM socle_carto_fxx_nico.r_chemin_n0
				GROUP BY s
				ORDER BY s;