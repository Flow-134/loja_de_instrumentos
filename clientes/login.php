<?php
session_start();
include("../conexao.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $conn->prepare("SELECT * FROM clientes WHERE email = :email AND senha = :senha");
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        if($cliente) {
            $_SESSION['cliente_id'] = $cliente['id'];
            $_SESSION['cliente_nome'] = $cliente['nome'];
            header("Location: index.php");
            exit;
        } else {
            echo "Email ou senha inválidos.";
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Loja de Instrumentos</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-black to-slate-800 flex items-center justify-center">

    <!-- Fundo decorativo -->
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1974')] bg-cover bg-center opacity-20"></div>

    <!-- Card Login -->
    <div class="relative z-10 w-full max-w-md mx-4">
        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">

            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto bg-orange-500 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-guitar text-white text-3xl"></i>
                </div>

                <h1 class="text-3xl font-bold text-white mt-4">
                    Music Store
                </h1>

                <p class="text-gray-300 mt-2">
                    Área do Cliente
                </p>
            </div>

            <form action="" method="post" class="space-y-5">

                <!-- Email -->
                <div>
                    <label class="text-gray-200 text-sm block mb-2">
                        Email
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            type="email"
                            name="email"
                            placeholder="Digite seu email"
                            class="w-full pl-12 pr-4 py-3 bg-white/10 border border-gray-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50"
                        >
                    </div>
                </div>

                <!-- Senha -->
                <div>
                    <label class="text-gray-200 text-sm block mb-2">
                        Senha
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            type="password"
                            name="senha"
                            placeholder="Digite sua senha"
                            class="w-full pl-12 pr-4 py-3 bg-white/10 border border-gray-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50"
                        >
                    </div>
                </div>

                <!-- Botão -->
                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition duration-300 shadow-lg hover:shadow-orange-500/30"
                >
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>
                    Entrar
                </button>

            </form>

            <!-- Rodapé -->
            <div class="mt-6 text-center">
                <p class="text-gray-400 text-sm">
                    🎸 Os melhores instrumentos para músicos apaixonados
                </p>
            </div>

        </div>
    </div>

</body>
</html>