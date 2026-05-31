<?php
include("../conexao.php");

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $stmt = $conn->prepare("SELECT * FROM instrumentos WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $instrumento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
        $preco = isset($_POST['preco']) ? $_POST['preco'] : 0;
        $estoque = isset($_POST['estoque']) ? $_POST['estoque'] : 0;
        $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;

        $stmt = $conn->prepare("UPDATE instrumentos SET nome = :nome, marca = :marca, preco = :preco, estoque = :estoque, id_categoria = :id_categoria WHERE id = :id");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':marca', $marca);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':estoque', $estoque);
        $stmt->bindValue(':id_categoria', $id_categoria);
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
    <title>Editar Instrumento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Editar Instrumento</h1>
        <form method="POST" class="space-y-4">
            <label class="block">
                <span class="text-sm font-medium">Nome</span>
                <input class="w-full border rounded-lg p-3 mt-1" type="text" id="nome" name="nome" value="<?= htmlspecialchars($instrumento["nome"]) ?>">
            </label>

            <label class="block">
                <span class="text-sm font-medium">Marca</span>
                <input class="w-full border rounded-lg p-3 mt-1" type="text" id="marca" name="marca" value="<?= htmlspecialchars($instrumento["marca"]) ?>">
            </label>

            <label class="block">
                <span class="text-sm font-medium">Preço</span>
                <input class="w-full border rounded-lg p-3 mt-1" type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($instrumento["preco"]) ?>">
            </label>

            <label class="block">
                <span class="text-sm font-medium">Estoque</span>
                <input class="w-full border rounded-lg p-3 mt-1" type="number" id="estoque" name="estoque" value="<?= htmlspecialchars($instrumento["estoque"]) ?>">
            </label>

            <label class="block">
                <span class="text-sm font-medium">Categoria</span>
                <select class="w-full border rounded-lg p-3 mt-1" id="id_categoria" name="id_categoria">
                    <?php
                    $categoriasStmt = $conn->prepare("SELECT * FROM categorias ORDER BY nome");
                    $categoriasStmt->execute();

                    while ($categoria = $categoriasStmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = $categoria['id'] == $instrumento['id_categoria'] ? 'selected' : '';
                    ?>
                        <option value="<?= $categoria['id'] ?>" <?= $selected ?>><?= htmlspecialchars($categoria['nome']) ?></option>
                    <?php } ?>
                </select>
            </label>

            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg" type="submit">Salvar</button>
                <a class="px-4 py-2 rounded-lg border" href="index.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>