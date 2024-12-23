<?php

    namespace Luanavargas\LinkShortener\Models;
    use Luanavargas\LinkShortener\Config\Database;

    class Link
    {
        protected $db;

        public function __construct()
        {
            //Conectar ao MongoDB
            $this->db = Database::connect();
        }

        // Aqui é a operação de criar no mongo
        public function create($original)
        {
            $collection = $this->db->links;

            //Mudei para uma forma mais simples e que valide ser unico o link encurtado
            do {
                $shortened = $this->generate(5);
                $flag = $collection->findOne(['shortened' => $shortened]);

            } while ($flag);

            // Insere o link original e encurtado no banco de dados
            $collection->insertOne([
                'original' => $original,
                'shortened' => $shortened
            ]);

            return $shortened;
        }

        private function generate($length = 5)
        {
            $c = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $key = strlen($c);
            $result = '';
            for ($i = 0; $i < $length; $i++) {
                $result .= $c[random_int(0, $key - 1)];
            }
            return $result;
        }

        // Aqui é a operação de encontrar no mongo pelo ID
        public function find($id)
        {
            $collection = $this->db->links;
            
            if (empty($id) || !preg_match('/^[a-fA-F0-9]{24}$/', $id)) {
                return null; 
            }

            $link = $collection->findOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);

            return $link;
        }

        // Aqui é a operação de encontrar no mongo pelo link encurtado
        public function findByShortened($shortened)
        {
            $collection = $this->db->links;
            return $collection->findOne(['shortened' => $shortened]);
        }

        // Aqui é a operação de atualizar no mongo
        public function update($id, $original)
        {
            $collection = $this->db->links;
            $collection->updateOne(
                ['_id' => new \MongoDB\BSON\ObjectID($id)],
                ['$set' => ['original' => $original]]
            );

            return ['id' => $id, 'original' => $original];
        }

        // Aqui é a operação de deletar no mongo
        public function delete($id)
        {
            $collection = $this->db->links;
            $result = $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);
            return ['deleted' => $result->getDeletedCount() > 0];
        }

        // Aqui é a operação de listar os links
        public function all()
        {
            $collection = $this->db->links;
            return iterator_to_array($collection->find());
        }
    }
?>