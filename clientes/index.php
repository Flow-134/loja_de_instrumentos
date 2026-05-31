<?php

include("../conexao.php");

$stmt = $conn->prepare("SELECT * FROM clientes");
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAgina inicial</title>
</head>
<body>
    <h1>clientes</h1>

    <a href="criar.php">Novo Cliente</a>

    <table border="1">
        <tr>
            <th>id</th>
            ?>
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Clientes</title>
                <script src="https://cdn.tailwindcss.com"></script>
            </head>
            <body class="bg-slate-100 min-h-screen">
                <div class="max-w-4xl mx-auto py-10 px-4">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-slate-800">Clientes</h1>
                        <a href="criar.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Novo Cliente</a>
                    </div>

                    <div class="bg-white rounded-xl shadow p-4">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Nome</th>
                                    <th class="p-3 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($cliente = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3"><?= $cliente["id"] ?></td>
                                    <td class="p-3"><?= $cliente["nome"] ?></td>
                                    <td class="p-3 text-center">
                                        <a href="editar.php?id=<?= $cliente['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                                        <a href="excluir.php?id=<?= $cliente['id'] ?>" class="bg-red-600 text-white px-3 py-1 rounded ml-2">Excluir</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </body>
            </html>