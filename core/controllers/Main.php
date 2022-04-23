<?php

namespace core\controllers;

use core\classes\Store;
use core\classes\Database;
use core\classes\EnviarEmails;
use core\models\Clientes;
use core\models\Produtos;

class Main
{

    public function index()
    {
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/footer',
            'layouts/html_footer',

        ]);
    }

    public function store()
    {
        
        // TRAZER TODOS PRODUTOS
        $produtos = new Produtos();

        $categoria = 'todos';
            if(isset($_GET['c'])){
                $categoria = $_GET['c'];
            }

        $store = $produtos->lista_produtos_disponiveis($categoria);
        
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'store',
            'layouts/footer',
            'layouts/html_footer',

        ],['produtos' => $store]);
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

    public function novo_cliente()
    {

        //  VERIFICAR SE EXISTE UM CLIENTE LOGADO?
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'novo_cliente',
            'layouts/footer',
            'layouts/html_footer',

        ]);
    }

    public function client_submit()
    {

        //  VERIFICAR SE EXISTE UM CLIENTE LOGADO?
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // VERIFICAR SE HOUVE SUBMISSAO DO FORMULARIO
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // CRIAR NOVO CLIENTE
        // 1. VERIFCA SE AS SENHAS SAO IGUAS
        if ($_POST['senha1'] !== $_POST['senha2']) {

            // AS SENHAS SAO DIFERENTES
            $_SESSION['erro'] = "As senhas devem ser iguais!";
            $this->novo_cliente();
            return;
        }

        // 2. VERIFICAR SE O EMAIL JA FOI REGISTADO

        $cliente = new Clientes();
        if ($cliente->verificar_registo_existente($_POST['email'])) {

            $_SESSION['erro'] = "Este email ja foi resgistado";
            $this->novo_cliente();
            return;
        }

        // REGISTAR NA BASE DE DADOS
        $purl = $cliente->registar_cliente();
        $email_client = strtolower(trim($_POST['email']));

        // ENVIAR EMAIL PARA O CLIENTE
        $email_send = new EnviarEmails();
        $resultado = $email_send->email__activacao_conta($email_client, $purl);

        // if($resultado = true){
        if ($resultado) {
            $_SESSION['sucesso'] = "Pre registo feito, verifique a caixa do email " . $email_client . " para continuar";
            $this->novo_cliente();
            return;
        } else {
            // $_SESSION['erro'] = "Erro ao enviar o email";
            // $this->novo_cliente();
            // return; 
            echo "Erro ao enviar o email";
            return;
        }
    }

    public function login()
    {
        //  VERIFICAR SE JA EXISTE UM CLIENTE LOGADO
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login',
            'layouts/footer',
            'layouts/html_footer',

        ]);
    }

    public function login_submit()
    {
        //  VERIFICAR SE JA EXISTE UM CLIENTE LOGADO
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // VERIFICAR SE HOUVE POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // VERIFICAR SE OS CAMPOS FORAM PREENCIDOS E SE O EMAIL E VALIDO
        if (!isset($_POST['usuario']) || !isset($_POST['senha']) || !filter_var(trim($_POST['usuario']), FILTER_VALIDATE_EMAIL)) {
            $_SESSION['erro'] = "Usuario ou Senha Invalido!";
            $this->login();
            return;
        }

        // VALIDAR NA BASE DE DADOS
        $usuario = strtolower(trim($_POST['usuario']));
        $senha = strtolower(trim($_POST['senha']));


        $cliente = new Clientes();
        $resultado_validacao = $cliente->validar_login($usuario, $senha);

        // ANALIZAR O RESULTADO
        // LOGIN INVALIDO
        if (is_bool($resultado_validacao)) {
            $_SESSION['erro'] = "Usuario ou Senha Invalidos!";
            $this->login();
            return;
        } else {
            $_SESSION['cliente'] = $resultado_validacao['id'];
            $_SESSION['nome_cliente'] = $resultado_validacao['nome_completo'];
            $_SESSION['usuario'] = $resultado_validacao['email'];

            Store::redirect();
        }
    }


    public function logout()
    {

        // REMOVER AS VARIAVES DAS SESSAO
        unset($_SESSION['cliente']);
        unset($_SESSION['nome_cliente']);
        unset($_SESSION['usuario']);

        // IR A PAGINA INICIAL
        Store::redirect();
    }

    public function validar_conta()
    {
        //  VERIFICAR SE EXISTE UM CLIENTE LOGADO?
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // Verificar se existe o purl na query string
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        // VERIFICAR SE O PURL E VALIDO
        $purl = $_GET['purl'];
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }
        $client = new Clientes();
        $resultado = $client->validar_conta($purl);

        if ($resultado) {
            $_SESSION['sucesso'] = "Conta Activada com sucesso!";
            $this->novo_cliente();
            return;
        }
        if (!$resultado) {
            $_SESSION['erro'] = "O link expirou!";
            $this->novo_cliente();
            return;
        }
    }
}
