<?php
include("../conexao.php");
include("../clientes/verificar.php");

$isAdmin = ($_SESSION['cliente_role'] ?? 'customer') === 'admin';
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';

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
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-slate-100">

    <div class="max-w-7xl mx-auto py-10 px-4">

        <div class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 p-8 shadow-2xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-white">🎸 Instrumentos</h1>
                    <p class="text-slate-300 mt-2">Gerencie todos os instrumentos cadastrado na loja.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                    <a href="../index.php" class="bg-slate-700 hover:bg-slate-600 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        ← Página Inicial
                    </a>
                    <a href="../clientes/logout.php" class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        Sair
                    </a>
                    <?php if ($isAdmin): ?>
                    <a href="criar.php" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        + Novo Instrumento
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl overflow-hidden">

            <?php if (!empty($success)): ?>
                <div class="p-4 bg-emerald-500/10 border border-emerald-400 text-emerald-100">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="p-4 bg-red-500/10 border border-red-400 text-red-100">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

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
                            <?php if ($isAdmin): ?>
                                <a href="editar.php?id=<?= $instrumento['id'] ?>" class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600">
                                    Editar
                                </a>
                                <a href="excluir.php?id=<?= $instrumento['id'] ?>" onclick="return confirm('Deseja excluir este instrumento?')" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 ml-2">
                                    Excluir
                                </a>
                            <?php else: ?>
                                <?php if ($instrumento['estoque'] > 0): ?>
                                    <form method="post" action="comprar.php" class="inline">
                                        <input type="hidden" name="id" value="<?= $instrumento['id'] ?>">
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                            Comprar
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-red-300">Sem estoque</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>