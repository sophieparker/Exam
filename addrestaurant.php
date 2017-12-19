<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Add restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Own stylesheet -->
    <link rel="stylesheet" href="stylesheet.css">
</head>
    
<body>  
    <div id="homepage"><a href="restaurants.php"><img id ="homepage" src="back1.png"    
alt="Back"/></a></div>
    <div class="nav">
      <div class="container">
        <ul class="pull-right">
          <li><a href="reviews.php">Tell us what you think</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    
    <?php
    if(!empty(filter_input(INPUT_POST, 'submit'))) {
	
	require_once('dbcon.php');
	
	$name = filter_input(INPUT_POST, 'name') 
		or die('Missing/illegal name parameter');
    $description = filter_input(INPUT_POST, 'description') 
		or die('Missing/illegal description parameter');
	$price = filter_input(INPUT_POST, 'price') 
		or die('Missing/illegal price parameter');
    $date = filter_input(INPUT_POST, 'date') 
		or die('Missing/illegal date parameter');
        
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
            }
        }
        
        if ($uploadOk){
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
    $sql = 'INSERT INTO restaurants (name, description, price, imageurl, date) VALUES (?,?,?,?,?)';
        $stmt = $link->prepare($sql);
        $stmt->bind_param('ssiss', $name, $description, $price, $target_file, $date);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            echo 'You offer is added to the website!';
        }
        else {
            echo 'Could not add the filedata to database';
        }
    }
    ?>
	


    <p>
    <form id="new" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Add restaurant</legend>
            <h5>Name of restaurant:</h5>
            <input class="in" name="name" type="text" placeholder="Name" required />
            <h5>What does the offer include?</h5>
            <input class="in" name="description" type="text" placeholder="Desription" required />
            <h5>Price (maximum 2500dkk): </h5>
            <input class="in" name="price" type="text" placeholder="Price in DKK" required />
            <h5>When does the offer end?</h5>
            <input class="in" name="date" id="date" type="date" required>
            <h5>Picture of the restaurant:</h5>
            <input class="in" type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="submit" value="Add restaurant" name="submit">
        </fieldset>
    </form>
    </p>


    </body>
    </html>
