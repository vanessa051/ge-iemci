<?php

class UsuarioController 
{

    public function informacaoDaConta($params)
    {
        try{
        //VAI PEGAR USUÁRIO POR ID
        $usuario = UsuarioModel::userGetById($params);

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('viewUsuario.html');

        $parametros = array();
        $parametros['id'] = $usuario->id;
        $parametros['nome'] = $usuario->nome;
        $parametros['cargo'] = $usuario->cargo;
        $parametros['departamento'] = $usuario->departamento;
        $parametros['email'] = $usuario->email;

        $conteudo = $template->render();
        echo $conteudo;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }


    public function alteraUsuario()
    {      
      try {
        UsuarioModel::altera($_POST);
            echo '<script>alert("Publicação alterada com sucesso");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=viewEquipamento&id=' . $_POST['id_equip'] . '"</script>';
        } catch (Exception $e) {
            echo $e->getMessage(); /*'<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=viewEquipamento&id=' . $_POST['id_equip'] . '"</script>';*/
        }
    }

}
