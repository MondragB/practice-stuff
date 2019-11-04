<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('../images/singing-lessons.jpg');width: 100%;height: 100%;">			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h1 class = "lessonsmaintitle" id="lessonsmaintitleh1">Singing <br>Lessons</h1>
							<h2 class = "lessonsmaintitle" id="lessonsmaintitleh2">Become the Next Star!</h2>
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
								<form class="freelessonform" form action="singing-lessons.php" method="post">
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
					<button type="button" class="btn ourprogramsbutton ourprogramsselector"><a href="../music_lessons/singing-lessons.php">Singing</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/drum-lessons.php">Drums</a></button>
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
		SINGING LESSONS FOR KIDS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Singing Lessons <br> For Kids</h1>
								<p class ="ourprograms">
									Our band based teaching method have changed the lives<br> of a lot of kids in our comunity. They get the full experience<br> of being a ROCK STAR: Confidence level raise, they feel <br>fulfilled and most importantly, they feel they are <br>unstopabble on anything they do in their lives.
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
		SINGING LESSONS FOR TEENS SECTION
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
								<h1 class="ourprograms">Singing Lessons <br> For Teens</h1>
								<p class ="ourprograms">
									We have a strong relationship with our students and parents,<br> this is a place where teachers become friends and mentor<br> and the school is a second home.
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
		SINGING LESSONS FOR ADULTS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Singing Lessons <br> For Adults</h1>
								<p class ="ourprograms">
									Students love coming to PY ROCK cause is a place where<br> they can get to be what they really wanna be. Musicians. 
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
		SINGING LESSONS FOR BEGINNERS SECTION
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
								<h1 class="ourprograms">Singing Lessons <br> For Beginner Students</h1>
								<p class ="ourprograms">
									On the first singing lesson at PY Rock, you will chat with <br>the teacher so they can understand what you like or dislike <br>about your voice, why you are taking vocal lessons and<br> what's the plan for the first month. Breathing exercises,<br> singing with power and resonance are main points you <br>should expect to work on in your first vocal lessons.
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
		SINGING LESSONS FOR INTERMEDIATE SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Singing Lessons <br> For Intermediate Students</h1>
								<p class ="ourprograms">
									To qualify for the intermediate singing lesson program,<br> students need to be comfortable singing in tune and in<br> time, use dynamics and have 2 octaves of full voice range<br> according to our vocal instructors. At this point, our singing<br> lessons focus on mastering falsetto, runs, vibrato and deliver <br>emotion in the performance. Paring private singing <br>lessons with some of our group-lesson based program is<br> highly recommended.
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
		SINGING LESSONS FOR ADVANCED SECTION
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
								<h1 class="ourprograms">Singing Lessons <br> For Advanced Students</h1>
								<p class ="ourprograms">
									Once the student graduated from our beginner and <br>intermediate vocal lessons they qualify to start our advance<br> vocal lessons where they work with their vocal instructor in <br>complex runs, big sustained high notes, high control of <br>vibrato and extreme control of dynamics. Our vocal <br>instructors reported that most of the singer that take this<br> program usually have difficulty getting through all songs in<br> a gig, find themselves losing their voice or tiring out after <br>just a few songs. Through our singing lessons program,<br> vocal instructors can help student reach level they did not <br>believe was possible.
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