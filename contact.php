
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

<?php

if(isset($_POST['submit'])){
    
    $email = "From:" . $_POST['email'];
    $msg = $_POST['body'];
    $subject = $_POST['subject'];
    mail('ryanvano@gmail.com', $subject, $msg, $email);
    echo "<div class='alert alert-success text-center' role='alert'>Your Message Has Been Sent</div>";



}







?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email Address">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                         
                         <div class="form-group">
                            <label for="body" class="sr-only">Message</label>
                            <textarea class="form-control" rows="10" name="body" id="body" placeholder="Enter your message"> </textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
