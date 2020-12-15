<?php




class Usuario{
    private $nome;
    private $cargo;
    private $departamento;
    private $email;
    private $senha;


    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function setDepartamento($departamento){
        $this->departamento = $departamento;
    }

    public function getDepartamento(){
        return $this->departamento;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }
   
}