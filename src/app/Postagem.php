<?php
namespace Blog\app;

use PDO;
use PDOException;

/**
 * Essa classe irá gerenciar os posts do blog.
 */
class Postagem extends Exibe{
    /**
     * Método construtor para retorno de informações e funcionalidades importantes
     */
    public function __construct() {
        $this->db = new Database;
        $this->conexao = $this->db->conexao();

        $this->titulo = "Título da Postagem";
        $this->dataHoje = date("Y-m-d H:i:s");
        $this->conteudo = "Conteúdo da postagem, Conteúdo da postagem, Conteúdo da postagem, Conteúdo da postagem, Conteúdo da postagem";
    }

    public function query($query, $array) {
        try {
            $queryEfetuar = $this->conexao->prepare("$query");
            Exibe::alerta($query);
            foreach ($array as $chave => $parametro) {
                Exibe::alerta($chave);
                Exibe::alerta($parametro);
                $queryEfetuar->bindParam($chave, $parametro);
            }
            $queryEfetuar->execute();
        } catch (PDOException $e) {
            Exibe::erro($e->getMessage());
        }
    }

    /**
     * Retorna as postagens de acordo com os parâmetros da função.
     *
     * @param int $idPost
     * @param int $selectLimit
     * 
     * @return array
     */
    public function selecionar($idPost = false, $selectLimit = false) {
        // Verificando possível erro
        if ($idPost != false && $selectLimit != false) {
            Exibe::erro("Não é possível passar os dois parâmetros que sejam diferentes de false.");
        }

        // Caso for selecionado por ID
        if ($idPost == true) {
            try {
                $selecionar = $this->conexao->prepare("SELECT * FROM postagem WHERE idPost = :idPost");
                $selecionar->bindParam('idPost', $idPost);
                $selecionar->execute();
                while($info = $selecionar->fetch(PDO::FETCH_ASSOC)){
                    $retorno = [
                        "idPost" => $info['idPost'],
                        "tituloPost" => $info['tituloPost'],
                        "conteudoPost" => $info['conteudoPost'],
                        "dataPost" => $info['dataPost']
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
                $selecionar = $this->conexao->prepare("SELECT * FROM postagem LIMIT $selectLimit");
                $selecionar->bindParam('idPost', $idPost);
                $selecionar->execute();
                $contador = 0;
                while($info = $selecionar->fetch(PDO::FETCH_ASSOC)){
                    $retorno['dados'][$contador] = [
                        "idPost" => $info['idPost'],
                        "tituloPost" => $info['tituloPost'],
                        "conteudoPost" => $info['conteudoPost'],
                        "dataPost" => $info['dataPost']
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
            $selecionar = $this->conexao->prepare("SELECT * FROM postagem");
            $selecionar->bindParam('idPost', $idPost);
            $selecionar->execute();
            $contador = 0;
            while($info = $selecionar->fetch(PDO::FETCH_ASSOC)){
                $retorno['dados'][$contador] = [
                    "idPost" => $info['idPost'],
                    "tituloPost" => $info['tituloPost'],
                    "conteudoPost" => $info['conteudoPost'],
                    "dataPost" => $info['dataPost']
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
    public function inserir($titulo, $conteudo) {
        try{
            $inserir = $this->conexao->prepare("INSERT INTO postagem (tituloPost, conteudoPost, dataPost) VALUES (:tituloPost, :conteudoPost, :dataPost)");
            $inserir->bindParam('tituloPost', $titulo);
            $inserir->bindParam('conteudoPost', $conteudo);
            $inserir->bindParam('conteudoPost', $this->dataHoje);
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
    public function alterar($idPost, $novoTitulo = "", $novoConteudo = "") {
        try{
            $alterar = $this->conexao->prepare("UPDATE postagem SET tituloPost = :tituloPost, conteudoPost = :conteudoPost WHERE idPost = :idPost");
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
    public function excluirPostagem($idPost) {
        try{
            $alterar = $this->conexao->prepare("DELETE FROM postagem WHERE idPost = :idPost");
            $alterar->bindParam('idPost', $idPost);
            $alterar->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Insere uma quantidade desejada de registros na tabela de postagem
     *
     * @param int $quantidade
     * @return void
     */
    public function semear($quantidade) {
        if (is_numeric($quantidade)) {
            for ($contador = 1; $contador <= $quantidade; $contador++) {
                $inserir = $this->conexao->prepare("INSERT INTO postagem (tituloPost, conteudoPost, dataPost) VALUES (:tituloPost, :conteudoPost, :dataPost)");
                $inserir->bindParam('tituloPost', $this->titulo);
                $inserir->bindParam('conteudoPost', $this->conteudo);
                $inserir->bindParam('dataPost', $this->dataHoje);
                $inserir->execute();
            }
        } else {
            Exibe::erro("O parâmetro da função precisa ser numérico!");
        }
    }

    /**
     * Deleta todos os registros da tabela de postagem
     * 
     * @return void
     */
    public function deletar() {
        $deletar = $this->conexao->prepare("DELETE FROM postagem");
        $deletar->execute();
    }
}
?>