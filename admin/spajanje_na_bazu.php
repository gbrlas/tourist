<?php
	$veza = mysqli_connect('localhost', 'root', 'ivan310', 'tourist') or die ('Došlo je do greške pri pokšaju spajanja s bazom podataka.');
			
	mysqli_set_charset($veza, 'utf8');
	$upitSQLmode = "SET SESSION sql_mode='STRICT_ALL_TABLES'";			
	mysqli_query ($veza, $upitSQLmode) or die ("Neuspješno postavljanje načina rada SQL-a");
?>