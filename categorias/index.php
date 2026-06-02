<?php

include("../conexao.php");
include("../clientes/verificar.php");

$stmt = $conn->prepare("SELECT * FROM categorias");
$stmt->execute();
$resultado = $stmt;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Categorias</title>
</head>
<body class="bg-orange-300 min-h-screen p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-black-600">
            Categorias
        </h1>

        <a href="criar.php"
           class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Nova Categoria
        </a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Nome</th>
                <th class="p-3 text-center">Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php while($categoria = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>

<tr class="border-b hover:bg-gray-50">

    <td class="p-3">
        <?= $categoria['id'] ?>
    </td>

    <td class="p-3">
        <?= $categoria['nome'] ?>
    </td>

    <td class="p-3 text-center">

        <a href="editar.php?id=<?= $categoria['id'] ?>"
           class="bg-yellow-500 text-white px-3 py-1 rounded">
            Editar
        </a>

        <a href="excluir.php?id=<?= $categoria['id'] ?>"
           class="bg-red-600 text-white px-3 py-1 rounded"
           onclick="return confirm('Deseja excluir esta categoria?')">
            Excluir
        </a>

    </td>

</tr>

<?php } ?>
    </tbody>
    </table>

</div>
</body>
</html>