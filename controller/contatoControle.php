<?php

// Determina se alguma das informações estão vazias, retornando um erro
if ($_POST['nome'] === "" || $_POST['email'] === "" || $_POST['mensagem'] === "") {
    if ($_POST['nome'] === "") {
        $retorno['nomeVazio'] = true;
    }
    if ($_POST['email'] === "") {
        $retorno['emailVazio'] = true;
    }
    if ($_POST['mensagem'] === "") {
        $retorno['mensagemVazio'] = true;
    }
}

echo json_encode($retorno);

?>