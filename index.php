<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pré Etec</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<link rel="shortcut icon" href="img/ico_escola.ico" />
	<?php require "conexao.php"; ?>
</head>
<body>
	<div id="logo">
		<img src="img/logoEtec.png" />
	</div>
	
	<div id="caixa_login">
		<?php
			if(isset($_POST['button']))
			{
				$login = $_POST['login'];
				$password = $_POST['password'];
	
				if($login == '')
				{
					echo "<h2> Por favor, digite o nome de usuário! </h2>";
				}
				else if($password == '')
				{
					echo "<h2> Por favor, digite sua senha! </h2>";		
				}
				else
				{
					$consulta_login = "SELECT * FROM login WHERE nome_usuario = '$login' AND senha = '$password'";
					$resultado_consulta_login = mysqli_query($conexao, $consulta_login);
					
					if(mysqli_num_rows($resultado_consulta_login) > 0)
					{
						while($resultado_consulta_login_1 = mysqli_fetch_assoc($resultado_consulta_login))
						{														
							$tipo_usuario = $resultado_consulta_login_1['tipo_usuario'];
							
							if($tipo_usuario == 'PROFESSOR')
							{								
								echo "<h2> Você Não tem acesso a essa Pagina!! </h2>";	
							}
							else
							{
								session_start();								
								
								$_SESSION['tipo_usuario'] = $tipo_usuario;
								
								echo "<script language='javascript'> window.location='admin/fazer_chamada.php?pg=chamada'; </script>";	
								
							}																									
						}
					}
					else
					{
						echo "<h2> Dados incorretos! </h2>";	
					} 
		
				}
			}
		?>
		<form name="form" method="post" action="" enctype="multipart/form-data">
			<table>
		  		<tr>
		   			<td>
						<h1>Nome de Usuário:</h1>
					</td>
		  		</tr>
		  		<tr>
		   			<td>
						<input type="text" name="login" />
					</td>
		  		</tr>
		   		<tr>
		   			<td>
						<h1>Senha:</h1>
					</td>
		  		</tr>
		  		<tr>
		   			<td>
						<input type="password" name="password" />
					</td>
		  		</tr>
		  		<tr>
		   			<td>
						<input class="input" type="submit" name="button" value="Entrar" />
					</td>
		  		</tr>
			</table>
		</form>
	</div>


</body>
</html>