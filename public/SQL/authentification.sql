DROP TABLE "authentification_INCA";

/* CREATE TABLE */
CREATE TABLE "authentification_INCA" (id int,
username VARCHAR(100),
role VARCHAR(100),
password VARCHAR(100));

/* INSERT QUERY */
INSERT INTO "authentification_INCA" VALUES
(1,'Admin', 'admin', 'Admin75!'),
(2,'Saisie', 'saisie', 'Saisie75!'),
(1,'Technicien', 'tech', 'Technicien75!');

SELECT * FROM "authentification_INCA";