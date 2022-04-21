<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Clientes
{

    public function verificar_registo_existente($email)
    {

        $db = new Database();

        $parametros = [
            ':email' => strtolower(trim($email))
        ];
        $resultados = $db->select("SELECT email FROM clientes WHERE email = :email", $parametros);

        if (count($resultados) != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registar_cliente()
    {

        $db = new Database();
        // CRIACAO DO PURL
        $purl = Store::criarHash();

        $params = [
            ':email' => strtolower(trim($_POST['email'])),
            ':senha' => password_hash(trim($_POST['senha1']), PASSWORD_DEFAULT),
            ':nome_complento' => trim($_POST['nome']),
            ':morada' => trim($_POST['morada']),
            ':telefone' => trim($_POST['telefone']),
            ':purl' => $purl,
            ':activo' => 0,
        ];

        $db->insert("
            INSERT INTO clientes VALUES(
                0,
                :email,
                :senha,
                :nome_complento,
                :morada,
                :telefone,
                :purl,
                :activo,
                NOW(),
                NOW(),
                NULL
                )
            ", $params);
        // RETORNA O PURL
        return $purl;
    }

    public function validar_conta($purl)
    {

        $db = new Database();
        $params = [
            ':purl' => $purl
        ];
        $resultados = $db->select("SELECT * FROM clientes WHERE purl = :purl", $params);
        // VERIFICA SE CLIENTE FOI ENCONTRADO 
        if (count($resultados) != 1) {
            return false;
        } else {

            $id_cliente = $resultados[0]['id'];

            // HABILITAR O LOGIN DO CLIENTE
            $parametros = [
                ':id_cliente' => $id_cliente
            ];
            $db->update("UPDATE clientes SET purl = null, activo = 1, update_at = NOW() WHERE id = :id_cliente", $parametros);

            return true;
        }
    }

    public function validar_login($usuario, $senha)
    {


        $parametros = [
            ':usuario' => $usuario
        ];

        // VERIFICAR SE O USUARIO E VALIDO, ESTA ACTIVO E NAO FOI ELIMINADO
        $sql = new Database();
        $senha = trim($senha);
        $resultado = $sql->select("SELECT * FROM clientes WHERE email = :usuario AND activo = 1 AND deleted_at IS NULL", $parametros);

        // O USUARIO EXISTE
        if (count($resultado) != 1) {
            return false;
        } else {

            $usuario = $resultado[0];
            if (!password_verify($senha, $resultado[0]['senha'])) {
                // SENHA INVALIDA
                return false;
            } else {
                // LOGIN VALIDO
                return $usuario;
            }
        }
    }
}
