<?php
include("../conexao.php");

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $stmt = $conn->prepare("SELECT * FROM instrumentos WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $instrumento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
        $preco = isset($_POST['preco']) ? $_POST['preco'] : 0;
        $estoque = isset($_POST['estoque']) ? $_POST['estoque'] : 0;
        $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;

        $stmt = $conn->prepare("UPDATE instrumentos SET nome = :nome, marca = :marca, preco = :preco, estoque = :estoque, id_categoria = :id_categoria WHERE id = :id");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':marca', $marca);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':estoque', $estoque);
        $stmt->bindValue(':id_categoria', $id_categoria);
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
    <title>Editar Instrumento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800 text-slate-100">

    <div class="fixed inset-0 bg-[url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1974')] bg-cover bg-center opacity-10"></div>

    <nav class="relative z-10 bg-black/30 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">🎸 Music Store</h1>
                <p class="text-sm text-gray-400">Editar dados do instrumento</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="../index.php" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition duration-300">Página Inicial</a>
                <a href="index.php" class="px-4 py-2 rounded-xl bg-orange-500 hover:bg-orange-600 text-white transition duration-300">Voltar para Instrumentos</a>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-4xl mx-auto p-6 sm:p-8">
        <section class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <div>
                <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold text-xs">Editar</p>
                <h2 class="mt-3 text-4xl font-bold text-white">Instrumento</h2>
                <p class="mt-2 text-slate-300">Atualize os dados do instrumento e salve para aplicar na loja.</p>
            </div>
        </section>

        <section class="rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">Nome do instrumento</label>
                    <input
                        class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        type="text"
                        id="nome"
                        name="nome"
                        value="<?= htmlspecialchars($instrumento["nome"]) ?>"
                        required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Marca</label>
                        <input
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            type="text"
                            id="marca"
                            name="marca"
                            value="<?= htmlspecialchars($instrumento["marca"]) ?>"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Categoria</label>
                        <select
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            id="id_categoria"
                            name="id_categoria"
                            required>
                            <?php
                            $categoriasStmt = $conn->prepare("SELECT * FROM categorias ORDER BY nome");
                            $categoriasStmt->execute();

                            while ($categoria = $categoriasStmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $categoria['id'] == $instrumento['id_categoria'] ? 'selected' : '';
                            ?>
                                <option value="<?= $categoria['id'] ?>" <?= $selected ?>><?= htmlspecialchars($categoria['nome']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Preço</label>
                        <input
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            type="number"
                            step="0.01"
                            id="preco"
                            name="preco"
                            value="<?= htmlspecialchars($instrumento["preco"]) ?>"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Estoque</label>
                        <input
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            type="number"
                            id="estoque"
                            name="estoque"
                            value="<?= htmlspecialchars($instrumento["estoque"]) ?>"
                            required>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        type="submit"
                        class="flex-1 rounded-2xl bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 transition duration-300 shadow-xl">
                        Salvar Alterações
                    </button>
                    <a href="index.php" class="flex-1 text-center rounded-2xl border border-white/20 text-white py-3 hover:bg-white/5 transition duration-300">
                        Cancelar
                    </a>
                </div>
            </form>
        </section>
    </main>

</body>
</html>