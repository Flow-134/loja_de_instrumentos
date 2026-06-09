<?php

include("../conexao.php");
include("verificar.php");

$stmt = $conn->prepare("SELECT * FROM clientes");
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
  <body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-slate-100 px-4 py-10">

    <div class="max-w-6xl mx-auto">

        <!-- Cabeçalho -->
        <div class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 p-8 shadow-2xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-white">Clientes</h1>
                    <p class="text-slate-300 mt-1">Gerencie os clientes cadastrados na loja</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                    <a href="../index.php"
                       class="bg-slate-700 hover:bg-slate-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        ← Página Inicial
                    </a>
                    <a href="logout.php"
                       class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-300 text-center">
                        Sair
                    </a>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl overflow-hidden">

            <!-- Barra superior -->
            <div class="px-8 py-5 border-b border-white/10">
                <h2 class="text-xl font-semibold text-white">Lista de Clientes</h2>
            </div>

            <!-- Tabela -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-800 text-slate-100 uppercase text-sm tracking-[0.08em]">
                            <th class="text-left px-8 py-4">ID</th>
                            <th class="text-left px-8 py-4">Nome</th>
                            <th class="text-left px-8 py-4">Último Login</th>
                            <th class="text-center px-8 py-4">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/10">

                        <?php if(count($clientes) > 0): ?>

                            <?php foreach($clientes as $cliente): ?>
                                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                    <td class="px-8 py-5 text-slate-300">#<?= $cliente['id'] ?></td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                                <?= strtoupper(substr($cliente['nome'],0,1)) ?>
                                            </div>
                                            <span class="text-white font-medium"><?= htmlspecialchars($cliente['nome']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-slate-400">Nunca acessou</td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-wrap justify-center gap-3">
                                            <a href="editar.php?id=<?= $cliente['id'] ?>" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-medium transition">Editar</a>
                                            <a href="excluir.php?id=<?= $cliente['id'] ?>" onclick="return confirm('Deseja excluir este cliente?')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="4" class="text-center py-10 text-slate-400">Nenhum cliente cadastrado.</td>
                            </tr>

                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>

        <!-- Rodapé -->
        <div class="mt-6 text-center text-slate-500 text-sm">Sistema de Gestão • Loja de Instrumentos</div>

    </div>

</body>
</html>