<?php
    require_once __DIR__ . '/../app/Controllers/LinkController.php';

    use Luanavargas\LinkShortener\Controllers\LinkController;

    $linkController = new LinkController();

    //Aqui novamente validamos os dados e chamamos a função de atualizar
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $original = $_POST['original'];

            $updatedLink = $linkController->updateWeb($id, $original);
            $updatedLinkData = json_decode($updatedLink, true);

            if (isset($updatedLinkData['error'])) {
                echo "<div class='alert alert-danger'>Erro: " . $updatedLinkData['error'] . "</div>";
            } else {
                header('Location: /web/listar');
                exit();
            }
        }
    } else {
        echo "<div class='alert alert-danger'>ID não fornecido!</div>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Link</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container py-4">
        <h1 class="mb-4">Editar Link</h1>
        
        <form method="POST">
            <div class="mb-3">
                <label for="original" class="form-label">URL Original</label>
                <input type="url" class="form-control" id="original" name="original" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </body>
</html>
