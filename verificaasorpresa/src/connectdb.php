<?php
   $host = "127.0.0.1"; //indirizzo di localhot
   $dbUser = "mecja_kevin"; //user del db (install.sh)
   $dbPassword ="mEcjA69@104"; //password del db (install.sh)
   $dbName = "verificaasorpresaDB"; //nome del database

   $connessione = new mysqli($host,$dbUser,$dbPassword,$dbName);

   if($connessione -> connect_errno)
   {
     die("Connessione fallita: " . $connessione->connect_error);

   }
?>