<?php
require_once '../vendor/autoload.php';

use Blog\app\Contato;

$contato = new Contato();

// Tratando validade dos dados
if (isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['mensagem'])) {
    $erroNome = false;
    $erroEmail = false;
    $erroMensagem = false;

    if ($_POST['nome'] === "") {
        $retorno['nomeVazio'] = true;
        $erroNome = true;
    } elseif (strlen($_POST['nome']) < 5) {
        $retorno['nomeInvalido'] = true;
        $erroNome = true;
    }

    if ($_POST['email'] === "") {
        $retorno['emailVazio'] = true;
        $erroEmail = true;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $retorno['emailInvalido'] = true;
        $erroEmail = true;
    }
    
    if ($_POST['mensagem'] === "") {
        $retorno['mensagemVazio'] = true;
        $erroMensagem = true;
    } elseif (strlen($_POST['mensagem']) <= 30) {
        $retorno['mensagemInvalido'] = true;
        $erroMensagem = true;
    }
    
    if ($erroNome === true || $erroEmail === true || $erroMensagem === true) {
        $retorno['sucesso'] = false;
    } else {
        $contato->inserir($_POST['nome'], $_POST['email'], $_POST['mensagem']);
        $retorno['sucesso'] = true;
    }
} 

echo json_encode($retorno);
?>