<?php

use Slim\Http\Request;
use Slim\Http\Response;
Use App\Models\Produto;
use App\Models\Usuario;
use \Firebase\JWT\JWT;

//Rotas para gerãção de token
$app->post('/api/token', function($request, $response){

	$dados = $request->getParsedBody();

	$email = $dados['email'] ?? null;
	$senha = $dados['senha'] ?? null;

	$usuario = Usuario::where('email', $email)->first();
	if(!is_null($usuario) && (md5($senha) === $usuario->senha)){
		//Base para ser utilizada na geração do token
		$secretkey = $this->get('settings')['secretkey'];
		//gerando token
		$chaveAcesso = JWT::encode($usuario, $secretkey);
		return $response->withJson([
			'chave' => $chaveAcesso
		]);
	}

	return $response->withJson([
			'status' => 'erro'
		]);
});