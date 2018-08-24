<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Estudantes</title>
	<link rel="stylesheet" type="text/css" href="css/estudantes.css"/>
	<link rel="stylesheet" type="text/css" href="css/cursos_e_disciplinas.css"/>
	<?php require "../conexao.php";?>	
	<script>
		function mostra_nome_aluno(str) {
    		/*if (str.length == 0) { 
        		document.getElementById("mostra_nome_aluno").innerHTML = "";
        		return;
    		} else {*/
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
                		document.getElementById("mostra_nome_aluno").innerHTML = this.responseText;
            		}
        		};
        		xmlhttp.open("GET", "mostraAluno.php?q=" + str, true);
        		xmlhttp.send();
    		//}
		}
	</script>
</head>

<body>
	<?php require "topo.php"; ?>

<!LISTA DE ESPERA>
	
	<div id="caixa_preta">
	</div><!-- caixa_preta -->
	
	<div id="box_curso">

		<?php if(@$_GET['pg'] == 'espera'){ ?>

<!Editando na Lista de Espera>
			<?php if(@$_GET['mod'] == 'edita'){ ?>
				
				<?php $cod_inscricao = $_GET['inscricao'];
											   
				$select_inscricao = "SELECT * FROM inscricao WHERE id_inscricao = '$cod_inscricao'";
											   
				$sql_select_inscricao = mysqli_query($conexao, $select_inscricao) or die(mysqli_error($conexao));
											   
				$select_inscricao_valores = mysqli_fetch_assoc($sql_select_inscricao);
											   
				$data_inscricao = $select_inscricao_valores['data_inscricao'];
				$nome_inscricao = $select_inscricao_valores['nome_aluno'];
				$sexo_inscricao = $select_inscricao_valores['sexo_aluno'];
				$email_inscricao = $select_inscricao_valores['email'];
				$telefone_inscricao = $select_inscricao_valores['telefone_responsavel'];
				$celular_inscricao = $select_inscricao_valores['celular_responsavel'];?>
				
				<?php if(isset($_POST['salvar'])){
					
					$nome_post = $_POST['nome_aluno'];
					$sexo_post = $_POST['sexo'];
					$email_post = $_POST['email'];
					$telefone_post = $_POST['telefone'];
					$celular_post = $_POST['celular'];
					
					$update_inscricao = "UPDATE inscricao SET nome_aluno = '$nome_post', sexo_aluno = '$sexo_post', email = '$email_post', telefone_responsavel = '$telefone_post', celular_responsavel = '$celular_post' WHERE inscricao.id_inscricao = '$cod_inscricao'";
					
					$sql_update_inscricao = mysqli_query($conexao, $update_inscricao) or die(mysqli_error($conexao));
					
					echo "<script language='javascript'> window.alert('Atualizado com Sucesso'); window.location='estudantes.php?pg=espera';</script>";
		
				 } ?>
			<br/>
				<form method="post">					
					<table>
						<tr>
							<td colspan="2"><center><strong><i>Ficha de Inscrição</i></i></strong></center></td>
						</tr>
						<tr>
							<td>Codígo de Inscrição</td>
							<td>Data de Inscrição</td>							
						</tr>
						<tr>
							<td><input style="width:70px" type="text" name="cod_inscricao" value="<?php echo $cod_inscricao;?>" disabled/></td>
							<td><input style="width:145px" type="text" name="data_inscricao" value="<?php date_default_timezone_set("America/Sao_Paulo");
								echo date('d/m/Y - H:i', strtotime($data_inscricao)); ?>" disabled/></td>							
						</tr>
						<tr>
							<td colspan="2"><center><strong><i>Dados Pessoais</i></i></strong></center></td>
						</tr>
						<tr>
							<td>Nome</td>
							<td>Sexo</td>	
						</tr>
						<tr>						
							<td><input style="width:400px" type="text" name="nome_aluno" value="<?php echo $nome_inscricao; ?>" maxlength="120"/></td>
							<td>
								<select name="sexo" size="1" id="">
									<option value="<?php echo $sexo_inscricao; ?>"><?php $mostra_sexo = strtolower($sexo_inscricao) ; echo ucfirst($mostra_sexo); ?></option>
									<?php if($sexo_inscricao == "MASCULINO"){ ?>
										<option value="FEMININO">Feminino</option>
										<option value="OUTRO">Outro</option>
									<?php }elseif($sexo_inscricao == "FEMININO"){ ?>
										<option value="MASCULINO">Masculino</option>
										<option value="OUTRO">Outro</option>
									<?php }else{ ?>
										<option value="MASCULINO">Masculino</option>
										<option value="FEMININO">Feminino</option>
									<?php } ?>								
							</select>
							</td>
						</tr>					
						<tr>
							<td colspan="3"><center><strong><i>Contato</i></i></strong></center></td>
						</tr>
						<tr>						
							<td>E-mail</td>
							<td>Telefone</td>
							<td>Celular</td>
						</tr>
						<tr>						
							<td><input style="width:400px" type="email" name="email" value="<?php echo $email_inscricao ;?>"></td>
							<td><input style="width:95px" type="text" name="telefone" maxlength="10" value="<?php echo $telefone_inscricao ;?>"></td>
							<td><input style="width:105px" type="text" name="celular" maxlength="11" value="<?php echo $celular_inscricao ;?>"></td>
						</tr>
						<tr>
							<td colspan="3"><center><input class="input" type="submit" name="salvar" value="Salvar"/> <a class="a2" href="estudantes.php?pg=espera">Cancelar</a></center></td>
						</tr>
					</table>
				</form>
			<br/>
		
			<?php die;}?>
		
			<br/><br/>
			<a class="a2" href="estudantes.php?pg=espera&amp;cadastra=sim">Cadastrar na lista de espera</a>
			
<!CADASTRANDO NA LISTA DE ESPERA>

				<?php if(@$_GET['cadastra'] == 'sim'){?> 

					<h1>Cadastrar Aluno para Lista de Espera</h1>

					<?php if(isset($_POST['button'])){

						/*Problemas
						$data_sem_formatacao = date("Y-m-d H:i:s");

						$timestamp = strtotime('-5 hours', strtotime($data_sem_formatacao));
						*/date_default_timezone_set("America/Sao_Paulo");
						$data_hora_formato_mysql = date("Y-m-d H:i:s");


						$nome_inscricao = $_POST['nome'];						
						$sexo = $_POST['sexo'];
						$email = $_POST['email'];
						$telefone = $_POST['telefone'];
						$celular = $_POST['celular'];

						if($nome_inscricao == '')
						{
							echo "<script language='javascript'>window.alert('Digite o nome do aluno');</script>";
						}
						else
						{							
							$sql_insere_aluno_cadastrado = ("INSERT INTO inscricao (data_inscricao, nome_aluno, sexo_aluno, email, telefone_responsavel, celular_responsavel) VALUES ('$data_hora_formato_mysql', '$nome_inscricao', '$sexo', '$email', '$telefone', '$celular')");

							$cadastrar_lista_espera = mysqli_query($conexao, $sql_insere_aluno_cadastrado) or die(mysqli_error($conexao));

							if ($cadastrar_lista_espera == '')
							{
								echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
							}
							else
							{		
								echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
								echo "<script language='javascript'>window.location='estudantes.php?pg=espera';</script>";
							}
						}
					}?> 

					<form name="form1" method="post" action="">
						<table width="900" border="0">
							<tr>
								<td>Código de inscrição:</td>					
								<td>Nome:</td>
								<td>Sexo:</td>
							</tr>
							<tr>
								<?php $sql_select_ultimo_cod_inscricao = "SELECT * FROM inscricao ORDER BY id_inscricao DESC LIMIT 1";

								$conexao_select_ultimo_cod_inscricao = mysqli_query($conexao, $sql_select_ultimo_cod_inscricao) or die(mysqli_error($conexao));
													  
								if(mysqli_num_rows($conexao_select_ultimo_cod_inscricao) == ''){
									$novo_cod_inscricao = 1; ?>

									<td>
										<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_inscricao; ?>">
									</td>
										<input type="hidden" name="code" value="<?php echo $novo_cod_inscricao; ?>"/>

								<?php }else{

									while($resultado_select_ultimo_cod_inscricao_valores = mysqli_fetch_assoc($conexao_select_ultimo_cod_inscricao)){
										$novo_cod_inscricao = $resultado_select_ultimo_cod_inscricao_valores['id_inscricao']+1; ?>
										<td>
											<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_inscricao; ?>">
										</td>
											<input type="hidden" name="code" value="<?php echo $novo_cod_inscricao; ?>" />
									<?php }
								}?>							
								<td>
									<input type="text" name="nome" id="textfield">
								</td>
								<td>
									<select name="sexo" size="1" id="textfield">
										<option value="MASCULINO">Masculino</option>
										<option value="FEMININO">Feminino</option>
										<option value="OUTRO">Outro</option>
									</select>
								</td>      						
							</tr>
							<tr>
								<td>E-mail:</td>
								<td>Telefone:</td>
								<td>Celular:</td>
							</tr>
							<tr>
								<td>
									<input type="email" name="email" id="textfield">
								</td>
								<td>
									<input type="text" name="telefone" id="textfield" maxlength="10">
								</td>
								<td>
									<input type="text" name="celular" id="textfield" maxlength="11">
								</td>
							</tr>    
							<tr>
								<td>
									<input class="input" type="submit" name="button" id="button" value="Cadastrar">
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</form>
					<br/>
				<?php die;} ?>
			<!-- fim div estudante Lista Espera -->

<!CONSULTA DA LISTA DE ESPERA>

			<?php $sql_consulta_aluno_cadastrado = "SELECT * FROM inscricao WHERE nome_aluno != '' ORDER BY data_inscricao ASC";				 
			$consulta_aluno_cadastrado = mysqli_query($conexao, $sql_consulta_aluno_cadastrado) or die(mysqli_error($conexao));
			if(mysqli_num_rows($consulta_aluno_cadastrado) == ''){
				echo "<h2>Não exisite há nenhuma inscrição no momento</h2>";
			}else{ ?>
				<br/><br/>
				<h1>Alunos que estão na lista de espera</h1>
				<table width="900" border="0">
					<tr>
						<td width="100">
							<center><strong>Código de Inscrição</strong></center>
						</td>
						<td width="100">
							<center><strong>Data de Inscrição</strong></center>
						</td>							
						<td>
							<center><strong>Nome Completo</strong></center>
						</td>							
						<td>
							<center><strong>E-mail</strong></center>
						</td>
						<td>
							<center><strong>Telefone</strong></center>
						</td>
						<td>
							<center><strong>Celular</strong></center>
						</td>
						<td width="100">
							<center><strong>Modificar</strong></center>
						</td>
					</tr>
					<?php while($resultado_consulta_aluno_cadastrado_valores = mysqli_fetch_assoc($consulta_aluno_cadastrado)){ ?>
						<tr>
							<td style="color: #A00C0E">
								<center><?php echo $resultado_consulta_aluno_cadastrado_valores['id_inscricao'];?></center>
							</td>
							<td style="color: #A00C0E">
								<center><?php $data_sem_formatacao = $resultado_consulta_aluno_cadastrado_valores['data_inscricao']; 
								$data_formatada = strtotime("$data_sem_formatacao");
								echo date("d-m-Y h:i:s", $data_formatada);?></center>
							</td>							
							<td style="color: #A00C0E">
								<center><?php echo $resultado_consulta_aluno_cadastrado_valores['nome_aluno']; ?></center>
							</td>							
							<td style="color: #A00C0E">
								<center><?php echo $resultado_consulta_aluno_cadastrado_valores['email']; ?></center>
							</td>
							<td style="color: #A00C0E">
								<center><?php echo $resultado_consulta_aluno_cadastrado_valores['telefone_responsavel']; ?></center>
							</td>
							<td style="color: #A00C0E">
								<center><?php echo $resultado_consulta_aluno_cadastrado_valores['celular_responsavel']; ?></center>
							</td>
							<td>
								<center><a href="estudantes.php?pg=espera&amp;mod=edita&inscricao=<?php echo $resultado_consulta_aluno_cadastrado_valores['id_inscricao'];?>"><img title="Editar" src="img/editar.png" width="18" height="18" border="0"></a>
								<a href="estudantes.php?pg=espera&amp;mod=deleta&inscricao=<?php echo $resultado_consulta_aluno_cadastrado_valores['id_inscricao']; ?>" ><img title="Excluir" src="img/deletar.ico" width="18" height="18" border="0"></a></center>								
							</td>
						</tr>
					<?php } ?>
				</table>
				<br/> 
			<?php } ?>
		
			<?php if(@$_GET['mod'] == 'deleta'){

			$cod_inscricao = $_GET['inscricao'];

			$sql_delelta_inscricao = "DELETE FROM inscricao WHERE id_inscricao = '$cod_inscricao'";
			mysqli_query($conexao, $sql_delelta_inscricao) or die(mysqli_error($conexao));

			echo "<script language='javascript'>window.location='estudantes.php?pg=espera';</script>";
			}?>
		
		<?php } // aqui fecha a lista de espera ?>
	
	
<!CADASTRO DOS ESTUDANTES>
	
		
		<?php  if(@$_GET['pg'] == 'cadastra'){ ?>					
		
			<?php  if(@$_GET['etapa'] == '1'){ // aqui abre a etapa 1 ?>			
					<h1>1ª Etapa: Cadastre os dados pessoais</h1>

					<?php  if(isset($_POST['button'])){

						$id_aluno = $_POST['code'];
						$id_inscricao = $_POST['cod_inscricao'];
						$data_nascimento_aluno = $_POST['data_nascimento_aluno'];
						$rg_aluno = $_POST['rg_aluno'];
						$cpf_aluno = $_POST['cpf_aluno'];
						$logradouro = $_POST['logradouro_aluno'];
						$bairro_aluno = $_POST['bairro_aluno'];
						$cidade_aluno = $_POST['cidade_aluno'];
						$complemento_aluno = $_POST['complemento_aluno'];
						$cep_aluno = $_POST['cep_aluno'];
						$escolaridade = $_POST['escolaridade'];
						$escola = $_POST['escola'];


						$sql_insere_aluno_matriculado = "INSERT INTO aluno (id_inscricao, data_nascimento_aluno, rg_aluno, cpf, logradouro_aluno, bairro_aluno, cidade_aluno, complemento_aluno, cep_aluno, escolaridade, escola) VALUES ('$id_inscricao', '$data_nascimento_aluno', '$rg_aluno', '$cpf_aluno', '$logradouro_aluno', '$bairro_aluno', '$cidade_aluno', '$complemento_aluno', '$cep_aluno', '$escolaridade', '$escola')";


						$cadastra_aluno_matriculado = mysqli_query($conexao, $sql_insere_aluno_matriculado) or die(mysqli_error($conexao));

						if($cadastra_aluno_matriculado == ''){
							echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";	
						}else{
							echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=2&inscricao=$id_inscricao';</script>";
						}

					}?> 

					<form name="form1" method="post" action="">
						<table width="900" border="0">
							<tr>
								<td>
								</td>
								<td colspan="2">
									<strong>Foi criado um código único para este aluno</strong>
								</td>
								<td>						
								</td>
							</tr>
							<tr>
								<td>
								</td>

								<?php $sql_select_ultimo_id_aluno_matriculado = "SELECT * FROM inscricao i INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao ORDER BY a.id_aluno DESC LIMIT 1";

								$conexao_select_ultimo_id = mysqli_query($conexao, $sql_select_ultimo_id_aluno_matriculado) or die(mysqli_error($conexao));

								if(mysqli_num_rows($conexao_select_ultimo_id) == ''){
									$novo_id = 1; ?>

									<td>
										<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_id; ?>">
									</td>
									<input type="hidden" name="code" value="<?php echo $novo_id; ?>"/>    
								<?php }else{

									while($resultado_select_aluno_matriculado_valores = mysqli_fetch_assoc($conexao_select_ultimo_id)){
										#$mostraNome = $resultado_select_aluno_matriculado_valores['nome'];
										$novo_id = $resultado_select_aluno_matriculado_valores['cod_aluno']+1; ?>
										<td>
											<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_id; ?>">
										</td>
										<input type="hidden" name="code" value="<?php echo $novo_id; ?>" />
									<?php } 
								} ?>

								<td>
								</td>							
							</tr>    
							<tr>
								<td>Código de inscrição:</td>
								<td>Nome Completo:</td>
								<td>Data de Nascimento:</td>
							</tr>
							<tr>
								<td>							
									<input type="number" name="cod_inscricao" onkeyup="mostra_nome_aluno(this.value)" id="textfield2">
								</td>
								<td>							
									<div id = "mostra_nome_aluno">
										<input type="text" disabled="disabled">
									</div>										
								</td>
								<td>							
									<input type="date" name="data_nascimento_aluno" id="textfield3">
								</td>
							</tr>
							<tr>
								<td>RG:</td>
								<td>CPF:</td>
								<td>Logradouro:</td>
							</tr>
							<tr>
								<td>								
									<input type="text" name="rg_aluno" id="textfield4" maxlength="14">
								</td>
								<td>
									<input type="text" name="cpf_aluno" id="textfield12" maxlength="11">
								</td>
								<td>
									<input type="text" name="logradouro_aluno" id="textfield5">
								</td>
							</tr>
							<tr>														  	
								<td>Bairro:</td>
								<td>Cidade:</td>
								<td>Complemento:</td>
							</tr>
							<tr>
								<td><input type="text" name="bairro_aluno" id="textfield7"></td>
								<td><input type="text" name="cidade_aluno" id="textfield8"></td>
								<td><input type="text" name="complemento_aluno" id="textfield8"></td>
							</tr>
							<tr>      								
								<td>Cep:</td>
								<td>Escolaridade:</td>
								<td>Escola:</td> 
							</tr>
							<tr>								
								<td><input type="text" name="cep_aluno" id="textfield8" maxlength="8"></td>
								<td>
									<select name="escolaridade" size="1" id="turno">
										<option value="Ensino fundamental cursando">Ensino fundamental cursando</option>
										<option value="Ensino fundamental concluído">Ensino fundamental concluído</option>
										<option value="Ensino médio cursando">Ensino médio cursando</option>
										<option value="Ensino médio concluído">Ensino médio concluído</option>
									</select>									
								</td>
								<td><input type="text" name="escola" id="textfield9"></td>
							</tr>							
							<tr>
								<td colspan="3"><center><input class="input" type="submit" name="button" id="button" value="Avançar"></center></td>								
							</tr>
						</table>
					</form>
					<br/> 				
				<?php } // aqui fecha a etapa 1 ?>

				<?php if(@$_GET['etapa'] == '2'){ // aqui abre a etapa 2 ?>			
		
					<h1>2ª Etapa: Cadastro de dados do Responsável</h1>
		
					<?php if(isset($_POST['button'])){
	
						$id_inscricao = $_GET['inscricao'];
						$id_responsavel = $_POST['id_responsavel'];
						$nome_responsavel = $_POST['nome_responsavel'];
						$sexo_responsavel = $_POST['sexo_responsavel'];
						$cpf_responsavel = $_POST['cpf_responsavel'];
						$rg_responsavel = $_POST['rg_responsavel'];
						$email_responsavel = $_POST['email_responsavel'];

						$sql_insere_responsavel = ("INSERT INTO responsavel (nome_responsavel, sexo_responsavel, cpf, rg_responsavel, email) VALUES ('$nome_responsavel', '$sexo_responsavel', '$cpf_responsavel', '$rg_responsavel', '$email_responsavel')");

						$cadastrar_responsavel = mysqli_query($conexao, $sql_insere_responsavel) or die(mysqli_error($conexao));

						if($cadastrar_responsavel == ''){
							echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
						}else{
							
							$sql_select_ultimo_id_responsavel = "SELECT * FROM responsavel r ORDER BY r.id_responsavel DESC LIMIT 1";

							$conexao_select_ultimo_id_responsavel = mysqli_query($conexao, $sql_select_ultimo_id_responsavel) or die(mysqli_error($conexao));
							
							while($resultado_ultimo_id_responsavel_valores = mysqli_fetch_assoc($conexao_select_ultimo_id_responsavel)){
								$id_responsavel_colhido = $resultado_ultimo_id_responsavel_valores['id_responsavel'];
							}
							
							$sql_update_aluno = ("UPDATE aluno SET id_responsavel = '$id_responsavel_colhido' WHERE id_inscricao = '$id_inscricao'");

							$update_aluno = mysqli_query($conexao, $sql_update_aluno) or die(mysqli_error($conexao));
							
							echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
							
							echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=resumo';</script>";
						}
					}?> 

					<form name="form1" method="post" action="">
						<table width="900" border="0">														
							<tr>
								<td><b>Código do Responsável:</b></td>			
								<td>Nome do responsável:</td>
								<td>Sexo do responsável:</td>
							</tr>
							<tr>																
								<?php $sql_select_ultimo_id_responsavel = "SELECT * FROM responsavel r ORDER BY r.id_responsavel DESC LIMIT 1";

								$conexao_select_ultimo_id_responsavel = mysqli_query($conexao, $sql_select_ultimo_id_responsavel) or die(mysqli_error($conexao));

								if(mysqli_num_rows($conexao_select_ultimo_id_responsavel) == ''){
									$novo_id = 1; ?>

									<td>
										<input type="text" name="id_responsavel" id="textfield" disabled="disabled" value="<?php echo $novo_id; ?>">
									</td>
									<input type="hidden" name="id_responsavel" value="<?php echo $novo_id; ?>"/> 

								<?php }else{

									while($resultado_select_responsavel_valores = mysqli_fetch_assoc($conexao_select_ultimo_id_responsavel)){
										$novo_id = $resultado_select_responsavel_valores['id_responsavel']+1; ?>
										<td>
											<input type="text" name="id_responsavel" id="textfield" disabled="disabled" value="<?php echo $novo_id; ?>">
										</td>
										<input type="hidden" name="id_responsavel" value="<?php echo $novo_id; ?>" />
									<?php } 
								}?>
								
								<td>
									<input type="text" name="nome_responsavel" id="textfield">
								</td>
								<td>
									<select name="sexo_responsavel" size="1" id="textfield">
										<option value="MASCULINO">Masculino</option>
										<option value="FEMININO">Feminino</option>
										<option value="OUTRO">Outro</option>
									</select>
								</td>      						
							</tr>
							<tr>
								<td>CPF do responsável:</td>
								<td>RG do responsável:</td>
								<td>E-mail do responsável:</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="cpf_responsavel" id="textfield" maxlength="11">
								</td>
								<td>
									<input type="text" name="rg_responsavel" id="textfield" maxlength="14">
								</td>								
								<td>
									<input type="email" name="email_responsavel" id="textfield">
								</td>
							</tr>    
							<tr>
								<td colspan="3">
									<input class="input" type="submit" name="button" id="button" value="Concluir">
								</td>								
							</tr>
						</table>
					</form>
					<br/>			
				<?php }// aqui fecha o bloco 2 ?>
	
				<?php  if(@$_GET['etapa'] == 'resumo'){ // aqui abre a etapa resumo ?>
					<h1>3º Passo - Mensagem de confirmação</h1>
					<table>
						<tr>
							<td>
								<h4>Este(a) Estudante foi cadastrado perfeitamente no sistema!
								<ul>
									<li>Fique atento em relação a chamada pois com 3 faltas não justificadas ele será removido do cursinho!</li> 
								</ul>
								<a href="estudantes.php?pg=aluno">Clique aqui para voltar para página de consultas</a>
								</h4>
							</td>
						</tr>
					</table>
					<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<?php }// aqui fecha a etapa resumo ?>
			<!-- fim div cadastra_estudante -->		
		<?php }// aqui fecha a PG cadastra ?>	
	

<!BUSCANDO ESTUDANTES NO BANCO>
	
		<?php if(@$_GET['pg'] == 'aluno'){ ?>
		
			<a class="a2" href="estudantes.php?pg=cadastra&etapa=1">Cadastrar Alunos</a>
		
			<h1>Alunos que estão cadastrados</h1>

			<?php $sql_consulta_alunos = "SELECT * FROM inscricao i INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao WHERE i.nome_aluno != '' ORDER BY i.nome_aluno";				 
			$consulta_alunos = mysqli_query($conexao, $sql_consulta_alunos) or die(mysqli_error($conexao));
										  
			if(mysqli_num_rows($consulta_alunos) == ''){
				
				echo "<h2>Não exisite nenhum aluno cadastrado no momento</h2>";
				
			}else{ ?>

				<table width="900" border="0">
					<tr>						
						<td>
							<center><strong>Código</strong></center>
						</td>
						<td>
							<center><strong>Nome Completo</strong></center>
						</td>
						<td>
							<center><strong>RG</strong></center>
						</td>
						<td>
							<center><strong>CPF</strong></center>
						</td>
						<td>
							<center><strong>Telefone </strong></center>
						</td>
						<td>
							<center><strong>Celular</strong></center>
						</td>						
					</tr>
					<?php while($resultado_consulta_alunos_valores = mysqli_fetch_assoc($consulta_alunos)){ ?>
						<tr>
							<td>
								<center><h3><?php echo $resultado_consulta_alunos_valores['id_aluno']; ?></h3></center>
							</td>
							<td>
								<center><h3><?php echo $resultado_consulta_alunos_valores['nome_aluno']; ?></h3></center>
							</td>
							<td>
								<center><h3><?php echo $resultado_consulta_alunos_valores['rg_aluno']; ?></h3></center>
							</td>
							<td>
								<center><h3><?php echo $resultado_consulta_alunos_valores['cpf']; ?></h3></center>
							</td>
							<td>
								<center><h3><?php echo $resultado_consulta_alunos_valores['telefone_responsavel']; ?></h3></center>
							</td>
							<td>
								<center><h3><?php echo $resultado_consulta_alunos_valores['celular_responsavel']; ?></h3></center>
							</td>
							<td>
							</td>
							<td>
								<!--<a class="a" href="estudantes.php?pg=consulta&func=deleta&id=<#?php echo $resultado_consulta_alunos_valores['cod_aluno']; ?>&code=><#?php echo $res_1['code']; ?>"><img title="Excluir Aluno(a)" src="img/deleta.jpg" width="18" height="18" border="0"></a>
								<#?php if($res_1['status'] == 'Inativo'){ ?>
								<a class="a" href="estudantes.php?pg=todos&func=ativa&id=<#?php echo $res_1['id']; ?>&code=<#?php echo $res_1['code']; ?>"><img title="Ativar novamente Aluno(a)" src="../img/correto.jpg" width="20" height="20" border="0"></a>
								<#?php } ?>
								<#?php if($res_1['status'] == 'Ativo'){?>
								<a class="a" href="estudantes.php?pg=todos&func=inativa&id=<#?php echo $res_1['id']; ?>&code=<#?php echo $res_1['code']; ?>"><img title="Inativar Aluno(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"></a>
								<#?php } ?>
								<a class="a" rel='superbox[iframe][800x600]' href="mostrar_resultado.php?q=<#?php echo $res_1['code']; ?>&s=aluno&curso=<#?php echo $res_1['serie']; ?>"><img title="Informações detalhada deste aluno(a)" src="../img/visualizar16.gif" width="18" height="18" border="0"></a>/>-->
							</td>
						</tr>
					<?php } ?>
				</table>
				<br/> 
			<?php } // aqui fecha a consulta ?>		

<! Exclusão, ativação e Desativação>

		<?php if(@$_GET['func'] == 'deleta'){

			$id = $_GET['id'];
			$code = $_GET['code'];

			$sql_del = "DELETE FROM estudantes WHERE id = '$id'";
			$sql_del2 = "DELETE FROM login WHERE code = '$code'";
			mysqli_query($conexao, $sql_del);
			mysqli_query($conexao, $sql_del2);

			echo "<script language='javascript'>window.location='estudantes.php?pg=consulta';</script>";
		}?>


		<?php if(@$_GET['func'] == 'ativa'){

			$id = $_GET['id'];
			$code = $_GET['code'];

			$sql_editar = "UPDATE estudantes SET status = 'Ativo' WHERE id = '$id'";
			$sql_editar2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
			mysqli_query($conexao, $sql_editar);
			mysqli_query($conexao,$sql_editar2);

			echo "<script language='javascript'>window.location='estudantes.php?pg=consulta';</script>";
		}?>


		<?php if(@$_GET['func'] == 'inativa'){

			$id = $_GET['id'];
			$code = $_GET['code'];

			$sql_editar = "UPDATE estudantes SET status = 'Inativo' WHERE id = '$id'";
			$sql_editar2 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
			mysqli_query($conexao, $sql_editar);
			mysqli_query($conexao,$sql_editar2);

			echo "<script language='javascript'>window.location='estudantes.php?pg=consulta';</script>";
		}?>
	
	<?php }// ?>
</div>
<?php require "rodape.php"; ?>

</body>
</html>