<?php
require_once('Crud.php');

class Usuario extends Crud{
    protected string $tabela = 'users';

    function __construct(
        public string $nome,
        private string $email,
        private string $senha,
        private string $repete_senha="",
        private string $recupera_senha="",
        private string $token="",
        private string $codigo_confirmacao="",
        private string $status="",
        public array $erro=[]
    ){}

    
    // Define o valor da repetição de senha.
    
    public function set_repeticao($repete_senha){
        $this->repete_senha = $repete_senha;
    }

    
    // Valida os dados de cadastro do usuário.
   
    public function validar_cadastro(){

        // VALIDAÇÃO DO NOME
        if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$this->nome)) {
           $this->erro["erro_nome"] = "Por favor informe um nome válido!";
        }

        // VERIFICAR SE EMAIL É VÁLIDO
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->erro["erro_email"] = "Formato de e-mail inválido!";
        }

        // VERIFICAR SE SENHA TEM MAIS DE 6 DÍGITOS
        if(strlen($this->senha) < 6){
            $this->erro["erro_senha"] = "Senha deve ter 6 caracteres ou mais!";
        }

        if($this->senha !== $this->repete_senha){
            $this->erro["erro_repete"] = "Senha e repetição de senha diferentes!";
        }

    }

    
    // Insere um novo usuário no banco de dados.
    
    public function insert(){
        // VERIFICAR SE ESTE EMAIL JÁ ESTÁ CADASTRADO NO BANCO
        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
        $sql = DB::prepare($sql);
        $sql->execute(array($this->email));
        $usuario = $sql->fetch();
        // SE NÃO EXISTIR O USUÁRIO - ADICIONAR NO BANCO
        if (!$usuario){
            $data_cadastro = date('d/m/Y');
            $senha_cripto = sha1($this->senha);
            $sql = "INSERT INTO $this->tabela VALUES (null,?,?,?,?,?)";
            $sql = DB::prepare($sql);
            return $sql->execute(array($this->nome,$this->email,$senha_cripto,$this->token,$data_cadastro));
        }else{
            $this->erro["erro_geral"] = "Usuário já cadastrado!";
            return false;
        }
    }

    
    // Atualiza o token de um usuário no banco de dados.
   
    public function update($id){
        $sql = "UPDATE $this->tabela SET token=? WHERE id=?";
        $sql = DB::prepare($sql);
        return $sql->execute(array($this->token,$id));
    }
}
