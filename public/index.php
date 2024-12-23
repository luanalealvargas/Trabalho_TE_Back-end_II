<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../app/Controllers/LinkController.php';
    require_once __DIR__ . '/../app/Models/Link.php';
    require_once __DIR__ . '/../app/Config/Database.php';

    use Luanavargas\LinkShortener\Controllers\LinkController;

    $linkController = new LinkController();
    $requestUri = $_SERVER['REQUEST_URI'];

    //Aqui são as rotas para as requisições no Insomnia ou Postman
    if (strpos($requestUri, '/links') === 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($requestUri === '/links') {
                echo $linkController->listarTodos();
            } elseif (preg_match('/^\/links\/(\w+)$/', $requestUri, $matches)) {
                echo $linkController->find($matches[1]);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $linkController->create();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if (preg_match('/^\/links\/(\w+)$/', $requestUri, $matches)) {
                echo $linkController->update($matches[1]);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            if (preg_match('/^\/links\/(\w+)$/', $requestUri, $matches)) {
                echo $linkController->delete($matches[1]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido.']);
        }
    } elseif (preg_match('/^\/(\w+)$/', $requestUri, $matches)) {
        $linkController->redirectToOriginal($matches[1]);
    } elseif (strpos($requestUri, '/web') === 0) { //Aqui são as rotas para as requisições na web
        if ($requestUri === '/web/listar') {
            require_once __DIR__ . '/../web/listar.php';           
        } elseif ($requestUri === '/web/criar') {
            require_once __DIR__ . '/../web/criar.php';
        } elseif (preg_match('/^\/web\/editar\/(\w+)$/', $requestUri, $matches)) {
            $_GET['id'] = $matches[1];
            require_once __DIR__ . '/../web/editar.php';
        } elseif (preg_match('/^\/web\/deletar\/(\w+)$/', $requestUri, $matches)) {
            $_GET['id'] = $matches[1];
            require_once __DIR__ . '/../web/deletar.php';
        } else {
            http_response_code(404);
            echo "Página não encontrada.";
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada.']);
    }
?>
