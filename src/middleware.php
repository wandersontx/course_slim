<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
    	//Restrige acesso de sites a API. Neste caso esta permitindo que seja acessado por todos os sites
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            //Caso a API seja de consulta, podemos excluir os metodos POST, PUT, Delete
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});