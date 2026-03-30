<?php
require 'config.php';

$codigo = $_POST['codigo'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$status = $_POST['status'] ?? 'disponivel';

if ($codigo && $modelo) {
    $sql = $db->prepare("INSERT INTO bikes (codigo, modelo, status) VALUES (:c, :m, :s)");
    $sql->bindValue(':c', $codigo);
    $sql->bindValue(':m', $modelo);
    $sql->bindValue(':s', $status);
    $sql->execute();

    header("Location: index.php?msg=add_ok");
    exit;
}
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