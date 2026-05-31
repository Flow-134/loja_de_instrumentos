<?php
include("../conexao.php");
    $id = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM instrumentos WHERE id = $id");

    $stmt->execute();

    header("Location: index.php");

?>