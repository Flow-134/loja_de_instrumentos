<?php
session_start();

if (!isset($_SESSION['cliente_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cliente_role'])) {
    include("../conexao.php");
    $stmt = $conn->prepare("SELECT nome, role FROM clientes WHERE id = :id");
    $stmt->bindValue(':id', $_SESSION['cliente_id'], PDO::PARAM_INT);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    $_SESSION['cliente_nome'] = $cliente['nome'];
    $_SESSION['cliente_role'] = $cliente['role'] ?? 'customer';
}
?>

