<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Add review</title>

</head>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Own stylesheet -->
    <link rel="stylesheet" href="stylesheet.css">
    
    <link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
<body>
    <div id="homepage"><a href="restaurants.php"><img id ="homepage" src="back1.png"
    alt="Back"/></a></div>
    <div class="nav">
      <div class="container">
        <ul class="pull-right">
          <li><a href="addrestaurant.php">Add new offer</a></li>
            <li><a href="logout.php">Logout</a></li>

        </ul>
      </div>
    </div>
    
    <?php
    if(!empty(filter_input(INPUT_POST, 'submit'))) {
	
	require_once('dbcon.php');
	
	$title = filter_input(INPUT_POST, 'restname') 
		or die('Missing/illegal title parameter');
    $description = filter_input(INPUT_POST, 'description') 
		or die('Missing/illegal description parameter');
        
        
    $sql = 'INSERT INTO Reviews (title, description) VALUES (?,?)';
        $stmt = $link->prepare($sql);
        $stmt->bind_param('ss', $title, $description);
        $stmt->execute();
        
    }
    ?>
    <p>
    <form id ="new" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Write a review about EXCL</legend>
        <h5>Your name:</h5>
    	<input class="in" name="restname" type="text" placeholder="Your name" required />
        <h5>Please tell us about your experience with EXCL:</h5>
    	<input class="in" name="description" type="text" placeholder="Tell us!"  required/>
    	<input class="in" type="submit" name="submit" value="Submit review" />
	</fieldset>
    </form>
    </p>
    
<?php  
        require_once('dbcon.php');
		$sql = 'SELECT title, description FROM reviews';
		$stmt = $link->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($title, $description);
		while($stmt->fetch()){ 
            echo '<div style="border: 2px dotted black; margin: 20px; width: 300px; padding: 20px; float: left;">
                    <tr>
					<h4>'.$title.'</h4><br>
					<td>'.$description.'</td><br>
                    <br>

				</tr></div>';
        }
?>
</div>
</body>
</html>