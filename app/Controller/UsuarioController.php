<?php

class UsuarioController 
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('cadastro.html');

        $conteudo = $template->render();
        echo $conteudo;
    }

    public function cadastrar()
    {
        try {

            UsuarioModel::cadastro($_POST);
            echo '<script>alert("Usuário cadastrado com sucesso");</script>';
            echo '<script>location.href="?pagina=home&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=home&metodo=index"</script>';
        }

}
}
