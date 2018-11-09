<?php

class tictactoe extends game
{
	var $player = "X";			//whose turn is
	var $board = array();		//the tic tac toe board
	var $totalMoves = 0;		//how many moves have been made so far		

	function tictactoe()
	{
		game::start();
        $this->newBoard();
	}
	
	function newGame()
	{
		//setup the game
		$this->start();
		
		//reset the player
		$this->player = "X";
		$this->totalMoves = 0;
			
		//clear out the board
		$this->newBoard();
	}

    function newBoard() {
    
        //clear out the board
		$this->board = array();
        
        //create the board
        for ($x = 0; $x <= 2; $x++)
        {
            for ($y = 0; $y <= 2; $y++)
            {
                $this->board[$x][$y] = null;
            }
        }
    }

	function playGame($spot, $value)
	{
		if (!$this->isOver() && $spot && $value)
			$this->move($spot, $value);
			
		//player pressed the button to start a new game
		if (isset($_POST['newgame'])) {
			$this->newGame();
        }
				
		//display the game
		$this->displayGame();
	}

	function displayGame()
	{
		
		//while the game isn't over
		if (!$this->isOver())
		{
			echo "<div id=\"board\">";
			
			for ($x = 0; $x < 3; $x++)
			{
				for ($y = 0; $y < 3; $y++)
				{
					echo "<div class=\"board_cell\">";
					
					//check to see if that position is already filled
					if ($this->board[$x][$y])
						echo "<img src=\"./theme/images/{$this->board[$x][$y]}.jpg\" alt=\"{$this->board[$x][$y]}\" title=\"{$this->board[$x][$y]}\" />";
					else
					{
						//let them choose to put an x or o there
						if($this->player=='X'){
						echo "<select onchange='xdb_in(\"{$x}_{$y}\");' name=\"{$x}_{$y}\" id=\"{$x}_{$y}\" x=\"{$x}\" y=\"{$y}\" class=\"board_spot\">
								<option value=\"\"></option>
								<option value=\"{$this->player}\" id='x'>{$this->player}</option>
							</select>";
						}
						else{
							echo "<select onchange='odb_in(\"{$x}_{$y}\");' name=\"{$x}_{$y}\" id=\"{$x}_{$y}\" x=\"{$x}\" y=\"{$y}\" class=\"board_spot\">
								<option value=\"\"></option>
								<option value=\"{$this->player}\" id='o'>{$this->player}</option>
							</select>";
						}
						
					}
					
					echo "</div>";
				}
				
				echo "<div class=\"break\"></div>";
			}
			
			echo "
				<p align=\"center\">
				<b style='color:green'> نوبت با : {$this->player} </b><br><br>
					<input type=\"submit\" name=\"move\" value=\"اجرای حرکت\" class=\"dobutton\" onClick=\"makeMove();\" /><br/>
					</p>
			</div>";
		}
		else
		{
			$winnnnnner=$this->isOver();
			if ($this->isOver() != "Tie")
				echo successMsg(" تبریک به " . $this->isOver() . " شما بازی را بردید ");
			else if ($this->isOver() == "Tie")
				echo errorMsg("بازی مساوی شد! دوباره بازی کنید");
				
	 
				
				echo "<br><center><a align=\"center\" href=\"index.php\"><span class='dobutton'>بازی جدید</span></a><br><br>
				<a align=\"center\" href=\"list.php\"><span class='dobutton' style='background:red !important'>لیست مسابقات</span></a>
				<center>";
				//echo $game;
				// SEND TOTAL MOVES AND OVER GAME IN DB'
				function connection()
				{
				$conn = @mysqli_connect('localhost','root','','xoxo');
				mysqli_set_charset($conn, "utf8");
				ini_alter('date.timezone','Asia/Tehran');
				date_default_timezone_set('Asia/Tehran');
				return $conn;
				}
				// on each request check time and update expire dates
				if (!connection()){
				$conn=connection();
				mysqli_error();
				die();	
				exit(0);
				}
				$conn=connection();
				$game_arr=get_object_vars($_SESSION['game']['tictactoe']);
				$move_db= $game_arr['totalMoves'];
				$over_db=1;
				$gamename= $_SESSION['name'];
				$db_up=mysqli_query($conn,"UPDATE games SET move='$move_db',over=1,winner='$winnnnnner' WHERE name='$gamename'");
				session_destroy();
			}
	}
	function move($spot, $value)
	{			

		if ($this->isOver())
			return;

		if ($value == $this->player)
		{	
			//update the board in that position with the player's X or O 
			$coords = explode("_", $spot);
			$this->board[$coords[0]][$coords[1]] = $this->player;

			//change the turn to the next player
			if ($this->player == "X")
				$this->player = "O";
			else
				$this->player = "X";
				
			$this->totalMoves++;
		}
	
		if ($this->isOver())
			return;
	}
	function isOver()
	{
		
		//top row
		if ($this->board[0][0] && $this->board[0][0] == $this->board[0][1] && $this->board[0][1] == $this->board[0][2])
			return $this->board[0][0];
			
		//middle row
		if ($this->board[1][0] && $this->board[1][0] == $this->board[1][1] && $this->board[1][1] == $this->board[1][2])
			return $this->board[1][0];
			
		//bottom row
		if ($this->board[2][0] && $this->board[2][0] == $this->board[2][1] && $this->board[2][1] == $this->board[2][2])
			return $this->board[2][0];
			
		//first column
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][0] && $this->board[1][0] == $this->board[2][0])
			return $this->board[0][0];
			
		//second column
		if ($this->board[0][1] && $this->board[0][1] == $this->board[1][1] && $this->board[1][1] == $this->board[2][1])
			return $this->board[0][1];
			
		//third column
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][2] && $this->board[1][2] == $this->board[2][2])
			return $this->board[0][2];
			
		//diagonal 1
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2])
			return $this->board[0][0];
			
		//diagonal 2
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0])
			return $this->board[0][2];
			
		if ($this->totalMoves >= 9)
			return "Tie";
	}
}
