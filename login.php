<?php
session_start();
$db = new SQLite3('users.db');


error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) 
    {
        session_regenerate_id(true);
        $_SESSION['user'] = $user['username'];
        header("Location: dash.php");
        exit;
    } 
    else 
    {   
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: index.php"); 
        exit;
    }
}
?>

<body>
<link rel="stylesheet" href="styles.css">
<form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>    