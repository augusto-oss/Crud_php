<?php
require 'config.php';

$id = $_GET['id'];

if ($_POST) {
    $codigo = $_POST['codigo'];
    $modelo = $_POST['modelo'];
    $status = $_POST['status'];

    $sql = $db->prepare("UPDATE bikes SET codigo=:c, modelo=:m, status=:s WHERE id=:id");
    $sql->bindValue(':c', $codigo);
    $sql->bindValue(':m', $modelo);
    $sql->bindValue(':s', $status);
    $sql->bindValue(':id', $id);
    $sql->execute();

    header("Location: index.php?msg=edit_ok");
    exit;
}

$sql = $db->prepare("SELECT * FROM bikes WHERE id = :id");
$sql->bindValue(':id', $id);
$sql->execute();
$bike = $sql->fetch();
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

                <div class="mb-3">
                    <label>Código</label>
                    <input type="text" name="codigo" class="form-control" value="<?= $bike['codigo'] ?>">
                </div>

                <div class="mb-3">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="<?= $bike['modelo'] ?>">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="disponivel" <?= $bike['status']=='disponivel'?'selected':'' ?>>Disponível</option>
                        <option value="alugada" <?= $bike['status']=='alugada'?'selected':'' ?>>Alugada</option>
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