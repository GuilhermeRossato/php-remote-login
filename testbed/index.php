<?php
//Start the session
session_start();
//Require the class
require('classes/FormKey.class.php');
//Start the class
$formKey = new FormKey();

$error = 'No error';
$logged = false;
//Is request?
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!isset($_POST['form_key']) || !$formKey->validate()) {
        //Form key is invalid, show an error
        $error = 'Form key error!';
    } else if (isset($_POST['action']) && $_POST['action'] === "Logout") { 
		session_destroy();
		$error = "Logged out successfuly";
	} else {
        $error = 'Username failed';
		if ($_POST['username'] == "Guilherme") {
			$error = 'Auth successfull';
			$logged = true;
			$_SESSION["username"] = $_POST['username'];
		}
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>Securing forms with form keys</title>
</head>
<body>
    <form action="" method="post">
    <dl>
    	<dt><?php $formKey->outputKey(); ?></dt>
	<?php if (!$logged): ?>
		<dt><h2>Log in</h2></dt>
		<dt><label for="username">Username:</label></dt>
		<dd><input type="text" name="username" id="username" /></dd>
		<dt><label for="username">Password:</label></dt>
		<dd><input type="password" name="password" id="password" /></dd>
		<dt></dt>
		<dd><input type="submit" name="action" value="Login" /></dd>
	<?php else: ?>
		<dt><h2>Logged in</h2></dt>
		<dt>Welcome, <?php echo $_SESSION['username'] ?></dt>
		<dt>You can access our <a href="list.php">secret list</a> now that you are logged!</dt>
		<dt></dt>
		<dd><input type="submit" name="action" value="Logout" /></dd>
	<?php endif ?>
		<dt style="color:red;font-weight:bold"><?php if($error) { echo("Error: ".$error); } ?></dt>
    </dl>
    </form>
</body>
</html>