<?php
require 'config.php';

if (!empty($_GET['del'])) {
    $id = $_GET['del'];
    $sql = $db->prepare("DELETE FROM bikes WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    header("Location: index.php?msg=del_ok");
    exit;
}

$lista = $db->query("SELECT * FROM bikes")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Locadora de Bikes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand mx-auto fw-bold">
            LOCADORA DE BIKES
        </span>
    </div>
</nav>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0">Bikes cadastradas</h5>
            <a href="adicionar.php" class="btn btn-success btn-sm">+ Nova Bike</a>
        </div>

        <div class="card-body">

<?php if(isset($_GET['msg'])): ?>

    <?php if($_GET['msg'] == 'add_ok'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Bike adicionada com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['msg'] == 'edit_ok'): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            ✏️ Bike atualizada com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['msg'] == 'del_ok'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            🗑️ Bike removida com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

<?php endif; ?>

            <table class="table table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Modelo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($lista as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['codigo'] ?></td>
                        <td><?= $item['modelo'] ?></td>

                        <td>
                            <?php if($item['status'] == 'disponivel'): ?>
                                <span class="badge bg-success">Disponível</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Alugada</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="editar.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?del=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<script>
setTimeout(() => {
    const alert = document.querySelector('.alert');
    if(alert){
        alert.style.display = 'none';
    }
}, 3000);
</script>

</body>
</html>