<?php

require_once 'vendor/autoload.php';

use Blog\app\Database;
use Blog\app\Postagem;

$con = Database::conexao();

// Postagem::inserirPostagem("Titulo Legal","Conteudo Legal");
// Postagem::alterarPostagem(6, "Titulo Legal Modificado","Conteudo Legal Modificado");
// Postagem::excluirPostagem();
$teste = Postagem::selecionarPostagens(false, 4);

echo '<pre>'; print_r($teste); echo '</pre>';

?>