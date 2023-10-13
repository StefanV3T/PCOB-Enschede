<?php
session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    require_once "db_connect.php";

    $stmt = $conn->prepare('DELETE FROM ingeschreven_voor_evenement WHERE id = :id');
    $stmt->execute(array(':id' => $id));

    if ($stmt->rowCount() > 0) {
        unset($_SESSION['id']);
        header("location: ../index.php");
    } else {
        echo "Er is een fout opgetreden bij het uitschrijven.";
        header("location: ../index.php");
    }
}
?>
