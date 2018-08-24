<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chamada</title>
<link rel="stylesheet" type="text/css" href="../professor/css/fazer_chamada.css"/>
</head>

<body>

<?php require "../professor/topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1>Abaixo está mostrando todos os alunos do(a) <strong><?php echo $curso = base64_decode($_GET['curso']); ?></strong> Data de Hoje <strong><?php echo date("d/m/Y"); ?></strong></h1>

<?php

$date = date("d/m/Y H:i:s");
$date_hoje = date("d/m/Y");
$dis = base64_decode($_GET['dis']);

$sql_1 = "SELECT * FROM estudantes WHERE serie = '$curso'";
$resultado = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($resultado) == ''){
	 echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
}else{
 while($res_1 = mysqli_fetch_assoc($resultado)){
	 $code_aluno = $res_1['code'];
?> 
<form name="button" method="post" enctype="multipart/form-data" action="">
<table width="955" border="0">
  <tr>
    <td width="94"><strong>Código:</strong></td>
    <td width="466"><strong>Nome:</strong></td>
    <td colspan="2"><strong>Este aluno está presente?</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['code']; ?><input type="hidden" name="code_aluno" value="<?php echo $res_1['code']; ?>" /></td>
    <td><?php echo $res_1['nome']; ?><input type="hidden" name="nome" value="<?php echo $res_1['nome']; ?>" /></td>
    <td width="315">
    <?php
    $sql_2 = "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND disciplina = '$dis' AND code_aluno = '$code_aluno'";
	$resultado2 = mysqli_query($conexao, $sql_2);
	if(mysqli_num_rows($resultado2) == ''){
	?>
    <input type="radio" name="presensa" id="radio" value="SIM">
    <label for="radio">SIM 
      <input type="radio" name="presensa" value="NÃO">
    </label> 
    NÃO 
    <input type="radio" name="presensa" value="JUSTIFICADA">
    FALTA JUSTIFICADA 
    <label for="fileField"></label></td>
    <td width="62"><input type="submit" name="button" id="button" value="Guardar"></td>
    <?php }else{ echo "Indisponível"; }?>
  </tr>
  <tr>
<?php if(isset($_POST['button'])){

$code_aluno = $_POST['code_aluno'];	
$nome = $_POST['nome'];	
@$presensa = $_POST['presensa'];

if($presensa == ''){
	echo "<script language='javascript'>window.alert('Por favor, informe se este aluno está presente ou não na sala de aula!');</script>";
}else{
$sql_3 = "SELECT * FROM confirma_entrada_de_alunos WHERE data_hoje = '$date_hoje' AND code_aluno = '$code_aluno'";
$resultado3 = mysqli_query($conexao, $sql_3);
if(mysqli_num_rows($resultado3) == '' && $presensa == 'SIM'){
	echo "<script language='javascript'>window.alert('Este aluno não entrou na escola hoje!');</script>";
}else{	
if(mysqli_num_rows($resultado3)>=1 && $presensa == 'NÃO' || $presensa == 'JUSTIFICADA'){
?>
 <td colspan="3">
 <h3><strong>Este aluno entrou na instituição hoje, tem certeza que ele não está na sala de aula?</strong></h3>
 <a href="../professor/fazer_chamada.php?curso=<?php echo $_GET['curso']; ?>&amp;dis=<?php echo $_GET['dis']; ?>&amp;confirmar_falta=sim&amp;code_aluno=<?php echo $code_aluno; ?>&amp;tipo=<?php echo $_POST['presensa']; ?>">CONFIRMAR FALTA</a> | <a href="">CANCELAR</a>
 </td>
<?php
}else{
$sql_4 = "INSERT INTO chamadas_em_sala (date, date_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('$date', '$date_hoje', '$curso', '$dis', '$code', '$code_aluno', '$presensa')";	
mysqli_query($conexao, $sql_4);
	echo "<script language='javascript'>window.location='';</script>";	
}}}}?>  
  </tr>
</table>
</form>

<?php if(@$_GET['confirmar_falta'] == 'sim'){

$code_aluno = $_GET['code_aluno'];
$presensa = $_GET['tipo'];


$sql_5 = "INSERT INTO chamadas_em_sala (date, date_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('$date', '$date_hoje', '$curso', '$dis', '$code', '$code_aluno', '$presensa')";	
mysqli_query($conexao, $sql_5);
$curso = $_GET['curso'];
$dis = $_GET['dis'];
echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$dis';</script>";
}?>


<?php }} ?>
</div><!-- box -->

<?php require "../professor/rodape.php"; ?>

</body>
</html>