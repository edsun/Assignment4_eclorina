<?php
     //define our database connection parameters using constants
     define('DB_HOST','localhost');
     define('DB_USER','serveruser');
     define('DB_PASS','gorgonzola7!');
     define('DB_NAME','serverside');
     
     //create a MySQLi(i=improved) resource object called $db
     $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
?>