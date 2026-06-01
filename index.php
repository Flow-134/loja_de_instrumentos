<?php
include("conexao.php");

$totalInstrumentos = $conn->query(
    "SELECT COUNT(*) FROM instrumentos"
)->fetchColumn();

$totalCategorias = $conn->query(
    "SELECT COUNT(*) FROM categorias"
)->fetchColumn();

$totalClientes = $conn->query(
    "SELECT COUNT(*) FROM clientes"
)->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Loja de Instrumentos</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <!-- Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">

            <h1 class="text-2xl font-bold">
                🎸 Loja de Instrumentos
            </h1>

            <span class="text-slate-300">
                Painel Administrativo
            </span>

        </div>

    </nav>

    <!-- Conteúdo -->
    <div class="max-w-7xl mx-auto p-8">

        <h2 class="text-4xl font-bold text-slate-800 mb-8">
            Dashboard
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            <!-- Instrumentos -->
            <a href="instrumentos/index.php">

                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">

                    <div class="text-5xl mb-4">
                        🎸
                    </div>

                    <h3 class="text-2xl font-bold text-slate-800">
                        Instrumentos
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Gerenciar instrumentos da loja.
                    </p>

                </div>

            </a>

            <!-- Categorias -->
            <a href="categorias/index.php">

                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">

                    <div class="text-5xl mb-4">
                        📂
                    </div>

                    <h3 class="text-2xl font-bold text-slate-800">
                        Categorias
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Gerenciar categorias.
                    </p>

                </div>

            </a>

            <!-- Clientes -->
            <a href="clientes/index.php">

                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">

                    <div class="text-5xl mb-4">
                        👥
                    </div>

                    <h3 class="text-2xl font-bold text-slate-800">
                        Clientes
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Gerenciar clientes.
                    </p>

                </div>

            </a>

        </div>

    </div>

</body>

</html>