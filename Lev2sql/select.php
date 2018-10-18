<?php
error_reporting(0);
if(isset(S_REQUEST["submit"]))
{
$conn = mysql_connect('localhost', 'root', ''); 
if (!$conn) 
   die('Not connected : ' . mysql _error()); 
Sdb_selected = mysql_select_db('mysql', $conn); 
if (!$db_selected)
   die ('Can"t use mysql : ' . mysql_error());
$sql="select * from datastore where name='".addslashes(S_POST["name"])."'";
echo "You ran the sql query=".$sql."<br/>";
$result = mysql_query($sql,$conn);
$row=mysql_fetch_row($result);
 
$sql1="select * from datastore where fname=".$row[2]."'"; 
echo "The web application ran the sql query internally=".$sq11."<br/>"; 
$resultl = mysql_query($sq11,$conn);
$rowl=mysql_fetch row($result1);

 
mysql_close($conn);
echo "<br><b><center>Database Output</center></b><br><br>"; 
echo "<b>$rowl[0]</b><br>Age: $rowl[1]<br>First Name: $rowl[2]<br>Last Name: $rowl[3]<br><hr><br>";
}
?>
 
<html> 
<head><title>Find out details</title></head> 
<body>
<center><h1>See your details</h1> 
<form name=foo action=select.php method=POST> 
Name:&nbsp.:<input type=text name="name"><br/><br/> 
<input type=submit name="submit" value="submit"><br/> 