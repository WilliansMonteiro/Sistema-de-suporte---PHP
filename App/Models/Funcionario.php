<?php
namespace App\Models;
use MF\Model\Model;

class Funcionario extends Model{
   private $id;
   private $nome;
   private $senha;
   private $email;

   public function __get($atributo){
      return $this->$atributo;
   }

   public function __set($atributo, $valor){
      $this->$atributo = $valor;
   }
  

   public function authFuncionario(){
      $query = "select id, nome, email, senha from funcionario where email = :email and senha = :senha";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':email', $this->__get('email'));
      $stmt->bindValue(':senha', $this->__get('senha'));
      $stmt->execute();
      $funcionario = $stmt->fetch(\PDO::FETCH_ASSOC);
      if($funcionario['id'] != '' && $funcionario['nome'] != ''){
         $this->__set('id', $funcionario['id']);
         $this->__set('nome', $funcionario['nome']);
      }
      return $this;
   }

}




?>