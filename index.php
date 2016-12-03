
<html>
	<head>
        <title>XO</title>
        <link rel="stylesheet" type="text/css" href="./theme/style.css" />		
	</head>
	<body>
        <div id="content">
        <center><h2>
		نام بازی را وارد کنید تا بتوانیم بعدا تاریخچه ان را به شما نشان دهیم!
		</h2>
<form action="./game.php" method="post">
<input type="text" name="game" placeholder="نام بازی" style="padding:10px;width:300px;">
<br>
<br>
<input type="submit" value="بازی را شروع کن !" name="gamesub" class="dobutton" >	
	</form>
	<?php
		echo "<br><center><br>
				<a align=\"center\" href=\"list.php\"><span class='dobutton' style='background:red !important'>لیست مسابقات</span></a>
				<center>";
	
	
	?>
        </div>
	</body>
</html>

