<?php
//PÁGINA RESPONSÁVEL POR RALIZAR CONEXÕES NO BANCO DE DADOS

class Equipamento
{
    public static function visualizarTodosEquipamentos()
    {
        $con = Connection::getConn();
        $sql = "SELECT *FROM equipamentos ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        $resultado = array();

        while ($row = $sql->fetchObject('Equipamento')) {
            $resultado[] = $row;
        }
        return $resultado;
    }


    public static function buscarPorId($idEquipamento)
    {
        $con = Connection::getConn();
        $sql = "SELECT * FROM equipamentos WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue('id', $idEquipamento, PDO::PARAM_INT);
        $sql->execute();
        $resultado = $sql->fetchObject('Equipamento');

        //VERIFICA A EXISTENCIA DE REGISTROS NO BANCO DE DADOS
        if (!$resultado) {
            throw new Exception("Ainda não há registros");
        } else {
            $resultado->registros = Registro::selecionarRegistros($resultado->id);
        }
        return $resultado;
    }


    public static function adicionar($dadosEquip)
    {
        $con = Connection::getConn();
        $autor_cadastro['name_user'] = $_SESSION['user']['name_user'];
        $sql = $con->prepare("SELECT count(*) FROM equipamentos WHERE :num_p = num_patrimonio");
        $sql->bindValue(':num_p', $dadosEquip['num_patrimonio']);
        $sql->execute();
        $count = $sql->fetchColumn();

        if ($count > 0) {
            throw new Exception(("Numero do patromônio público já cadastrado"));
        } else {
            $sql = 'INSERT INTO equipamentos (modelo, detalhes, num_serial , num_patrimonio, departamento, categoria, autor_cadastro, data_cadastro) VALUES (:model, :det, :num_s, :num_p, :dep, :cat, :aCad, NOW())';
            $sql = $con->prepare($sql);
            $sql->bindValue(':model', $dadosEquip['modelo']);
            $sql->bindValue(':det', $dadosEquip['detalhes']);
            $sql->bindValue(':num_s', $dadosEquip['num_serial']);
            $sql->bindValue(':num_p', $dadosEquip['num_patrimonio']);
            $sql->bindValue(':dep', $dadosEquip['departamento']);
            $sql->bindValue(':cat', $dadosEquip['categoria']);
            $sql->bindValue(':aCad', $autor_cadastro['name_user']);

            $resultado = $sql->execute();

            if ($resultado == 0) {
                throw new Exception(("Equipamento não inserido"));
                return false;
            }
        }
        return true;
    }

    public static function alterar($params)
    {
        $con = Connection::getConn();
        $sql = 'UPDATE equipamentos SET  modelo = :model, detalhes = :det, num_serial = :num_s,num_patrimonio = :num_p, departamento = :dep, categoria = :cat WHERE id = :id';
        $sql = $con->prepare($sql);
        $sql->bindValue(':model', $params['modelo']);
        $sql->bindValue(':det', $params['detalhes']);
        $sql->bindValue(':num_s', $params['num_serial']);
        $sql->bindValue(':num_p', $params['num_patrimonio']);
        $sql->bindValue(':dep', $params['departamento']);
        $sql->bindValue(':cat', $params['categoria']);
        $sql->bindValue(':id', $params['id_equip']);
        $sql->execute();

        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception(("Equipamento não alterado"));

            return false;
        }
        return true;
    }
}
