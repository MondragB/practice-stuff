<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('../images/drum-lessons.jpg');width: 100%;height: 100%;">			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h1 class = "lessonsmaintitle" id="lessonsmaintitleh1">Drum <br>Lessons</h1>
							<h2 class = "lessonsmaintitle" id="lessonsmaintitleh2">Blasting Fire</h2>
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
								<form class="freelessonform" form action="drum-lessons.php" method="post">
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
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/piano-lessons.php">Piano</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/bass-guitar-lessons.php">Bass Guitar</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/guitar-lessons.php">Guitar</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/singing-lessons.php">Singing</a></button>
					<button type="button" class="btn ourprogramsbutton ourprogramsselector"><a href="../music_lessons/drum-lessons.php">Drums</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/ukulele-lessons.php">Ukulele</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/violin-lessons.php">Violin</a></button>					
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
		DRUM LESSONS FOR KIDS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Drum Lessons <br> For Kids</h1>
								<p class ="ourprograms">
									We've developed a well-thought-out drum lesson plan for<br> kids that focus on motivating the kids to learn and practice. <br>Our expert drum instructors make the students walk away <br>from the lesson energized, feeling good and looking <br>forward to more drum lessons!. Based on the kid's level, PY <br>Rock's drum program include private lessons and live <br>performance programs.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
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
		DRUM LESSONS FOR TEENS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6 ourprogramsline">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-teens.jpg" class="img-responsive ourprogramsimage">
						</div>							
						<div class="col-md-5">
							<div class="ourprogramscontainer">
								<h1 class="ourprograms">Drum Lessons <br> For Teens</h1>
								<p class ="ourprograms">
									Students who enroll in our drum lessons enjoy a fresh<br> approach to drumming. Every program for teens includes <br>private lessons and band rehearsals. Our drum instructors <br>focus on every detail from gripping the sticks properly to<br> learning the essential rudiments. Our drum lessons<br> designed for kids also focuses on providing a solid<br> foundation for successful drumming skills.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
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
		DRUM LESSONS FOR ADULTS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Drum Lessons <br> For Adults</h1>
								<p class ="ourprograms">
									It's never too late to learn drums!. PY Rock drum lessons <br>designed for adults will take you through a song-oriented<br> approach to drumming, where you will play your favorite<br> song right from the first day. Most of our drum instructors <br>are multi-instrumentalists, and many have toured the world <br>playing music, this makes every session filled with<br> experience sharing and motivation for the adult students.<br> Based on the student's level, every program includes<br> private drum lessons and band rehearsals. 
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-adults.jpg" class="img-responsive ourprogramsimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->

<!-- ==============================================
		SECTION DIVIDER - TITLE
		=============================================== -->		
		<div class="sectiondivider">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<h1 class="ourprogramssectiontitle"> All Levels</h1>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>
	<!-- ==============================================
		ALL LEVELS
		DRUM LESSONS FOR BEGINNERS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6 ourprogramsline">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-teens.jpg" class="img-responsive ourprogramsimage">
						</div>							
						<div class="col-md-5">
							<div class="ourprogramscontainer">
								<h1 class="ourprograms">Drum Lessons <br> For Beginner Students</h1>
								<p class ="ourprograms">
									We have a fresh approach to drum lessons. We have a<br> comprehensive step-by-step drum lessons curriculum that <br>provides drummers a solid foundation of independence,<br> technique and music theory. Our highly trained drum<br> instructors work first on holding the drumstick correctly, <br>choosing the right ones, and heels-up and heels-down<br> methods.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
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
		DRUM LESSONS FOR INTERMEDIATE SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Drum Lessons <br> For Intermediate Students</h1>
								<p class ="ourprograms">
									If you don't feel the beginner drum lessons are for you <br>cause you've been playing drums for a while and you want<br> to get better, then our intermediate drum lessons is for you.<br> Drum instructors go deeper into techniques, independence,<br> reading rhythmic notation and playing fills. We highly<br> recommend paring the private drum lessons with a rock<br> band program to experience the stage and apply all <br>knowledge into real music contexts.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-adults.jpg" class="img-responsive ourprogramsimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->
		
		<!-- ==============================================
		DRUM LESSONS FOR ADVANCED SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6 ourprogramsline">
						<!-- Placeholder for Buttons -->
							<img src="../images/piano-teens.jpg" class="img-responsive ourprogramsimage">
						</div>							
						<div class="col-md-5">
							<div class="ourprogramscontainer">
								<h1 class="ourprograms">Drum Lessons <br> For Advanced Students</h1>
								<p class ="ourprograms">
									Our drum instructors assume the students already<br> mastered reading basis rhythmic notation including quarter<br> notes, eighth notes, triplets and sixteenth notes. Though<br> drum lessons focused on mastering time and groove using <br>metronomes and advance coordination, the students <br>experience higher levels of playing and performing. Paring <br>this drum lessons with a season rock program is the best<br> option for an advance drum player.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
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