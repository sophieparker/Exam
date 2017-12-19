<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Own stylesheet -->
    <link rel="stylesheet" href="stylesheet.css">
<body>

<?php
//check if the input is NOT empty and checks if the username and password matches the info in database. 
//If it does; it logs in. If not it returns an error message
if(!empty(filter_input(INPUT_POST, 'submit'))) {
	require_once('dbcon.php');
	
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal name parameter');
	$pw = filter_input(INPUT_POST, 'pw') 
		or die('Missing/illegal password parameter');
	$sql = 'SELECT idUsers, pwhash FROM Users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);
	while ($stmt->fetch()) {} // fill result variables
	
	if (password_verify($pw, $pwhash)){
        echo "<script> window.location.assign('secret.php'); </script>";
		$_SESSION['uid'] = $uid;
		$_SESSION['un'] = $un;
	}
	else {
		echo 'illegal username/password combination';
	}
}
?>
<link rel="stylesheet" href="stylesheet.css">
<div id="homepage"><a href="index.php"><img id ="homepage" src="back1.png"
alt="Back"/></a></div>

<div class="nav">
      <div class="container">
        <ul class="pull-right">
          <li><a href="login.php">Log In</a></li>
          <li><a href="about.php">About EXCL</a></li>
        </ul>
      </div>
</div>
<p>
<form id ="loginform" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Login</legend>
    	<input class="in" name="un" type="text" placeholder="Username" required />
    	<input class="in"name="pw" type="password" placeholder="Password"  required/>
    	<input class="in" type="submit" name="submit" value="Login" />
	</fieldset>
</form>
    <p id="newuser">New user? <a href="adduser.php">Create new account</a></p>
</p>



</body>
</html>