<?php 

namespace core\controllers;

use core\classes\Database;
use core\classes\Store;
use core\models\Produtos;

class Carrinho
{
    public function adicionar_carrinho()
    {
        // VERIFICAR SE O PRODUTO EXISTE
        if(!isset($_GET['id_produto'])){
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }

        
        // TRAZER O ID PRODUTO DA QUERY STRING PARA O CODIGO
        $id_produto = $_GET['id_produto'];

        $produto = new Produtos();
        $resultado = $produto->verificar_Id($id_produto);
        
        if($resultado == false){
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }
        // ADICIONAR A VARIAVEL NA SESSAO 'CARRINHO'
        $carrinho = [];

        if(isset($_SESSION['carrinho'])){
            $carrinho = $_SESSION['carrinho'];
        }

        if(key_exists($id_produto, $carrinho)){
            // O PRODUTO JA EXISTE NA SESSAO, ACRESCENTA MAIS 1 UNIDADE
            $carrinho[$id_produto] ++;
        }else{
            $carrinho[$id_produto] = 1;
        }

        // ACTUALIZA OS DADOS DO CARRINHO NA SESSAO
        $_SESSION['carrinho'] = $carrinho;
        // DEVOLTA O NUMERO TOTAL DE PRODUTOS
        $qtd_produtos = 0;
         foreach($carrinho as $produto_qtd){
             $qtd_produtos += $produto_qtd;
         }
        // RESPOSTA
        echo $qtd_produtos;
    }

    public function limpar_carrinho(){
        unset($_SESSION['carrinho']);
        $this->carrinho();
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