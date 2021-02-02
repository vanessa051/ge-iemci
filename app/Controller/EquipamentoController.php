<?php

class EquipamentoController
{
    //FUNÇÃO PARA VISUALIZAÇÃO DA PÁGINA DE CADA EQUIPAMENTO
    public function visualizarEquipamento($params)
    {
        try {
            $equipamento = Equipamento::buscarPorId($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('visualizarEquipamento.html');

            $parametros = array();
            $parametros['id'] = $equipamento->id;
            $parametros['modelo'] = $equipamento->modelo;
            $parametros['detalhes'] = $equipamento->detalhes;
            $parametros['num_serial'] = $equipamento->num_serial;
            $parametros['num_patrimonio'] = $equipamento->num_patrimonio;
            $parametros['departamento'] = $equipamento->departamento;
            $parametros['categoria'] = $equipamento->categoria;
            $parametros['registros'] = $equipamento->registros;
            $parametros['autor_cadastro'] = $equipamento->autor_cadastro;

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //FUNÇÃO PARA ADICIONAR EQUIPAMENTOS
    public function adicionarEquipamento()
    {
        try {
            Equipamento::adicionar($_POST);
            echo '<script>alert("Equipamento inserido com sucesso");</script>';
            echo '<script>location.href="?pagina=home&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="?pagina=home&metodo=index"</script>';
        }
    }

    //FUNÇÃO QUE ALTERA OS DADOS DOS EQUIPAMENTOS
    public function alterarEquipamento()
    {
        try {
            Equipamento::alterar($_POST);
            echo '<script>alert("Equipamento alterado com sucesso");</script>';
            echo '<script>location.href="?pagina=equipamento&metodo=visualizarEquipamento&id=' . $_POST['id_equip'] . '"</script>';
        } catch (Exception $e) {
            echo $e->getMessage(); 
            
        }
    }
}
