<h1>Post board</h1>

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
    $stmt = $pdo->query('SELECT * FROM post');
    if($stmt->rowCount() == 0){
        throw new Exception("Geen posts gevonden.");
    }
    while($row = $stmt->fetch()) {
        ?>
        <div>
            <img src="" alt="Post image">
            <h3><?= $row["title"]?></h3>
        </div>
        <?php
    }
} catch (Exception $e) {
    echo "<p>Error: ".$e->getMessage()."</p>";
}

?>