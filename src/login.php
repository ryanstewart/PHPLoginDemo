<?php
session_start();
$_SESSION['logged_in'] = false;
$_SESSION['username'] = "";

if(isset($_POST['is_submitted']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// If the "Remember my username" box is checked
	// then we use the setcookie function to save it.
	// Otherwise, we clear it out. 
	if($_POST['keep_username'] == true)
	{
		setcookie("username",$username,time()+36000);
	} else {
		setcookie("username");
	}
	
	// This is where you would look up the username
	// and password. Normally this would be an LDAP call
	// or a query to a database. In this case, I'm just
	// accepting everything.
	if($username && $password)
	{
		// Set our session variables.
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $username;
		
		// Redirect to the Flex application
		header("location:index.php");
	} else
	{
		echo "Go back and put in a username and password.";
	}
} else {
?>

<form name="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	Username: <input type="text" name="username" value="<?php echo $_COOKIE['username']; ?>" /><br />
	Password: <input type="password" name="password" /><br />
	Remember my username: <input type="checkbox" name="keep_username" value="true"><br />
	<input type="hidden" name="is_submitted" value="true" />
	<input type="submit" value="Submit" />	
</form>

<?php 
}
?>