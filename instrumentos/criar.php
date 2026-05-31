<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $preco = isset($_POST['preco']) ? $_POST['preco'] : 0;
    $estoque = isset($_POST['estoque']) ? $_POST['estoque'] : 0;
    $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;

    $stmt = $conn->prepare("INSERT INTO instrumentos (nome, marca, preco, estoque, id_categoria) VALUES (:nome, :marca, :preco, :estoque, :id_categoria)");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':marca', $marca);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':estoque', $estoque);
    $stmt->bindValue(':id_categoria', $id_categoria);
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
    <title>Novo Instrumento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl p-8">

        <h1 class="text-3xl font-bold text-center text-slate-800 mb-6">
            🎸 Cadastrar Instrumento
        </h1>

        <form method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nome
                </label>
                <input
                    type="text"
                    name="nome"
                    placeholder="Ex: Guitarra Stratocaster"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Marca
                </label>
                <input
                    type="text"
                    name="marca"
                    placeholder="Ex: Fender"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Preço
                </label>
                <input
                    type="number"
                    step="0.01"
                    name="preco"
                    placeholder="0.00"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Estoque
                </label>
                <input
                    type="number"
                    name="estoque"
                    placeholder="Quantidade disponível"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Categoria
                </label>

                <select
                    name="id_categoria"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-orange-500">

                    <?php
                    $stmt = $conn->prepare("SELECT * FROM categorias");
                    $stmt->execute();

                    while($categoria = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <option value="<?= $categoria['id'] ?>">
                            <?= $categoria['nome'] ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-lg">

                Salvar Instrumento

            </button>

        </form>

    </div>

</body>
</html>