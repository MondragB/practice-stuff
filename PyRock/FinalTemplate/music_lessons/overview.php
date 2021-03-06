<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('../images/ourlessonsoverview.jpg');width: 100%;height: 100%;">			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h2>Music School</h2>
							<h1>Specialized in taking students</h1>
							<h2>From classrooms to stages</h2>
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
					</div><!--End message-box -->
				</div><!--End container -->
			</div>
		</header><!--End header -->
	
		<!-- ==============================================
		GUITAR LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/guitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Guitar Lessons</h1>
								<p class ="ourlessonsoverview">
									Learning to play guitar requires discipline, consistency, and a well-structured <br>
									guitar lessons plan. PY Rock music lessons include <em>30-60 minutes</em> <br>
									sessions, in either a private or group setting. Daily practice is essential <br>
									to retain muscle memory and our guitar instructors know it.<br>
									<em>That is the reason they use top hit songs to motivate students to practice<br>
									at home.</em> Additionally, once they reach a ceratain level, they get to be in a <br>
									<em>rock band</em>, where the real learning and fun begins!
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/guitar-lessons.php"><h2>Learn More..</h2></a></button>
								</p>
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
		BASS GUITAR LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverviewleft">Bass Guitar Lessons</h1>
								<p class ="ourlessonsoverviewleft">
									Bass guitar playing requires a good amount of strength, flexibility, <br>
									and precision in the hands that nobody posseses initially. PY Rock <br>
									instructors always remind students of bad habits and <br>
									<em> encourage them to practice appropriately </em> so that they can develop <br>
									the strength and flexibility needed to truly play the bass guitar beautifully.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/bass-guitar-lessons.php"><h2>Learn More..</h2></a></
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<img src="../images/bassguitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->

		<!-- ==============================================
		SINGING LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/guitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Singing Lessons</h1>
								<p class ="ourlessonsoverview">
									Private singing lessons combined with our performance programs is the best <br> way to develop a great voice. Our vocal instructors first take an <em>evaluation <br> of the student's voice  </em >  to know what they should be working on. They know <br> the path is not the same for everyone. <em>Our priority in our singing lessons is to develop good habits when doing vocal exercises.</em> We think that a single lesson with the right vocal teacher can change the course of the student career.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/singing-lessons.php"><h2>Learn More..</h2></a></button>
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
		PIANO LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverviewleft">Piano Lessons</h1>
								<p class ="ourlessonsoverviewleft">
									PY Rock curriculum is specially designed to take complete beginners <br> to an intermediate level <em> faster than any other piano lesson method. </em><br> Our piano lessons are suitable for <em> kids, teens, and adults.</em><br> Students can expect to have weekly private or group piano lessons,<br> as well as band rehearsals.
									<br>
									<br>
										<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/piano-lessons.php"><h2>Learn More..</h2></a></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<img src="../images/bassguitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->		

		<!-- ==============================================
		DRUM LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/guitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Drum Lessons</h1>
								<p class ="ourlessonsoverview">
									The drum is an instrument you can learn relatively quickly if your goal is to <br> play for fun as part of a hobby or stress relief. On the other hand,<em> if your<br> goal is to archive complete mastery, you need the help of well-structured drum lessons. </em> 
									At PY Rock, our drum instructors quickly identify the amount the <br> beginner drummers that have the potential to be in a band.<em> Our drum <br> lessons are strongly related to live performances </em> to keep the student <br> motivated and engaged in their drum lessons.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/drum-lessons.php"><h2>Learn More..</h2></a></button>
								</p>
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
		VIOLIN LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverviewleft">Violin Lessons</h1>
								<p class ="ourlessonsoverviewleft">
									Beautiful when performed solo, captivating when paired with other <br>
									instruments, <em> the violin is a very popular stringed instrument for students of all ages and levels.</em>
									Our teachers ensure all students receive <em> well-rounded <br>
									and engaging instruction on the violin </em> to prepare them to perform in many of our multiple shows and really understand its beauty.	
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/violin-lessons.php"><h2>Learn More..</h2></a></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<img src="../images/bassguitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->			

		<!-- ==============================================
		UKULELE LESSONS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/guitarlessons1.jpg" class="img-responsive ourlessonsoverviewimage">
						</div>
						<div class="col-md-5">
							<div class="ourlessonscontainer">
								<h1 class="ourlessonsoverview">Ukulele Lessons</h1>
								<p class ="ourlessonsoverview">
									Whether you're picking up your ukulele for the very first time or are ready <br> to step up your game with new songs and improved techniques,<em> PY Rock <br> ukulele lessons can help you get to the next level.</em> The better you play, <br> the more you're going to enjoy playing, and the more fun you'll <br> have when you get together with other musicians. <em> Ready for the next step? </em>
									<br>
									<br>
								<button type="button" class="btn btn-secondary" style="width:200px;"><a href="../music_lessons/ukulele-lessons.php"><h2>Learn More..</h2></a></button>
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