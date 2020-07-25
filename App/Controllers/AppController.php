<?php
namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{

    public function novoServico(){
        $this->view->inserir = false;
        $this->view->erro = false;
        if(isset($_GET['inserir']) && $_GET['inserir'] == 1){
            $this->view->inserir = true;
        }

        if(isset($_GET['erro']) && $_GET['erro'] == 1){
            $this->view->erro = true;
        }

        $this->render('novoServico');

    }

    public function dadosServico(){
        $dadosServico = Container::getModel('Servico');
        if(isset($_POST['categoria'])){
            $dadosServico->__set('categoria', $_POST['categoria']);
            $dadosServico->__set('totalVendas', $dadosServico->listarVendas());
            echo json_encode($dadosServico->listarVendas());
        }
        $this->render('dadosServico');
    }

    public function dadosAjax(){
        $dadosAjax = Container::getModel('Servico');
        if(isset($_POST['categoria'])){
            $dadosAjax->__set('categoria', $_POST['categoria']);
            $dadosAjax->__set('totalVendas',$dadosAjax->listarVendas());
            echo json_encode($dadosAjax->listarVendas());
        }
    }

    public function inserir(){
    	$novoServico = Container::getModel('Servico');
        if($_POST['nome'] != '' && $_POST['endereco'] != '' && $_POST['servico'] != '' && $_POST['categoria'] != '' && $_POST['descricao'] != '' && $_POST['valor'] != '') {      

            $novoServico->__set('cliente', $_POST['nome']);
            $novoServico->__set('endereco', $_POST['endereco']);
            $novoServico->__set('servico', $_POST['servico']);
            $novoServico->__set('categoria', $_POST['categoria']);
            $novoServico->__set('descricao', $_POST['descricao']);
            $novoServico->__set('valor', $_POST['valor']);
            if($novoServico->salvar()){
               header('location:/novoServico?inserir=1');
           }


       } else {
        header('location:/novoServico?erro=1');
    }
}

public function todosServicos(){
    $todosServicos = Container::getModel('Servico');
    if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
       $todosServicos->__set('id', $_GET['id']);
       $todosServicos->excluirTodos();
   }
   if(isset($_GET['acao']) && $_GET['acao'] == 'modificarStatus'){
    $todosServicos->__set('id', $_GET['id']);
    $todosServicos->modificarStatus();
}

$variavelServicos = $todosServicos->listarTodos();
$this->view->listar = $variavelServicos;
$this->render('todosServicos');
}

public function atualizarTodos(){
    $todosServicos = Container::getModel('Servico');
    $todosServicos->__set('categoria', $_POST['categoria']);
    $todosServicos->__set('cliente', $_POST['cliente']);
    $todosServicos->__set('endereco', $_POST['endereco']);
    $todosServicos->__set('servico', $_POST['servico']);
    $todosServicos->__set('descricao', $_POST['descricao']);
    $todosServicos->__set('valor', $_POST['valor']);
    $todosServicos->__set('id', $_POST['id']);
    if($todosServicos->atualizarServico()){
        header('location:/todosServicos');
    }
}
 public function principal(){
    $this->render('principal');
  }
  public function clienteLogin(){
    $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
    $this->render('clienteLogin');
  }
  public function inscreverse(){
    $this->view->usuario = array(
             'nome' => '',
             'email' => '',
             'senha' => '',


            );
    $this->view->erroCadastro = false;
    $this->render('inscreverse');
  }

  public function registrar(){
   $registrarCliente = Container::getModel('Cliente');
   $registrarCliente->__set('nome', $_POST['nome']);
   $registrarCliente->__set('email', $_POST['email']);
   $registrarCliente->__set('senha', md5($_POST['senha']));
   if($registrarCliente->validarCadastro() && count($registrarCliente->getUsuarioPorEmail()) == 0 ){
      $registrarCliente->salvar();
      $this->render('cadastro');    
   } else {

     $this->view->usuario = array(
      'nome' => $_POST['nome'],
      'email' => $_POST['email'],
      'senha' => $_POST['senha'],
     );
     $this->view->erroCadastro = true;
     $this->render('inscreverse');
   }
  
  }

  public function autenticarCliente(){
     $cliente = Container::getModel('Cliente');
     $cliente->__set('email', $_POST['email']);
     $cliente->__set('senha', md5($_POST['senha']));
     
     $retorno = $cliente->authCliente();
     if($cliente->__get('id') != '' && $cliente->__get('nome')){
      session_start();
      $_SESSION['id'] = $cliente->__get('id');
      $_SESSION['nome'] = $cliente->__get('nome');
      header('location: /principalCliente');
     } else{
      header('location:/clienteLogin?login=erro');
     }
  }
  public function autenticarFuncionario(){
    $funcionario = Container::getModel('Funcionario');
    $funcionario->__set('email', $_POST['email']);
    $funcionario->__set('senha', $_POST['senha']);
    $retorno = $funcionario->authFuncionario();
    $captcha = $_POST['g-recaptcha-response'];
    if($funcionario->__get('id') != '' && $funcionario->__get('nome') != '' && $captcha != ''){
      session_start();
      $_SESSION['id'] = $funcionario->__get('id');
      $_SESSION['nome'] = $funcionario->__get('nome');
      header('location: /');
    } else {
      header('location: /funcionarioLogin?login=erro');
    }
  }

  public function principalCliente(){
    session_start();
    if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
      $this->render('principalCliente');
    } else {
      header('location:/clienteLogin?=erro');
    }

  
  }
  public function enviarEmail(){
    $this->view->erro = isset($_GET['error']) ? $_GET['error'] : '';
    $this->render('enviarEmail');
  }
  public function processaEnvio(){
    $this->render('processaEnvio');
  }
  public function emailSucesso(){
    $this->render('emailSucesso');
  }
  public function sair(){
    session_start();
    session_destroy();
    header('location:/principal');
  }
  public function funcionarioLogin(){
    $this->render('funcionarioLogin');
  }


} 



?>