<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_save_path('/var/www/html/sessions');


if (session_status() === PHP_SESSION_NONE) 
{
    session_start();
}


$db = new SQLite3('/var/www/html/users.db'); 


$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
)");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 


    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    if ($stmt) 
    {
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);

        if ($stmt->execute())
         {
            echo "User registered successfully! <a href='login.php'>Login here</a>";
         } 
        else 
        {
            echo "Error: Username already taken or database issue.";
        }
    } 
    else 
    {
        echo "Error: Failed to prepare the SQL statement.";
    }
}
?>

