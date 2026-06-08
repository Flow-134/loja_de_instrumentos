<?php

include("../conexao.php");
include("../clientes/verificar.php");

$isAdmin = ($_SESSION['cliente_role'] ?? 'customer') === 'admin';

$stmt = $conn->prepare("SELECT * FROM categorias");
$stmt->execute();
$resultado = $stmt;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Categorias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-slate-100 px-4 py-10">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 p-8 shadow-2xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-white">📂 Categorias</h1>
                    <p class="text-slate-300 mt-2">Gerencie as categorias de instrumentos disponíveis na loja.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 items-stretch">
                    <a href="../index.php" class="bg-slate-700 hover:bg-slate-600 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        ← Página Inicial
                    </a>
                    <a href="../clientes/logout.php" class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        Sair
                    </a>
                    <a href="criar.php" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        + Nova Categoria
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl overflow-hidden p-6">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-800 text-slate-100 text-sm uppercase tracking-[0.1em]">
                            <th class="p-4 text-left">ID</th>
                            <th class="p-4 text-left">Nome</th>
                            <th class="p-4 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">

                        <?php while($categoria = $resultado->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                <td class="p-4 text-slate-200">#<?= $categoria['id'] ?></td>
                                <td class="p-4 text-white"><?= htmlspecialchars($categoria['nome']) ?></td>
                                <td class="p-4 text-center">
                                    <?php if ($isAdmin): ?>
                                    <div class="flex justify-center gap-3">
                                        <a href="editar.php?id=<?= $categoria['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">Editar</a>
                                        <a href="excluir.php?id=<?= $categoria['id'] ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition" onclick="return confirm('Deseja excluir esta categoria?')">Excluir</a>
                                    </div>
                                    <?php else: ?>
                                    <span class="text-slate-300">Acesso restrito</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>