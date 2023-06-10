<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";
require "profile.php";



?>

<article>
	<div class="matchCont">
		<h1>My Match</h1>
		<hr>
		<table>

			<?php
			$a = new ExtractData();
			$retval = $a->extMyMatch($_SESSION['userid']);
			$data = mysqli_num_rows($retval);

			if($data>0){
				while($row=mysqli_fetch_array($retval)){
					#print_r($row);
					if($row['user1']!=$_SESSION['userid']){
						$matchid = $row['user1'];
					}else{
						$matchid = $row['user2'];
					}
					$matchinfo = $a->extMatchId($matchid);

				?>	<tr><td>
					<a href="userinfo.php?matchid=<?php echo $matchid; ?>">
						<div class="card">
							<img src="../uploads/<?php echo $matchinfo['profileImg']; ?>" style="width:100%">
							<div class="cardContainer">
								<h2><?php echo $matchinfo['firstname']." ".$matchinfo['lastname']; ?></h2>
								<p><b>Age: </b><?php echo $matchinfo['age']; ?></p>
								<p><b>Height: </b><?php echo $matchinfo['height']; ?></p>
								<p><b>Email: </b><?php echo $matchinfo['email']; ?></p>
								<p><?php echo $matchinfo['bio']; ?></p>
							</div>
						</div>
					</a></td></tr>

				<?php
				}
			}?>
		</table>
	</div>
</article>
</section>
</body>
</html>