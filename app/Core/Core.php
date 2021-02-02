<?php

//PÁGINA RESPONSÁVEL PELO GERENCIAMENTO DE URL'S

class Core
{
    private $usuario;
    private $error;

    public function __construct()
    {
        $this->usuario = $_SESSION['user'] ?? null;
        $this->error = $_SESSION['msg_error'] ?? null;

        if (isset($this->error)) {
            if ($this->error['count'] === 0) {
                $_SESSION['msg_error']['count']++;
            } else {
                unset($_SESSION['msg_error']);
            }
        }       
    }

    public function start($urlGet)
    {
        if (isset($urlGet['metodo'])) {
            $acao = $urlGet['metodo'];
        } else {
            $acao = 'index';
        }

        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'] . 'Controller');
        } else {
            $controller = 'LoginController';
        }

        if (!class_exists($controller)) {
            $controller = 'ErroController';
        }

        if (isset($urlGet['id']) && $urlGet['id'] != null) {
            $id = $urlGet['id'];
        } else {
            $id = null;
        }

        //VERIFICA SE EXISTE USUÁRIO LOGADO    
        if ($this->usuario) {
            //DEFINE AS PERMISSÕES DO USUÁRIO LOGADO
            $pg_permission = ['LoginController', 'HomeController', 'EquipamentoController', 'RegistroController', 'UsuarioController'];
            //DEFINE A PÁGINA PRINCIPAL PARA O USUÁRIO LOGADO
            if (!isset($controller) || !in_array($controller, $pg_permission)) {
                $controller = 'HomeController';
                $acao = 'index';
            }
        } else {
            //DEFINE AS PERMISSÕES DO USUÁRIO NÃO LOGADO
            $pg_permission = ['LoginController'];

            if (!isset($controller) || !in_array($controller, $pg_permission)) {
                $controller = 'LoginController';
                $acao = 'index';
            }
        }

        call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
}
