<?php
    include_once('../config.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt =$conn->prepare("INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
        header("Location: login.php");
    }
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="nome" placeholder="Nome do cliente">
        <input type="text" name="email" placeholder="Email do cliente">
        <input type="password" name="senha" placeholder="Senha do cliente">
        <button type="submit">Cadsatrar</button>
    </form>    
</body>
</html>