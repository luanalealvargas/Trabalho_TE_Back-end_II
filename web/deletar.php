<?php
    require_once __DIR__ . '/../app/Controllers/LinkController.php';

    use Luanavargas\LinkShortener\Controllers\LinkController;

    $linkController = new LinkController();

    // Aqui vamos validar o ID e chamar a função delete
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $deleteResult = $linkController->delete($id);

        if ($deleteResult) {
            header('Location: /web/listar');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Erro ao deletar o link. O link não foi encontrado.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>ID não fornecido!</div>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deletar Link</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container py-4">
        <h1 class="mb-4">Deletar Link</h1>
        <p>Você tem certeza que deseja deletar este link?</p>
        <form action="/links/<?= htmlspecialchars($id) ?>" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">Deletar</button>
            <a href="/web/listar" class="btn btn-secondary">Cancelar</a>
        </form>
    </body>
</html>
