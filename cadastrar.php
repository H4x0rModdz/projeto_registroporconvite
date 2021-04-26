<?php
session_start();
require 'config.php';

if(!empty($_GET['codigo'])) {
    $codigo = addslashes($_GET['codigo']);

    $sql = "SELECT * FROM usuarios WHERE codigo = '$codigo'";
    $sql = $pdo->query($sql);

    if($sql->rowCount() == 0) {
        header("Location: login.php");
        exit;
    }

} else {
    header("Location: login.php");
    exit;
}
if(!empty($_POST['email'])) {
	$email = addslashes($_POST['email']);
	$senha = md5($_POST['senha']);

	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	$sql = $pdo->query($sql);

	if($sql->rowCount() <= 0) {

		$codigo = md5(rand(0,9999999).rand(0,9999999));
		$sql = "INSERT INTO usuarios (email, senha, codigo) VALUES ('$email', '$senha', '$codigo')";
		$sql = $pdo->query($sql);

		unset($_SESSION['logado']);

		header("Location: index.php");
		exit;
	}
}
?>

<h3>Cadastrar</h3>

<form method="POST">
    Email:<br/>
    <input type="email" name="email" placeholder="usuario" /><br/><br/>

    Senha:<br/>
    <input type="password" name="senha" placeholder="*******" /><br/><br/>

    <input type="submit" value="Cadastrar Usuário" />
</form>