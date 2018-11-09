<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include_once('../includes/config.php');
	$conn=connection();
		function call($error,$wy,$msg){
        $call = array('error'=>$error,'wy'=>$wy,'ms'=>$msg);
        echo json_encode($call);
}
if(
isset($_POST['game']) && $_POST['game']!='' && is_numeric($_POST['game']) &&
isset($_POST['x']) && $_POST['x']!='' && is_numeric($_POST['x']) &&
isset($_POST['y']) && $_POST['y']!='' && is_numeric($_POST['y']) 
){
	$game=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_POST['game']))));	
	$x=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_POST['x']))));	
	$y=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_POST['y']))));	
	$player=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_POST['player']))));
 if (!empty($player))	{
	$insert="INSERT INTO moves(id,game_id,x,y,player) VALUES('','$game','$x','$y','$player')";
	if($insert_query=mysqli_query($conn,$insert)){
	call('false','ok!','ok!');
	return true;
	}

	else{
		call('true','sql wrong','خطایی رخ داده است');
	}
	mysqli_close($conn);
 }
}
else{
    header_remove();
    header('location:./list.php');
}
}

else{
    header_remove();
    header('location:./list.php');
}




?>