# Sistema de Login com PHP Orientado a Objetos

<img src="https://www.hostinger.com/tutorials/wp-content/uploads/sites/2/2021/11/php-8-2.webp"> 

## Descrição
Um sistema de login desenvolvido em PHP orientado a objetos (POO) usando um banco de dados MySQL/MariaDB e autenticação via tokens JWT.

## Funcionalidades

- Registro de usuários
- Autenticação de login
- Geração de token JWT
- Página restrita acessível apenas para usuários autenticados

## Pré-requisitos

- Servidor web (por exemplo, Apache)
- PHP 7.0 ou superior
- MySQL ou MariaDB

## Configuração do Banco de Dados

1. Certifique-se de ter um servidor MySQL/MariaDB em execução.
2. Crie um banco de dados chamado `loginpoo`.
3. Dentro do banco de dados `loginpoo`, crie uma tabela chamada `users` com a seguinte estrutura:

   ```sql
   CREATE TABLE `users` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `nome` varchar(255) NOT NULL,
     `email` varchar(255) NOT NULL,
     `senha` varchar(255) NOT NULL,
     `token` varchar(255) NOT NULL,
     `data_cadastro` varchar(20) NOT NULL,
     PRIMARY KEY (`id`)
   );
4. Certifique-se de que as credenciais de acesso ao banco de dados estejam corretamente configuradas no arquivo config.php dentro da pasta Class.

## Instalação

5. Clone o repositório do GitHub:
 `git clone https://github.com/HttpFelipe/login-poo.git`
6. Navegue até o diretório raiz do projeto:
 `cd login-poo`
7. Instale as dependências usando o Composer:
`composer install`
8. Configure o servidor web para apontar para a pasta raiz do projeto.
9. Acesse o sistema de login em seu navegador:
`http://localhost/login-poo`

## Estrutura de Arquivos e Pastas

    Class: Contém as classes do projeto, incluindo a lógica de autenticação e interação com o banco de dados.
    css: Contém o arquivo CSS para estilização da interface.
    restrita: Contém os arquivos da área restrita acessível após o login.
    vendor: Contém as dependências do Composer.
    autoload.php: Arquivo gerado pelo Composer para carregar as classes automaticamente.
    cadastrar.php: Página de registro de usuários.
    composer.json e composer.lock: Arquivos de configuração do Composer.
    index.php: Página inicial do sistema de login.
    README.md: Este arquivo.

## Licença
Este projeto está licenciado sob a MIT License.
