<?php
if(isset($_REQUEST[submit])) 
{
$conn = mysql_connect('localhost', 'root', ''); 
if (!$conn) 
    die('Not connected : ' . mysql _error()); 
$db_selected = mysql_select_db('mysqls', $conn); 
if (!$db_selected) 
	die ('Cant use mysql :' . mysql_error());
$sql_statement="INSERT into datastore (name,age,fname,lname) values('".mysql_real_escape_string($_REQUEST["name"])."',".intval(S_REQUEST["age"]).",'". mysql_real_escape_string($_REQUEST["fname"])."','".mysql_real_escape_string($_REQUEST["lname"])."')";
echo "You ran the sql query=".$sql_statement."<br/>";
$qry = mysql_query($sql_statement,$conn) || die (mysql_error()); 
mysql_close($conn); 
Echo "Data inserted successfully"; 
}
?>

<html> <head><title>Insert details</title></head> 
<body><center> 
<h1>Insert your details</h1><br/> 
<form name=foo action=insert2.php method=POST> 
Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="name"><br/><br/> 
Age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="age"><br/><br/> 
First Name:&nbsp;<input type=text name="fname"><br/><br/> 
Last Name:&nbsp;<input type=text name="lname"><br/><br/> 
<input type=submit name="submit" value="submit"><br/> 
</form> 
</center> 
</body> 
</html> 