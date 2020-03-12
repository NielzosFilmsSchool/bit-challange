<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>

<div class="title login_title">
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
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->query('SELECT * FROM post WHERE id = '.$_GET["post_id"].'');
    if($stmt->rowCount() == 0){
        throw new Exception("Geen posts gevonden.");
    }
    while($row = $stmt->fetch()) {
        ?>
        <div class="post" onclick="location.href='post_details.php/?post_id=<?= $row['id']?>';">
            <img src="" alt="Post image">
            <h3><?= $row["title"]?></h3>
        </div>
        <?php
    }
} catch (Exception $e) {
    echo "<p>Error: ".$e->getMessage()."</p>";
}
?>

