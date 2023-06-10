<?php 
require "profile.php"

?>
		<article>
			<div class="profile_info">
				<h1>My Profile</h1>
				<img src="../uploads/<?php echo $_SESSION['profileImg']; ?>" alt="Avatar">
		
		    	<div style="margin-top: 45px;">
			    	<h2 style="color: #ff4584;">My Profile</h2>
			    	<table>
			    		<tr>
			    			<td>Full Name:</td>
			    			<td><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></td>
			    		</tr>
			    		<tr>
			    			<td>Email:</td>
			    			<td><?php echo $_SESSION['email']; ?></td>
			    		</tr>
			    		<tr>
			    			<td>Age:</td>
			    			<td><?php echo $_SESSION['age']; ?></td>
			    		</tr>
			    		<tr>
			    			<td>Gender:</td>
			    			<td><?php echo $_SESSION['gender']; ?></td>
			    		</tr>
			    		<tr>
			    			<td>Height:</td>
			    			<td><?php echo $_SESSION['height']." cm"; ?></td>
			    		</tr>
			    		<tr>
			    			<td>Bio:</td>
			    			<td><?php echo $_SESSION['bio']; ?></td>
			    		</tr>
			    	</table>
		    	</div>

		    </div>
		</article>
	</section>

</body>
</html>


