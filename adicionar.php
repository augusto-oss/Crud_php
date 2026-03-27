<?php require 'config.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');

$error = '';

if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $check = $db->prepare("SELECT id FROM contatos WHERE email = :email");
    $check->bindValue(':email', $email);
    $check->execute();

    if ($check->rowCount() == 0) {

        $sql = $db->prepare("INSERT INTO contatos (nome, email) VALUES (:nome, :email)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->execute();

        header("Location: index.php");
        exit();

    } else {
        $error = 'Email já existe';
    }

} else {
    $error = 'Preencha corretamente os campos';
}


 

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

    <div class="container mt-3">

        <?php if($error): ?>
            <div class="alert alert-warning"><?=$error; ?></div>
        <?php endif; ?>

        <h3>Adicionar</h3>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
    <footer>
        <nav class="navbar">
            <div class="container-fluid">
                <span class="navbar mx-auto">&copy; Todos os direitos reservados</span>
            </div>
        </nav>
    </footer>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>