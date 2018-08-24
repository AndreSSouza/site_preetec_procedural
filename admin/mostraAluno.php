<?php
	require "../conexao.php";

	// get the q parameter from URL
	$q = intval($_GET['q']);

	if($q ==''){ ?>

		<input type="text" disabled="disabled" value="">

	<?php }else{
		
		$sql_consulta_nome_aluno = "SELECT nome_aluno FROM inscricao WHERE id_inscricao = '".$q."'";				 
		$consulta_nome_aluno = mysqli_query($conexao, $sql_consulta_nome_aluno) or die(mysqli_error($conexao));

		if(mysqli_num_rows($consulta_nome_aluno) == ''){ ?>

			<input type="text" disabled="disabled" value="Aluno não encontrado!">

		<?php }else{
			
			$resultado_consulta_busca_nome_valores = mysqli_fetch_assoc($consulta_nome_aluno);?>
			<input type="text" disabled="disabled" value="<?php echo $resultado_consulta_busca_nome_valores['nome_aluno']; ?>">

		<?php }	
	} ?>