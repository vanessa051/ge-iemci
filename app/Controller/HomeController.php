<?php

//PAGINA RESPONSAVEL POR ENVIAR OS DADOS PARA VIEW home.html
class HomeController
{
    //FUNÇÃO PARA EXIBIÇÃO DA LISTAGEM DE TODOS OS EQUIPAMENTOS
    public function index()
    {
        try {
            $rowEquipamento = Equipamento::visualizarTodosEquipamentos();

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            //ENVIA OS DADOS DOS EQUIPAMENTOS CADASTRADOS PARA A VIEW home.html
            $parametros = array();
            $parametros['equipamentos'] = $rowEquipamento;
            $parametros['nome_usuario'] = $_SESSION['user']['name_user'];  //INFORMAÇÃO DO USUÁRIO

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //FUNÇÃO RESPONSÁVEL PELO LOGOUT
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ?pagina=login$metodo=index');
    }
}
