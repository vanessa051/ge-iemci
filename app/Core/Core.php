<?php

//SE NÃO EXISTIR PAGINA ELE VAI DIRETO PARA O LoginController.php

class Core
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = $_SESSION['user'] ?? null;
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
           // $controller = 'HomeController';
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
            $pg_permission = ['HomeController', 'EquipamentoController', 'RegistroController'];
            //DEFINE A PÁGINA PRINCIPAL PARA O USUÁRIO LOGADO
            if (!isset($controller) || !in_array($controller, $pg_permission)) {
                $controller = 'HomeController';
                $acao = 'index';
            }
        } else {
            $pg_permission = ['LoginController'];

            if (!isset($controller) || !in_array($controller, $pg_permission)) {
                $controller = 'LoginController';
                $acao = 'index';
            }
        }

        call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
}
