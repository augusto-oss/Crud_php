<?php
require 'config.php';

$id = $_GET['id']; // pega o id da URL

if ($_POST) { // se o form foi enviado
    $codigo = $_POST['codigo']; // recebe codigo
    $modelo = $_POST['modelo']; // recebe modelo
    $status = $_POST['status']; // recebe status

    $sql = $db->prepare("UPDATE bikes SET codigo=:c, modelo=:m, status=:s WHERE id=:id"); // prepara update
    $sql->bindValue(':c', $codigo); // vincula codigo
    $sql->bindValue(':m', $modelo); // vincula modelo
    $sql->bindValue(':s', $status); // vincula status
    $sql->bindValue(':id', $id); // vincula id
    $sql->execute(); // executa no banco

    header("Location: index.php?msg=edit_ok"); // redireciona
    exit; // encerra execução
}

$sql = $db->prepare("SELECT * FROM bikes WHERE id = :id"); // prepara select
$sql->bindValue(':id', $id); // vincula id
$sql->execute(); // executa consulta
$bike = $sql->fetch(); // pega resultado
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Bike</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow col-md-6 mx-auto">
            <div class="card-header bg-warning text-center">
                ✏️ Editar Bike
            </div>

            <div class="card-body">

                <form method="POST">

                    <div class="mb-3"> <!-- campo codigo -->
                        <label>Código</label> <!-- label do campo -->
                        <input type="text" name="codigo" class="form-control" value="<?= $bike['codigo'] ?>">
                        <!-- mostra codigo atual -->
                    </div>

                    <div class="mb-3"> <!-- campo modelo -->
                        <label>Modelo</label> <!-- label do campo -->
                        <input type="text" name="modelo" class="form-control" value="<?= $bike['modelo'] ?>">
                        <!-- mostra modelo atual -->
                    </div>

                    <div class="mb-3"> <!-- campo status -->
                        <label>Status</label> <!-- label do campo -->
                        <select name="status" class="form-select"> <!-- select de status -->
                            <option value="disponivel" <?= $bike['status'] == 'disponivel' ? 'selected' : '' ?>>Disponível
                            </option> <!-- seleciona se for disponivel -->
                            <option value="alugada" <?= $bike['status'] == 'alugada' ? 'selected' : '' ?>>Alugada</option>
                            <!-- seleciona se for alugada -->
                        </select>
                    </div>

                    <button class="btn btn-primary w-100">Salvar</button>
                    <a href="index.php" class="btn btn-secondary w-100 mt-2">Voltar</a>

                </form>

            </div>
        </div>

    </div>

</body>

</html>