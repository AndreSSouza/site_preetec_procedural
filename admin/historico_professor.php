<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Histórico</title>
<link rel="stylesheet" type="text/css" href="css/historico_do_professor.css"/>
 <?php require "../conexao.php"; ?>
</head>

<body>

<div id="box">
<?php
$id = $_GET['id'];

$sql_1 = "SELECT * FROM professores WHERE id = '$id'";
$consulta = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($consulta)){
?>
   <table width="900" border="0">
    <tr>
      <td><h2>Status:</h2></td>
      <td><h2>Salário:</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_1['status']; ?></h3></td>
      <td><h3><?php echo $res_1['salario']; ?></h3></td>
    </tr>
    <tr>
      <td><h2>Código:</h2></td>
      <td><h2>Nome:</h2></td>
      <td><h2>CPF:</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $code = $res_1['code']; ?></h3></td>
      <td><h3><?php echo $res_1['nome']; ?></h3></td>
      <td><h3><?php echo $res_1['cpf']; ?></h3></td>
    </tr>
    <tr>
      <td><h2>Data de nascimento:</h2></td>
      <td><h2>Formação Acadêmica:</h2></td>
      <td><h2>Graduação(ões):</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_1['nascimento']; ?></h3></td>
      <td><h3><?php echo $res_1['formacao']; ?></h3></td>
      <td><h3><?php echo $res_1['graduacao']; ?></h3></td>
    </tr>
    <tr>
      <td><h2>Pos-graduação(ões):</h2></td>
      <td><h2>Mestrado(s):</h2></td>
      <td><h2>Doutorado(s):</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_1['pos_graduacao']; ?></h3></td>
      <td><h3><?php echo $res_1['mestrado']; ?></h3></td>
      <td><h3><?php echo $res_1['doutorado']; ?></h3></td>
    </tr>
    <tr>
      <td><h2><strong>Disciplinas que este professor ensina:</strong> <?php $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
	   $result_disc = mysqli_query($conexao, $sql_2);
	   echo mysqli_num_rows($result_disc); ?></h2></td>
    </tr>
    <?php while($res_2 = mysqli_fetch_assoc($result_disc)){ ?>
    <tr>
      <td><h2>Série:</h2></td>
      <td><h2>Disciplina:</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_2['curso']; ?></h3></td>
      <td><h3><?php echo $res_2['disciplina']; ?></h3></td>
    </tr>
    <?php } ?>
  </table>
<?php } ?>  
</div><!-- box -->

</body>
</html>