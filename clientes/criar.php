<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO clientes (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':senha', $senhaHash);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Novo Cliente</h1>
        <form action="" method="post" class="space-y-4">
            <input class="w-full border rounded-lg p-3" type="text" name="nome" placeholder="Nome do cliente" required>
            <input class="w-full border rounded-lg p-3" type="email" name="email" placeholder="Email do cliente" required>
            <input class="w-full border rounded-lg p-3" type="password" name="senha" placeholder="Senha do cliente" required>
            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg" type="submit">Salvar</button>
                <a class="px-4 py-2 rounded-lg border" href="index.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>