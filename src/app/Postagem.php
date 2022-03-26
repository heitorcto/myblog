<?php
namespace Blog\app;

use PDO;
use PDOException;

/**
 * Essa classe irá gerenciar os posts do blog.
 */
class Postagem {

    /**
     * Retorna as postagens de acordo com os parâmetros da função.
     *
     * @param int $idPost
     * @param int $selectLimit
     * 
     * @return array
     */
    public static function selecionarPostagens($idPost = false, $selectLimit = false) {
        $conexao = Database::conexao();

        // Verificando possível erro
        if ($idPost != false && $selectLimit != false) {
            echo "[Erro 1 - Postagem Class] - Não é possível passar os dois parâmetros que sejam diferentes de false.";
        }

        // Caso for selecionado por ID
        if ($idPost == true) {
            try {
                $selecionar = $conexao->prepare("SELECT * FROM postagem WHERE idPost = :idPost");
                $selecionar->bindParam('idPost', $idPost);
                $selecionar->execute();
                while($info = $selecionar->fetch(PDO::FETCH_ASSOC)){
                    $retorno = [
                        "idPost" => $info['idPost'],
                        "tituloPost" => $info['tituloPost'],
                        "conteudoPost" => $info['conteudoPost'],
                    ];
                }
                return $retorno;
            } catch (PDOException $e) {
                return false;
            }
        }

        // Caso for selecionado por LIMIT
        if ($selectLimit != false && is_numeric($selectLimit) && $selectLimit > 0) {
            try {
                $selecionar = $conexao->prepare("SELECT * FROM postagem LIMIT $selectLimit");
                $selecionar->bindParam('idPost', $idPost);
                $selecionar->execute();
                $contador = 0;
                while($info = $selecionar->fetch(PDO::FETCH_ASSOC)){
                    $retorno['dados'][$contador] = [
                        "idPost" => $info['idPost'],
                        "tituloPost" => $info['tituloPost'],
                        "conteudoPost" => $info['conteudoPost']
                    ];
                    $contador++;
                }
                $retorno['total'] = $contador;
                return $retorno;
            } catch (PDOException $e) {
                return false;
            }
        }

        // Caso os parâmetros não sejam passados
        if ($idPost === false && $selectLimit === false) {
            $selecionar = $conexao->prepare("SELECT * FROM postagem");
            $selecionar->bindParam('idPost', $idPost);
            $selecionar->execute();
            $contador = 0;
            while($info = $selecionar->fetch(PDO::FETCH_ASSOC)){
                $retorno['dados'][$contador] = [
                    "idPost" => $info['idPost'],
                    "tituloPost" => $info['tituloPost'],
                    "conteudoPost" => $info['conteudoPost']
                ];
                $contador++;
            }
            $retorno['total'] = $contador;
            if ($retorno['total'] > 0) {
                return $retorno;
            } else {
                return false;
            }
        }
    }

     /**
     * Insere através dos parâmetros na tabela postagem.
     * 
     * @param string $titulo Título da postagem do blog.
     * @param string $conteudo Conteúdo da postagem do blog.
     * 
     * @return boolean
     */
    public static function inserirPostagem($titulo, $conteudo) {
        $conexao = Database::conexao();
        try{
            $inserir = $conexao->prepare("INSERT INTO postagem (tituloPost, conteudoPost) VALUES (:tituloPost, :conteudoPost)");
            $inserir->bindParam('tituloPost', $titulo);
            $inserir->bindParam('conteudoPost', $conteudo);
            $inserir->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Altera através dos parâmetros na tabela postagem.
     *
     * @param int $idPost
     * @param string $novoTitulo
     * @param string $novoConteudo
     * @return boolean
     */
    public static function alterarPostagem($idPost, $novoTitulo = "", $novoConteudo = "") {
        $conexao = Database::conexao();
        try{
            $alterar = $conexao->prepare("UPDATE postagem SET tituloPost = :tituloPost, conteudoPost = :conteudoPost WHERE idPost = :idPost");
            $alterar->bindParam('idPost', $idPost);
            $alterar->bindParam('tituloPost', $novoTitulo);
            $alterar->bindParam('conteudoPost', $novoConteudo);
            $alterar->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Altera através dos parâmetros na tabela postagem.
     *
     * @param int $idPost
     * @return boolean
     */
    public static function excluirPostagem($idPost) {
        $conexao = Database::conexao();
        try{
            $alterar = $conexao->prepare("DELETE FROM postagem WHERE idPost = :idPost");
            $alterar->bindParam('idPost', $idPost);
            $alterar->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>