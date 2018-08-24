<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Configuraçoes</title>
</head>
<body>
	<?php 
	/*	require "conexao.php";
	
		@session_start();
		$_SESSION['nome_usuario'] = $nome_usuario;
		$_SESSION['nome_completo'] = $nome_completo;
		$_SESSION['senha'] = $senha;
		$_SESSION['tipo_usuario'] = $tipo_usuario;
	
		if($nome_usuario == '')
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";	
		}
		else if($nome_completo == '')
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";	
		}
		else if($senha == '')
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";
		}
		else if($usuario_atual != $tipo_usuario)
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";
		} */
	?>
	<?php 
		if(@$_GET['pg'] == 'sair')
		{			
			session_destroy(); 
			$_SESSION['nome_usuario'] = $nome_usuario;
			$_SESSION['nome_completo'] = $nome_completo;
			$_SESSION['senha'] = $senha;
			$_SESSION['tipo_usuario'] = $tipo_usuario;
			
			echo "<script language='javascript'>window.location='index.php';</script>";
			
		}	
	?>

</body>
</html>