<?php
namespace Blog\app;

use PDOException;
/**
 * Classe para o envio do contato no blog.
 */
class Contato {

    /**
     * Função que insere a mensagem de quem entrou em contato no banco.
     *
     * @param string $nome
     * @param string $email
     * @param string $mensagem
     * @return boolean
     */
    public static function inserirContato($nome, $email, $mensagem) {
        $conexao = Database::conexao();
        try{
            $inserir = $conexao->prepare("INSERT INTO contato (nomeContato, emailContato, mensagemContato) VALUES (:nomeContato, :emailContato, :mensagemContato)");
            $inserir->bindParam('nomeContato', $nome);
            $inserir->bindParam('emailContato', $email);
            $inserir->bindParam('mensagemContato', $mensagem);
            $inserir->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
}

?>