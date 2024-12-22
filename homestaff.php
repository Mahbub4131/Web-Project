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
} else {
    $type1 = $_SESSION["type"];
    $username1 = $_SESSION["username"];
    $sql = "select * from " . $type1 . " where mail='{$username1}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbmail, $dbpw, $dbusn;
        while ($row = mysqli_fetch_array($res)) {
            $dbmail = $row['mail'];
            $dbname = $row['name'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
        }
    }
    if (isset($_POST['submit'])) {
        $qname = strtolower($_POST['quizname']);
        $_SESSION["qname"]=$qname;
        $sql1 = "insert into quiz(quizname,mail) values('$qname','$username1')";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            $sql = "select quizid from quiz where quizname='" . $qname . "';";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                header("location: addqs.php");
            } else {
                echo "<script>alert(\"some error occured\");</script>";
            }
        } else {
            echo "<script>alert(\"Already name exists\");</script>";
        }
    }
    if (isset($_POST['submit1'])) {
        $qid1 = strtolower($_POST['quizid']);
        $sql1 = "delete from quiz where quizid='{$qid1}'";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            echo "<script>alert(\"Quiz successfully deleted\");</script>";
        } else {
            echo "<script>alert(\"Unknown error occured during deletion of quiz\");</script>";

        }
    }
    if (isset($_POST['submit2'])) {
        $qid1 =$_POST['quizid'];
        $sql1 = "select quizid from quiz where quizid='{$qid1}'";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            echo "<script>window.location.replace(\"viewq.php?qid=".$qid1."\");</script>";
        } else {
            echo "<script>alert(\"Unknown error occured during viweing of quiz\");</script>";

        }
    }
}
?>
<link rel="stylesheet" href="./homestaff.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="margin: 0 !important;font-weight: bolder !important;font-family:'Roboto', sans-serif;height:auto;color:#fff">
    <div id="main" style="background-color: #042A38;height: auto;color:#fff !important">
    <div class="navbar" style="display: grid;width: 85vw;height:4vw;color:#042A38;position:fixed;border-radius:10rem;margin-top:4vh;margin-left:6vw;">
    <section style="margin-left: 3vw;height:5vh;display:grid;padding-top: 0.5vh;padding-bottom: 1vh; font-size: 2vw;font-family: 'Libre Baskerville', serif;">Quiz Bee</section>
            <ul  style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10vw;top:3vh;position: fixed;width: 40vw;">
                <li onclick="dash()"><span style="font-size: 1.2vw;">Dashboard</span></li>
                <li onclick="prof()"><span style="font-size: 1.2vw;">Profile</span></li>
                <li onclick="score()"><span style="font-size: 1.2vw;">Score</span></li>
                <li onclick="lo()"><span style="font-size: 1.2vw;">Sign Out</span></li>
                <!-- <li onclick="dash()">Dashboard</li>
                <li onclick="prof()">Profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li> -->
            </ul>
        </div><br><br> 
        <center><section style="width:100vw;margin:0vw;margin-top:7vw;font-size:3vw;">Welcome to Quiz bee&nbsp;<?php echo $dbname ?></section></center>
        <section class="dash" style="margin: 3vw;width: 90vw;">
            <center><h1 style="font-weight:bolder;font-size:3vw">Dashboard</h1></center>
           <center> <button onclick="addquiz()">Add Quiz</button>            <button onclick="delquiz()">Delete Quiz</button>         <button onclick="viewq()">View Quiz</button></center>
           <center>
            <section id="addq" style="display:none;">
                <form style="margin: 1vw;width: 30vw" method="post">
                  
                        <h1>Add quiz</h1>
                        <label for="quizname" style="margin-right:1vw;">Quiz name</label>
                        <input type="text" name="quizname" placeholder="enter quiz name" required><br><br>
                        <input type="submit" style="font-size: 1.5vw;" name="submit" value="submit" class="submit_btn">
                  
                </form>
            </section>  </center><center>
            <section id="delq" style="display:none;">
                <form style="margin: 1vw;width: 30vw" method="post">
                    
                        <h1>Delete Quiz</h1>
                        <label for="quizid" style="margin-right:1vw;">Quiz Id</label>
                        <input type="number" name="quizid" placeholder="enter quiz id" required><h7 onclick="score()" style="padding:0;color: #fff;font-size:1vw;text-decoration:underline"><span style="margin-left: 1vw; text-decoration: none; cursor:pointer;">get Quiz ID</span></h7><br><br>
                        <input type="submit" style="font-size: 1.5vw;" name="submit1" value="submit" class="submit_btn">
                    
                </form>
            </section></center>
            <center>
            <section id="viewq" style="display:none;">
                <form style="margin: 1vw;width: 30vw" method="post">
                    
                        <h1>View Quiz</h1>
                        <label for="quizid" style="margin-right:1vw;">Quiz Id</label>
                        <input type="number" name="quizid" placeholder="enter quiz id" required><h7 onclick="score()" style="padding:0;color: #fff;font-size:1vw;text-decoration:underline"><span style="margin-left: 1vw; text-decoration: none; cursor:pointer;">get Quiz ID</span></h7><br><br>
                        <input type="submit" style="font-size: 1.5vw;" name="submit2" value="submit" class="submit_btn">
                    
                </form>
            </section></center>

            <!-- <section id="ans" style="display: none;">
            <form style="margin: 5vw;width: 30vw" method="post">
                    <center>
                        <label for="quizname">Questions</label><br><br>
                        <div id="QS">
                        <input type="text" name="qs" placeholder="enter question " required><br><br>
                        <input type="text" name="op1" placeholder="option1" required><br><br>
                        <input type="text" name="op2" placeholder="option2" required><br><br>
                        <input type="text" name="op3" placeholder="option3" required><br><br>
                        <input type="text" name="ans" placeholder="answer" required><br><br>
                        </div>
                        <input type="submit" name="submit" value="submit" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                    </center>
                </form>
            </section> -->
        </section>
        <section class="prof" id="prof" style="display: none;color:#042A38;">
        <div class="container1">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
            <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </div>
        <div class="container2">
            <img src=" images/user.png">
        </div>
        </section>
        <section id="score" style="display:none;">
            <?php 
            $sql ="select * from quiz where mail='{$username1}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<h1>List of Quiz added by U</h1>";
                echo "<table id=\"sc\"><thead><tr><td>Quiz id</td>&nbsp;<td>Quiz Title</td><td>Created on</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizid"]."</td><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td></tr>"; 
                }
                echo "</table>";
            }
            ?>
        </section>
        <section style="color:#fff !important">
            <?php
            $sql="select quizname,s.name,score,totalscore from student s,staff st,score sc,quiz q where q.quizid=sc.quizid and s.mail=sc.mail and q.mail=st.mail and q.mail='{$username1}' ORDER BY score DESC";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<center><h1 style=\"font-size: 3vw\">Leaderboard</h1></center>";
                echo "<table id=\"le\"><thead><tr><td>Quiz Title</td>&nbsp;<td>Student name</td><td>score obtained</td><td>Max Score</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["name"]."</td><td>".$row["score"]."</td><td>".$row["totalscore"]."</td></tr>"; 
                }
                echo "</table><br><br>";
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
<?php
echo '<script>' .
    "function prof(){" .
    "document.getElementById(\"prof\").style=\"display: grid !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function score(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: grid!important;\";" .
    "}" .
    "function dash(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function lo(){" .
    "alert(\"Thank You for Using our Quiz bee\");";
    //session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");" .
    "}" .
    "function addquiz(){" .
    "document.getElementById(\"addq\").style=\"display: initial;\";" .
    "document.getElementById(\"delq\").style=\"display: none;\";" .
    "document.getElementById(\"viewq\").style=\"display: none;\";" .

    "}" .
    "function delquiz(){" .
        "document.getElementById(\"delq\").style=\"display: initial;\";" .
        "document.getElementById(\"addq\").style=\"display: none;\";" .
        "document.getElementById(\"viewq\").style=\"display: none;\";" .
        "}" .
        "function viewq(){" .
            "document.getElementById(\"viewq\").style=\"display: initial;\";" .
            "document.getElementById(\"delq\").style=\"display: none;\";" .
            "document.getElementById(\"addq\").style=\"display: none;\";" .
            "}" .

    "</script>";
?>
</html>