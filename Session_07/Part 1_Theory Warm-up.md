# 1. JOIN Distinction:
An INNER JOIN only returns records that have matching values in both tables. If a record in the left table doesn't have a match in the right table, it is excluded. A LEFT JOIN returns all records from the left table, regardless of whether there is a match in the right table. If there is no match, the columns from the right table will contain NULL.
# 2. Aggregation Logic:
The HAVING clause is used to filter records after an aggregation has taken place (e.g., grouping and calculating SUM()). We cannot use the WHERE clause for this because WHERE filters rows before they are grouped and aggregated.
# 3. PDO Definition & Advantages:
PDO stands for PHP Data Objects.
Advantage 1: It supports multiple database systems (MySQL, PostgreSQL, SQLite, etc.), meaning you can switch databases without rewriting all your code.
Advantage 2: It uses a consistent, object-oriented API and natively supports Prepared Statements, making it highly secure against SQL injection.
# 4. Security (Prepared Statements):
Prepared Statements separate the SQL query structure from the user-provided data. The database engine compiles the SQL template first. Then, user inputs are sent separately as literal values (not executable code). This guarantees that an attacker cannot alter the query's underlying logic via SQL Injection.
# 5. Execution Flow:
The database engine evaluates these clauses in this specific order: 1. WHERE (filters raw rows) -> 2. GROUP BY (aggregates the filtered rows) -> 3. HAVING (filters the grouped results).