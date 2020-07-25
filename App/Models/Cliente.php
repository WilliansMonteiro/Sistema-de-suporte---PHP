<?php
namespace App\Models;
use MF\Model\Model;

class Cliente extends Model{
   private $id;
   private $nome;
   private $email;
   private $senha;
   
 //salvar
 //validar se um cadastro pode ser feito
 //recuperar um usuario por e-mail

 public function __get($atributo){
   return $this->$atributo;
 }  
 public function __set($atributo, $valor){
   $this->$atributo = $valor;
 }

 public function salvar(){
   $query = "insert into cliente (nome,email,senha) values (:nome,:email,:senha)";
   $stmt = $this->db->prepare($query);
   $stmt->bindValue(':nome', $this->__get('nome'));
   $stmt->bindValue(':email', $this->__get('email'));
   $stmt->bindValue(':senha', $this->__get('senha'));
   $stmt->execute();
   return $this;
 }

 public function validarCadastro(){
   $valido = true;

   if(strlen($this->__get('nome')) < 3){
     $valido = false;
   }
    if(strlen($this->__get('email')) < 3){
     $valido = false;
   }
    if(strlen($this->__get('senha')) < 3){
     $valido = false;
   }

   return $valido;
 }

 public function getUsuarioPorEMail(){
   $query = "select nome, email from cliente where email = :email";
   $stmt = $this->db->prepare($query);
   $stmt->bindValue(':email', $this->__get('email'));
   $stmt->execute();
   return $stmt->fetchAll(\PDO::FETCH_ASSOC);
 }

 public function authCliente(){
  $query = "select id, nome, email from cliente where email = :email and senha = :senha";
  $stmt = $this->db->prepare($query);
  $stmt->bindValue(':email', $this->__get('email'));
  $stmt->bindValue(':senha', $this->__get('senha'));
  $stmt->execute();
  $cliente = $stmt->fetch(\PDO::FETCH_ASSOC);
  if($cliente['id'] != '' && $cliente['nome'] != '' ){
    $this->__set('id', $cliente['id']);
    $this->__set('nome', $cliente['nome']);
  }
  return $this;
 }



}
 



?>