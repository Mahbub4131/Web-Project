<html>

<head>
    <title>Quiz Bee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php

if (isset($_POST['studsu'])) {
    session_start();
    if (isset($_POST['name1']) && isset($_POST['mail1']) && isset($_POST['dept1']) && isset($_POST['dob1'])  && isset($_POST['password1']) && isset($_POST['cpassword1'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($servername, $username, $password, $dbname);       if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name1 = mysqli_real_escape_string($conn, $_POST['name1']);
        
        $mail1 = mysqli_real_escape_string($conn, $_POST['mail1']);
        
        $dept1 = mysqli_real_escape_string($conn, $_POST['dept1']);
        $dob1 = mysqli_real_escape_string($conn, $_POST['dob1']);
        
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $cpassword1 = mysqli_real_escape_string($conn, $_POST['cpassword1']);
        $password1 = crypt($password1,'rakeshmariyaplarrakesh');
        $cpassword1 = crypt($cpassword1,'rakeshmariyaplarrakesh');
        if ($password1 == $cpassword1) {
            $sql = "insert into student (name,mail,dept,DOB,pw) values('$name1','$mail1','$dept1','$dob1','$password1')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('successful!');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            } else {
                echo "<script>
                alert('Data enter by you alreay exist in Database please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert(' Password should be same');
                window.location.replace(\"singup.php\");</script>";
            session_destroy();
        }
    }
}

if (isset($_POST['staffsu'])) {
    session_start();
    if (isset($_POST['name2']) && isset($_POST['mail2']) && isset($_POST['dept2']) && isset($_POST['dob2']) && isset($_POST['password2']) && isset($_POST['cpassword2'])) {
require 'sql.php';
        $conn = mysqli_connect($servername, $username, $password, $dbname);        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name2 = mysqli_real_escape_string($conn, $_POST['name2']);
       
        $mail2 = mysqli_real_escape_string($conn, $_POST['mail2']);
       
        $dept2 = mysqli_real_escape_string($conn, $_POST['dept2']);
        $dob2 = mysqli_real_escape_string($conn, $_POST['dob2']);
        
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $cpassword2 = mysqli_real_escape_string($conn, $_POST['cpassword2']);
        $password2 = crypt($password2,'rakeshmariyaplarrakesh');
        $cpassword2 = crypt( $cpassword2,'rakeshmariyaplarrakesh');
        if ($password2 == $cpassword2) {
            $sql = "insert into staff (name,mail,dept,DOB,pw) values('$name2','$mail2','$dept2','$dob2','$password2')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('successful!');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            } else {
                echo "<script>
                alert('Data enter by you alreay exist in Database please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert(' Password should be same');
                window.location.replace(\"signup.php\");</script>";
            session_destroy();
        }
    }
}
?>
<link rel="stylesheet" href="./signup.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="margin: 0;padding: 0;outline: none;height: 100%;min-height: 100%;color:#042A38;background-color:transparent;">
    <div class="video-container">
      <video id="bg-video" autoplay loop muted playsinline>
        <source src="./images/bg2.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    </div>
    <div style="font-family:'Roboto', sans-serif, monospace;margin: 0;padding: 0;background-color: transparent;height: 100%;width: 100%;padding-bottom: 5vw;background-image: url(images/image.png);height: 100px;background-repeat: no-repeat;background-size:cover;">
        <center class="nav">
        <center>
            <h1 class="w3-container">Quiz Bee</h1>
        </center>
        </center>
        <div class="seluser">
            <center> <button onclick="stud()">STUDENT</button><button onclick="staff()">STAFF</button></center>
        </div>
        <div class="stud" id="stud">
            <center style="margin-top: 3vh;" >

                <form name="student" method="POST" style="width: 80vw;background-color:white;"><br>
                    <h1 class="formname"style="top-padding:2rem;">Sign-up as student</h1><br><br>
                    <label for="name1">NAME</label><br>
                    <input type="text" name="name1" required><br><br>
                    
                    <label for="mail1">Email</label><br>
                    <input type="email" name="mail1" required><br><Br>
                    
                    <label for="dept1">Department</label><br>
                    <select name="dept1" class="selc" required>
                        <option value="CSE">CSE</option>
                        <option value="ISE">ISE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                    </select><br><br>
                    <label for="dob1">DOB</label><br>
                    <input type="date" name="dob1" required><br><Br>
                    
                    <label for="password1">Password</label><br>
                    <input type="password" name="password1" required><br><Br>
                    <label for="cpassword1">Confirm Password</label><br>
                    <input type="password" name="cpassword1" required><br><Br>
                    <input type="submit" class="su" name="studsu" value="Sign-Up as Student">
                </form>

            </center>
        </div>
        <div class="staff" id="staff">
            <center style="margin-top: 3vh;">

                <form name="staffSIGNUP" method="POST" style="width: 80vw;background-color:white;"><br>

                    <h1 class="formname"style="top-padding:2rem;">Sign-up as staff</h1><br><br><label for="name">NAME</label><br>
                    <input type="text" name="name2" required><br><br>
                    
                    <label for="mail2">Email</label><br>
                    <input type="email" name="mail2" required><br><Br>
                    
                    <label for="dept2">Department</label><br>
                    <select name="dept2" class="selc" required>
                        <option value="CSE">CSE</option>
                        <option value="ISE">ISE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                    </select><br><br> <label for="dob2">DOB</label><br>
                    <input type="date" name="dob2" required><br><Br>
                   
                    <label for="password2">Password</label><br>
                    <input type="password" name="password2" required><br><Br>
                    <label for="cpassword2">Confirm Password</label><br>
                    <input type="password" name="cpassword2" required><br><Br>
                    <input type="submit" name="staffsu" class="su" value="Sign-Up as Staff">
                </form>
            </center>
        </div>
        <center><a href="index.php" style="color:#fff !important; text-decoration:none; ">Cancel</a></center>
        <link rel="stylesheet" href="style.css">    
    </div>
    <!-- <footer class="footer" style= "background: black;opacity: 0.9;font-size: 1rem;height: 3.5rem;display:flex;margin-top:61%;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:43rem; color:white;" >
             <p style="padding-top: 0.01rem;">Copyright &copy; Quiz bee</p>
        </div>
    </footer> -->
</body>
<script src="./videoSpeed.js"></script>
<script>
    function stud() {
        document.getElementById('stud').style = "display:initial";
        document.getElementById('staff').style = "display:hidden";
    }

    function staff() {
        document.getElementById('stud').style = "display:hidden";
        document.getElementById('staff').style = "display:initial";
    }
</script>

</html>
