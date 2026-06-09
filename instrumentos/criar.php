<?php
include("../conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $preco = isset($_POST['preco']) ? $_POST['preco'] : 0;
    $estoque = isset($_POST['estoque']) ? $_POST['estoque'] : 0;
    $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;

    $stmt = $conn->prepare("INSERT INTO instrumentos (nome, marca, preco, estoque, id_categoria) VALUES (:nome, :marca, :preco, :estoque, :id_categoria)");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':marca', $marca);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':estoque', $estoque);
    $stmt->bindValue(':id_categoria', $id_categoria);
    $stmt->execute();

    header('Location: index.php');
    exit;

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Instrumento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800 text-slate-100">

    <div class="fixed inset-0 bg-[url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1974')] bg-cover bg-center opacity-10"></div>

    <nav class="relative z-10 bg-black/30 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">🎸 Music Store</h1>
                <p class="text-sm text-gray-400">Cadastrar novo instrumento</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="../index.php" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition duration-300">Página Inicial</a>
                <a href="index.php" class="px-4 py-2 rounded-xl bg-orange-500 hover:bg-orange-600 text-white transition duration-300">Voltar para Instrumentos</a>
            </div>
        </div>
    </nav>

    <main class="relative z-10 max-w-4xl mx-auto p-6 sm:p-8">
        <section class="mb-8 rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <div class="flex flex-col gap-4">
                <div>
                    <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold text-xs">Cadastro</p>
                    <h2 class="mt-3 text-4xl font-bold text-white">Novo Instrumento</h2>
                    <p class="mt-2 text-slate-300">Insira os dados para adicionar um instrumento ao catálogo.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-3xl bg-slate-950/70 border border-white/10 p-6">
                        <p class="text-4xl">🎸</p>
                        <p class="mt-4 text-slate-300">Use um título claro e escolha a categoria correta para facilitar a organização.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-950/70 border border-white/10 p-6">
                        <p class="text-4xl">📦</p>
                        <p class="mt-4 text-slate-300">Defina o preço e o estoque disponível para manter o sistema atualizado.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl p-8">
            <form method="POST" class="space-y-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-200 mb-2">Nome do instrumento</label>
                    <input
                        type="text"
                        name="nome"
                        placeholder="Ex: Guitarra Stratocaster"
                        class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Marca</label>
                        <input
                            type="text"
                            name="marca"
                            placeholder="Ex: Fender"
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Categoria</label>
                        <select
                            name="id_categoria"
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM categorias");
                            $stmt->execute();

                            while($categoria = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Preço</label>
                        <input
                            type="number"
                            step="0.01"
                            name="preco"
                            placeholder="0,00"
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-200 mb-2">Estoque</label>
                        <input
                            type="number"
                            name="estoque"
                            placeholder="Quantidade disponível"
                            class="w-full rounded-2xl border border-white/20 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        type="submit"
                        class="flex-1 rounded-2xl bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 transition duration-300 shadow-xl">
                        Salvar Instrumento
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