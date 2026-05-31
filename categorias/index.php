<?php
include("../conexao.php");

$sql = $conn->prepare("SELECT * FROM categorias");
$sql->execute();
$resultado = $sql;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>categorias</h1>

    <a href="criar.php">Nova Categoria</a>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>

        <?php while($categoria = $resultado->fetch_assoc()) { ?>

        <tr>
            <td><?= $categoria["id"] ?></td>
            <td><?= $categoria["nome"] ?></td>
            <td>
                <a href="editar.php?id=<?= $categoria['id'] ?>">Editar</a>

                <a href="editar.php?id=<?= $categoria['id'] ?>">Excluir</a>
            </td>
        </tr>
        <?php } ?>

    </table>
</body>
</html>