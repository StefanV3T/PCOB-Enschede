<?php 
include 'include/db_connect.php';
require_once "include/config.php"; 

session_start();
$query = $pdo->query('SELECT * FROM sponsoren');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onze Sponsoren</title>
    <link rel="stylesheet" href="css/sponsors.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<body>

    <?php include 'include/header.php';?>

    <h1 class="sponsortitel">Onze Sponsoren</h1>
    <hr class="ondertitellijn">



    <?php
    $rows = $pdo->query('SELECT COUNT(*) AS count FROM sponsoren');
    $row = $rows->fetch(PDO::FETCH_ASSOC);
    $rowcount = $row['count'];
    ?> <div class="sponsorlijst"> <?php
    if ($rowcount > 0) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="sponsor">
                <a href="<?php echo htmlspecialchars($row['link']) ?>">
                    <img class="plaatje" src="images/<?php echo $row['sponsor_logo']?>" alt="evenement">
                </a>
                <?php
                if (isset($_SESSION["is_logged_in"])) {
                    ?>
                    <form method="post">
                        <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Verwijder sponsoren" name="submit">
                    </form>
                <?php
                }

                if (isset($_POST['submit'])) {
                    $item_id = $_POST["item_id"];

                    $sql = "DELETE FROM sponsoren WHERE id = :item_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
                    $stmt->execute();

                    header("Location: $_SERVER[PHP_SELF]");
                    exit();
                }
            ?> </div> <?php
        }
    } else {
        echo '<h1 class="error">Er is momenteel geen sponsoren.</h1>';
    }
    ?>
    </div>
    <div class="sponsorworden">
        <h1 class="sponsortitel">Sponsor worden?</h1>
        <!-- Lorem ipsum veranderen met echte tekst-->
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente sit, tempora fugit rem, nostrum alias
            quibusdam necessitatibus voluptatibus quos reiciendis unde?
            Laudantium nobis nam odio saepe qui ullam. Vero, repellat?</p>
        <div class="sponsorcontact">
            <!-- voorbeelden veranderen met echte contact gegevens-->
            <h2>06-12345678 - example@domain.com</h2>
        </div>
    </div>
    <?php include 'include/footer.php';
    ?>
</body>

</html>