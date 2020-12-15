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




    public static function cadastro($dadosUsua){
        $con = Connection::getConn();


        $sql = $con->prepare("SELECT count(*) FROM usuario WHERE :email = email");
        $sql->bindValue(':email', $dadosUsua['email']);
        $sql->execute();
        $count = $sql->fetchColumn();

        if($count > 0){
            throw new Exception(("Email já cadastrado."));
        }else{
            $sql = 'INSERT INTO usuario (nome, cargo, departamento, email, senha) VALUES (:nome, :cargo, :dep, :email, :senha)';
            $sql = $con->prepare($sql);
            $sql->bindValue(':nome', $dadosUsua['nome']);
            $sql->bindValue(':cargo', $dadosUsua['cargo']);
            $sql->bindValue(':dep', $dadosUsua['departamento']);
            $sql->bindValue(':email', $dadosUsua['email']);
            $sql->bindValue(':senha', $dadosUsua['senha']);

            echo $dadosUsua['nome'];
            echo $dadosUsua['cargo'];
            $resultado = $sql->execute();
    
            if ($resultado == 0) {
                throw new Exception(("Usuário não cadastrado."));
    
                return false;
            }           
        }
        return true;   
    }


}