<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('../images/our-programs.jpg');width: 100%;height: 100%;">			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h2>Music School</h2>
							<h1>Specialized in Taking Students</h1>
							<h2>From Classrooms to Stages</h2>
						</div>
						<div class="col-md-5">
					
					<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require_once('../mysqli_connect.php');

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

							<!-- Test Form-->
							<div>						
								<form class="freelessonform" form action="overview.php" method="post">
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
		PRE-ROCK BAND SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/pre-rock-band.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Pre-Rock Band</h1>
								<p class ="ourlessonsoverview">
									<em>This is a program designed for students that want to be on stage but they<br>
									are not just ready yet.</em> They meet once a week for 60 minutes and they <br>
									work as a band toward low-preasure performances in the class in <br>
									front of a supportive audience. After they complete this program <br>
									they then graduate to the Rock Band Program.<br>
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_programs/pre-rock-bands.php"><h2>Learn More..</h2></a></button>
								</p>

							</div>

						</div>
						<div class="col-md-1">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->
		
		<!-- ==============================================
		ROCK BAND SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/pre-rock-band.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Rock Band</h1>
								<p class ="ourlessonsoverview">
									After an audtion, the students get to be a member of one of our rock bands that<br>
									work towards live performances. Our professional band coaches work closely with <br>
									students and direct and train the bands. Band members meet every week for a 90<br>
									minute rehearsal where they work on every part of the song that will be <br>
									performed on stage. Our goal in this program is to prepare the students for the live<br>
									performance. Performances take place at local music venues in front of real audiences!
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_programs/rock-bands.php"><h2>Learn More..</h2></a></button>
								</p>

							</div>

						</div>
						<div class="col-md-1">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->

		<!-- ==============================================
		GROUP LESSON SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/pre-rock-band.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Group Lessons</h1>
								<p class ="ourlessonsoverview">
									One of the main benefits of taking group lessons is the opportunity to develop<br>
									social, personal, and technical abilities that are not possible to learn in a private music<br>
									lesson. The duration of the group lesson sessions is typically longer than other programs. They<br>
									meet once a week on the same day, time, and with the same teacher. Our students reported<br>
									that in a group setting they learn from their classmate's experiences, what worked<br>
									and did not work for them, as well as tips, tricks, and techniques shared by them.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_programs/group-lessons.php"><h2>Learn More..</h2></a></button>
								</p>

							</div>

						</div>
						<div class="col-md-1">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->

		<!-- ==============================================
		PRIVATE LESSON SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/pre-rock-band.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Private Lessons</h1>
								<p class ="ourlessonsoverview">
									Private Lessons are ideal for beginners who have no prior experience with any<br>
									instrument. It is important for the students to take private music lessons at this<br>
									phase because they will be developing the fundamental habits of a good<br>
									musician. Private lessons are shorter than group music lessons due to the<br>
									intensity of the sessions.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_programs/private-lessons.php"><h2>Learn More..</h2></a></button>
								</p>

							</div>

						</div>
						<div class="col-md-1">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->	

		<!-- ==============================================
		HOUSE BAND SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/pre-rock-band.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">House Bands</h1>
								<p class ="ourlessonsoverview">
									Students that complete the Pre-Rock Band and Rock Band Programs have the<br>
									opportunity to audition to be part of the school house band! The house band<br>
									program is an intense performing program that involves touring around different<br>
									cities and music venues to perform in from of live audiences!
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_programs/house-bands.php"><h2>Learn More..</h2></a></button>
								</p>

							</div>

						</div>
						<div class="col-md-1">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->		
		
		<!-- ==============================================
		BREAK CAMP SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/pre-rock-band.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Break Camps</h1>
								<p class ="ourlessonsoverview">
									Every spring, summer, and winter break, students get together every day (full day<br>
									and half day options) to work on composing, recording, performing, history of music, and<br>
									much more. They even get to design their own band's shirts! Camps are intensive programs<br>
									where students can go from not knowing anything about music to performing on<br>
									stage in only a week! Our highly trained instructors use various tools and techniques<br>
									in order to make this happen.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_programs/break-camps.php"><h2>Learn More..</h2></a></button>
								</p>

							</div>

						</div>
						<div class="col-md-1">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->					
		
<?php include 'includes/footer.php' ?>