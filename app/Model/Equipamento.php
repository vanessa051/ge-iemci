<?php

class Equipamento{

    public static function allHardwares(){
        $con = Connection::getConn();
        

        $sql = "SELECT * FROM equipamentos ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado =array();

        while($row = $sql->fetchObject('Equipamento')){
        $resultado[] = $row;
        }

        if(!$resultado){
            throw new Exception("Não foi encontrado registro no banco");
        }

        return $resultado;
    }

    public static function getById($idEquipamento){
        $con = Connection::getConn();

        $sql = "SELECT * FROM equipamentos WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue('id', $idEquipamento, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Equipamento');

        //ESSA PARTE VAI VER SE TEM REGISTROS DE ALTERACAO NO BD
       /* if(!$resultado){
            throw new Exception("Não foi encontrado registro no banco");
        }else{
            $resultado->comentarios = Equipamento::selecionarComentarios($resultado->id);

            
        }*/

        return $resultado;

    }
    

    public static function insert($dadosPost){

        /*FAZER TRATAMENTO DE SQL INJECTION
        if(empty($dadosPost['modelo']) || empty($dadosPost['serial'])){
            throw new Exception("Preencha todod os canpos", 1);

            return false;
        }*/

        $con = Connection::getConn();

        $sql = 'INSERT INTO equipamentos (modelo, detalhes, num_serial, num_patrimonio, departamento, categoria) VALUES (:model, :det, :num_s, :num_p, :dep, :cat)';
        $sql = $con->prepare($sql);
        $sql->bindValue(':model', $dadosPost['modelo']);
        $sql->bindValue(':det', $dadosPost['detalhes']);
        $sql->bindValue(':num_s', $dadosPost['num_serial']);
        $sql->bindValue(':num_p', $dadosPost['num_patrimonio']);
        $sql->bindValue(':dep', $dadosPost['departamento']);
        $sql->bindValue(':cat', $dadosPost['categoria']);

        $resultado = $sql->execute();

        if ($resultado == 0){
            throw new Exception(("Publicação não inserida"));

            return false;
        }

        return true;

        }
}