<?php
namespace Blog\app;

use PDO;
use PDOException;
/**
 * Classe para o envio do contato no blog.
 */
class Contato extends Database {
    /**
     * Classe que referencia diretamente a função que se conecta ao banco de dados para realizar requisições
     */
    public function __construct() {
        $this->db = new Database;
        $this->conexao = $this->db->conexao();

        $this->nome = "Nome Do Usuário";
        $this->email = "emaildousuario@email.com";
        $this->mensagem = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum";

        $this->exibe = new Exibe;
    }

    /**
     * Função que insere a mensagem de quem entrou em contato no banco.
     *
     * @param string $nome
     * @param string $email
     * @param string $mensagem
     * @return boolean
     */
    public function inserir($nome, $email, $mensagem) {
        try{
            $inserir = $this->conexao->prepare("INSERT INTO contato (nomeContato, emailContato, mensagemContato) VALUES (:nomeContato, :emailContato, :mensagemContato)");
            $inserir->bindParam('nomeContato', $nome);
            $inserir->bindParam('emailContato', $email);
            $inserir->bindParam('mensagemContato', $mensagem);
            $inserir->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Insere uma quantidade desejada de registros na tabela de Contato
     *
     * @param int $quantidade
     * @return void
     */
    public function semear($quantidade) {
        if (is_numeric($quantidade)) {
            for ($contador = 1; $contador <= $quantidade; $contador++) {
                $inserir = $this->conexao->prepare("INSERT INTO contato (nomeContato, emailContato, mensagemContato) VALUES (:nomeContato, :emailContato, :mensagemContato)");
                $inserir->bindParam('nomeContato', $this->nome);
                $inserir->bindParam('emailContato', $this->email);
                $inserir->bindParam('mensagemContato', $this->mensagem);
                $inserir->execute();
            }
        } else {
            $this->exibe->erro("O parâmetro da função precisa ser numérico!");
        }
    }

    /**
     * Deleta todos os registros da tabela de Contato
     * 
     * @return void
     */
    public function deletar() {
        $deletar = $this->conexao->prepare("DELETE FROM contato");
        $deletar->execute();
    }
    
}

?>