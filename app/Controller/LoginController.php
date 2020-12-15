<?php




class LoginController 
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('login.html');

        $conteudo = $template->render();
        echo $conteudo;
    }

    public function check()
    {
        try{
          
            $usuario = new Usuario;
            $usuarioModel = new UsuarioModel;
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);
            $usuarioModel->validaLogin($usuario);

            header('Location: ?pagina=home&metodo=index');

        }catch(\Exception $e){
            echo ('Tá errado');
        }
           
        
    }

}
