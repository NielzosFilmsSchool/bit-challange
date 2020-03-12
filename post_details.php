<ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="register.php">Register</a></li>
    <li><a href="create_post.php">Create Post</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

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
        <center>
            <div class="post_details">
                <h1><?= $row["title"]?></h1>
                <img src="<?= $row["image_link"]?>" alt="Post image">
                <p><?= $row["text"]?></p>
            </div>
        </center>
        <?php
    }
} catch (Exception $e) {
    echo "<p>Error: ".$e->getMessage()."</p>";
}
?>
<center>
    <div class="question_container">
        <script>
        function search() {
            let str = document.getElementById("search").value;
            let goto_str = "post_details.php?post_id=<?= $_GET["post_id"]?>";
            if(str != ""){
                goto_str = "post_details.php?post_id=<?= $_GET["post_id"]?>&search="+str;
            }
            window.location.replace(goto_str);
        }
        </script>
        <input type="text" size="30" id="search" placeholder="Zoeken...">
        <button onclick="search()">Zoek</button>
        <br><br>
        <form method="POST">
            <input type="text" id="question" name="question" placeholder="Stel hier je vraag...">
            <input type="submit" name="submit">
        </form>

        <table class="questions">
            <tr>
                <td>
                    <?php  
                        $link = "post_details.php?post_id=".$_GET["post_id"]; //&search=$_GET["search"]&sort=dsc"
                        if(isset($_GET["search"])){
                            $link .= "&search=".$_GET["search"];
                        }
                        if(isset($_GET["sort"])){
                            if($_GET["sort"] == "asc"){
                                ?>
                                <a href="<?= $link?>&sort=dsc"><h3>Vraag</h3></a>
                                <?php
                            }
                            if($_GET["sort"] == "dsc"){
                                ?>
                                <a href="<?= $link?>&sort=asc"><h3>Vraag</h3></a>
                                <?php
                            }
                        }else {
                            ?>
                            <a href="<?= $link?>&sort=asc"><h3>Vraag</h3></a>
                            <?php
                        }
                    ?>
                   
                </td>
            </tr>
            <?php
            try {
                $pdo = new PDO($dsn, $user, $pass, $options);
                
                if(isset($_GET["search"])) {
                    if(isset($_GET["sort"])) {
                        if($_GET["sort"] == "asc") {
                            $stmt = $pdo->query('SELECT * FROM questions WHERE post_id = '.$_GET["post_id"].' AND question like "%'.$_GET["search"].'%" ORDER BY question ASC');
                        }else {
                            $stmt = $pdo->query('SELECT * FROM questions WHERE post_id = '.$_GET["post_id"].' AND question like "%'.$_GET["search"].'%" ORDER BY question DESC');
                        }
                    }else {
                        $stmt = $pdo->query('SELECT * FROM questions WHERE post_id = '.$_GET["post_id"].' AND question like "%'.$_GET["search"].'%"');
                    }
                    
                }else {
                    if(isset($_GET["sort"])) {
                        if($_GET["sort"] == "asc") {
                            $stmt = $pdo->query('SELECT * FROM questions WHERE post_id = '.$_GET["post_id"].' ORDER BY question ASC');
                        }else {
                            $stmt = $pdo->query('SELECT * FROM questions WHERE post_id = '.$_GET["post_id"].' ORDER BY question DESC');
                        }
                    } else {
                        $stmt = $pdo->query('SELECT * FROM questions WHERE post_id = '.$_GET["post_id"].'');
                    }
                }
                if($stmt->rowCount() == 0){
                    throw new Exception("Geen vragen gevonden.");
                }
                while($row = $stmt->fetch()) {
                    ?>
                    <tr class="post_details">
                        <td>
                            <b><?= $row["question"]?></b>
                        </td>
                    </tr>
                    <?php
                }
            } catch (Exception $e) {
                echo "<p>Error: ".$e->getMessage()."</p>";
            }
            ?>
        </table>
    </div>
</center>

<?php

try {
    if(isset($_POST["submit"])){
        if(!empty($_POST["question"])){
            $pdo = new PDO($dsn, $user, $pass, $options);
            $stmt = $pdo->prepare(
                "INSERT INTO questions (question, post_id)
                VALUES ('".$_POST["question"]."', '".$_GET["post_id"]."')"
            );
            $stmt->execute();
            header("Location: post_details.php?post_id=".$_GET["post_id"]);
        }else {
            throw new Exception("Geen vraag ingevult.");
        }
    }
} catch (Exception $e) {
    echo "<p>Error: ".$e->getMessage()."</p>";
}

?>

<link rel="stylesheet" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>

