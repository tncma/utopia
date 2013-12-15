<?
require_once('dbconf.php');
$id = mysql_escape_string(stripslashes($_POST['username'])); 
$pass = md5($_POST['password']);

$val = mysql_query("select username from user where id=$id and hash='$pass'");
if(mysql_num_rows($val)==1)
{
	session_start();
	$_SESSION['userid']=$id;
	$_SESSION['user']=mysql_fetch_array($val);
	$_SESSION['time']=time();
	header("location: ./home.html");
}
else
{
	echo "error";
}
?>