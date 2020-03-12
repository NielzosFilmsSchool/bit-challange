<center>
    <div class="login_container create_post_container">
        <h3>Registreren</h3>
        <form action="register.php" method="post" id="form">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" name="submit">
        </form>
    </div>
</center>

<?php
$host = '127.0.0.1';
$db   = 'bit_challange';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
?>

<?php
if(isset($_COOKIE["logged_in"])){
    header("Location: index.php");
}

if(isset($_POST["submit"])){
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        if(!empty($_POST["username"]) && !empty($_POST["password"])) {
            $stmt = $pdo->prepare(
                "INSERT INTO users (username, password)
                VALUES ('".$_POST["username"]."', '".$_POST["password"]."')"
            );
            $stmt->execute();
            setcookie("logged_in", $row["id"], time() + (86400 * 1), "/"); // 86400 = 1 day
            header("Location: index.php");
        } else {
            throw new Exception("Je hebt niet alles ingevult");
        }
    } catch (Exception $e) {
        echo "<p>Error: ".$e->getMessage()."</p>";
    }
}

?>

<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>