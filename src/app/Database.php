<?php
namespace Blog\app;

use PDO;
use PDOException;

/**
 * Essa classe irá gerenciar a conexão e retorno de informações do banco de dados.
 */
class Database extends Exibe {

    /**
     * Método construtor para facilitar a visualização dos campos do banco
     */
    public function __construct() {
        $this->servidor = 'localhost';
        $this->nomeBanco = 'incode';
        $this->usuario = 'root';
        $this->senha = '';
    }

    /**
     * Realiza a conexão com o banco de dados e retorna por opção o estado da conexão.
     * 
     * @param boolean $debug Passar true para a função fará que retorne o estado da conexão.
     * 
     * @return Conexão ou retorno de estado.
     */
    public function conexao($debug = false) {
        if ($debug == true) {
            Exibe::sucesso("Servidor: $this->servidor");
            Exibe::sucesso("Nome do banco: $this->nomeBanco");
            Exibe::sucesso("Usuário: $this->usuario");
            Exibe::sucesso("Senha: $this->senha");
        }
        try {
            $conexao = new PDO("mysql:host=$this->servidor;dbname=$this->nomeBanco", "$this->usuario", "$this->senha");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ($debug == true) {
                echo "Conexão realizada com Sucesso <br>";
                Exibe::sucesso("Conexão realizada com sucesso!");
            }
        } catch (PDOException $e) {
            if ($debug == true) {
                echo Exibe::erro($e->getMessage());
            }
        }
        return $conexao;
    }
}
?>