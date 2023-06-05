<?php
require_once('DB.php');
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';

use Firebase\JWT\JWT;

class Login {
    protected string $tabela = 'users';
    public string $email;
    private string $senha;
    public string $nome;
    public array $erro = [];

    
    // Realiza a autenticação do usuário.
    
    public function auth($email, $senha) {
        $senha_cripto = sha1($senha);
        
        // Verificar se o usuário está cadastrado
        $sql = "SELECT * FROM $this->tabela WHERE email=? AND senha=? LIMIT 1";
        $sql = DB::prepare($sql);
        $sql->execute(array($email, $senha_cripto));

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Gerar o token JWT
            $key = "example_key";
            $payload = array(
                "email" => $usuario['email'],
                "nome" => $usuario['nome']
            );
            $token = JWT::encode($payload, $key);

            // Atualizar o token no banco de dados
            $sql = "UPDATE $this->tabela SET token=? WHERE email=? AND senha=? LIMIT 1";
            $sql = DB::prepare($sql);
            if ($sql->execute(array($token, $email, $senha_cripto))) {
                // Colocar o token na sessão
                $_SESSION['TOKEN'] = $token;
                // Redirecionar para a área restrita
                header('location: restrita/index.php');
            } else {
                $this->erro["erro_geral"] = "Falha ao se comunicar com o servidor!";
            }
        } else {
           $this->erro["erro_geral"] = "Usuário ou senha incorretos!";
        }
    }

    
    // Verifica se o token de autenticação é válido.
    
    public function isAuth($token) {
        $sql = "SELECT * FROM $this->tabela WHERE token=? LIMIT 1";
        $sql = DB::prepare($sql);
        $sql->execute(array($token));

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $this->nome =  $usuario["nome"]; 
            $this->email =  $usuario["email"];
        } else {
            header('location: ../index.php');
        }
    }
}
