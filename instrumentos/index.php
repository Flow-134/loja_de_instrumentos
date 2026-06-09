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
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800 text-slate-100">

    <div class="fixed inset-0 bg-[url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1974')] bg-cover bg-center opacity-10"></div>

    <nav class="relative z-10 bg-black/30 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">🎸 Music Store</h1>
                <p class="text-sm text-gray-400">Controle de instrumentos</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="../index.php" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition duration-300">Página Inicial</a>
                <a href="../clientes/logout.php" class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white transition duration-300">Sair</a>
                <?php if ($isAdmin): ?>
                    <a href="criar.php" class="px-4 py-2 rounded-xl bg-orange-500 hover:bg-orange-600 text-white transition duration-300">+ Novo Instrumento</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-7xl mx-auto p-6 sm:p-8">
        <section class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h2 class="text-4xl font-bold text-white">🎸 Instrumentos</h2>
                    <p class="mt-2 text-slate-300">Gerencie os instrumentos cadastrados na loja.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full sm:w-auto">
                    <a href="../index.php" class="px-5 py-3 rounded-2xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-center transition duration-300">Página Inicial</a>
                    <a href="../clientes/logout.php" class="px-5 py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-semibold text-center transition duration-300">Sair</a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden">
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

            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-800 text-white">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Nome</th>
                            <th class="p-4">Marca</th>
                            <th class="p-4">Preço</th>
                            <th class="p-4">Estoque</th>
                            <th class="p-4">Categoria</th>
                            <th class="p-4 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-950/80 text-slate-100">
                        <?php while($instrumento = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr class="border-b border-white/10 hover:bg-slate-900/80 transition-colors duration-200">
                                <td class="p-4"><?= $instrumento['id'] ?></td>
                                <td class="p-4 font-medium"><?= htmlspecialchars($instrumento['nome']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($instrumento['marca']) ?></td>
                                <td class="p-4 text-green-400 font-semibold">R$ <?= number_format($instrumento['preco'], 2, ',', '.') ?></td>
                                <td class="p-4"><?= htmlspecialchars($instrumento['estoque']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($instrumento['categoria']) ?></td>
                                <td class="p-4 text-center space-x-2">
                                    <?php if ($isAdmin): ?>
                                        <a href="editar.php?id=<?= $instrumento['id'] ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition duration-200">Editar</a>
                                        <a href="excluir.php?id=<?= $instrumento['id'] ?>" onclick="return confirm('Deseja excluir este instrumento?')" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition duration-200">Excluir</a>
                                    <?php else: ?>
                                        <?php if ($instrumento['estoque'] > 0): ?>
                                            <form method="post" action="comprar.php" class="inline">
                                                <input type="hidden" name="id" value="<?= $instrumento['id'] ?>">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">Comprar</button>
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
        </section>
    </main>
</body>
</html>