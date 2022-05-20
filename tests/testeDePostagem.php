<?php

require_once '../vendor/autoload.php';

use Blog\app\Postagem;

$post = new Postagem();

$post->semear(2);

// $query = "INSERT INTO postagem (tituloPost) VALUES (:tituloPost)";
// $param = ["tituloPost" => "Meu Título"];

// $post->query($query, $param);

?>