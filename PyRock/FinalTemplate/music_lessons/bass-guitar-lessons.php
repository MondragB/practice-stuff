<?php include 'includes/header.php';?>

		<!-- ==============================================
		HEADER
		=============================================== -->

		<header id="home" class="jumbotron">
			<div class="container" style="background-image: url('../images/bass-guitar.jpg');width: 100%;height: 100%;">			
				<div class="message-box clearfix">
					<div class="row">
						<div class="col-md-7">
							<h1 class = "lessonsmaintitle" id="lessonsmaintitleh1">Bass Guitar <br>Lessons</h1>
							<h2 class = "lessonsmaintitle" id="lessonsmaintitleh2">The heart of Music</h2>
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
								<form class="freelessonform" form action="bass-guitar-lessons.php" method="post">
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
					<button type="button" class="btn ourprogramsbutton ourprogramsselector"><a href="../music_lessons/bass-guitar-lessons.php">Bass Guitar</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/guitar-lessons.php">Guitar</a></button>
					<button type="button" class="btn ourprogramsbutton"><a href="../music_lessons/singing-lessons.php">Singing</a></button>
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
		BASS GUITAR LESSONS FOR KIDS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Bass Guitar Lessons <br> For Kids</h1>
								<p class ="ourprograms">
									PY Rock has introduced a new bass lesson method <br>designed for kids who want to learn the bass guitar. Our<br> bass instructors evaluate the size of the kid's hand and <br>length of their fingers in order to find the right bass size for <br>their bass lessons. PY Rock bass lessons for kids are <br>designed to give the student an enjoyable experience<br> learning this awesome instrument.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/basskid.jpg" class="img-responsive ourprogramsimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->
		
		<!-- ==============================================
		BASS GUITAR LESSONS FOR TEENS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6 ourprogramsline">
						<!-- Placeholder for Buttons -->
							<img src="../images/bassteen.jpg" class="img-responsive ourprogramsimage">
						</div>							
						<div class="col-md-5">
							<div class="ourprogramscontainer">
								<h1 class="ourprograms">Bass Guitar Lessons <br> For Teens</h1>
								<p class ="ourprograms">
									PY Rock bass guitar lessons for teens focus on giving the<br> student the complete understanding of what the function of<br> the bass player in a band. Our bass guitar instructors know<br> that bass guitarists have the most crucial role in the band,<br> for that reason they structured the bass guitar lessons in a<br> way that gives importance on topics such as; linking<br> between harmony and rhythm and keeping a steady<br> rhythm.
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
		PIANO LESSONS FOR ADULTS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Bass Guitar Lessons <br> For Adults</h1>
								<p class ="ourprograms">
									Our approach to our guitar lessons for adults is different<br> from the kids and teens guitar lessons. We know that adults <br>faced other obstacles like busy schedules, work, and family<br> commitments. For that reason, our adult guitar instructors<br> have been trained to provide intense and effective guitar<br> lesson sessions designed for busy students. Py Rock guitar <br>instructors are professional, skilled, patient and friendly,<br> which are key points to have a great learning experience. 
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/bassadultv2.jpg" class="img-responsive ourprogramsimage">
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
		BASS GUITAR LESSONS FOR BEGINNERS SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6 ourprogramsline">
						<!-- Placeholder for Buttons -->
							<img src="../images/b1v2.jpg" class="img-responsive ourprogramsimage">
						</div>							
						<div class="col-md-5">
							<div class="ourprogramscontainer">
								<h1 class="ourprograms">Bass Guitar Lessons <br> For Beginner Students</h1>
								<p class ="ourprograms">
									We have a new approach to bass lessons. We first set the<br>  student on private bass lessons, and once they reach a <br> certain level, they can audition to be part of one of our rock <br> bands!. Not only the bass lessons are fun on their own, but<br>  they can positively influence the lives of the kids with all the<br>  benefits from taking music lessons; they help develop <br> discipline, teamwork, and self-confidence. Beginner bass <br> lessons cover topic such as; the role of the bass, holding<br>  the bass, fretting, breaking bad habits and more.
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
		BASS GUITAR LESSONS FOR INTERMEDIATE SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-1">
						</div>					
						<div class="col-md-5">
							<div class="ourprogramscontainer ourprogramsline">
								<h1 class="ourprograms">Bass Guitar Lessons <br> For Intermediate Students</h1>
								<p class ="ourprograms">
									After you have been taking bass lessons for a while, you<br> might find yourself no longer feeling the magic when you<br> pick up your bass guitar. Sounds that used to get you fired<br> up when playing with your bass intructor just aren't there<br> anymore. At this point, is time to go further into topics that<br> are more challenging for you. On our bass lessons for<br> intermediate players, students learn topics such as; keys in <br>music, circle of fifths, hammer-ons, pull-offs and more. We <br>also recommend the players to audition for one of our rock<br> band programs where they see a remarkable increase in <br>motivation.
									<br>
									<br>
									<button type="button" class="btn btn-secondary" style="width:200px;"><h2>Learn More..</h2></button>
								</p>
							</div>
						</div>
						<div class="col-md-6">
						<!-- Placeholder for Buttons -->
							<img src="../images/b2.jpg" class="img-responsive ourprogramsimage">
						</div>
					</div>						
				</div><!--End message-box -->				
			</div><!--End container -->			
		</section><!--End about section -->
		
		<!-- ==============================================
		BASS GUITAR LESSONS FOR ADVANCED SECTION
		=============================================== -->		
		<section id="about">
			<div class="container-ourlessons" ">
				<div class="" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6 ourprogramsline">
						<!-- Placeholder for Buttons -->
							<img src="../images/b3.jpg" class="img-responsive ourprogramsimage">
						</div>							
						<div class="col-md-5">
							<div class="ourprogramscontainer">
								<h1 class="ourprograms">Bass Guitar Lessons <br> For Advanced Students</h1>
								<p class ="ourprograms">
									Our advanced bass lessons instructors have a deep<br> understanding of techniques and equipment. Our bass<br> instructors share with student thoughts about equipment<br> set up for live shows, economy of motion for bass playing,<br> pinch harmonics and more. Tapping and moving around the<br> neck is also a topic on our bass lessons. Participating in<br> our rock programs at this level is highly recommended by<br> our bass instructors so they can apply all the theory they <br>learned in classes into a real live music context.
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