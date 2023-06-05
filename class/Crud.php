<?php
require_once('DB.php');

abstract class Crud extends DB{
    protected string $tabela;

    
    // Método abstrato para inserir registros.
     
    abstract public function insert();

   
    // Método abstrato para atualizar registros.
    
    abstract public function update($id);

    
    // Busca um registro pelo seu ID.
   
    public function find($id){
        $sql = "SELECT * FROM $this->tabela WHERE id=?";
        $sql = DB::prepare($sql);
        $sql->execute(array($id));
        $valor = $sql->fetch();
        return $valor;
    }

   
    //  Busca todos os registros da tabela.
    
    public function findAll(){
        $sql = "SELECT * FROM $this->tabela";
        $sql = DB::prepare($sql);
        $sql->execute();
        $valor = $sql->fetchAll();
        return $valor;
    }

    
    // Deleta um registro pelo seu ID.
    
    public function delete($id){
        $sql = "DELETE FROM $this->tabela WHERE id=?";
        $sql = DB::prepare($sql);
        return $sql->execute(array($id));
    }
}
