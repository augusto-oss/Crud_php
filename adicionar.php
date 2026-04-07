<?php
require 'config.php';

$id = $_GET['id']; // pega o id pela URL

if ($_POST) { // verifica se o formulário foi enviado
    $codigo = $_POST['codigo']; // pega o codigo do form
    $modelo = $_POST['modelo']; // pega o modelo do form
    $status = $_POST['status']; // pega o status do form

    $sql = $db->prepare("UPDATE bikes SET codigo=:c, modelo=:m, status=:s WHERE id=:id"); // prepara o update
    $sql->bindValue(':c', $codigo); // associa codigo
    $sql->bindValue(':m', $modelo); // associa modelo
    $sql->bindValue(':s', $status); // associa status
    $sql->bindValue(':id', $id); // associa id
    $sql->execute(); // executa update no banco

    header("Location: index.php?msg=edit_ok"); // redireciona com mensagem
    exit; // encerra o script
}

$sql = $db->prepare("SELECT * FROM bikes WHERE id = :id"); // prepara select
$sql->bindValue(':id', $id); // associa id
$sql->execute(); // executa busca
$bike = $sql->fetch(); // pega os dados da bike
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Adicionar Bike</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow col-md-6 mx-auto">
            <div class="card-header bg-primary text-white text-center">
                🚲 Adicionar Bike
            </div>

            <div class="card-body">

                <?php if ($erro): ?> <!-- Mostrar  mensagem de erro -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $erro ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label>Código</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Modelo</label>
                        <input type="text" name="modelo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="disponivel">Disponível</option>
                            <option value="alugada">Alugada</option>
                        </select>
                    </div>

                    <button class="btn btn-success w-100">Salvar</button>
                    <a href="index.php" class="btn btn-secondary w-100 mt-2">Voltar</a>

                </form>

            </div>
        </div>

    </div>

</body>

</html>