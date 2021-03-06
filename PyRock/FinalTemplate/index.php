<?php include './includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
		
			<div class="container" style="background-image: url('images/pyrockmainimage.jpg');width: 100%;height: 100%; background-size:cover;">
			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-6">
							<div class="right-col flexslider home-slider" style="z-index:1;">					
							<ul class="slides">
								<li>
									<h2 class="titleleftalign">Music School</h2>
									<h1 class="titleleftalign">Specialized in taking students</h1>
									<h2 class="titleleftalign">From classrooms to stages</h2>
								</li>					
								
								<li>
									<h2 class="titleleftalign">Talented Instructors</h2>
									<h1 class="titleleftalign">Goal Oriented Lessons</h1>
									<h2 class="titleleftalign">Great Environment</h2>
								</li>
								
								<li>
									<h2 class="titleleftalign">Take a Tour</h2>
									<h1 class="titleleftalign">Meet the Music Instructors</h1>
									<h2 class="titleleftalign">See if you got the talent</h2>
								</li>
								
							</ul>
							</div><!--End home-slider -->
						</div>
					<div class="col-md-5">
						<!-- Test Form-->
						<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once('mysqli_connect.php');

if(isset($_POST['submit'])) {
    
    $phonenumber = filter_var($_POST['phonenumber'], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST['studentAge'], FILTER_SANITIZE_STRING);
    $studentName = filter_var($_POST['studentName'], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
    $lesson = filter_var($_POST['lesson'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO Customers (studentName, studentAge, Name, Email, phoneNumber, Location, Lesson, Message) VALUES ('$studentName', '$age','$name','$email','$phonenumber','$location',' $lesson','$message')";
    $result = mysqli_query($dbc, $sql) or die(mysqli_error($dbc));

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.letsrockathome.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'contactus@letsrockathome.com';                 // SMTP username
        $mail->Password = 'kean123';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom("$email", strval($name));
        $mail->addAddress('contactus@letsrockathome.com', 'PyRock');     // Add a recipient
       

        // $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Message From Customer';
        $mail->Body    = "Location: $location\nLesson: $lesson\nFrom: $name\nStudent Name: $studentName\nStudent Age: $age\nEmail: $email\nPhone Number: $phonenumber\nMessage: $message\n";
        $mail->send();
        echo 'Message has been sent';
        $send = TRUE;

    } 
    
    catch (Exception $e) {
        $send = FALSE;
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    } 

    if($send)
    {
        $mail = new PHPMailer();
        $mail->Subject = 'Message From Py Rock';
        $mail->setFrom('contactus@letsrockathome.com', 'PyRock');
        $mail->addAddress(strval($email), strval($name));
        $mail->Body    = "We have Recieved your Request. We will Respond within 1-2 Business Days. For your records a copy of your request is attached below.\nLocation: $location\nLesson: $lesson\nStudent Name: $studentName\nStudent Age: $age\nMessage: $message";
        $mail->send();
    }
}

?>

						<div>						
							<form class="freelessonform" form action="index.php" method="post">
								<h2 class="freelessonformtitle">Schedule a Free Trial</h2>
								<br>
								<input type="text" name="studentName" placeholder="Student Name:">
								<input type="text" name="studentAge" placeholder="Student Age:">
								<input type="text" name="firstname" placeholder="Your Name:">
								<input type="email" name="email" placeholder="Email:">
								<input type="tel" name="phonenumber" placeholder="Phone Number:">
								<select name="location" required="" id="selecttextpadding">
									<option value="" disabled="" selected="">Select Location</option>
									<option value="Elizabeth" class="placeholderform">Elizabeth</option>
									<option value="West New York" class="placeholderform">West New York</option>
								</select>
								<select name="lesson" required="" id="selecttextpadding">
									<option value="" disabled="" selected="">Select Lesson</option>
									<option value="Bass" class="placeholderform">Bass</option>
									<option value="Drum" class="placeholderform">Drum</option>
									<option value="Guitar" class="placeholderform">Guitar</option>
									<option value="Singing" class="placeholderform">Singing</option>
									<option value="Piano" class="placeholderform">Piano</option>
									<option value="Ukulele" class="placeholderform">Ukulele</option>
									<option value="Violin" class="placeholderform">Violin</option>
								</select>
								<br>
								<button type="submit" name="submit" class="btn btn-primary buttonfreelesson">Send Message</button>
							</form>
						</div>
					</div>
				</div>
					
					
					
				</div><!--End message-box -->
				
			</div><!--End container -->
			
		</header><!--End header -->
	
		<!-- ==============================================
		OUR LESSONS SECTION
		=============================================== -->		
		<section id="about">
		<div class="container" style="background-image: url('images/ourlessons.jpg');width: 100%;height: 1000px;">
			
			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-5">
						<!-- Placeholder for Buttons -->
							<div>					
							<button type="button" class="btn btn-secondary" style="width:200px;"><a href="#"><h2>Something Here</h2></a></button>

							</div>
						</div>
						<div class="col-md-7">
							<div class="right-col flexslider home-slider" style="z-index:1;">					
								<ul class="slides">
									<li>
										<h2>Music School</h2>
										<h1>Specialized in taking students</h1>
										<h2>From classrooms to stages</h2>
									</li>					
									
									<li>
										<h2>Talented Instructors</h2>
										<h1>Goal Oriented Lessons</h1>
										<h2>Great Environment</h2>
									</li>
									
									<li>
										<h2>Take a Tour</h2>
										<h1>Meet the Music Instructors</h1>
										<h2>See if you got the talent</h2>
									</li>
									
								</ul>
							</div><!--End home-slider -->
						</div>
					</div>	
					
				</div><!--End message-box -->
				
			</div><!--End container -->
			
		</section><!--End about section -->
	
		<!-- ==============================================
		OUR PROGRAMS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container" style="background-image: url('images/ourprograms.jpg');width: 100%;height: 1000px;">
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h2>Music School</h2>
							<h1>Specialized in taking students</h1>
							<h2>From classrooms to stages</h2>
						</div><!--End home-slider -->
						<div class="col-md-5">
						<!-- Placeholder for Buttons -->
							<div>					
								<h2>Placeholder for Buttons</h2>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div><!--End container -->
		</section><!--End about section -->	
	
	
		<div id="page-wrapper"> 


				<!-- Banner3 -->
				<section id="banner2">
					<header>
						<h2><strong>Reviews</strong></h2>
					</header>
				</section>

				<!-- Reviews -->
				<div class="wrapper style1">
					<div class="container special">
						<section style="color:black;"> 
							
							<script type="text/javascript">
								var review_token = '91TdOnJCdjXF8HST09IOX97EY9Ozztk0WZ6hKtNyQpRNIhjFO1';
								var review_target = 'review-container'; 
							</script>	
							<script src="https://reviewsonmywebsite.com/js/embed.js?v=3" type="text/javascript"></script>
							<div id="review-container"></div>
							<hr />
						</section>
					</div>
				</div>

<?php include './includes/footer.php' ?>