<?php
include("../conexao.php");

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $stmt = $conn->prepare("DELETE FROM clientes WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: index.php");
    exit;
?>