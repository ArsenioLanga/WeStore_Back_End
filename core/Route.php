<?php

// colecao de rotas
$rotas = [
    'index' => 'main@index',
    'store' => 'main@store',
    'adicionar_carrinho' => 'carrinho@adicionar_carrinho',
    'carrinho' => 'carrinho@carrinho',
    'limpar_carrinho' => 'carrinho@limpar_carrinho',
    'novo_cliente' => 'main@novo_cliente',
    'client_submit' => 'main@client_submit',
    'login' => 'main@login',
    'login_submit' => 'main@login_submit',
    'validar_conta' => 'main@validar_conta',
    'logout' => 'main@logout',
];

// DEFINIR A ACCAO POR DEFEITO
    $acao = 'index';

// VERIFICAR SE EXISTE A ACAO NA QUERY STRING 
    if(isset($_GET['p'])){

        // VERIFICAR SE A EXISTE ACAO NAS ROTAS
        if(!key_exists($_GET['p'], $rotas)){
            $acao = 'index';
        } else {
            $acao = $_GET['p'];
        }
        
    }

    //TRATAR A DEFINICAO DE ROTAS
    // explode separa a string/variavel
    $partes = explode('@', $rotas[$acao]);
    $controlador = 'core\\controllers\\'.ucfirst($partes[0]);
    $metodo = $partes[1];

    $ctr = new $controlador();
    $ctr->$metodo();