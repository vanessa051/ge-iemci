<?php

class Equipamento{

    public static function allHardwares(){
        $con = Connection::getConn();
        

        $sql = "SELECT *FROM equipamentos ORDER BY id DESC";
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
       if(!$resultado){
            throw new Exception("Ainda não há registros");
        }else{
            $resultado->registros = Registro::selecionarRegistros($resultado->id);

            
        }

        return $resultado;

    }
    

    public static function insert($dadosEquip){

        /*FAZER TRATAMENTO DE SQL INJECTION
        if(empty($dadosEquip['modelo']) || empty($dadosEquip['serial'])){
            throw new Exception("Preencha todod os canpos", 1);

            return false;
        }*/

        $con = Connection::getConn();

        $sql = 'INSERT INTO equipamentos (modelo, detalhes, num_serial, num_patrimonio, departamento, categoria, data_cadastro) VALUES (:model, :det, :num_s, :num_p, :dep, :cat, NOW())';
        $sql = $con->prepare($sql);
        $sql->bindValue(':model', $dadosEquip['modelo']);
        $sql->bindValue(':det', $dadosEquip['detalhes']);
        $sql->bindValue(':num_s', $dadosEquip['num_serial']);
        $sql->bindValue(':num_p', $dadosEquip['num_patrimonio']);
        $sql->bindValue(':dep', $dadosEquip['departamento']);
        $sql->bindValue(':cat', $dadosEquip['categoria']);

        $resultado = $sql->execute();

        if ($resultado == 0){
            throw new Exception(("Publicação não inserida"));

            return false;
        }

        return true;

        }
}