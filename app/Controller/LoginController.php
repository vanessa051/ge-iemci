<?php




class LoginController 
{

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('login.html');
        $parameters['error'] =  $_SESSION['msg_error'] ?? null;

        $conteudo = $template->render($parameters);
        echo $conteudo;
    }

    public function telaCadastro()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('cadastro.html');

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
            $_SESSION['msg_error'] = array('msg' => $e->getMessage(), 'count' => 0);
            header('Location: ?pagina=home&metodo=index');
        }
   
    }

    public function cadastrar()
    {
        try {

            UsuarioModel::cadastro($_POST);
            echo '<script>alert("Usuário cadastrado com sucesso");</script>';
            echo '<script>location.href="?pagina=login&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=login&metodo=index"</script>';
        }
    }

}
