<?php
		
		function pripremiZaBazu ( $unos )  //funkcija priprema atribut za sigurno slanje bazi podataka
		{
			$unos = htmlspecialchars ( $unos );
			//$unos = nl2br ( $unos );
			$unos = stripslashes ($unos);
			$unos = mysql_real_escape_string ( $unos );
			
			if ( is_null ($unos) || $unos == '' ) $unos = 'null';
			
			return $unos;
		}
		
		
		function navodnici ( $unos ) // dodaje navodnike (') na poèetak i kraj znakovnih nizova razlièitih od "null"
		{
			if ( $unos != 'null' ) $unos = "'" . $unos . "'";
			
			return $unos;
		}

		function mysql_zapocni_transakciju() // zapoèinje MySQL transakciju
		{
			$upit = "BEGIN;";
			$rezultat = mysql_query ($upit);
		}
		
		function mysql_pohrani() // pohranjuje rezultat upita izvedenih unutar transakcije
		{
			$upit = "COMMIT;";
			$rezultat = mysql_query ($upit);
		}
		
		function mysql_odbaci() // odbacije sve upite izvedene unutar transakcije i vraæa bazu u stanje prije poèetka transakcije
		{
			$upit = "ROLLBACK;";
			$rezultat = mysql_query ($upit);
		}
?>