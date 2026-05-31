<?php
include("../conexao.php");
    $id = $_GET["id"];

    $sql = $conn->prepare("SELECT * FROM categorias WHERE id = $id");

    $resultado = $conn->query($sql);
    $categoria = $resulatdo->fetch_assoc();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];

        $sql = $conn->prepare("UPDATE categorias SET nome='$nome' WHERE id=$id");

        $conn->execute($sql);
    }
?>