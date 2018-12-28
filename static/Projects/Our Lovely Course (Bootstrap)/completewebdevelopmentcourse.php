<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Free Web Hosting</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<style>
    .contactForm{
        margin-top : 50px;
        border: 1px solid #8f73dd;
        border-radius: 15px;
    }
    h1{
        color: purple;
    }
    .btn{
        margin-bottom: 10px;   
    }
    
</style>
  </head>
<?php
    
?>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Get your free web hosting:</h1>
<?php
// Get user inputs
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$url = $_POST["url"];
//error messages
$missingFirstName = '<p><strong>Please enter your first name!</strong></p>';
$missingLastName = '<p><strong>Please enter your last name!</strong></p>';
$missingURL = '<p><strong>Please enter your Udemy Profile URL!</strong></p>';
$invalidURL = '<p><strong>Please enter a valid URL!</strong></p>';
 $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingMessage = '<p><strong>Please enter a message!</strong></p>';


if($_POST["submit"]){
//check for errors
if(!$firstname){
    $errors .= $missingFirstName;   
}else{
    $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);   
}
if(!$lastname){
    $errors .= $missingLastName;   
}else{
    $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);   
}
if(!$email){
    $errors .= $missingEmail; 
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
$errors .= $invalidEmail; 
}
}
    
if(!$url){
    $errors .= $missingURL; 
}else{
    $url = filter_var($_POST["url"], FILTER_SANITIZE_URL);
if(!filter_var($url,FILTER_VALIDATE_URL)){
$errors .= $invalidURL; 
}
}
                                
if($errors){
    //there is an error
    $resultMessage = '<div class=" alert alert-danger">' . $errors . '</div>';
}else{
    //there is no error
    $message = "
    <p>Hi " . $firstname . ", </p>
    <p>Following is your coupon code to get your free 4 months Unlimited Web Hosting: CWDCStudent </p>
    <p>Please make sure you use your coupon within 48 hours.</p>
    <p>Kind regards</p>
    <p>Development Island</p>";
    $headers = 'From: Development Island Ltd \r\n';
    $headers .= 'Content-type: text/html;';
    if(mail($email, "Your Free Unlimited Web Hosting", $message, $headers)){
        $resultMessage = '<div class=" alert alert-success">Thanks for your message. We will get back to you as soon as possible!</div>'; 
        header("Location: success.php");
    }else{
        $resultMessage = '<div class=" alert alert-warning">Unable to Send email. Please try again later.</div>';       
    }
}
echo $resultMessage;
}
?>
<!--
            The action attribute references a PHP file "process_form.php" that receives the data entered into the form when user submit it by pressing the submit button.
The method attribute tells the browser to send the form data through POST method.
In real world you cannot trust the user inputs; you must implement some sort of validation to filter the user inputs before using them. In the next chapter you will learn how sanitize and validate this contact form data and send it through the email using PHP.
-->
            <form action="completewebdevelopmentcourse.php" method="post">
                <div class="form-group">
                    <label for="name" class="sr-only">First Name: </label>    
                    <input type="text" id="firstname" placeholder="First Name"  class="form-control" name="firstname" value="<?php echo $_POST["firstname"]; ?>">
                </div>
                <div class="form-group">
                    <label for="lastname" class="sr-only">Last Name: </label>    
                    <input type="text" id="lastname" placeholder="Last Name"  class="form-control" name="lastname" value="<?php echo $_POST["lastname"]; ?>">
                </div>
                <div class="form-group">
                    <label for="url" class="sr-only">Udemy Profile URL: </label>    
                    <input type="text" id="url" placeholder="Udemy Profile URL"  class="form-control" name="url" value="<?php echo $_POST["url"]; ?>">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?php echo $_POST["email"]; ?>">
                </div>


                <input type="submit" name="submit" class="btn btn-success btn-lg" value="Get my Coupon">
            </form>
        </div>
    </div>
</div>
<?php

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_flush(); ?>