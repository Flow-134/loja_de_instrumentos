<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

    $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();

    header('Location: index.php'); 
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body class="bg-orange-300 min-h-screen p-8">
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

    <h1 class="text-2xl font-bold mb-6">
        Nova Categoria
    </h1>

    <form method="POST">

        <input type="text" name="nome" placeholder="Nome da categoria" class="w-full border rounded-lg p-3 mb-4">

        <button type="submit" class="w-full bg-orange-600 text-white p-3 rounded-lg hover:bg-green-700"> Salvar
        </button>

    </form>

</div>
</body>
</html>