<?php

class Registro{
    public static function selecionarRegistros($idEquip){
        $con = Connection::getConn();

        $sql = "SELECT * FROM registro WHERE id_equip = :id ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idEquip, PDO::PARAM_INT);
        $sql->execute();

        $resultado = array();

        while($row = $sql->fetchObject('Registro')){
            $resultado[] = $row;
        }

        return $resultado;

    }

    public static function insert($dadosRegistro){

        if(empty($dadosRegistro['descricao'])){
            throw new Exception("Preencha todod os canpos", 1);

            return false;
        }

        $con = Connection::getConn();

        $sql = 'INSERT INTO registro (descricao, id_equip, data_registro) VALUES (:descr, :id_equip, NOW())';
        $sql = $con->prepare($sql);
        $sql->bindValue(':descr', $dadosRegistro['descricao']);
        $sql->bindValue(':id_equip', $dadosRegistro['id_equip'], PDO::PARAM_INT);

        $resultado = $sql->execute();

        if ($resultado == 0){
            throw new Exception(("Registro não inserido"));

            return false;
        }

        return true;

    }
}