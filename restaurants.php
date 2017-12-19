<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Available restaurants</title>

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
    <div id="homepage"><a href="index.php"><img id ="homepage" src="back1.png"
    alt="Back"/></a></div>
    
    <div class="nav">
      <div class="container">
        <ul class="pull-right">
          <li><a href="addrestaurant.php">Add new offer</a></li>
          <li><a href="reviews.php">Tell us what you think</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    
    <div id="value">
        <h3 id="pricerange">Choose your pricerange:</h3>
        <form  action="#" method="post">
        <input class="btn" type="submit" name="under500" value="LESS THAN 500DKK">
        <input class="btn" type="submit" name="under1000" value="LESS THAN 1000DKK">
        <input class="btn" type="submit" name="under1500" value="LESS THAN 1500DKK">
        <input class="btn" type="submit" name="all" value="VIEW ALL OFFERS">
        </form>
    </div>
    
    <?php
    if (isset($_POST['under500'])) {
    require_once('dbcon.php');
		$sql = 'SELECT idRestaurants, name, description, price, date, imageurl FROM restaurants WHERE price<500';
		$stmt = $link->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($resid, $name, $description, $price, $date, $imageurl);
        $dirname = "img/";
        $images = glob($dirname."*.jpg");
		while($stmt->fetch()){ 
            echo '<div style="border: 1px solid black; margin-right: auto; margin-left: auto; width: 340px; height: auto; padding: 20px; margin: 20px; float: left; background-color: white;">
                    <tr>
                    <td><img src="'.$imageurl.'" height="200" width="300"/><br /></td><br>
					<h3>'.$name.'</h3><br>
					<h5>'.$description.'</h5><br>
                    <td>Price:</td>
					<h4>'.$price.' dkk</h4><br>
                    <td>The offer ends:</td>
					<td>'. date('F d, Y', strtotime($date)) . '</td><br>
                    <br>
                    <button class="in" type="button">Reserve the table!</button><br><br>

				</tr></div>';
        }
    } ?>
    
    <?php
    if (isset($_POST['under1000'])) {
    require_once('dbcon.php');
		$sql = 'SELECT idRestaurants, name, description, price, date, imageurl FROM restaurants WHERE price<1000';
		$stmt = $link->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($resid, $name, $description, $price, $date, $imageurl);
        $dirname = "img/";
        $images = glob($dirname."*.jpg");
		while($stmt->fetch()){ 
            echo '<div style="border: 1px solid black; margin-right: auto; margin-left: auto; width: 340px; height: auto; padding: 20px; margin: 20px; float: left; background-color: white;">
                    <tr>
                    <td><img src="'.$imageurl.'" height="200" width="300"/><br /></td><br>
					<h3>'.$name.'</h3><br>
					<h5>'.$description.'</h5><br>
                    <td>Price:</td>
					<h4>'.$price.' dkk</h4><br>
                    <td>The offer ends:</td>
					<td>'. date('F d, Y', strtotime($date)) . '</td><br>
                    <br>
                    <button class="in" type="button">Reserve the table!</button><br><br>

				</tr></div>';
        }
    } ?>
    
    <?php
    if (isset($_POST['under1500'])) {
    require_once('dbcon.php');
		$sql = 'SELECT idRestaurants, name, description, price, date, imageurl FROM restaurants WHERE price<1500';
		$stmt = $link->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($resid, $name, $description, $price, $date, $imageurl);
        $dirname = "img/";
        $images = glob($dirname."*.jpg");
		while($stmt->fetch()){ 
            echo '<div style="border: 1px solid black; margin-right: auto; margin-left: auto; width: 340px; height: auto; padding: 20px; margin: 20px; float: left; background-color: white;">
                    <tr>
                    <td><img src="'.$imageurl.'" height="200" width="300"/><br /></td><br>
					<h3>'.$name.'</h3><br>
					<h5>'.$description.'</h5><br>
                    <td>Price:</td>
					<h4>'.$price.' dkk</h4><br>
                    <td>The offer ends:</td>
					<td>'. date('F d, Y', strtotime($date)) . '</td><br>
                    <br>
                    <button class="in" type="button">Reserve the table!</button><br><br>

				</tr></div>';
        }
    } ?>
    
    <?php
    if (isset($_POST['all'])) {
    require_once('dbcon.php');
		$sql = 'SELECT idRestaurants, name, description, price, date, imageurl FROM restaurants';
		$stmt = $link->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($resid, $name, $description, $price, $date, $imageurl);
        $dirname = "img/";
        $images = glob($dirname."*.jpg");
		while($stmt->fetch()){ 
            echo '<div style="border: 1px solid black; margin-right: auto; margin-left: auto; width: 340px; height: auto; padding: 20px; margin: 20px; float: left; background-color: white;">
                    <tr>
                    <td><img src="'.$imageurl.'" height="200" width="300"/><br /></td><br>
					<h3>'.$name.'</h3><br>
					<h5>'.$description.'</h5><br>
                    <td>Price:</td>
					<h4>'.$price.' dkk</h4><br>
                    <td>The offer ends:</td>
					<td>'. date('F d, Y', strtotime($date)) . '</td><br>
                    <br>
                    <button class="in" type="button">Reserve the table!</button><br><br>

				</tr></div>';
        }
    } ?>
    
    
    
</body>
</html>