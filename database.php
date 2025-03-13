<?php
$db = new SQLite3('users.db');

$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
)";
$db->exec($query);

echo "Database and table created successfully!";
?>
