<?
require_once('dbconf.php');
session_start();
if(time()-$_SESSION['time'] >= 300)
{
	header("location: logout.php");
	exit();
}
$_SESSION['time']=time();
if($_SESSION['userid']==1)
{
	$res = mysql_query("select problem.id,event.name,description,latitude,longitude,event.icon from problem,event where event.id = problem.id and problem.event in (select event_id from problem,user,dept_event,dept where user.id=$_SESSION[userid] and user.type = dept.id and dept_event.dept_id=dept.id)");
}
else if($_SESSION['userid']>1 && $_SESSION['userid']<5)
{
	$res = mysql_query("select problem.id,event.name,description,latitude,longitude,event.icon from problem,event where event.id=problem.id");
}
else 
{
	echo "null";
	exit();
}	
if($_POST['flag'] == 1)
{
	$result = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	$result .= "<Document>";
	while($i++<mysql_num_rows($res))
	{
		$val = mysql_fetch_array($res);
		$result .="<Placemark><styleUrl>".$val['icon']."</styleUrl><name>".$val['name']."</name><description>".$val['description']."---".$val['id']."</description><Point><coordinates>".$val['latitude'].",".$val['longitude'].",0</coordinates></Point></Placemark>";
	}
	$result.="</Document></kml>";
	echo $result;
}
else
{
	$result = [];
	while($i++<mysql_num_rows($res))
	{
		$result[$i]	= mysql_fetch_array($res);
	}
	echo json_encode($result);
}