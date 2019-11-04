<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('../images/drum-lessons.jpg');width: 100%;height: 100%;">			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h1 class = "lessonsmaintitle" id="lessonsmaintitleh1">Break<br>Camps</h1>
							<h2 class = "lessonsmaintitle" id="lessonsmaintitleh2">Go Beyond the Classroom</h2>
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
        $mail->Body    = "We have Recieved your Request. We will Respond within 1-2 Business Days. For your records a copy of your request is attached below.\nLocation: $location\nLesson: $lesson\nStudent Name: $studentName\nStudent Age: $age\nMessage: $message";
        $mail->send();
    }
}

?>

							<!-- Test Form-->
							<div>						
								<form class="freelessonform" form action="break-camps.php" method="post">
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
		SECTION DIVIDER - TITLE
		=============================================== -->		
		<div class="sectiondivider">
			<div class="row">
				<div class="col-md-12 ourprogramsinstruments">
					<p>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_programs/rock-bands.php">Rock Bands</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_programs/pre-rock-bands.php">Pre-Rock Bands</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_programs/group-lessons.php">Group Lessons</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_programs/private-lessons.php">Private Lessons</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_programs/house-bands.php">House Bands</a></button>
					<button type="button" class="btn ourprogramsbutton ourprogramsselector"><a href="../music_programs/break-camps.php">Break Camps</a></button>				
					</p>
				</div>
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h1 class="ourprogramssectiontitle"> All Levels, All Ages </h1>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>
	
		<!-- ==============================================
		BREAK SECTION ONE
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Learn Outside<br>The Classroom</h1>
								<p class ="ourprograms">
									In addition to our normal programs, we also offer special programs<br>
									during normal school breaks of spring, summer, and winter.<br>
									Not only do these meetings focus on learning music, they also learn to<br> 
									compose and record music, in addition to learning about music history from<br>
									our teachers!
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Sign Up Today!</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-kids.jpg" class="img-responsive ourprogramsimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->
		
		<!-- ==============================================
		BREAK SECTION TWO
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Play<br>Everyday</h1>
								<p class ="ourprograms">
									Our break camps get together everyday of our student's breaks, and<br>
									these sessions are typically the full day and very intense. However, this<br>
									program has been known to have students go from complete beginners to performing<br> 
									in as short as a week in the past. Who knows what you can achieve as well!
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Sign Up Today!</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-kids.jpg" class="img-responsive ourprogramsimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->


		
<?php include 'includes/footer.php' ?>