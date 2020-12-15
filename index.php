<?php

session_start();

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/EquipamentoController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Controller/RegistroController.php';
require_once 'app/Controller/LoginController.php';
require_once 'app/Controller/UsuarioController.php';
require_once 'app/Model/Connection.php';
require_once 'app/Model/Equipamento.php';
require_once 'app/Model/Registro.php';
require_once 'app/Model/Usuario.php';
require_once 'app/Model/UsuarioModel.php';
require_once 'app/Core/Core.php';
require_once 'vendor/autoload.php';

$template = file_get_contents('app/Template/template.html');


//METODO QUE PEGA O RETORNO DA FUNÇÃO START()
ob_start();
$core = new Core;
$core->start($_GET);
$saida = ob_get_contents();
ob_clean();

//SUBSTITUI A VARIAVEL {{AREA_DINAMICA}} QUE ESTÁ NO INDEX PELO RETORNO DO METODO ANTERIOR
$tplPronto = str_replace('{{content}}', $saida, $template);
echo $tplPronto;
