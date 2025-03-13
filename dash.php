<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<body>
    
<link rel="stylesheet" href="styles.css">
<h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
<a href="logout.php">Logout</a>
</body>