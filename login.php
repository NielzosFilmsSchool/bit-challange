<center>
    <div class="login_container">
        <h3>Login:</h3>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" name="submit"><br>
        </form>
    </div>
</center>

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

<!-- registreer button hier -->

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
if(isset($_POST["submit"])){
    try {
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            $pdo = new PDO($dsn, $user, $pass, $options);
            $stmt = $pdo->query('SELECT * FROM users WHERE username LIKE "'.$_POST["username"].'"');
            if($stmt->rowCount() == 0){
                throw new Exception("Geen gebruiker gevonden.");
            }
            while($row = $stmt->fetch()) {
                if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){
                    setcookie("logged_in", $row["id"], time() + (60 * 60), "/"); // 86400 = 1 day
                    header("Location: index.php");
                }else {
                    throw new Exception("Het wachtwoord komt niet overeen.");
                }
            }
        }else {
            throw new Exception("Je hebt niet alles ingevult.");
        }
    } catch (Exception $e) {
        echo "<p>Error: ".$e->getMessage()."</p>";
    }
}
?>