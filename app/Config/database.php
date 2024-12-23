<?php
    namespace Luanavargas\LinkShortener\Config;

    use MongoDB\Client;

    //Arquivo para a criação da conexão com o Mongo

    class Database
    {
        const MONGODB_URI = 'mongodb://localhost:27017';
        const DB_NAME = 'shortener';

        //Cria o banco se não estiver criado já

        public static function connect()
        {
            try {
                $client = new Client(self::MONGODB_URI);
                return $client->selectDatabase(self::DB_NAME);

            } catch (\Exception $e) {
                throw $e;
            }
        }
    }
?>