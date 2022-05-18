<?php

namespace Blog\App;
/**
 * Essa classe serve apenas para ajudar a exibir resultados em testes
 */
class Exibe {
    /**
     * Função que retorna a string inserida com uma cor verde
     *
     * @param String $string
     * @return String
     */
    public static function sucesso ($string) {
        return "<span style='color:grenn;'>$string</span><br>";
    }

    /**
     * Função que retorna a string inserida com uma cor vermelha
     *
     * @param String $string
     * @return String
     */
    public static function erro ($string) {
        return "<span style='color:red;'>$string</span><br>";
    }

    /**
     * Função que retorna a string inserida com uma cor laranja
     *
     * @param String $string
     * @return String
     */
    public static function alerta ($string) {
        return "<span style='color:orange;'>$string</span><br>";
    }

    /**
     * Função que retorna o array com uma visão melhorada inserida com uma cor roxa
     *
     * @param Array $string
     * @return Array
     */
    public static function array ($array) {
        return "<pre style='color:purple;'>".print_r($array)."</pre>";
    }
}

?>