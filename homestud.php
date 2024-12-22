<html>
<head>
    <title>
        Quiz Bee
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
require_once 'sql.php';
                $conn = mysqli_connect($servername, $username, $password, $dbname);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>
<link rel="stylesheet" href="./homestud.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body>
    <div class="video-container">
      <video id="bg-video" autoplay loop muted playsinline>
        <source src="./images/bg2.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    </div>
    <div style="height:auto;">
        <div class="navbar" style="display: grid;width: 85vw;height:4vw;color:#042A38;position:fixed;border-radius:10rem;margin-top:4vh;margin-left:6vw;">
        <section style="margin-left: 3vw;height:5vh;display:grid;padding-top: 0.5vh;padding-bottom: 1vh; font-size: 2vw;font-family: 'Libre Baskerville', serif;">Quiz Bee</section>
            <ul style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10vw;top:3vh;position: fixed;width: 40vw;">
                <li onclick="dash()"><span style="font-size: 1.2vw;">Dashboard</span></li>
                <li onclick="prof()"><span style="font-size: 1.2vw;">Profile</span></li>
                <li onclick="score()"><span style="font-size: 1.2vw;">Score</span></li>
                <li onclick="lo()"><span style="font-size: 1.2vw;">Sign Out</span></li>
                <!-- <li onclick="prof()">Profile</li>
                <li onclick="score()">Score</li>
                <li onclick="lo()">Sign Out</li> -->
            </ul>
        </div><br><br>
        <?php
        $type1 = $_SESSION["type"];
        $username1 = $_SESSION["username"];
        $sql = "select * from " . $type1 . " where mail='{$username1}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbmail = $row['mail'];
                $dbname = $row['name'];
                $dbdob = $row['DOB'];
                $dbdept = $row['dept'];
            }
        }
        ?>
        
        <!-- Home section start  -->
        <div class="home">
            <div class="home_content">
                <h2 class="home_title">Welcome &nbsp;<?php echo $dbname ?></h2>
                <h2 class="home_title2">Test your programming knowledge</h2>
            </div>
            <div class="banner">
                 <img src="./images/banner.png" alt="" />
            </div>
        </div>
        <!-- Home section end  -->
        
        <section style="color:white !important"><br><br><br><br><br>
        <?php 
            $sql ="select * from quiz";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size:2vw;\">Take any Quiz</h1></center>";
                echo "<center><table><thead><tr><td>Quiz Title</td><td>Created on</td><td>Created By</td><td>  </td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td><td>".$row["mail"]."</td><td><a id=\"tq\" href='takeq.php?qid=".$row['quizid']."'>Take Quiz</button></tr>"; 
                }
                echo "</table></center>";
            }
            ?>
        </section>
        <section class="prof" id="prof" style="display: grid;color:#042A38;">
        <div class="container1">
                <p><b>Type of user&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
                <p><b>Name &nbsp;:&nbsp;<?php echo $dbname ?></b></p>
                <p><b>Email &nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
                <p><b>DOB &nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
                <p><b>Dept &nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </div>  
        <div class="container2">
            <img src=" images/user.png">
        </div>    
        </section>
        <section id="score" style="display:block;">
        <?php 
            $sql ="select * from score,quiz where score.mail='{$username1}' and score.quizid=quiz.quizid";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<small class=\"scoreboard\">Scoreboard</small>";
                echo "<table id=\"sc\"><thead><tr><td>Quiz Title</td><td>Score Obtained</td><td>Total Score</td><td>Remarks</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td><td>".$row["remark"]."</tr>"; 
                }
                echo "</table>";
            }
            else{
                echo " ".mysqli_error($conn);
            }
            ?><br><br><br>
            </section>
            <section style="color:#fff !important">
            <?php
            $sql="call leaderboard;";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size: 2vw\">Leaderboard</h1></center>";
                echo "<table id=\"le\"><thead><tr><td>Quiz Title</td><td>Score</td><td>Total Score</td><td>Student name</td><td>Student Mail ID</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td><td>".$row["name"]."</td><td>".$row["mail"]."</td></tr>"; 
                }
                echo "</table><br><br><br>";
            }
            else{
                echo mysqli_error($conn);
            }
            ?>
        </section>
    </div>
    <footer class="footer" style= "background: black; opacity: 0.9;  font-size: 1rem; height: 3.5rem;display:flex;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:42rem; color:white;" >
             <p style="padding-top: 0.01rem;">Copyright &copy; Quiz Bee</p>
        </div>
    </footer>
</body>
<script src="./videoSpeed.js"></script>
<?php
echo '<script>'.
"function prof(){".
"document.getElementById(\"prof\").style=\"display: grid !important;\";".
"document.getElementById(\"score\").style=\"display: none !important;\";".
"}".
"function score(){".
"document.getElementById(\"prof\").style=\"display: none !important;\";".
"document.getElementById(\"score\").style=\"display: grid !important;\";".
"}".
"function dash(){".
    "document.getElementById(\"prof\").style=\"display: none !important;\";".
    "document.getElementById(\"score\").style=\"display: none !important;\";".
    "}".
"function lo(){".
"alert(\"Thank You for Using our Quiz bee\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");".
"}</script>";
?>
</html>