<?php

class UsuarioModel
{
    
    public static function exclui(){
        $con = Connection::getConn();

        $email_usuario['email'] = $_SESSION['user']['email'];

        $sql = "DELETE FROM usuario WHERE email = :email";
        $sql = $con->prepare($sql);

        $sql->bindValue(':email', $email_usuario['email']);
        $sql->execute();
        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception(("Usuário não excluido"));

            return false;
        }
        return true;
    }


    public static function listagemUsuarios()
    {
        $con = Connection::getConn();
        $sql = "SELECT *FROM usuario ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        $resultado = array();

        while ($row = $sql->fetchObject('Usuario')) {
            $resultado[] = $row;
        }
        return $resultado;
    }


    public function validaLogin($usuario)
    {
        $con = Connection::getConn();
        //VERIFICA SE EXISTE O EMAIL INSERIDO   
        $sql = 'SELECT * FROM usuario WHERE email = :email';
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->execute();

        //SE EXISTIR O EMAIL, VERIFICA SE A SENHA ESTÁ CORRETA
        if ($stmt->rowCount()) {
            $result = $stmt->fetch();

            if (password_verify($usuario->getSenha(), $result['senha'])) {
                $_SESSION['user'] = array(
                    'id_user' => $result['id'],
                    'name_user' => $result['nome'],
                    'cargo' => $result['cargo'],
                    'departamento' => $result['departamento'],
                    'email' => $result['email']
                );
                return true;
            }
        }
        throw new \Exception('Login Inválido');
    }


    public static function cadastro($dadosUsua)
    {
        $con = Connection::getConn();
        $sql = $con->prepare("SELECT count(*) FROM usuario WHERE :email = email");
        $sql->bindValue(':email', $dadosUsua['email']);
        $sql->execute();
        $count = $sql->fetchColumn();

        if ($count > 0) {
            echo '<script>alert("Email já cadastrado, tente outro.");</script>';
            echo '<script>location.href="?pagina=login&metodo=index"</script>';
            die();
        } else {
            $senhaHash = password_hash($dadosUsua['senha'], PASSWORD_DEFAULT);

            $sql = 'INSERT INTO usuario (nome, cargo, departamento, email, senha) VALUES (:nome, :cargo, :dep, :email, :sh)';
            $sql = $con->prepare($sql);
            $sql->bindValue(':nome', $dadosUsua['nome']);
            $sql->bindValue(':cargo', $dadosUsua['cargo']);
            $sql->bindValue(':dep', $dadosUsua['departamento']);
            $sql->bindValue(':email', $dadosUsua['email']);
            $sql->bindValue(':sh', $senhaHash);
            $resultado = $sql->execute();

            if ($resultado == 0) {
                throw new Exception(("Usuário não cadastrado."));

                return false;
            }
        }
        return true;
    }


    public static function altera($params)
    {
        $con = Connection::getConn();
        $sql = 'UPDATE usuario SET  nome = :nome, cargo = :cargo, departamento = :dep, email = :email, senha = :senha WHERE id = :id';
        $sql = $con->prepare($sql);
        $sql->bindValue(':nome', $params['nome']);
        $sql->bindValue(':cargo', $params['cargo']);
        $sql->bindValue(':senha', $params['senha']);
        $sql->bindValue(':email', $params['email']);
        $sql->bindValue(':dep', $params['departamento']);
        $sql->bindValue(':id', $params['id_equip']);
        $sql->execute();
        $resultado = $sql->execute();

        if ($resultado == 0) {
            throw new Exception(("Usuário não alterado"));

            return false;
        }
        return true;
    }

}
