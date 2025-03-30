
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
        <nav>
            <label class="logo">BRICKWOODS ACADEMY</label>
            <ul>
                <li><a href="about.html">ABOUT US</a></li>
                <li><a href="contact.html ">CONTACT US</a></li>
                 <li><a href="login.php" class="btn btn-success">LOGIN</a></li>
            </ul>
        </nav>
<div class="section1">
    <label class="img_text">EDUCATION PAR EXCELLENCE </label>
    <img class="main_img" src="brick 1.png">
    
</div> 
<div class="container">
    <div class="row">
        <div class="col-md-4">
                <img class="welcome_img" src="brick2.jpg">
                
            </div>
            <div class="col-md-8">
                <h1>Welcome to BRICKWOODS ACADEMY </h1>
                 <p> 
                 At Brickwood Academy, we believe in nurturing the minds of tomorrow through innovative education and a supportive learning environment. We offer a well-rounded curriculum that emphasizes not only academic excellence but also personal growth, creativity, and critical thinking skills.</p>
        </div>
    </div>
    
</div>
    <h1> Our Exceptional Teachers</h1>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img class=" teacher"src="brick7.jpg">
        </div>
        <div class="col-md-8">
            <p>
                At Brickwood Academy, our teachers are the cornerstone of our educational philosophy. They are dedicated professionals who are passionate about fostering a love for learning and empowering students to reach their full potential.
                Our teachers actively participate in school events, extracurricular activities, and community service projects. They encourage students to engage with the community, fostering a sense of responsibility and connection beyond the classroom.
            </p>
             </div>
        </div>
    </div>
    

    <h1> Co-Curricular Activities</h1>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img class=" teacher"src="brick9.jpg">

                </div>
    <div class="col-md-8">
        <p>
            At Brickwood Academy, we believe that education extends beyond the classroom. Our co-curricular activities are designed to complement the academic curriculum, providing students with opportunities to explore their interests, develop new skills, and foster personal growth. These activities play a vital role in shaping well-rounded individuals who are prepared for the challenges of the future.
        </p>
         </div>
    </div>
</div>
<center>
<h1 class="adm">ADMISSION FORM</h1>
<div align="center" class="admission_form">
    <form  action="data_check.php" method="POST" action="submit_form.php">
        <div class="adm_int">
            <label class="label_text" for="first_name">SURNAME</label>
            <input class="input_deg" type="text" id="surname" name="surname" required>
        </div>
        <div class="adm_int">
            <label class="label_text" for="firstname">FIRST NAME</label>
            <input class="input_deg" type="text" id="firstname" name="firstname" required>
        </div>

        <div class="adm_int">
            <label class="label_text" for="last_name">LAST NAME</label>
            <input class="input_deg" type="text" id="lastname" name="lastname" required>
        </div>

        <div class="adm_int">
            <label class="label_text" for="birth_date">BIRTH DATE</label>
            <input class="input_deg" type="date" id="birthdate" name="birthdate" required>
        </div>

       <div class="adm_int">
    <label class="label_text">GENDER</label>
    <div class="radio_group">
        <input type="radio" id="male" name="gender" value="male" required>
        <label class="label_text" for="male">Male</label>
        
        <input type="radio" id="female" name="gender" value="female" required>
        <label class="label_text" for="female">Female</label>
    </div>
</div>
       
        <div class="adm_int">
            <label class="label_text" for="email">EMAIL</label>
            <input class="input_deg" type="email" id="email" name="email" placeholder="example@example.com" required>
        </div>


        <div class="adm_int">
 <label class="label_text" for="guardian_name">GUARDIAN NAME</label>
     <input class="input_deg" type="text" name="guardian_name" placeholder="guardian_name">

        </div>

<div class="adm_int">
<label class="label_text" for="guardian_contact">GUARDIAN CONTACT</label>
<input class="input_deg" type="text" name="guardian_contact" placeholder="guardian_contact">

    </div>

        <div class="hobbies_int">
    <label class="label_text">HOBBIES</label>
     <div class="checkbox_group">
    <input type="checkbox" id="swimming" name="hobbies" value="swimming">
    <label for="swimming">Swimming</label>

    <input type="checkbox" id="gymnastics" name="hobbies" value="gymnastics">
    <label for="gymnastics">Gymnastics</label>

    <input type="checkbox" id="modeling" name="hobbies" value="modeling">
    <label for="modeling">Modeling</label>

    <input type="checkbox" id="painting" name="hobbies" value="painting">
    <label for="painting">Painting</label>
</div>

        <div class="adm_int">
            <label class="label_text" for="message">MESSAGE</label>
            <textarea class="input_txt" id="message" name="message"></textarea>
        </div>

        <div class="adm_int">
            <input class="btn btn-danger" type="reset" value="RESET">
            <input class="btn btn-primary" id="submit" type="submit" value="APPLY" name="apply">
        </div>
    </form>
    <div id="success_message" style="display: none; color: green; margin-top: 10px;">
        Your application has been submitted successfully!
    </div>
</div>
    
       
</center>

    <footer>
         @copyright 2025 Brickwood`s. All rights reserved.
          </footer>
</body>
</html>




