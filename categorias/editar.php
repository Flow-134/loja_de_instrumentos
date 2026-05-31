<?php
include("../conexao.php");

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $stmt = $conn->prepare("SELECT * FROM categorias WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

        $stmt = $conn->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Editar Categoria</h1>
        <form method="POST" class="space-y-4">
            <label class="block">
                <span class="text-sm font-medium">Nome</span>
                <input class="w-full border rounded-lg p-3 mt-1" type="text" id="nome" name="nome" value="<?= htmlspecialchars($categoria["nome"]) ?>">
            </label>
            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg" type="submit">Salvar</button>
                <a class="px-4 py-2 rounded-lg border" href="index.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>