<?php

require_once '../vendor/autoload.php';

use Blog\app\Contato;

$contato = new Contato();

// $contato->semear("a");
$contato->deletar();

?>