<h1>create post page</h1>

<form action="create_post.php" method="post">
    <input type="file" name="file"><br>
    <input type="text" name="title" placeholder="Titel"><br>
    <input type="text" name="text" placeholder="Text..."><br>
    <input type="submit" name="submit">
</form>

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
if(!isset($_COOKIE["logged_in"])){
    header("Location: login.php");
}

if(isset($_POST["submit"])){
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare(
            "INSERT INTO post (title, text)
            VALUES ('".$_POST["title"]."', '".$_POST["text"]."')"
        );
        $stmt->execute();
        header("Location: index.php");
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

<div class="title">
    <span>
    Bit-Challange
    </span>

    <br>
    <div id="names">
    <span>
      Powered by Niels, and Iz-Dine
    </span>
    </div>
</div>