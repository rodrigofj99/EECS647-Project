<?php
function OpenCon()
 {
 $dbhost = "mysql.eecs.ku.edu";
 $dbuser = "vicachevchenco";
 $dbpass = "waYeiqu3";
 $db = "vicachevchenco";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 return $conn;
 }

function CloseCon($conn)
 {
 $conn -> close();
 }

?>
