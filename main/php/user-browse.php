<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$search = $search_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new search
    if(empty(trim($_POST["search"]))){
        $search_err = "Please enter ISBN, title, or author name.";     
    }
    else{
        $myvalue = trim($_POST["search"]);
        $arr = explode(' ',trim($myvalue));
        $search = $arr[0];
    }

        
    // Check input errors
    if(empty($search_err)){
        if (($search == "Ted") || ($search == "Hagos")|| ($search == "9781484259368")|| ($search == "Learn")|| ($search == "Android")|| ($search == "Studio")|| ($search == "4")){
            header("location: book-1-result.php");
            exit();
        }
        else if (($search == "Jennifer")|| ($search == "Robbins")|| ($search == "Learning")|| ($search == "Web")|| ($search == "Design")|| ($search == "9781491960202")){
            header("location: book-2-result.php");
            exit();
        }
        else if (($search == "Alan")|| ($search == "Thorn")|| ($search == "Mastering")|| ($search == "Unity")|| ($search == "Scripting")|| ($search == "9781784390655")) {
            header("location: book-3-result.php");
            exit();
        }
        else if (($search == "Marcos")|| ($search == "Romero")|| ($search == "Blueprints")|| ($search == "Visual")|| ($search == "for")|| ($search == "Unreal")|| ($search == "Engine")|| ($search == "9781789347067")){
            header("location: book-4-result.php");
            exit();
        }
        else if (($search == "Cornelia")|| ($search == "Davis")|| ($search == "Cloud")|| ($search == "Native")|| ($search == "Patterns")|| ($search == "9781617294297")){
            header("location: book-5-result.php");
            exit();
        }
        else {
            echo "Oops! we did not find anything that matches your search.";
        }

    }
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to CSCI 4050 Online Bookstore</h1>
    </div>
    <p>
        <a href="user-browse.php" class="btn btn-warning">Browse Books</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="reset-info.php" class="btn btn-warning">Reset Your Info</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($search_err)) ? 'has-error' : ''; ?>">
                <label>Search by a book by ISBN, title, or author name</label>
                <input type="text" name="search" class="form-control" value="<?php echo $search; ?>">
                <span class="help-block"><?php echo $search_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form> 

    <p>Here are all the available books.</p>

    <p><a href="book-1.php"><img src="img\book-1.jpg" width="300" height="500"></a><b> Learn Android Studio 4</b></p>

    <p><a href="book-2.php"><img src="img\book-2.jpg" width="300" height="500"></a><b> Learning Web Design</b></p>

    <p><a href="book-3.php"><img src="img\book-3.jpg" width="300" height="500"></a><b> Mastering Unity Scripting</b></p>

    <p><a href="book-4.php"><img src="img\book-4.jpg" width="300" height="500"></a><b> Blueprints Visual Scripting for Unreal Engine</b></p>

    <p><a href="book-5.php"><img src="img\book-5.jpg" width="300" height="500"></a><b> Cloud Native Patterns</b></p>

</body>
</html>