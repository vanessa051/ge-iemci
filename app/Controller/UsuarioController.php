<?php
//PÁGINA RESPONSÁVEL PELA EXIBIÇÃO E ALTERAÇÃO DOS DADOS DOS USUÁRIOS

class UsuarioController
{
    //FUNÇÃO PARA LISTAR TODOS OS USUÁRIOS CADASTRADOS
    public function listagemUsuarios()
    {
        try {
            $rowUsuario = UsuarioModel::listagemUsuarios();
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('listagemUsuarios.html');


            //ENVIA OS DADOS DOS USUÁRIOS CADASTRADOS PARA A VIEW home.html
            $parametros = array();
            $parametros['usuarios'] = $rowUsuario;
            $parametros['nome_usuario'] = $_SESSION['user']['name_user']; //INFORMAÇÃO DO USUÁRIO LOGADO

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //FUNÇÃO PARA EXIBIR INFORMAÇÕES DO USUÁRIO LOGADO
    public function informacaoDaConta()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('viewUsuario.html');

            //INFORMAÇÃO DO USUÁRIO
            $info['name_user'] = $_SESSION['user']['name_user'];
            $info['cargo'] = $_SESSION['user']['cargo'];
            $info['departamento'] = $_SESSION['user']['departamento'];
            $info['email'] = $_SESSION['user']['email'];

            $conteudo = $template->render($info);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //FUNÇÃO PARA ALTERAR AS INFORMAÇÕES DOS USUÁRIO LOGADO
    public function alteraUsuario()
    {
        try {
            UsuarioModel::altera($_POST);
            echo '<script>alert("Usuário alterado com sucesso");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=viewEquipamento&id=' . $_POST['id_equip'] . '"</script>';
        } catch (Exception $e) {
            echo $e->getMessage(); /*'<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=viewEquipamento&id=' . $_POST['id_equip'] . '"</script>';*/
        }
    }



    public function excluiUsuario()
    {
        try {
            UsuarioModel::exclui();
            echo '<script>alert("Usuário excluído com sucesso");</script>';
            echo '<script>location.href="?pagina=login&metodo=index"</script>';
        } catch (Exception $e) {
            echo $e->getMessage(); /*'<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=viewEquipamento&id=' . $_POST['id_equip'] . '"</script>';*/
        }
    }
}
