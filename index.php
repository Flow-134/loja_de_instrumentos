<?php
include("conexao.php");
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header("Location: clientes/login.php");
    exit;
}


$totalInstrumentos = $conn->query("SELECT COUNT(*) FROM instrumentos")->fetchColumn();

$totalCategorias = $conn->query("SELECT COUNT(*) FROM categorias")->fetchColumn();

$totalClientes = $conn->query("SELECT COUNT(*) FROM clientes")->fetchColumn();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Loja de Instrumentos</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800">

    <!-- Imagem de fundo -->
    <div class="fixed inset-0 bg-[url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1974')] bg-cover bg-center opacity-10"></div>

    <!-- Navbar -->
    <nav class="relative z-10 bg-black/30 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-3xl font-bold text-white">
                🎸 Music Store
            </h1>

            <div class="text-right">
                <p class="text-gray-300"> Olá, <span class="font-semibold text-orange-400"><?= $_SESSION['cliente_nome'] ?? 'Visitante' ?></span> </p>

                <p class="text-sm text-gray-400">
                    Painel Administrativo
                </p>
            </div>

        </div>
    </nav>

    <!-- Conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto p-8">
        

        <!-- Título -->
        <div class="mb-10">
            <h2 class="text-5xl font-bold text-white mb-2">
                Dashboard
            </h2>

            <p class="text-gray-400">
                Gerencie sua loja de instrumentos musicais.
            </p>
        </div>

        <!-- Estatísticas -->
        <div class="grid md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-xl">
                <div class="text-5xl mb-3">🎸</div>

                <h3 class="text-gray-300 text-lg">
                    Instrumentos
                </h3>

                <p class="text-4xl font-bold text-orange-400">
                    <?= $totalInstrumentos ?>
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-xl">
                <div class="text-5xl mb-3">📂</div>

                <h3 class="text-gray-300 text-lg">
                    Categorias
                </h3>

                <p class="text-4xl font-bold text-orange-400">
                    <?= $totalCategorias ?>
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-xl">
                <div class="text-5xl mb-3">👥</div>

                <h3 class="text-gray-300 text-lg">
                    Clientes
                </h3>

                <p class="text-4xl font-bold text-orange-400">
                    <?= $totalClientes ?>
                </p>
            </div>

        </div>

        <!-- Menu -->
        <div class="grid md:grid-cols-3 gap-8">

            <!-- Instrumentos -->
            <a href="instrumentos/index.php">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 hover:scale-105 hover:border-orange-500 transition-all duration-300 shadow-xl">

                    <div class="text-6xl mb-5">
                        🎸
                    </div>

                    <h3 class="text-2xl font-bold text-white">
                        Instrumentos
                    </h3>

                    <p class="text-gray-400 mt-3">
                        Cadastre, edite e remova instrumentos da loja.
                    </p>

                </div>
            </a>

            <!-- Categorias -->
            <a href="categorias/index.php">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 hover:scale-105 hover:border-orange-500 transition-all duration-300 shadow-xl">

                    <div class="text-6xl mb-5">
                        📂
                    </div>

                    <h3 class="text-2xl font-bold text-white">
                        Categorias
                    </h3>

                    <p class="text-gray-400 mt-3">
                        Organize os produtos por categoria.
                    </p>

                </div>
            </a>

            <!-- Clientes -->
            <a href="clientes/index.php">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 hover:scale-105 hover:border-orange-500 transition-all duration-300 shadow-xl">

                    <div class="text-6xl mb-5">
                        👥
                    </div>

                    <h3 class="text-2xl font-bold text-white">
                        Clientes
                    </h3>

                    <p class="text-gray-400 mt-3">
                        Gerencie os clientes cadastrados.
                    </p>

                </div>
            </a>

        </div>

        <!-- Rodapé -->
        <div class="text-center mt-12 text-gray-500">
            🎵 Sistema de Gerenciamento da Loja de Instrumentos
        </div>

    </div>

</body>
</html>