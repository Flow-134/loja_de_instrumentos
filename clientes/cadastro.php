<?php
session_start();
include_once('../conexao.php');

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // Verifica se o email já existe
    $verifica = $conn->prepare("SELECT id FROM clientes WHERE email = :email");
    $verifica->bindValue(':email', $email);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {

        $erro = "Este e-mail já está cadastrado.";

    } else {

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            INSERT INTO clientes (nome, email, senha, role)\
            VALUES (:nome, :email, :senha, 'customer')\
        ");

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaHash);
        $stmt->execute();

        $id = $conn->lastInsertId();

        $_SESSION['cliente_id'] = $id;
        $_SESSION['cliente_nome'] = $nome;

        try {
            $stmtUpdate = $conn->prepare(
                "UPDATE clientes SET last_login = NOW() WHERE id = :id"
            );
            $stmtUpdate->bindValue(':id', $id, PDO::PARAM_INT);
            $stmtUpdate->execute();
        } catch (Exception $e) {
            // ignore
        }

        header('Location: ../index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Loja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800 flex items-center justify-center px-4">
    <div class="w-full max-w-lg">
        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto bg-orange-500 rounded-full flex items-center justify-center shadow-xl">
                    <span class="text-white text-3xl font-bold">+</span>
                </div>
                <h1 class="text-3xl font-bold text-white mt-6">Criar Conta</h1>
                <p class="text-gray-300 mt-2">Cadastre-se como cliente e acesse a loja</p>
            </div>
            <?php if (!empty($erro)): ?>
                <div class="mb-4 bg-red-500/20 border border-red-500 text-red-200 p-3 rounded-xl">
                <?= htmlspecialchars($erro) ?>
                </div>
<?php endif; ?>
            <form action="" method="post" class="space-y-5">
                <div>
                    <label class="text-gray-200 text-sm block mb-2">Nome</label>
                    <input type="text" name="nome" placeholder="Seu nome" class="w-full pl-4 pr-4 py-3 bg-white/10 border border-gray-600 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30" required>
                </div>

                <div>
                    <label class="text-gray-200 text-sm block mb-2">Email</label>
                    <input type="email" name="email" placeholder="Seu email" class="w-full pl-4 pr-4 py-3 bg-white/10 border border-gray-600 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30" required>
                </div>

                <div>
                    <label class="text-gray-200 text-sm block mb-2">Senha</label>
                    <input type="password" name="senha" placeholder="Sua senha" class="w-full pl-4 pr-4 py-3 bg-white/10 border border-gray-600 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30" required>
                </div>

                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-2xl transition duration-300">Criar Conta</button>
            </form>

            <p class="text-center text-sm text-gray-400 mt-6">Já tem conta? <a class="text-orange-400 hover:text-orange-300" href="login.php">Entrar</a></p>
        </div>
    </div>
</body>
</html>