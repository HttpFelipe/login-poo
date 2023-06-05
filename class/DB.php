<?php
require_once('config.php');

class DB {
    private static $pdo;

   
    // Método responsável por obter a conexão com o banco de dados.
   
    public static function obterConexao() {
        // Verifica se a conexão já foi estabelecida
        if (!isset(self::$pdo)) {
            try {
                // Cria a conexão PDO utilizando as constantes de configuração
                self::$pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
                // Configura o PDO para lançar exceções em caso de erros
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Configura o PDO para retornar os resultados como objetos
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $erro) {
                // Em caso de falha na conexão, exibe uma mensagem de erro
                echo "Erro ao se conectar com o banco de dados: ".$erro->getMessage();
            }
        }

        // Retorna a instância do PDO
        return self::$pdo;
    }

    
    // Método responsável por preparar uma consulta SQL.
    
    public static function prepare($sql) {
        return self::obterConexao()->prepare($sql);
    }
}
?>