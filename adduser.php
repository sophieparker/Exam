<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create a user</title>
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
        if(!empty(filter_input(INPUT_POST, 'submit'))) {

            require_once('dbcon.php');

            $un = filter_input(INPUT_POST, 'un') 
                or die('Missing/illegal name parameter');
            $pw = filter_input(INPUT_POST, 'pw') 
                or die('Missing/illegal password parameter');

            //Hash and salt the password
            $pw = password_hash($pw, PASSWORD_DEFAULT); 

            //Add the username and password to the db.
            $sql = 'INSERT INTO Users (username, pwhash) VALUES (?,?)';
            $stmt = $link->prepare($sql);
            $stmt->bind_param('ss', $un, $pw);
            $stmt->execute();

            //Checks if the statement is successful and returns either a confirmation of that fact or an error message. 
            if ($stmt->affected_rows >0){
                echo "<script> window.location.assign('login.php'); </script>";
                echo 'User: '.$un.' is added! Welcome.';
            }
            else {
                echo 'Error adding user '.$un.'. Does it already exist? If not, please try again.';
            }
        }
    ?>
    
    <?php
    include('menu.php')
    ?>
    <p class="forms">
    <form id="adduserform" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
            <legend>Add new user</legend>
            <input id="un" name="un" type="text" placeholder="Username" required />
            <input id="pw" name="pw" type="password" placeholder="Password"  required/>
            <input id="loginbtn" type="submit" name="submit" value="Create user" />
        </fieldset>
    </form>
    </p>
    <img id="eatwell" src="eatwell.png">



</body>
</html>