<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../app/Controllers/LinkController.php';

    use Luanavargas\LinkShortener\Controllers\LinkController;

    //Aqui vai validar os dados e chamar a função para criar

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['original']) && !empty($_POST['original'])) {
            $original = trim($_POST['original']);

            $linkController = new LinkController();
            ob_start();
            $linkController->createWeb();
            $output = ob_get_clean();

            $response = json_decode($output, true);

            if (isset($response['shortened'])) {
                header('Location: /web/listar');
                exit();
            } else {
                $error = $response['error'] ?? 'Erro desconhecido ao criar o link.';
            }
        } else {
            $error = 'A URL original é obrigatória.';
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Criar Link</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container py-4">
        <h1 class="mb-4">Criar Novo Link</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="original" class="form-label">URL Original</label>
                <input type="url" class="form-control" id="original" name="original" placeholder="Digite a URL original" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </body>
</html>