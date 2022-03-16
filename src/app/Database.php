<?php
    namespace Blog\app;

    /**
     * Essa classe irá gerenciar a conexão e retorno de informações do banco de dados.
     */
    class Database {

        /**
         * Realiza a coneção com o banco de dados e retorna por opção o estado da conexão.
         * @param boolean $debug Passar true para a função fará que retorne o estado da conexão.
         * @return Conexão ou retorno de estado.
         */
        public static function dbConnect($debug) {
            if($debug == true){
                echo "##################################################<br>";
                echo "Servidor -> localhost <br>";
                echo "Nome do banco -> myblog <br>";
                echo "Nome de usuário -> root <br>";
                echo "Senha -> <br>";
                echo "##################################################<br>";
            }
            try {
                $conexao = new PDO("mysql:host=localhost;dbname=myblog", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($debug == true){
                    echo "Conexão realizada com Sucesso <br>";
                }
            } catch(PDOException $e) {
                if($debug == true){
                    printError("Connection -> Falhou");
                    echo "A Conexão falhou -> ".$e->getMessage();
                }
            }
        }
    }


?>