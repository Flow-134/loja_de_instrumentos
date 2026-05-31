<?php
include("../conexao.php");

$stmt = $conn->prepare("SELECT instrumentos.*,categorias.nome AS categoria FROM instrumentos LEFT JOIN categorias
    ON instrumentos.id_categoria = categorias.id
");

$stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Instrumentos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <div class="max-w-7xl mx-auto py-10 px-4">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-slate-800">
                🎸 Instrumentos
            </h1>

            <a href="criar.php"
               class="bg-orange-600 text-white px-5 py-3 rounded-lg shadow hover:bg-orange-700 transition">
                + Novo Instrumento
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Nome</th>
                        <th class="p-4 text-left">Marca</th>
                        <th class="p-4 text-left">Preço</th>
                        <th class="p-4 text-left">Estoque</th>
                        <th class="p-4 text-left">Categoria</th>
                        <th class="p-4 text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($instrumento = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>

                    <tr class="border-b hover:bg-slate-50">

                        <td class="p-4">
                            <?= $instrumento['id'] ?>
                        </td>

                        <td class="p-4 font-medium">
                            <?= $instrumento['nome'] ?>
                        </td>

                        <td class="p-4">
                            <?= $instrumento['marca'] ?>
                        </td>

                        <td class="p-4 text-green-600 font-semibold">
                            R$ <?= number_format($instrumento['preco'], 2, ',', '.') ?>
                        </td>

                        <td class="p-4">
                            <?= $instrumento['estoque'] ?>
                        </td>

                        <td class="p-4">
                            <?= $instrumento['categoria'] ?>
                        </td>

                        <td class="p-4 text-center">

                            <a href="editar.php?id=<?= $instrumento['id'] ?>"
                               class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600">
                                Editar
                            </a>

                            <a href="excluir.php?id=<?= $instrumento['id'] ?>"
                               onclick="return confirm('Deseja excluir este instrumento?')"
                               class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 ml-2">
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>