<?php 

namespace core\controllers;

use core\classes\Store;

class Carrinho
{
    public function adicionar_carrinho()
    {
        $id_produto = $_GET['id_produto'];
        $_SESSION['teste'] = $id_produto;
        echo 'Produto '.$id_produto . ' adicionado ao carinho!';
    }

    public function carrinho()
    {
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',

        ]);
    }

}