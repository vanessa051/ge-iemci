<?php

class EquipamentoController{
    public function index(){

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

          $parametros = array();


          $conteudo = $template->render($parametros);
          echo $conteudo;

        }

    public function create(){
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
            $template = $twig->load('create.html');

          $parametros = array();

          $conteudo = $template->render($parametros);
          echo $conteudo;
    }   
    
    public function insert()
    {
        try{
            //Postagem::insert($_POST);
            echo '<script>alert("Publicação inserida com sucesso");</script>';
            echo'<script>location.href="?pagina=equipamento&metodo=index"</script>';

        }catch(Exception $e){
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo'<script>location.href="?pagina=equipamento&metodo=index"</script>';
        }
       
    }

    }
    
