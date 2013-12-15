<?
require_once('dbconf.php');
session_start();
if(time()-$_SESSION['time'] >= 300)
{
	header("location: logout.php");
	exit();
}
$val = mysql_query("select path from problem where id = $_POST[problem]");
$val=mysql_fetch_array($val);
header("location: ".$val['path']);