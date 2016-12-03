<?php
session_start();
if(isset($_POST['gamesub']) && isset($_POST['game']) && !empty($_POST['game'])){
require_once('includes/class.game.php');
require_once('includes/xolib.php');
include_once('includes/config.php');
$conn=connection();
$game=strip_tags(stripslashes(mysqli_real_escape_string($conn,$_POST['game']))).' - '.microtime(true);
$_SESSION['name']=$game;
$date=date('Y-m-d');
$insert_game_s="INSERT INTO games(id,name,move,date) VALUES('','$game','','$date')";
if($insert_game_q=mysqli_query($conn,$insert_game_s)){
?>
<html>
	<head>
        <title>		<?php	
		echo 'مسابقه :'.$game;
		?></title>
        <link rel="stylesheet" type="text/css" href="./theme/style.css" />
        <script language="Javascript" src="./theme/js/jquery-1.7.1.min.js"></script>
        <script language="Javascript" src="./theme/js/xo.js"></script>
		
	</head>
	<body>
        <div id="content">

        <center>در حال بارگزاری</center>
        </div>
		<script>
		function getid(id) {
			var valr = document.getElementById(id).value;
				return valr;
			}
		function xdb_in(id){
		var x,y,player;
		x= id.substr(0, 1);
		y= id.substr(2, 2);
		player='x';
		var game=<?php echo mysqli_insert_id($conn) ?>;
		if(confirm('جناب x آیا مطمئنید؟')==true){
        $.ajax('./requests/movements.php', {
            type: 'post',
            dataType: 'json',
            data: {x:x,y:y,game:game,player:player},
            cache: false,
            success: function (data) {
                if (data) {
                    var error = data.error;
                    if(error=='true'){
                       alert('خطایی رخ داده است');
                    }else{
                        // do nothing for success dude!
                    }
                }
            }
        });
		}
		else{
			alert('عملیات کنسل شد');
		}
		
		}
		function odb_in(id){
		var x,y,player;
		x= id.substr(0, 1);
		y= id.substr(2, 2);
		player='o';
		var game=<?php echo mysqli_insert_id($conn) ?>;
		if(confirm('جناب o آیا مطمنید؟')==true){
        $.ajax('./requests/movements.php', {
            type: 'post',
            dataType: 'json',
            data: {x:x,y:y,game:game,player:player},
            cache: false,
            success: function (data) {
                if (data) {
                    var error = data.error;
                    if(error=='true'){
                       alert('خطایی رخ داده است');
                    }else{
                        // do nothing for success dude!
                    }
                }
            }
        });
		}
		else{
			alert('عملیات کنسل شد');
		}
		
		}
		</script>
	</body>
</html>

<?php

}
else{
	header_remove();
	header("Location: ./index.php");
}
}
else{
	header_remove();
	header("Location: ./index.php");
}
?>