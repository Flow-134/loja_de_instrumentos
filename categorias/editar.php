<?php
include("../conexao.php");

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $stmt = $conn->prepare("SELECT * FROM categorias WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

        $stmt = $conn->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800 text-slate-100">

    <div class="fixed inset-0 bg-[url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1974')] bg-cover bg-center opacity-10"></div>

    <nav class="relative z-10 bg-black/30 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">🎸 Music Store</h1>
                <p class="text-sm text-gray-400">Editar categoria</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="../index.php" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition duration-300">Página Inicial</a>
                <a href="index.php" class="px-4 py-2 rounded-xl bg-orange-500 hover:bg-orange-600 text-white transition duration-300">Voltar para Categorias</a>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-4xl mx-auto p-6 sm:p-8">
        <section class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <div>
                <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold text-xs">Editar Categoria</p>
                <h2 class="mt-3 text-4xl font-bold text-white">Atualizar Categoria</h2>
                <p class="mt-2 text-slate-300">Modifique o nome da categoria e salve as alterações.</p>
            </div>
        </section>

        <section class="rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2" for="nome">Nome da categoria</label>
                    <input
                        class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        type="text"
                        id="nome"
                        name="nome"
                        value="<?= htmlspecialchars($categoria["nome"]) ?>"
                        required>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="flex-1 rounded-2xl bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 transition duration-300 shadow-xl">Salvar</button>
                    <a href="index.php" class="flex-1 text-center rounded-2xl border border-white/20 text-white py-3 hover:bg-white/5 transition duration-300">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>