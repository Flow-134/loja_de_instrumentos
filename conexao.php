<?php

$conn = new PDO(
    "mysql:host=mysql;port=3306;dbname=loja_instrumentos;charset=utf8mb4",
    "root",
    "senha_root_123"
);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $conn->exec("ALTER TABLE clientes ADD COLUMN role VARCHAR(20) NOT NULL DEFAULT 'customer'");
} catch (PDOException $e) {
    // Ignore if column already exists or schema changes are not needed
}

try {
    $stmtAdmin = $conn->query("SELECT id FROM clientes WHERE role = 'admin' LIMIT 1");
    if (!$stmtAdmin->fetch(PDO::FETCH_ASSOC)) {
        $senhaHash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO clientes (nome, email, senha, role) VALUES (:nome, :email, :senha, 'admin')");
        $stmt->bindValue(':nome', 'Administrador');
        $stmt->bindValue(':email', 'admin@loja.com');
        $stmt->bindValue(':senha', $senhaHash);
        $stmt->execute();
    }
} catch (PDOException $e) {
    // Ignore if table or columns are not ready yet
}
