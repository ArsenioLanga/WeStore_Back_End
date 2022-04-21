<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos
{

    public function lista_produtos_disponiveis()
    {
        // TRAZER TODOS PRODUTOS DISPONIVEIS
        $db = new Database();
        $resultado = $db->select("SELECT * FROM produtos WHERE stock > 5 AND visivel = 1");

        return $resultado;
    }    

}
