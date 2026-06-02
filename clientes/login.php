<?php
session_start();
include("../conexao.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $conn->prepare("SELECT * FROM clientes WHERE email = :email AND senha = :senha");
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        if($cliente) {
            $_SESSION['cliente_id'] = $cliente['id'];
            $_SESSION['cliente_nome'] = $cliente['nome'];
            header("Location: index.php");
            exit;
        } else {
            echo "Email ou senha inválidos.";
        }
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
        <input type="text" name="email" placeholder="Email do cliente">
        <input type="password" name="senha" placeholder="Senha do cliente">
        <button type="submit">Entrar</button>
</body>
</html>