DROP TABLE "produits";
/* CREATE TABLE */
CREATE TABLE "produits" (nom VARCHAR(100),
						 zoom int,
						 table_name VARCHAR(100));

/* INSERT QUERY */
INSERT INTO "produits" VALUES
/* PLAN IGN */
/* zoom 14 */
('plan IGN', 14, 'r_chemin_n0'),
('plan IGN', 14, 'v_vegetation_n0'),
('plan IGN', 14, 'b_hydro_surf_n1'),
('plan IGN', 14, 'v_nature_sol_n1'),
/* zoom 15 */
('plan IGN', 15, 'v_vegetation_n0'),
('plan IGN', 15, 'r_chemin_n0'),
('plan IGN', 15, 'v_vegetation_n0'),
/* zoom 16 */
('plan IGN', 16, 'v_vegetation_n0'),
('plan IGN', 16, 'r_chemin_n0'),
('plan IGN', 16, 'v_vegetation_n0'),
/* zoom 17 */
('plan IGN', 17, 'v_vegetation_n0'),
('plan IGN', 17, 'r_chemin_n0'),
('plan IGN', 17, 'v_vegetation_n0'),
/* zoom 18 */
('plan IGN', 18, 'v_vegetation_n0'),
('plan IGN', 18, 'v_vegetation_n0'),
('plan IGN', 18, 'r_chemin_n0'),
/* zoom 19 */
('plan IGN', 19, 'v_vegetation_n0'),
('plan IGN', 19, 'v_vegetation_n0'),
('plan IGN', 19, 'r_chemin_n0'),

/* TOP 250 */
/* zoom 1 */
('TOP 250', 1, 'f_voie_n25'),
('TOP 250', 1, 'f_voie_sup_n25'),
('TOP 250', 1, 'f_voie_sou_n25'),

/* Vision de la table */
SELECT * FROM "produits";