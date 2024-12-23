<?php
    require_once __DIR__ . '/../app/Controllers/LinkController.php';

    use Luanavargas\LinkShortener\Controllers\LinkController;

    $linkController = new LinkController();

    //Aqui só chamamos a função para apresentar todos os dados do Mongo
 
    $linksJson = $linkController->listarTodos();
    $links = json_decode($linksJson, true);

    if (!is_array($links)) {
        $links = [];
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listar Links</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container py-4">
        <h1 class="mb-4">Links Cadastrados</h1>
        <a href="/web/criar" class="btn btn-primary mb-3">Criar Novo Link</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>URL Original</th>
                    <th>URL Curta</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($links)): ?>
                    <?php foreach ($links as $link): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$link['_id']['$oid']) ?></td>
                            <td><?= htmlspecialchars($link['original']) ?></td>
                            <td><a href="/<?= htmlspecialchars($link['shortened']) ?>" target="_blank"><?= htmlspecialchars($link['shortened']) ?></a></td>
                            <td>
                                <a href="/web/editar/<?= htmlspecialchars((string)$link['_id']['$oid']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="/web/deletar/<?= htmlspecialchars((string)$link['_id']['$oid']) ?>" class="btn btn-danger btn-sm">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum link encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </body>
</html>
