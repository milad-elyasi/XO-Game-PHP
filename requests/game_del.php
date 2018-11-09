<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include_once('../includes/config.php');
	$conn=connection();
		function call($error,$wy,$msg){
        $call = array('error'=>$error,'wy'=>$wy,'ms'=>$msg);
        echo json_encode($call);
}
if(isset($_POST['id']) && $_POST['id']!='' && is_numeric($_POST['id']) ){
	$del=strip_tags(stripcslashes(trim(mysqli_real_escape_string($conn,$_POST['id']))));	
	$del_s="DELETE FROM games WHERE id='$del';
	DELETE FROM moves WHERE game_id='$del';
	";
	if($delsql=mysqli_multi_query($conn,$del_s)){
		call('false','ok!','ok!');
		return true;
	}
	else{
		call('true','sql wrong','خطایی رخ داده است');
	}
	}
	else{
		call('true','admin worm!','خطایی رخ داده است');
	}
	mysqli_close($conn);

}

else{
    header_remove();
    header('location:./list.php');
}
