<center>
    <div class="login_container create_post_container">
        <h3>Post aanmaken</h3>
        <form action="create_post.php" method="post" id="form">
            <input type="text" name="image" placeholder="Foto link"><br>
            <input type="text" name="title" placeholder="Titel"><br>
            <textarea form="form" width="100" type="text" name="text" placeholder="Text..."></textarea><br>
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
if(!isset($_COOKIE["logged_in"])){
    header("Location: login.php");
}

if(isset($_POST["submit"])){
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        if(!empty($_POST["title"]) && !empty($_POST["text"]) && !empty($_POST["image"])) {
            $stmt = $pdo->prepare(
                "INSERT INTO post (title, text, image_link)
                VALUES ('".$_POST["title"]."', '".$_POST["text"]."', '".$_POST["image"]."')"
            );
            $stmt->execute();
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