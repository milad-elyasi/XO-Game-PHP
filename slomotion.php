<?php

	include_once('./includes/config.php');
	$conn=connection();
		function call($x,$y,$msg){
        $call = array('x'=>$x,'y'=>$y,'ms'=>$msg);
        echo json_encode($call);
}

	$id=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_POST['idsss']))));	
	$act=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_GET['act']))));	

	$insert="SELECT * FROM moves WHERE id='$act' and game_id='$id' ";
	//echo $insert;
	if($select_query=mysqli_query($conn,$insert)){
	$rows=mysqli_fetch_assoc($select_query);
	
	$xcell=$rows['x'];
	$ycell=$rows['y'];
	call($xcell,$ycell,'ok!');
	return true;
	}
	else{
		call('x','y','خطایی رخ داده است');
	}
	mysqli_close($conn);






?>