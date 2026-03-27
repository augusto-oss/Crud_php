<?php
require 'config.php';

if (!empty($_GET['del'])) {
    $id = $_GET['del'];

    $sql = $db->prepare("DELETE FROM contatos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    header("Location: index.php?msg=del_ok");
    exit;
}

$lista = $db->query("SELECT * FROM contatos")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de contato</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar bg-dark navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">SISTEMA DE CONTATO</span>
        </div>
    </nav>

    <div class="container">

        <!-- ALERTA -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'del_ok'): ?>
            <div  id="alert-Msg" class="alert alert-danger mt-4">Contato removido</div>
        <?php endif; ?>

        <a href="adicionar.php" class="btn btn-secondary mt-3">Adicionar Contato</a>

        <!-- Listagem Inicio -->
        <table class="table text-center table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider align-middle">

                <?php foreach ($lista as $item): ?>
                    <tr>
                        <th scope="row"><?= $item['id']; ?></th>
                        <td><?= $item['nome']; ?></td>
                        <td><?= $item['email']; ?></td>
                        <td>
                            <a href="editar.php?id=<?= $item['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?del=<?= $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <!-- Listagem Final -->

    </div>

    <footer>
        <nav class="navbar">
            <div class="container-fluid">
                <span class="navbar mx-auto">&copy; Todos os direitos reservados</span>
            </div>
        </nav>
    </footer>

    <script >
        const alertMsg = document.getElementById('alert-Msg')

        if(alertMsg){
            setTimeout(() => {
                alertMsg.style.display= 'none';
            }, 3000);
        }
    </script>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>