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
		
		
		function navodnici ( $unos ) // dodaje navodnike (') na po�etak i kraj znakovnih nizova razli�itih od "null"
		{
			if ( $unos != 'null' ) $unos = "'" . $unos . "'";
			
			return $unos;
		}

		function mysql_zapocni_transakciju() // zapo�inje MySQL transakciju
		{
			$upit = "BEGIN;";
			$rezultat = mysql_query ($upit);
		}
		
		function mysql_pohrani() // pohranjuje rezultat upita izvedenih unutar transakcije
		{
			$upit = "COMMIT;";
			$rezultat = mysql_query ($upit);
		}
		
		function mysql_odbaci() // odbacije sve upite izvedene unutar transakcije i vra�a bazu u stanje prije po�etka transakcije
		{
			$upit = "ROLLBACK;";
			$rezultat = mysql_query ($upit);
		}
?>