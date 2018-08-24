<?php $usuario_atual = "ADMINISTRADOR";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php require "../config.php"; ?>
	<link href="css/topo.css" rel="stylesheet" type="text/css" />
	<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
	<script src="../js/lightbox.js"></script>
	<link href="../css/lightbox.css" rel="stylesheet" />
	<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="../jquery.superbox-min.js"></script>
	<script type="text/javascript">
		$(function(){
			$.superbox.settings = {
				closeTxt: "Fechar",
				loadTxt: "Carregando...",
				nextTxt: "Next",
				prevTxt: "Previous"
			};
			$.superbox();
		});
	</script>   
</head>
<body bgcolor="#000">
	 <div id="box_topo">
 		<div id="logo">
  			<img src="../img/logoEtec.png" width="130"/>
 		</div> 
 		<div id="campo_busca">
  			<form name="" method="post" action="" enctype="multipart/form-data">
   				<input type="text" name="key" /><input class="input" type="submit" name="search" value="Buscar" />
 			</form>
 		</div>  
 		<div id="mostra_login">
  			<h1><!--<strong>Seja Bem Vindo - Usuário atual: <#?php echo @$nome_usuario; ?></strong>--></h1>
			<!-- <strong><a href="../config.php?pg=sair">Sair</a></strong></h1> -->
			<a href="../config.php?pg=sair"> <input id="logout" class="input" type="submit" name="logout" value="Sair" /> </a>
 		</div> 
	</div>
	<div id="box_menu">
 		<div id="menu_topo">
  			<ul>   				
   				<li> <a href="fazer_chamada.php">CHAMADA</a> </li>   				
   				<li><a href="">TURMAS</a>
					<ul>
						<li>
							<a href="cursos_e_disciplinas.php?pg=turma">Cadastrar Turma</a>
						</li>
						<li>
							<a href="cursos_e_disciplinas.php?pg=matricula">Realizar Matricula</a>
						</li>
						<li>
							<!--<a href="cursos_e_disciplinas.php?pg=chamada">Realizar Chamada</a>-->
						</li>
					</ul>
				</li>
				<li>
					<a href="">PROFESSORES</a>
					<ul>
						<li>
							<a href="professores.php?pg=professor">Professores</a><!--pg=professor-->
						</li>
						<li>
							<a href="professores.php?pg=disciplina">Disciplinas</a><!--pg=disciplinas-->
						</li>
						<li>
							<a href="professores.php?pg=disciplinas_ministradas">Professores & Disciplinas</a><!--pg=professoredisciplinas-->
						</li>
					</ul>
				</li>   				
				<li>
					<a href="">ESTUDANTES</a>
					<ul>
						<li>
							<a href="estudantes.php?pg=espera">Lista Espera</a>
						</li>
						<li>
							<a href="estudantes.php?pg=aluno">Alunos</a>
						</li>						
					</ul>
				</li>
 			</ul>
 		</div><!-- menu_topo -->
	</div><!-- box_menu -->
</body>
</html>