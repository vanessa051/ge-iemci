<?php
//PAGINA RESPONSAVEL POR ENVIAR OS DADOS PARA VIEW home.html

class HomeController
{
    public function index()
    {

        try {
            $rowEquipamento = Equipamento::allHardwares();

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            //INFORMAÇÃO DO USUÁRIO
            var_dump($_SESSION['user']);
            $info['name_user'] = $_SESSION['user']['name_user'];

            //ENVIA OS DADOS DOS EQUIPAMENTOS CADASTRADOS PARA A VIEW home.html
            $parametros = array();
            $parametros['equipamentos'] = $rowEquipamento;


            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();

        header('Location: ?pagina=login$metodo=index');
    }
}
