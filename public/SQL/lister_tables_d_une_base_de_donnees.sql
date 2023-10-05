-- Uniquement les tables
SELECT tablename
FROM pg_tables
WHERE tablename !~ '^pg_'
	AND tablename !~ '^sql_'
ORDER BY tablename;

-- Tables et vues
SELECT table_name
FROM information_schema.tables 
WHERE table_schema = 'public'
ORDER BY table_name;
