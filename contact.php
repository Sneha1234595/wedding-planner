<?php

$conn = mysqli_connect('localhost','root','','wedding_db');

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $number = $_POST['number'];
   $plan = $_POST['plan'];
   $address = $_POST['address'];
   $message = $_POST['message'];

   $insert = "INSERT INTO `contact_form`(`name`, `email`, `number`, `plan`, `address`, `message`) VALUES ('$name','$email','$number','$plan','$address','$message')";

   mysqli_query($conn, $insert);

   header('location:contact.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

<?php @include 'header.php'; ?>

<section class="contact">

   <h1 class="heading">contact us</h1>

   <form action="" method="post">

      <div class="flex">

         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>

         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>

         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>

         <div class="inputBox">
            <span>choose plan</span>
            <select name="plan">
               <option value="basic">basic plan</option>
               <option value="premium">premium plan</option>
               <option value="ultimate">ultimate plan</option>
            </select>
         </div>

         <div class="inputBox">
            <span>your address</span>            
            <textarea name="address" placeholder="enter your address" required cols="30" rows="10"></textarea>
         </div>

         <div class="inputBox">
            <span>your message</span>            
            <textarea name="message" placeholder="enter your message" required cols="30" rows="10"></textarea>
         </div>

      </div>

      <input type="submit" value="send message" name="send" class="btn">

   </form>

</section>

<?php @include 'footer.php'; ?>

</div>

<div id="form-messages"></div>

(function($) {
2
    // Select the form and form message
3
    var form = $('#ajax-contact-form'),
4
        form_messages = $('#form-messages');
5
         
6
    // Action at on submit event
7
    $(form).on('submit', function(e) {
8
        e.preventDefault(); // Stop browser loading
9
         
10
        // Get form data
11
        var form_data = $(form).serialize();
12
         
13
        // Send Ajax Request
14
        var the_request = $.ajax({
15
            type: 'POST', // Request Type POST, GET, etc.
16
            url: "contact.php",
17
            data: form_data
18
        });
19
         
20
        // At success
21
        the_request.done(function(data){
22
            form_messages.text("Success: "+data);
23
             
24
            // Do other things at success
25
        });
26
         
27
        // At error
28
        the_request.done(function(){
29
            form_messages.text("Error: "+data);
30
             
31
            // Do other things at fails
32
        });
33
    });
34
})(jQuery);
Now finally we will create contact.php file for our ajax contact form php. Just add these php code.

view sourceprint?

<?php

// Proccess at only POST metheod


if ($_SERVER["send_message"] == "POST") {

    // name of sender

    $name = strip_tags(trim($_POST["name"]));
     

    // Email of sender

    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

     

    // Sender number
    $number = strip_tags(trim($_POST["number"]));


     // name of plan

    $plan = strip_tags(trim($_POST["plan"]));
     // sender adsress

     $address= strip_tags(trim($_POST["address"]));

    // Sender Message
    $message = trim($_POST["message"]);
     
    // Your email where this email will be sent

    $your_email = "example@example.com";
    //Your site name for identify

    $your_site_name = "Example";

     
    // Build email subject
    $email_subject = "[{$your_site_name}] New Message by {$name}";
     
    // Build Email Content
    $email_content = "Name: {$name}\n";

    $email_content .= "Email: {$email}\n";

    $email_content .= "number: {$number}\n";

    $email_content .= "plan: {$plan}\n";

    $email_content .= "address: {$address}\n";
    
    $email_content .= "Message: {$message}\n";
     
    // Build email headers

    $email_headers = "From: {$name} <{$email}>";

    // Send email

    $send_email = mail($your_email, $email_subject, $email_content, $email_headers);
     

    // Check email sent or not

    if($send_email){

        // Send a 200 response code.
        http_response_code(200);

        echo "Thank You! Your message has been sent.";
    } else {

        // Send a 500 response code.

        http_response_code(500);
        echo "Oops! we couldn't send your message. Please try again later";

    }

} else {

    // Send 403 response code

    http_response_code(403);
    echo "Oops! Submition problem. Please try again later";

}
?>
    














<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>