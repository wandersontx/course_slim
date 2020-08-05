<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(new Tuupola\Middleware\JwtAuthentication([
    /*"variavel" que vai receber como valor o token. (no postman, será 'Key' e receberá como valor o 'token') --- Também pode ser usado o cabeçalho padrão que é Authorization, neste caso pode omitir a linha onde é informado o header
    */
    "header" => "X-Token",
    "regexp" => "/(.*)/",
     "path" => "/api", /* or ["/api", "/admin"] - rota a ser protegida*/
    "ignore" => ["/api/token"],
    "secret" => $container->get('settings')['secretkey']
]));

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
    	//Restrige acesso de sites a API. Neste caso esta permitindo que seja acessado por todos os sites
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            //Caso a API seja de consulta, podemos excluir os metodos POST, PUT, Delete
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});