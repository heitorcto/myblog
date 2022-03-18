<?php
namespace Blog\app;

use PDO;
use PDOException;

// ANOTAÇÃO: TRATAR POSSÍVEIS ERROS NOS PARÂMETROS

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
    public static function selecionarPostagens($idPost = null, $selectLimit = null) {
        $conexao = Database::conexao();

        $limitarRegistros = "";

        if ($idPost != null) {
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
        } elseif ($selectLimit != null){
            $limitarRegistros = "LIMIT $selectLimit";
        } elseif ($selectLimit != null && $idPost != null){
            return "[Erro 1 - class Postagem] Certifique-se que os parâmetros estão corretos.";
        }

        $selecionar = $conexao->prepare("SELECT * FROM postagem $limitarRegistros");
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
        
        return $retorno['dados'];
    }

     /**
     * Insere através dos parâmetros na tabela postagem.
     * 
     * @param string $titulo Título da postagem do blog.
     * @param string $conteudo Conteúdo da postagem do blog.
     * 
     * @return boolean
     */
    public function inserirPostagem($titulo, $conteudo) {
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