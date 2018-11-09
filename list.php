<html>
	<head>
        <title>XO</title>
        <link rel="stylesheet" type="text/css" href="./theme/style.css" />	
		        <script language="Javascript" src="./theme/js/jquery-1.7.1.min.js"></script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: right;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>		
	</head>
	<body>
        <div id="content">
        <center><h2>
		تاریخچه ی بازی های شما
		</h2>
<table>
  <tr>
    <th>شماره</th>
    <th>تاریخ</th>
    <th>نام</th>
    <th>تعداد حرکت</th>
    <th>برنده</th>
    <th>عملیات</th>
  </tr>
  <?php
  include_once('./includes/config.php');
  $conn=connection();
  $select_list=mysqli_query($conn,"SELECT * FROM games");
  while($games=mysqli_fetch_assoc($select_list)){
	  echo' <tr id='.$games['id'].'>
    <td>'.$games['id'].'</td>
    <td>'.$games['date'].'</td>
    <td>'.$games['name'].'</td>
    <td>'.$games['move'].'</td>
    <td>'.$games['winner'].'</td><td>
		<a href="table.php?id='.$games['id'].'" class="dobutton">مشاهده</a>
		<span onclick="del(\''.$games['id'].'\')" class="dobutton" style="background:red !important;cursor: no-drop;">حذف</span></td>

  </tr> ';
  }
  ?>

</table>
  <script>
  		 function del(id) {
	    if(confirm('آیا مطمئنید؟')==true){
        $.ajax('./requests/game_del.php', {
            type: 'post',
            dataType: 'json',
            data: {id:id},
            cache: false,
            success: function (data) {
                if (data) {
                    var error = data.error;
                    if(error=='true'){
                       alert('خطایی رخ داده است');
                    }else{
                        $('#'+id).hide();
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
        </div>
	</body>
</html>

