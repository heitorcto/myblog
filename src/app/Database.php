<?php
namespace Blog\app;

use PDO;
use PDOException;

/**
 * Essa classe irá gerenciar a conexão e retorno de informações do banco de dados.
 */
class Database {

    /**
     * Realiza a conexão com o banco de dados e retorna por opção o estado da conexão.
     * 
     * @param boolean $debug Passar true para a função fará que retorne o estado da conexão.
     * 
     * @return Conexão ou retorno de estado.
     */
    public static function conexao($debug = false) {
        if ($debug == true) {
            echo "##################################################<br>";
            echo "Servidor -> sql10.freesqldatabase.com <br>";
            echo "Nome do banco -> sql10479799 <br>";
            echo "Nome de usuário -> sql10479799 <br>";
            echo "Senha -> rBSuVdfyxn <br>";
            echo "##################################################<br>";
        }
        try {
            $conexao = new PDO("mysql:host=sql10.freesqldatabase.com;dbname=sql10479799", "sql10479799", "rBSuVdfyxn");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($debug == true){
                echo "Conexão realizada com Sucesso <br>";
            }
        } catch (PDOException $e) {
            if ($debug == true) {
                echo "A Conexão falhou -> ".$e->getMessage();
            }
        }
        return $conexao;
    }
}
?>