<?php
namespace App\Models;
use MF\Model\Model;

class Servico extends Model{
   private $id;
   private $id_status;
   private $cliente;
   private $servico;
   private $categoria;
   private $endereco;
   private $data_cadastro;
   private $valor;
   private $totalVendas;


   public function __get($atributo){
   	return $this->$atributo;
   }
   public function __set($atributo, $valor){
   	$this->$atributo = $valor;
   }

   public function salvar(){
   	$query = "insert into tb_servico (cliente,servico,categoria,endereco,descricao, valor) values (:cliente, :servico, :categoria, :endereco, :descricao, :valor)";
   	$stmt = $this->db->prepare($query);
   	$stmt->bindValue(':cliente', $this->__get('cliente'));
   	$stmt->bindValue(':servico', $this->__get('servico'));
   	$stmt->bindValue(':categoria', $this->__get('categoria'));
   	$stmt->bindValue(':endereco', $this->__get('endereco'));
   	$stmt->bindValue(':descricao', $this->__get('descricao'));
   	$stmt->bindValue(':valor', $this->__get('valor'));
   	$stmt->execute();
   	return $this;
   }

   public function listarTodos(){
   	$query = "select t.id, t.id_status, t.categoria, t.cliente, t.servico, t.endereco, t.descricao,
          DATE_FORMAT(t.data_cadastrado, '%d/%m/%Y %H:%i') as data_cadastrado, t.valor, 
   	    s.status
   	     from tb_servico as t left join tb_status as s on (t.id_status = s.id)";
   	$stmt = $this->db->prepare($query);
   	$stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }

   public function atualizarServico(){

      $query = "update tb_servico
       set
      categoria = :categoria, 
      cliente   = :cliente,
      endereco  = :endereco,
      servico   = :servico,
      descricao = :descricao,
      valor     = :valor
      where id  = :id";

      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':categoria', $this->__get('categoria'));
      $stmt->bindValue(':cliente', $this->__get('cliente'));
      $stmt->bindValue(':endereco', $this->__get('endereco'));
      $stmt->bindValue(':servico', $this->__get('servico'));
      $stmt->bindValue(':descricao', $this->__get('descricao'));
      $stmt->bindValue(':valor', $this->__get('valor'));
      $stmt->bindValue(':id', $this->__get('id'));
      return $stmt->execute();
     
   }

   public function excluirTodos(){
      $query = "delete from tb_servico where id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':id', $this->__get('id'));
      $stmt->execute();
      return true;
   }

   public function modificarStatus(){
      $query = "update tb_servico set id_status = 2 where id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':id', $this->__get('id'));
      $stmt->execute();
      return true;
   }

   public function listarPendentes(){
      $query = "select t.id, t.id_status, s.status, t.categoria, t.cliente, t.endereco, t.servico, t.descricao, 
        DATE_FORMAT(t.data_cadastrado, '%d/%m/%Y %H:%i') as data_cadastrado, valor from tb_servico as t left join tb_status as s on (t.id_status = s.id) where t.id_status = 1";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }

   public function listarVendas(){
      $query = "select SUM(valor) as totalVendas from tb_servico where categoria = :categoria";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':categoria', $this->__get('categoria'));
      $stmt->execute();
      return $stmt->fetch(\PDO::FETCH_OBJ)->totalVendas;
   }



}




?>