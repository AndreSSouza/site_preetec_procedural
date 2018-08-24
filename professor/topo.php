<? $painel_atual = "professor";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require "../config.php"; $code; ?>
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<title>To Learn - Administração do Professor</title>
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

<body>
<div id="box_topo">
 
 <div id="logo">
  <img src="../img/logo.png" width="250" />
 </div><!-- logo -->
 
 <div id="campo_busca">
 
 
 
  <form name="" method="post" action="" enctype="multipart/form-data">
   <input type="text" name="key" /><input class="input" type="submit" name="search" value="" />
  </form>
 </div><!-- campo_busca -->
 
 <div id="mostra_login">
  <h1><strong>Olá Professor! Seu código é:</strong> <?php echo @$code; ?> <strong><a href="../config.php?pg=sair">Sair</a></strong></h1>
 </div><!-- mostra_login -->
</div><!-- box_topo -->

<div id="box_menu">
 
 <div id="menu_topo">
  <ul>
   <li><a href="index.php">HOME</a></li>
   <li><a href="turmas_e_alunos.php">TURMAS & ALUNOS</a></li>   
   <li><a href="">TODAS AS AVALIAÇÕES</a>
    <ul>
     <li><a href="trabalhos_bimestrais.php">Trabalhos bimestrais</a></li>
     <li><a href="todas_as_avaliacoes.php?pg=provas_bimestrais">Provas bimestrais</a></li>
     <li><a href="trabalhos_extras.php">Trabalhos extras</a></li>
     <li><a href="notas_observacoes.php">Notas de observação</a></li>
    </ul>
   </li>
   <li><a href="suporte_tecnico.php">SUPORTE TECNICO</a></li>
  </ul>
 </div><!-- menu_topo -->

</div><!-- box_menu -->
</body>
</html>