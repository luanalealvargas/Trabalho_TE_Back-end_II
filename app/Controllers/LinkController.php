<?php

    namespace Luanavargas\LinkShortener\Controllers;
    use Luanavargas\LinkShortener\Models\Link;

    class LinkController
    {
        protected $linkModel;

        public function __construct()
        {
            $this->linkModel = new Link();
        }

        // Função de Criação pelo Insomnia ou Postman
        public function create()
        {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!isset($data['original'])) {
                echo json_encode(['error' => 'Link original é obrigatório.']);
                return;
            }

            $shortened = $this->linkModel->create($data['original']);
            $link = $this->linkModel->findByShortened($shortened); 

            return json_encode($link);
        }

        // Função de Criação pela Web
        public function createWeb()
        {
            $data = json_decode(file_get_contents('php://input'), true);
    
            if (isset($_POST['original']) && !empty($_POST['original'])) {
                $original = $_POST['original'];
    
                $shortened = $this->linkModel->create($original);
                $link = $this->linkModel->findByShortened($shortened);
    
                echo json_encode($link);
            } else {
                echo json_encode(['error' => 'Link original é obrigatório.']);
            }
        }

        //Ler e mostrar todos os objetos do banco
        public function listarTodos()
        {
            $links = $this->linkModel->all(); 

            return json_encode($links);
        }

        // Vai abrir o link original em outra página
        public function redirectToOriginal($shortened)
        {
            $link = $this->linkModel->findByShortened($shortened);

            if ($link) {
                header('Location: ' . $link['original']);
                exit();
            } else {
                echo json_encode(['error' => 'Link não encontrado.']);
            }
        }

        // Vai atualizar o link pelo Insomnia ou Postaman
        public function update($id)
        {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!isset($data['original'])) {
                echo json_encode(['error' => 'Link original é obrigatório.']);
                return;
            }

            $updatedLink = $this->linkModel->update($id, $data['original']);
            $link = $this->linkModel->find($id);

            return json_encode($link);
        }

        // Vai atualizar o link pela web
        public function updateWeb($id, $original)
        {
            $updatedLink = $this->linkModel->update($id, $original);

            if (!$updatedLink) {
                echo json_encode(['error' => 'Erro ao atualizar o link.']);
                return;
            }

            $link = $this->linkModel->find($id);

            return json_encode($link);
        }


        // Aqui vai deletar o link
        public function delete($id)
        {
            $link = $this->linkModel->find($id);
        
            if (!$link) {
                echo json_encode(['error' => 'Link não encontrado.']);
                return;
            }
        
            $result = $this->linkModel->delete($id);
        
            return json_encode($result);
        }   
    }
?>
