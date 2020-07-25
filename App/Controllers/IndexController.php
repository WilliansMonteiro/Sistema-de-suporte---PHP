<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
       $servicosPendentes = Container::getModel('Servico');
       if(isset($_GET['acao']) && $_GET['acao'] == 'modificarStatus'){
       	 $servicosPendentes->__set('id', $_GET['id']);
       	 $servicosPendentes->modificarStatus();
       }

       if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
       	$servicosPendentes->__set('id', $_GET['id']);
       	$servicosPendentes->excluirTodos();
       }

       $this->view->pendentes = $servicosPendentes->listarPendentes();
	   $this->render('index');
	}

	public function atualizarPendentes(){
      $atualizarPendentes = Container::getModel('Servico');
      $atualizarPendentes->__set('id', $_POST['id']);
      $atualizarPendentes->__set('categoria', $_POST['categoria']);
      $atualizarPendentes->__set('cliente', $_POST['cliente']);
      $atualizarPendentes->__set('endereco', $_POST['endereco']);
      $atualizarPendentes->__set('servico', $_POST['servico']);
      $atualizarPendentes->__set('descricao', $_POST['descricao']);
      $atualizarPendentes->__set('valor', $_POST['valor']);
      if($atualizarPendentes->atualizarServico()){
      	header('location:/');
      }

	}
      

}


?>