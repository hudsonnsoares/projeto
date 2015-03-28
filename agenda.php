<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AGENDA</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	
	<style>
		.agenda{
			margin-top:15px;
		}
	</style>
	
  </head>
  <body>
<?php
	include('header.php');
?>
<div class="row">
	<div class="large-12 columns">	
<?php

//ATUALIZA AS INFORMAÇÕES DO BANCO
if(isset($_POST['atualizar'])){
	$a_id = $_POST['id'];
	$a_nome = $_POST['nome'];
	$a_email = $_POST['email'];
	$a_telefone = $_POST['telefone'];
	
	$atualizar = mysql_query("UPDATE contato set nome='$a_nome',email='$a_email',telefone='$a_telefone' where id=$a_id");
	if($atualizar == true){
		echo "<div data-alert class=\"alert-box success\">CADASTRADO ATUALIZADO COM SUCESSO!<a href=\"#\" class=\"close\">&times;</a></div>";
		echo "<meta http-equiv=\"refresh\" content=\"2\">";
	}else{
		echo "<div data-alert class=\"alert-box alert\">CADASTRADO NÃO ATUALIZADO!<a href=\"#\" class=\"close\">&times;</a></div>";
		echo "<meta http-equiv=\"refresh\" content=\"2\">";
	}
}
//ATUALIZA AS INFORMAÇÕES DO BANCO

//REMOVE DADOS DO BANCO

else{
	if(isset($_POST['excluir'])){
	$a_id = $_POST['id'];
	$delete = mysql_query("DELETE FROM contato where id=$a_id");
	var_dump($delete);
	if($delete == true){
		echo "<div data-alert class=\"alert-box success\">REMOVIDO COM SUCESSO!<a href=\"#\" class=\"close\">&times;</a></div>";
		echo "<meta http-equiv=\"refresh\" content=\"2\">";
	}else{
		echo "<div data-alert class=\"alert-box alert\">NÃO FOI POSSÍVEL REMOVER!<a href=\"#\" class=\"close\">&times;</a></div>";
		echo "<meta http-equiv=\"refresh\" content=\"2\">";
	}
	}
}

//REMOVE DADOS DO BANCO

//RECUPERA OS CAMPOS VIA GET
	if((isset($_GET['acao'])) && ($_GET['acao'] == 'alterar') && (isset($_GET['id']))){
	$id_get = $_GET['id'];
	$recup = mysql_query("SELECT * FROM contato where id=$id_get");
	$rec = mysql_fetch_assoc($recup);
//RECUPERA OS CAMPOS VIA GET

?>

<!-- ## FORM ATUALIZAR DADOS ## -->
		<form action="" method="post">	
		
				<label>NOME:</label><input type="text" maxlength="50" name="nome" value="<?php echo($rec['nome']);?>"/>
				<label>EMAIL:</label><input type="email" name="email" value="<?php echo($rec['email']);?>"/>
				<label>TELEFONE:</label><input type="tel" name="telefone" maxlength="10" value="<?php echo($rec['telefone']);?>"/>
				<span class="label secondary"><i>Ex.:1122223333</i></span>
				<input type="hidden" name="id" value="<?php echo($rec['id']);?>"/>
				<br><br>
					
				<center>
					<input type="submit" class="button" name="atualizar" value="ATUALIZAR">
					<input type="submit" class="button alert" name="excluir" value="REMOVER">
				</center>
		</form>
<!-- ## FORM ATUALIZAR DADOS ## -->
		
	<?php
}
?>
	</div>
</div>

<?php

//LOOP LISTA

	$ver_agenda = mysql_query("SELECT * FROM contato");
	$cont_list = mysql_num_rows($ver_agenda);
	if($cont_list == 0){
	?>
		<div class="row">
			<div class="large-12 columns">
				<div data-alert class="alert-box alert">
					<center>
						NENHUM REGISTRO ENCONTRADO!
					</center>
					<a href="#" class="close">&times;</a>
				</div>
			</div>
		</div>
	<?php
	}else{
	
		while($list = mysql_fetch_assoc($ver_agenda)){
		$id_c = $list['id'];
		$nome_c = $list['nome'];
		$telefone_c = $list['telefone'];
		$email_c = $list['email'];
?>
<div class="row">
	<div class="large-12 columns">
		
		<div class="agenda">
			<div class="row-collapse">
				<fieldset>
					<div class="large-4 columns"><?php echo "<b>Nome: </b><br>$nome_c";?></div>
					<div class="large-2 columns"><?php echo "<b>Telefone: </b><br>$telefone_c";?></div>
					<div class="large-4 columns"><?php echo "<b>E-mail: </b><br>$email_c";?></div>
					<a href="agenda.php?acao=alterar&id=<?php echo($id_c); ?>"><div class="large-2 columns button secondary tiny">EDITAR</div></a>
				</fieldset>
			</div>
		</div>
	</div>
</div>
	
<?php
	}//FINAL LOOP LISTA
}//FINAL ELSE

?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
