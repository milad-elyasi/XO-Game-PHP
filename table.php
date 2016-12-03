<html>
<head>
<title>مسابقه</title>
<link rel="stylesheet" type="text/css" href="./theme/style.css" />	
  <script language="Javascript" src="./theme/js/jquery-1.7.1.min.js"></script>
	</head>
	<body>
	<?php
		include_once('./includes/config.php');
		$conn=connection();
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$ids_array = array();


	$id=trim(strip_tags(stripslashes(mysqli_real_escape_string($conn,$_GET['id']))));
	$game=mysqli_query($conn,"SELECT * FROM games WHERE id='$id'");
	$info=mysqli_fetch_assoc($game);
	if(mysqli_num_rows($game)==1){
	function get_part($x,$y,$id){
		include_once('./includes/config.php');
		$conn=connection();	
	$selection="SELECT * FROM moves WHERE x='$x' AND y='$y' AND game_id='$id'";
	$query=mysqli_query($conn,$selection);
	$cell=mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query)==1){
	   if($cell['player']=='x'){
		   echo '<img src="./theme/images/X.jpg" alt="X" title="X">';
	   }
	   else if($cell['player']=='o'){
		  echo '<img src="./theme/images/O.jpg" alt="O" title="O">'; 
	   }
	}
	else{
		echo 'خالی';
	}
	}
$result = mysqli_query($conn,"SELECT id FROM moves WHERE game_id='$id'");

while($row = mysqli_fetch_array($result))
{
    $ids_array[] = $row['id'];
}
	
	
	
	?>
	<script>

$(document).ready(function(){
	doRequest(0);
function doRequest(index) {
	toRequest=<?php echo json_encode($ids_array) ?>;
var idsss='<?php echo $id; ?>';
  $.ajax({
    url:"./slomotion.php?act="+toRequest[index],
    async:true,
	data: {idsss: idsss},
    cache: false,
    type: 'post',
    dataType: 'json',
    success: function(data){    
       $('#'+data.x+'_'+data.y).show(500); 
       
	   // seconds to show requests
		//alert('#'+data.x+'_'+data.y);
		//alert(data.x);
      if (index+1<toRequest.length) {
		   setTimeout(function(){
        doRequest(index+1)
    },1000);
      }
    }
  }); 
}
   
});


</script>
        <div id="content">
		<h4> <span style="color:red"> نام بازی : </span><?php echo $info['name']  ?> </h4>
		<h4>
		<span style="color:red">
		تعداد حرکت : </span>
		<?php echo $info['move']  ?> ||
		<span style="color:red">
		 برنده :  </span>
		 <?php echo $info['winner']  ?> ||
		 <span style="color:red">
		 تاریخ انجام :  </span>
		 <?php echo $info['date']  ?> </h4>
		 <h4> <span style="color:red"> شرح حرکات بازیکنان : </span></h4>
		<div id="board">
		<br>
<div class="board_cell" >
<div id="0_0" style="display:none">
<?php
get_part(0,0,$id);
?>
</div>
</div>
<div class="board_cell"  >
<div id="0_1" style="display:none">
<?php
get_part(0,1,$id);
?>
</div></div>

<div class="board_cell"  >
<div id="0_2" style="display:none">
<?php
get_part(0,2,$id);
?>
</div>
</div>
<div class="break">
<!-- ردیف دوم -->
</div>
<div class="board_cell"  >
<div id="1_0" style="display:none">
<?php
get_part(1,0,$id);
?>
</div>
</div>
<div class="board_cell"  >
<div id="1_1" style="display:none">
<?php
get_part(1,1,$id);
?>
</div>
</div>
<div class="board_cell"  >
<div id="1_2" style="display:none">
<?php
get_part(1,2,$id);
?>
</div>
</div>
<div class="break"></div>
<!-- ردیف سوم -->
<div class="board_cell"  >
<div id="2_0" style="display:none">
<?php
get_part(2,0,$id);
?>
</div>
</div>
<div class="board_cell"  >
<div id="2_1" style="display:none">
<?php
get_part(2,1,$id);
?>
</div>
</div>
<div class="board_cell" >
<div  id="2_2" style="display:none">
<?php
get_part(2,2,$id);
?>
</div>
</div>

</div>
</div>
<?php
	}
	else{
		header_remove();
		header('Location: ./list.php');
		
	}

	}
	else{
		header_remove();
		header('Location: ./list.php');
		
	}
?>

	</body>
</html>