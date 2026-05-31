<?php
require_once "conexao.php";

if ($_SERVER[REQUEST_METHOD] == "POST") {

    $nome = $_POST['nome'];

    $sql = $conn->prepare("INSERT INTO categorias(nome) VALUES (':nome')");
    $query->bindValue(':nome' , $nome);
    $conn->execute($sql);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="nome" placeholder="Nome da categoria">
        <button type="submit">Salvar</button>
        
    </form>
</body>
</html>