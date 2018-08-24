<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Chamada</title>
	<link rel="stylesheet" type="text/css" href="../professor/css/fazer_chamada.css"/>
	<link href="css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />
	<?php require "../conexao.php";?>
</head>
<body>	
	<?php require "topo.php"; ?>
	<div id="caixa_preta">
	</div><!-- caixa_preta -->	
	<!--<div id="box_curso">
		<br/>
		<a class="a2" href="fazer_chamada.php?cadastra=sim"> Realizar Chamada </a>
	<?php /* if(@$_GET['pg'] == 'chamada'){ ?>
 		<h1>Fazer Chamada:</h1>		
		<?php  if(isset($_POST['enviar'])){
			$data_hoje = date("Y-m-d");
			$turma = $_POST['cod_turma'];
			$aluno = $_POST['cod_aluno'];
			$professor = $_POST['cod_professor'];
			$presenca = $_POST['presenca'];
	
			$sql_insert_chamada = ("INSERT INTO chamada (cod_turma, cod_aluno, cod_professor, data_chamada, Presenca) VALUES ('$turma','$aluno','$professor','$data_hoje','$presenca')");
	
			$insert_chamada = mysqli_query($conexao, $sql_insert_chamada);
			
			if($insert_chamada == ''){
				echo "Erro ao fazer a chamada!";
			}else{
				echo "Chamada realizada com exito!";
				echo "<script language='javascript'>window.location='fazer_chamada.php?pg=chamada';</script>";
			}
	
		} ?> 
	<form name="button" method="post" enctype="multipart/form-data" action="">
		<table width="780" border="0">
  			<tr>
    			<td>Código da turma:</td>
    			<td>Código do aluno:</td>    			
  			</tr>
  			<tr>
				<td>
					<input type="text" name="cod_turma">
				</td>
				<td>				
					<input type="text" name="cod_aluno">
				</td>
			</tr>
			<tr>
				<td>Código do professor</td>
				<td>Presente ?</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="cod_professor">
				</td>				
    			<td>
					<input type="radio" name="presenca" value="1">Sim
					<input type="radio" name="presenca" value="0">Não
				</td>
			</tr>
    		<tr>
    			<td>
					<input class="input" type="submit" name="enviar" id="button" value="Enviar">
				</td>
			</tr>
		</table>
	</form>
    <?php# } ?>-->
	</div><!-- box 
	
	
	
	
	<div id="box_curso">
		<?php if(@$_GET['pg'] == 'chamada'){?>
		
			<?php if(isset($_POST['buscar'])){	
			$cod_turma = $_POST['turma'];	
			$cod_professor = $_POST['professor'];
			$sql_resultado_consulta_nome_turma = "SELECT * FROM turma WHERE cod_turma = '$cod_turma'";
			$resultado_consulta_nome_turma = mysqli_query($conexao, $sql_resultado_consulta_nome_turma) or die('Não consultado!');
			$valores_nome_turma = mysqli_fetch_assoc($resultado_consulta_nome_turma);
			$nome_turma = $valores_nome_turma['nome_turma'];
			$sql_resultado_consulta_nome_professor = "SELECT * FROM professor WHERE cod_professor = '$cod_professor'";
			$resultado_consulta_nome_professor = mysqli_query($conexao, $sql_resultado_consulta_nome_professor) or die('Não consultado!');
			$valores_nome_professor = mysqli_fetch_assoc($resultado_consulta_nome_professor);
			$nome_professor = $valores_nome_professor['nome']; ?>
		
 			<h1><center>Chamada na Turma <strong><?php echo $nome_turma; ?></strong>, com o Professor(a) <strong><?php echo $nome_professor; ?></strong></center></h1><br/>
				<?php } else{ ?>
				<h1><center>Chamada: Selecione a turma e o professor e dê "Buscar"</center></h1><br/>	
			<?php } ?>	
		
			<form id="form_busca_chamada" name="form_select_chamadas" method="post">
				<table>
					<tr>
						<td>Selecione a Turma:</td>
						<td>
							<select name="turma" style="width:60px">
								<?php $sql_resultado_consulta_turma = "SELECT * FROM turma WHERE nome_turma != ''";
								$resultado_consulta_turma = mysqli_query($conexao, $sql_resultado_consulta_turma) or die('Não consultado!');
								while($valores_turma = mysqli_fetch_assoc($resultado_consulta_turma)){?>
									<option value="<?php echo $valores_turma['cod_turma']; ?>">
										<?php echo $valores_turma['nome_turma']; ?>
									</option>
								<?php } ?>
							</select>
						</td>
						<td>Selecione o Professor:</td>
						<td>
							<select name="professor">
								<?php $sql_resultado_consulta_professor = "SELECT * FROM professor WHERE nome != ''";
								$resultado_consulta_professor = mysqli_query($conexao, $sql_resultado_consulta_professor) or die('Não consultado!');
								while($valores_professor = mysqli_fetch_assoc($resultado_consulta_professor)){?>
									<option value="<?php echo $valores_professor['cod_professor']; ?>">
										<?php echo $valores_professor['nome']; ?>
									</option>
								<?php } ?>
							</select>
						</td>
						<td>Data de Hoje:</td>
						<td>
							<input type="disabled" name="data_atual" value="<?php echo date('d/m/Y'); ?>" style="width:80px">
						</td>
						<td>
							<input type="submit" name="buscar" value="Buscar" class="input" id="button">
						</td>
					</tr>
				</table>
			</form><br/><br/>	
		
			<?php $sql_consulta_matricula = "SELECT preetec.aluno_matriculado.cod_aluno, preetec.aluno_cadastrado.nome AS nome_aluno FROM preetec.matricula INNER JOIN preetec.aluno_matriculado ON preetec.aluno_matriculado.cod_aluno = preetec.matricula.cod_aluno INNER JOIN preetec.aluno_cadastrado ON preetec.aluno_cadastrado.cod_inscricao = preetec.aluno_matriculado.cod_inscricao INNER JOIN preetec.turma ON preetec.turma.cod_turma = preetec.matricula.cod_turma WHERE preetec.turma.cod_turma = '$cod_turma' ORDER BY preetec.aluno_cadastrado.nome ASC";
			$resultado_consulta_matricula = mysqli_query($conexao, $sql_consulta_matricula) or die('Não Consultado!');
			
			if(mysqli_num_rows($resultado_consulta_matricula) == ''){
	 			echo "<h2><font color='#fff' size='2px'>Essa turma ainda não possui alunos!</font></h2>";
			}else{
 				while($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)){
	 				$cod_aluno = $resultado_consulta_matricula_valores['cod_aluno'];
					$nome_aluno = $resultado_consulta_matricula_valores['nome_aluno'];?>
		
					<form name="button" method="post" enctype="multipart/form-data" action="">
						<table width="955" border="0">
  							<tr>
								<td width="94"><strong>Código:</strong></td>
								<td width="450"><strong>Nome:</strong></td>
								<td><strong>Status:</strong></td>
  							</tr>
  							<tr>
								<td><?php echo $cod_aluno; ?><input type="hidden" name="cod_aluno" value="<?php $cod_aluno; ?>" /></td>
								<td><?php echo $nome_aluno; ?><input type="hidden" name="nome" value="<?php echo $nome_aluno; ?>" /></td>
								<td>									
									<input style="width:45px" type="radio" name="presenca" value="1" checked>Presente
									<input style="width:45px" type="radio" name="presenca" value="0">Ausente										
								<td>
    							<td width="62"><input type="submit" name="confirmar" id="button" class="input" value="Confirmar"></td>    
  							</tr>
  							<tr>
								<?php if(isset($_POST['confirmar'])){
						
									$cod_aluno = $_POST['cod_aluno'];										
									@$presenca = $_POST['presenca'];
									$data_hoje = date('Y-m-d');

									$sql_insere_chamada = "INSERT INTO chamada (cod_turma, cod_aluno, cod_professor, data_chamada, presenca) VALUES ('$cod_turma', '$cod_aluno', '$cod_professor', '$data_hoje', '$presenca')";	
									mysqli_query($conexao, $sql_insere_chamada) or die('Não Inserido!');
									echo "<script language='javascript'>window.location='fazer_chamada.php?cod_curso=$cod_turma&cod_professor=$cod_professor';</script>"; 
								}?>  
							</tr>
						</table>
					</form>
			<?php } }
		}*/?>
	</div>-->
	
	<!--<div id="box_curso">
		<?php /* if(@$_GET['pg'] == 'chamada'){ ?>					
			<form id="form_busca_chamada" name="form_select_chamadas" method="post">
				<table>
					<tr>
						<td>Selecione a Turma:</td>
						<td>
							<select name="turma" style="width:60px">
								<?php $sql_resultado_consulta_turma = "SELECT * FROM turma WHERE nome_turma != ''";
								$resultado_consulta_turma = mysqli_query($conexao, $sql_resultado_consulta_turma) or die('Não consultado!');
								while($valores_turma = mysqli_fetch_assoc($resultado_consulta_turma)){?>
									<option value="<?php echo $valores_turma['cod_turma']; ?>">
										<?php echo $valores_turma['nome_turma']; ?>
									</option>
								<?php } ?>
							</select>
						</td>
						<td>Selecione o Professor:</td>
						<td>
							<select name="professor">
								<?php $sql_resultado_consulta_professor = "SELECT * FROM professor WHERE nome != ''";
								$resultado_consulta_professor = mysqli_query($conexao, $sql_resultado_consulta_professor) or die('Não consultado!');
								while($valores_professor = mysqli_fetch_assoc($resultado_consulta_professor)){?>
									<option value="<?php echo $valores_professor['cod_professor']; ?>">
										<?php echo $valores_professor['nome']; ?>
									</option>
								<?php } ?>
							</select>
						</td>
						<td>Data de Hoje:</td>
						<td>
							<input type="disabled" name="data_atual" value="<?php date_default_timezone_set("America/Sao_Paulo"); echo date('d/m/Y'); ?>" style="width:80px">
						</td>
						<td>
							<input type="submit" name="buscar" value="Buscar" class="input" id="button">
						</td>
					</tr>
				</table>
			</form><br/><br/>
			<?php if(!isset($_POST['buscar'])){ ?>
		
				<h1><center>Chamada: Selecione a Turma o Professor e dê "Buscar"</center></h1><br/>
				
			<?php } else{ 
				$cod_turma = $_POST['turma'];	
				$cod_professor = $_POST['professor'];
				$sql_resultado_consulta_nome_turma = "SELECT * FROM turma WHERE cod_turma = '$cod_turma'";
				$resultado_consulta_nome_turma = mysqli_query($conexao, $sql_resultado_consulta_nome_turma) or die('Não consultado!');
				$valores_nome_turma = mysqli_fetch_assoc($resultado_consulta_nome_turma);
				$nome_turma = $valores_nome_turma['nome_turma'];
				$sql_resultado_consulta_nome_professor = "SELECT * FROM professor WHERE cod_professor = '$cod_professor'";
				$resultado_consulta_nome_professor = mysqli_query($conexao, $sql_resultado_consulta_nome_professor) or die('Não consultado!');
				$valores_nome_professor = mysqli_fetch_assoc($resultado_consulta_nome_professor);
				$nome_professor = $valores_nome_professor['nome']; ?>

 				<h1><center>Chamada na Turma <strong><?php echo $nome_turma; ?></strong>, com o Professor(a) <strong><?php echo $nome_professor; ?></strong></center></h1><br/>
		
			
			
			<?php $sql_consulta_matricula = "SELECT preetec.aluno_matriculado.cod_aluno, preetec.aluno_cadastrado.nome AS nome_aluno FROM preetec.matricula INNER JOIN preetec.aluno_matriculado ON preetec.aluno_matriculado.cod_aluno = preetec.matricula.cod_aluno INNER JOIN preetec.aluno_cadastrado ON preetec.aluno_cadastrado.cod_inscricao = preetec.aluno_matriculado.cod_inscricao INNER JOIN preetec.turma ON preetec.turma.cod_turma = preetec.matricula.cod_turma WHERE preetec.turma.cod_turma = '$cod_turma' ORDER BY preetec.aluno_cadastrado.nome ASC";
			$resultado_consulta_matricula = mysqli_query($conexao, $sql_consulta_matricula) or die('Não Consultado!');
			
			if(mysqli_num_rows($resultado_consulta_matricula) == ''){
	 			echo "<h2><font color='#fff' size='2px'>Essa turma ainda não possui alunos!</font></h2>";
			}else{
 				while($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)){
	 				$cod_aluno = $resultado_consulta_matricula_valores['cod_aluno'];
					$nome_aluno = $resultado_consulta_matricula_valores['nome_aluno'];?>
		
					<form name="button" method="post" enctype="multipart/form-data" action="">
						<table width="955" border="0">
  							<tr>
								<td width="94"><strong>Código:</strong></td>
								<td width="450"><strong>Nome:</strong></td>
								<td><strong>Status:</strong></td>
  							</tr>
  							<tr>
								<td><?php echo $cod_aluno; ?><input type="hidden" name="cod_aluno" value="<?php echo $cod_aluno; ?>" /></td>
								<td><?php echo $nome_aluno; ?><input type="hidden" name="nome" value="<?php echo $nome_aluno; ?>" /></td>
								<td>									
									<input style="width:45px" type="radio" name="presenca" value="1" checked>Presente
									<input style="width:45px" type="radio" name="presenca" value="0">Ausente										
								</td>							
    							<td width="62"><input type="submit" name="confirmar" id="button" class="input" value="Confirmar"></td>
  							</tr>								  							
						</table>
					</form>
					
								<?php if(isset($_POST['confirmar'])){
						
									$cod_aluno = $_POST['cod_aluno'];										
									@$presenca = $_POST['presenca'];
									date_default_timezone_set("America/Sao_Paulo");
									$data_hoje = date('Y-m-d');

									$sql_insere_chamada = "INSERT INTO chamada (cod_turma, cod_aluno, cod_professor, data_chamada, Presenca) VALUES ('$cod_turma', '$cod_aluno', '$cod_professor', '$data_hoje', '$presenca')";
									mysqli_query($conexao, $sql_insere_chamada) or die('Não Inserido!');
									echo "<script language='javascript'>window.location='fazer_chamada.php?pg=chamada;</script>";
								}?>
			<?php } }
		 } } */?>
	</div>-->
	
	<div id="box_curso">
	
	<?php if(!isset($_GET['buscar'])){ ?>
		
		<h1><center>Chamada: Selecione a Turma o Professor e dê "Buscar"</center></h1><br/>

		<form method="GET">		
			<table>
				<tr>
					<td>Selecione a Turma:</td>
					<td>
						<select name="turma" style="width:60px">
							<?php $sql_resultado_consulta_turma = "SELECT * FROM turma WHERE nome_turma != '' ORDER BY nome_turma ASC";
							$resultado_consulta_turma = mysqli_query($conexao, $sql_resultado_consulta_turma) or die(mysqli_error($conexao));
							while($valores_turma = mysqli_fetch_assoc($resultado_consulta_turma)){?>
								<option value="<?php echo $valores_turma['id_turma']; ?>">
									<?php echo $valores_turma['nome_turma']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
					<td>Selecione o Professor:</td>
					<td>
						<select name="professor">
							<?php $sql_resultado_consulta_professor = "SELECT * FROM professor WHERE nome_professor != '' ORDER BY nome_professor ASC";
							$resultado_consulta_professor = mysqli_query($conexao, $sql_resultado_consulta_professor) or die(mysqli_error($conexao));
							while($valores_professor = mysqli_fetch_assoc($resultado_consulta_professor)){?>
								<option value="<?php echo $valores_professor['id_professor']; ?>">
									<?php echo $valores_professor['nome_professor']; ?>
								</option>
							<?php } ?>
						</select>
					</td>
					<td>Data de Hoje:</td>
					<td>
						<input type="disabled" name="data_atual" value="<?php date_default_timezone_set("America/Sao_Paulo"); echo date('d/m/Y'); ?>" style="width:80px">
					</td>
					<td>						
						<input type="submit" name="buscar" value="Buscar" class="input" id="button">
					</td>
				</tr>
			</table>
		</form>
		<br/><br/>
		
	<?php }else{ ?>
		
		<?php $cod_turma = $_GET['turma'];	
		$cod_professor = $_GET['professor'];
		date_default_timezone_set("America/Sao_Paulo");
		$data_hoje_USA = date('Y-m-d');
		$data_hoje_BR = date('d-m-Y');
				
		$sql_resultado_consulta_nome_turma = "SELECT * FROM turma WHERE id_turma = '$cod_turma'";
		$resultado_consulta_nome_turma = mysqli_query($conexao, $sql_resultado_consulta_nome_turma) or die(mysqli_error($conexao));
		$valores_nome_turma = mysqli_fetch_assoc($resultado_consulta_nome_turma);
		$nome_turma = $valores_nome_turma['nome_turma'];
				
		$sql_resultado_consulta_nome_professor = "SELECT * FROM professor WHERE id_professor = '$cod_professor'";
		$resultado_consulta_nome_professor = mysqli_query($conexao, $sql_resultado_consulta_nome_professor) or die(mysqli_error($conexao));
		$valores_nome_professor = mysqli_fetch_assoc($resultado_consulta_nome_professor);
		$nome_professor = $valores_nome_professor['nome_professor']; ?>

 		<h1><center>Chamada na Turma <strong><?php echo $nome_turma; ?></strong>, com o Professor(a) <strong><?php echo $nome_professor; ?></strong></center></h1><br/>
		
		<?php $sql_consulta_matricula = "SELECT * FROM matricula m INNER JOIN aluno a ON a.id_aluno = m.id_aluno INNER JOIN inscricao i ON i.id_inscricao = a.id_inscricao INNER JOIN turma t ON t.id_turma = m.id_turma WHERE t.id_turma = '$cod_turma' ORDER BY i.nome_aluno ASC"; 
		$resultado_consulta_matricula = mysqli_query($conexao, $sql_consulta_matricula) or die(mysqli_error($conexao));
				
		if(mysqli_num_rows($resultado_consulta_matricula) == ''){
			
	 		echo "<h2><font color='#fff' size='2px'>Essa turma ainda não possui alunos!</font></h2>";
			
		}else{
			
			while($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)){
	 				$cod_aluno = $resultado_consulta_matricula_valores['id_aluno'];
					$nome_aluno = $resultado_consulta_matricula_valores['nome_aluno'];?>
		
					<form name="button" method="post" enctype="multipart/form-data" action="">
						<table width="955" border="0">
  							<tr>
								<td width="94"><strong>Código:</strong></td>
								<td width="450"><strong>Nome:</strong></td>
								<td><strong>Status:</strong></td>
  							</tr>
  							<tr>
								<td><?php echo $cod_aluno; ?><input type="hidden" name="cod_aluno" value="<?php echo $cod_aluno; ?>" /></td>
								<td><?php echo $nome_aluno; ?><input type="hidden" name="nome" value="<?php echo $nome_aluno; ?>" /></td>
								<td>
									<?php $sql_select_chamada = "SELECT * FROM chamada WHERE data_chamada = '$data_hoje_USA' AND id_turma = '$cod_turma' AND id_aluno = '$cod_aluno'";
									$select_chamada = mysqli_query($conexao, $sql_select_chamada) or die(mysqli_error($conexao));
				
									if(mysqli_num_rows($select_chamada) == ''){	?>
									
										<input style="width:45px" type="radio" name="presente" value="1">Presente
									
										<input style="width:45px" type="radio" name="presente" value="0">Ausente										
								</td>							
    							<td width="62"><input type="submit" name="guardar" id="button" class="input" value="Guardar"/></td>
								
									<?php }else{
										echo "este aluno ja respondeu a chamada hoje!"; 
									} ?>
								
									<?php if(isset($_POST['guardar'])){
						
										$cod_aluno = $_POST['cod_aluno'];
										$nome_aluno = $_POST['nome'];
										$presente = $_POST['presente'];
										date_default_timezone_set("America/Sao_Paulo");
										$data_hoje = date('Y-m-d'); ?>
								
												<?php date_default_timezone_set("America/Sao_Paulo");
												$data_hoje_USA = date('Y-m-d');

												$sql_insere_chamada = "INSERT INTO chamada (id_turma, id_aluno, id_professor, data_chamada, presenca) VALUES ('$cod_turma', '$cod_aluno', '$cod_professor', '$data_hoje', '$presente')";
										
												mysqli_query($conexao, $sql_insere_chamada) or die(mysqli_error($conexao));
								
												echo "<script language='javascript'>window.location='';</script>"; ?>
								
											<?php 
										
									} ?>
  							</tr>								  							
						</table>
					</form>									
		
			<?php }
		} ?>		
		
	<?php } ?>
		
			
		
			<?php /*  													
						
			
			<?php $sql_consulta_matricula = "SELECT preetec.aluno_matriculado.cod_aluno, preetec.aluno_cadastrado.nome AS nome_aluno FROM preetec.matricula INNER JOIN preetec.aluno_matriculado ON preetec.aluno_matriculado.cod_aluno = preetec.matricula.cod_aluno INNER JOIN preetec.aluno_cadastrado ON preetec.aluno_cadastrado.cod_inscricao = preetec.aluno_matriculado.cod_inscricao INNER JOIN preetec.turma ON preetec.turma.cod_turma = preetec.matricula.cod_turma WHERE preetec.turma.cod_turma = '$cod_turma' ORDER BY preetec.aluno_cadastrado.nome ASC";
			$resultado_consulta_matricula = mysqli_query($conexao, $sql_consulta_matricula) or die('Não Consultado!');
			
			if(mysqli_num_rows($resultado_consulta_matricula) == ''){
	 			echo "<h2><font color='#fff' size='2px'>Essa turma ainda não possui alunos!</font></h2>";
			}else{
 				while($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)){
	 				$cod_aluno = $resultado_consulta_matricula_valores['cod_aluno'];
					$nome_aluno = $resultado_consulta_matricula_valores['nome_aluno'];?>
		
					<form name="button" method="post" enctype="multipart/form-data" action="">
						<table width="955" border="0">
  							<tr>
								<td width="94"><strong>Código:</strong></td>
								<td width="450"><strong>Nome:</strong></td>
								<td><strong>Status:</strong></td>
  							</tr>
  							<tr>
								<td><?php echo $cod_aluno; ?><input type="hidden" name="cod_aluno" value="<?php echo $cod_aluno; ?>" /></td>
								<td><?php echo $nome_aluno; ?><input type="hidden" name="nome" value="<?php echo $nome_aluno; ?>" /></td>
								<td>									
									<input style="width:45px" type="radio" name="presenca" value="1" checked>Presente
									<input style="width:45px" type="radio" name="presenca" value="0">Ausente										
								</td>							
    							<td width="62"><input type="submit" name="confirmar" id="button" class="input" value="Confirmar"></td>
  							</tr>								  							
						</table>
					</form>
					
								<?php if(isset($_POST['confirmar'])){
						
									$cod_aluno = $_POST['cod_aluno'];										
									@$presenca = $_POST['presenca'];
									date_default_timezone_set("America/Sao_Paulo");
									$data_hoje = date('Y-m-d');

									$sql_insere_chamada = "INSERT INTO chamada (cod_turma, cod_aluno, cod_professor, data_chamada, Presenca) VALUES ('$cod_turma', '$cod_aluno', '$cod_professor', '$data_hoje', '$presenca')";
									mysqli_query($conexao, $sql_insere_chamada) or die('Não Inserido!');
									echo "<script language='javascript'>window.location='';</script>";
								}?>
			<?php } } */?>
	</div>
	
	
	
	
	
	
	
	<?php require "rodape.php"; ?>
</body>
</html>