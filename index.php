<?php
	//Llamado a la clase de Conexión
	require 'db/database.php';
	//Inicializar variable de almacenamiento del controlador base
	$controller = 'empleadoController';
	//Determinar Acciones a Tomar
	if(!isset($_REQUEST['controller'])) {
		//Llamado a la clase controlador a usar
		require 'controllers/'.$controller.'.php';

		$controller = ucwords($controller);
		$controller = new $controller;
		$controller->index();
	} else {
		//Cuando existe una solicitud desde el navegador
		$controller = ucwords($_REQUEST['controller']. 'Controller');
		//condicional ternario   condición           si es Verdad        si es Falso
		$method		= isset($_REQUEST['method']) ? $_REQUEST['method'] : 'index';

		require 'controllers/'.$controller.'.php';
		$controller = new $controller;

		//realizar el llamado o la ejecución del metodo en el controlador
		call_user_func(array($controller, $method));	

	}