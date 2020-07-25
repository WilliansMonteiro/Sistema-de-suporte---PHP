<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		$routes['novoServico'] = array(
			'route' => '/novoServico',
			'controller' => 'AppController',
			'action' => 'novoServico'
		);
		$routes['todosServicos'] = array(
			'route' => '/todosServicos',
			'controller' => 'AppController',
			'action' => 'todosServicos'
		);
		$routes['inserir'] = array(
			'route' => '/inserir',
			'controller' => 'AppController',
			'action' => 'inserir'
		);
		$routes['atualizarTodos'] = array(
			'route' => '/atualizarTodos',
			'controller' => 'AppController',
			'action' => 'atualizarTodos'
		);
		$routes['removerTodos'] = array(
			'route' => '/removerTodos',
			'controller' => 'AppController',
			'action' => 'removerTodos'
		);
			$routes['atualizarPendentes'] = array(
			'route' => '/atualizarPendentes',
			'controller' => 'IndexController',
			'action' => 'atualizarPendentes'
		);
			$routes['dadosServico'] = array(
			'route' => '/dadosServico',
			'controller' => 'AppController',
			'action' => 'dadosServico'
		);
			$routes['dadosAjax'] = array(
			'route' => '/dadosAjax',
			'controller' => 'AppController',
			'action' => 'dadosAjax'
		);
			$routes['principalCliente'] = array(
			'route' => '/principalCliente',
			'controller' => 'ClienteController',
			'action' => 'principalCliente'
		);
			$routes['principal'] = array(
			'route' => '/principal',
			'controller' => 'AppController',
			'action' => 'principal'
		);
			 $routes['clienteLogin'] = array(
			'route' => '/clienteLogin',
			'controller' => 'AppController',
			'action' => 'clienteLogin'
		);
			 $routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'AppController',
			'action' => 'inscreverse'
		);
			 $routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'AppController',
			'action' => 'registrar'
		);
			 $routes['autenticarCliente'] = array(
			'route' => '/autenticarCliente',
			'controller' => 'AppController',
			'action' => 'autenticarCliente'
		);
		    $routes['principalCliente'] = array(
			'route' => '/principalCliente',
			'controller' => 'AppController',
			'action' => 'principalCliente'
		);
		    $routes['enviarEmail'] = array(
			'route' => '/enviarEmail',
			'controller' => 'AppController',
			'action' => 'enviarEmail'
		);
		     $routes['processaEnvio'] = array(
			'route' => '/processaEnvio',
			'controller' => 'AppController',
			'action' => 'processaEnvio'
		);
		     $routes['emailSucesso'] = array(
			'route' => '/emailSucesso',
			'controller' => 'AppController',
			'action' => 'emailSucesso'
		);
		     $routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AppController',
			'action' => 'sair'
		);
		     $routes['funcionarioLogin'] = array(
			'route' => '/funcionarioLogin',
			'controller' => 'AppController',
			'action' => 'funcionarioLogin'
		);
		     $routes['autenticarFuncionario'] = array(
			'route' => '/autenticarFuncionario',
			'controller' => 'AppController',
			'action' => 'autenticarFuncionario'
		);




			
		

		$this->setRoutes($routes);
	}

}

?>