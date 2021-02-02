<?php
//PÁGINA RESPONSÁVEL PELA EXIBIÇÃO E CADASTRO DOS REGISTROS

class RegistroController
{
    //FUNÇÃO PARA EXIBIÇÃO DOS REGISTROS
    public function index($params)
    {
        try {
            $equipamento = Equipamento::buscarPorId($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('visualizarEquipamento.html');

            $parametros = array();
            $parametros['id'] = $equipamento->id;
            $parametros['modelo'] = $equipamento->modelo;
            $parametros['autor_registro'] = $equipamento->autor_registro;
            $parametros['detalhes'] = $equipamento->detalhes;

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //FUNÇÃO PARA ADICIONAR REGISTROS
    public function adicionarRegistro()
    {
        try {
            Registro::inserirRegistro($_POST);
            header('Location:?pagina=equipamento&metodo=visualizarEquipamento&id=' . $_POST['id_equip'] . '');
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=visulizarEquipamento&id=' . $_POST['id_equip'] . '"</script>';
        }
    }

}
