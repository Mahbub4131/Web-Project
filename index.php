<?php session_start(); ?>
<html>
<head>
    <title>Quiz Bee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
</head><?php
        if (isset($_POST['login'])) {
            if (isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['pass'])) {        
                require_once 'sql.php';
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$conn) {
                    echo "<script>alert(\"Database error retry after some time !\")</script>";
                }
                $type = mysqli_real_escape_string($conn, $_POST['usertype']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['pass']);
                $password = crypt($password, 'rakeshmariyaplarrakesh');
                $sql = "select * from " . $type . " where mail='{$username}'";
                $res =   mysqli_query($conn, $sql);
                if ($res == true) {
                    global $dbmail, $dbpw;
                    while ($row = mysqli_fetch_array($res)) {
                        $dbpw = $row['pw'];
                        $dbmail = $row['mail'];
                        $_SESSION["name"] = $row['name'];
                        $_SESSION["type"] = $type;
                        $_SESSION["username"] = $dbmail;
                    }
                    if ($dbpw === $password) {
                        if ($type === 'student') {
                            header("location:homestud.php");
                        } elseif ($type === 'staff') {
                            header("Location: homestaff.php");
                        }
                    } elseif ($dbpw !== $password && $dbmail === $username) {
                        echo "<script>alert('password is wrong');</script>";
                    } elseif ($dbpw !== $password && $dbmail !== $username) {
                        echo "<script>alert('username name not found sing up');</script>";
                    }
                }
            }
        }
        ?>

<link rel="stylesheet" href="./index.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">

<body style="margin:0;height: 100%;outline:none;color: #042A38 !important;padding-bottom:5vw;">
    <div class="video-container">
      <video id="bg-video" autoplay loop muted playsinline>
        <source src="./images/bg2.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    </div>
    <div class="bg" style="font-weight: bolder;background-image: url(./images/image.png);background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;font-family:  'Roboto', sans-serif;opacity: 0.9;height: 110%;">
        <center class="navbar">
            <h1 class="w3-container">Quiz Bee</h1>
        </center>
        <center>
            <div class="w3-card" class="login" style="color: #042A38;width: 40vw;background-color: #ffffffab;border: 2px solid black;padding: 2vw;font-weight: bolder;margin-top: 10vh;border-radius: 10px;">
                <form method="POST">
                    <div class="seluser">
                        <input type="radio" name="usertype" value="student" required> STUDENT
                        <input style="margin-left: 1vw;" type="radio" name="usertype" value="staff" required> STAFF
                    </div><br><br>
                    <div class="signin">

                        <label for="username" style="text-transform: uppercase;">Username</label><br><br>
                        <input type="email" name="username" placeholder=" Email" class="inp" required>
                        <br><br>
                        <label for="password" style="text-transform: uppercase;">Password</label><br><br>
                        <input type="password" name="pass" placeholder="******" class="inp" required>
                        <br><br>
                        <input name="login" class="sub" type="submit" value="Login" ><br>

                </form><br>
                 &nbsp; If you are a new user <a href="signup.php" style="margin-left: 1vw; text-decoration:none;" >SIGN UP</a>
            </div>
    </div>
    </center>
    </div>
    <footer class="footer" style= "background: transparent; opacity: 0.9;  font-size: 1rem; height: 3.5rem;display:flex;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:45rem; color:white;" >
             <p style="padding-top: 0.01rem;">Copyright &copy; Quiz bee</p>
        </div>
    </footer>
    <script src="./videoSpeed.js"></script>
</body>
</html>