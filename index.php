<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HOME</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
<?php
	include('header.php');
?>
<div class="row">
	<div class="large-12 columns">
<!--##CADASTRO##-->

<?php
if(isset($_POST['enviar'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
				
//VERIFICAR CONTA DE E-MAIL
	$con_email = mysql_query("SELECT * FROM contato where email='$email'");
	$ver_email = mysql_num_rows($con_email);
	
	if($ver_email == 1 ){
		echo "<div data-alert class=\"alert-box alert\">E-MAIL JÁ CADASTRADO!<a href=\"#\" class=\"close\">&times;</a></div>";
	}
//FINAL VERIFICAR CONTA DE E-MAIL

	else{
	
//ADICIONA CONTATO
	$add_agenda = mysql_query("INSERT INTO contato VALUES('','$nome','$email','$telefone')");
	if($add_agenda == true){
		echo "<div data-alert class=\"alert-box success\">CADASTRADO REALIZADO COM SUCESSO!<a href=\"#\" class=\"close\">&times;</a></div>";
		echo "<meta http-equiv=\"refresh\" content=\"2\">";
	}else{
		echo "<div data-alert class=\"alert-box alert\">ERRO AO INSERIR DADOS!<a href=\"#\" class=\"close\">&times;</a></div>";
		echo "<meta http-equiv=\"refresh\" content=\"2\">";
	}
	}
		
//FINAL ADICIONA CONTATO

}
?>
<!--## FIM CADASTRO##-->		

<!--## FORM CADASTRO##-->	
		<fieldset>
			<legend align="center">CADASTRO DE AGENDA</legend>
				<form action="" method="post">
					<label>NOME:</label><input type="text" maxlength="50" name="nome" required/>
					<label>EMAIL:</label><input type="email" name="email" required/>
					<label>TELEFONE:</label><input type="number" name="telefone" maxlength="10" required/>
					<span class="label secondary"><i>Ex.:1122223333</i></span>
					<br><br>
					<center>
						<input type="submit" class="button" name="enviar" value="ENVIAR">
					</center>
				</form>
		</fieldset>
<!--## FORM CADASTRO##-->

	</div>
</div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
