<?
require_once('dbconf.php');
session_start();
$val = $_SESSION['time'];
if(time()-$val>=300)
{
	header("location: ./logout.php");
	exit();
}
$_SESSION['time']=time();
mysql_query("insert into problem(event,description,latitude,longitude,userid) values ($_POST[event],'$_POST[description]',$_POST[latitude],$_POST[longitude],$_SESSION[userid])");

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    	echo"success";
    }
  }
else
  {
  echo "Invalid file";
  }
?> 