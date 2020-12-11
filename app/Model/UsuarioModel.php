<?php

class UsuarioModel{

    public function validaLogin($usuario){
        $con = Connection::getConn();
        //VERIFICA SE EXISTE O EMAIL INSERIDO   
        $sql = 'SELECT * FROM usuario WHERE email = :email';
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->execute();

        //SE EXISTIR O EMAIL, VERIFICA SE A SENHA ESTÁ CORRETA
        if($stmt->rowCount()){
            $result = $stmt->fetch();

            if($result['senha'] === $usuario->getSenha()){
                $_SESSION['user'] = $result['id'];

                return true;
            }

        }

        throw new \Exception('Login Inválido');

    }


}