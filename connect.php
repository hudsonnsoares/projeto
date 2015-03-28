<?php
$host = "localhost";
$banco = "agenda";
$usuario = "root";
$senha = "";

$con = mysql_connect($host,$usuario,$senha);
$con_db = mysql_select_db($banco);

?>