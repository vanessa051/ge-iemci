<?php
//PAGINA RESPONSAVEL POR ENVIAR OS DADOS PARA VIEW home.html

class HomeController{
    public function index(){

        try{
           // $colecaoPostagens = Postagem::selecionaTodos();

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

         $parametros = array();
         // $parametros['postagens'] = $colecaoPostagens;

          
          $conteudo = $template->render($parametros);
          echo $conteudo;
            //echo $template;

        }catch(Exception $e){
            echo $e->getMessage();
        }

    }
    
    }