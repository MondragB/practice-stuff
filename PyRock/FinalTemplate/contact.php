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
        $mail->Body    = "We have Recieved your Request. We will Respond within 1-2 Business Days. For your records a copy of your request is attached below.\nLocation: $location\nLesson: $lesson\nFrom: $name\nStudent Name: $studentName\nStudent Age: $age\nMessage: $message";
        $mail->send();
    }
}

?>

<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('./images/contact.jpg');width: 100%;height: 100%;">			
				<div class="clearfix" id="maindivmargin" style="padding-top:300px;">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-5">
							<h1 class="titleleftalign">Contact Us</h1>
							<h2 class="titleleftalign">Do you have a question for us?</h2>
							<p class="titleleftalign">
								<a href="https://www.facebook.com/pyrockmusicschool">
								<img src="./images/facebook-social.png" class="socialmediacontact">
								</a>
								<a href="https://www.instagram.com/pyrockmusicschool">
								<img src="./images/instagram-social.png" class="socialmediacontact">
								</a>	
								<a href="https://www.youtube.com/channel/UCpjtNbwC_S18jGT8OuLrgbA">
								<img src="./images/youtube-social.png" class="socialmediacontact"> <br><br>
								</a>
								<a href="#about" ><button type="button" class="btn btn-secondary" style="width:200px;"><h2>Our Locations</h2></button></a><br><br>
								<a href="#faq"><button type="button" class="btn btn-secondary" style="width:200px;"><h2>FAQ</h2></button></a>
								<a href="#event"><button type="button" class="btn btn-secondary" style="width:200px;"><h2>Local Events</h2></button></a>
							</p>
						</div>
						<div class="col-md-5">
							<!-- Test Form-->
							<div>						
								<form class="freelessonform" form action="contact.php" method="post">
									<h2 class="freelessonformtitle">Send us a Message!</h2>
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
									<input type="text"  name="message" required placeholder="Message">
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
		SECTION DIVIDER - TITLE
		=============================================== -->		
		<div class="sectiondivider">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h1 class="contactsectiontitle"> Multiple Locations </h1>
					<p class="ourprograms">P.Y. Rock is commited to expanding our locations so that <em>everyone</em> 
					can find themselves participating in our programs locally.</p>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>	
	
	
		<!-- ==============================================
		LOCATIONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-5">
							<div class="contactcontainer">
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-8">
										<h1 class="ourprograms">Elizabeth Location!</h1>
										<p class ="ourprograms">
											Our location in Elizabeth NJ is in the heart of a very diverse community. Walking distance
											away from major highways and a NJ Transit train station, making your commute simpler. We like
											to host nearby events, so that our bands have the opportunity to perform for the community, 
											at the many different venues and festivals. 
										</p>
									</div>
									<div class="col-md-2">
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-4 contacthours">
										<p class="contacthours">
											<b>Hours</b><br>
											<b>Mon:</b> 3:00 pm - 10:00 pm <br>
											<b>Tue:</b> 3:00 pm - 10:00 pm <br>								
											<b>Wed:</b> 3:00 pm - 10:00 pm <br>
											<b>Thu:</b> 3:00 pm - 10:00 pm <br>
											<b>Fri:</b> 3:00 pm - 10:00 pm <br>	
											<b>Sat:</b> 8:00 am - 6:00 pm <br>
											<b>Sun:</b> CLOSED <br>				
										</p>
									</div>
									<div class="col-md-4 locationdetails">
										<p class="locationdetails">
											 <b>TEL:</b> +1 908 469 7838 <br>
											 <b>310 Morris Ave #204<br>
											 Elizabeth, NJ 07208</b>	
										</p>
									</div>
									<div class="col-md-2">
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
										<div class="map-responsive" style="text-align: center;">
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3026.225081277138!2d-74.22030608509702!3d40.66900934818229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3b2aaacbd7f9f%3A0xb5f7e563cde921c6!2sPY+Rock+Music+School!5e0!3m2!1sen!2sus!4v1542434330571" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen>	
											</iframe>
										</div>
									</div>
									<div class="col-md-1">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="contactcontainer">
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-8">
										<h1 class="ourprograms">West New York Location!</h1>
										<p class ="ourprograms">
											P.Y. Rock is expanding to the vibrant city of West New York, NJ ! If you would like to become one of or new students at our school 
											please fill out the conact form so that we can get a rep in touch with you.    
										</p>
									</div>
									<div class="col-md-2">
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-4 contacthours">
										<p class="contacthours">
											<b>Hours</b><br>
											<b>Mon:</b> COMING SOON <br>
											<b>Tue:</b> COMING SOON <br>								
											<b>Wed:</b> COMING SOON <br>
											<b>Thu:</b> COMING SOON <br>
											<b>Fri:</b> COMING SOON <br>	
											<b>Sat:</b> COMING SOON <br>
											<b>Sun:</b> COMING SOON <br>				
										</p>
									</div>
									<div class="col-md-4 locationdetails">
										<p class="locationdetails">
											 <b>TEL:</b> +1 908 469 7838 <br>
											 <b>Coming Soon<br>
											 West New York, NJ </b>	
										</p>
									</div>
									<div class="col-md-2">
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
										<div class="map-responsive" style="text-align: center;">
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24167.470519294206!2d-74.02575799072936!3d40.78546917671724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258131938b8d5%3A0xe39c30a8afef2d96!2sWest+New+York%2C+NJ+07093!5e0!3m2!1sen!2sus!4v1542433645965" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen>
											</iframe>
										</div>
									</div>
									<div class="col-md-1">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-1">
						</div>
					</div>										
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->

		<!-- ==============================================
		FAQ SECTION
		=============================================== -->	
		
		<div id= "faq" class="row ourprogramscontainer">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
			<h1>Frequently Asked Questions</h1> 
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-5 contacthours faqsectionleft">
					<h3 class="contacthours"> <b> How long will it take for my kid to play?</b>
					</h3>
					<p class="contacthours">All kids have different learning capabilities, the amount of time required to learn an instrument varies from student to student. Basically, we always tell our students, "you will take out what you put in", in other words, if the student is dedicated he will learn fast, if not, it will take longer.
					</p>
				</div>
				<div class="col-md-5 locationdetails faqsectionright">
					<h3 class="locationdetails"> <b> How long will it take for my kid to play?</b></h3>
					<p class="locationdetails">All kids have different learning capabilities, the amount of time required to learn an instrument varies from student to student. Basically, we always tell our students, "you will take out what you put in", in other words, if the student is dedicated he will learn fast, if not, it will take longer.</p>
				</div>
				<div class="col-md-1">
				</div>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		</div>



		<!-- ==============================================
		Local Events SECTION
		=============================================== -->	
		
		<div id="event" class="row ourprogramscontainer">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
			<h1>Local Events</h1> 
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-5 contacthours faqsectionleft">
					<h3 class="contacthours"> <b> Spring Break Camp</b>
					</h3>
					<p class="contacthours">All kids have different learning capabilities, the amount of time required to learn an instrument varies from student to student. Basically, we always tell our students, "you will take out what you put in", in other words, if the student is dedicated he will learn fast, if not, it will take longer.
					</p>
				</div>



				<div class="col-md-5 locationdetails faqsectionright">
					<h3 class="locationdetails"> <b> Open Mic </b></h3>
					<p class="locationdetails">All kids have different learning capabilities, the amount of time required to learn an instrument varies from student to student. Basically, we always tell our students, "you will take out what you put in", in other words, if the student is dedicated he will learn fast, if not, it will take longer.</p>
				</div>


				<div class="col-md-5 locationdetails faqsectionright">
					<h3 class="locationdetails"> <b> Concerts </b></h3>
					<p class="locationdetails">All kids have different learning capabilities, the amount of time required to learn an instrument varies from student to student. Basically, we always tell our students, "you will take out what you put in", in other words, if the student is dedicated he will learn fast, if not, it will take longer.</p>
				</div>


				<div class="col-md-1">



				</div>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		</div>



		
<?php include 'includes/footer.php' ?>