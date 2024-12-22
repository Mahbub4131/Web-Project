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

    $qid=$_GET["qid"];
    if (isset($_POST['submit'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            echo '<script>history.pushState({}, "", "");</script>';
        } elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
    if (isset($_POST['submit1'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            header("Location: homestaff.php");
        } elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
}
?>
<link rel="stylesheet" href="./addq.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Roboto', sans-serif;color:#fff !important">
    <div style="background-color: #042A38;height: 100%;">
    <div style="background-color: #042A38;height:auto;">
        <div class="navbar" style="display: grid;width: 85vw;height:4vw;color:#042A38;position:fixed;border-radius:10rem;margin-top:4vh;margin-left:6vw;">
        <section style="margin-left: 3vw;height:5vh;display:grid;padding-top: 0.5vh;padding-bottom: 1vh; font-size: 2vw;font-family: 'Libre Baskerville', serif;">Quiz Bee</section>
            <ul style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10vw;top:3vh;position: fixed;width: 40vw;">
                <li onclick="dash()"><span style="font-size: 1.2vw;">Dashboard</span></li>
                <li onclick="prof()"><span style="font-size: 1.2vw;">Profile</span></li>
                <li onclick="score()"><span style="font-size: 1.2vw;">Score</span></li>
                <li onclick="lo()"><span style="font-size: 1.2vw;">Sign Out</span></li>
            </ul>
        </div><br><br>
        <section class="dash" style="margin-top:4vw">
            <section id="ans">
                <center>
                    <form style="margin: 0vw;width: 100vw" method="post">

                        <label for="quizname" style="font-size: 3vw;" >Add Questions</label><br><br>
                        <div id="QS">
                            <label for="qs">Question</label>
                            <input type="text" name="qs" placeholder="enter question " required><br><br>
                            <label for="op1">Option 1</label>
                            <input type="text" name="op1" placeholder="option1" required><br><br>
                            <label for="op2">Option 2</label>
                            <input type="text" name="op2" placeholder="option2" required><br><br>
                            <label for="op3">Option 3</label>
                            <input type="text" name="op3" placeholder="option3" required><br><br>
                            <label for="ans">Answer &nbsp;</label>
                            <input type="text" name="ans" placeholder="answer" required><br><br>
                        </div>
                        <input type="submit" name="submit" value="add 1 more question" style="height: 3vw;width: auto;font-family:'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue; font-size:1.4vw; padding-right:1vw; cursor:pointer;">
                        <input type="submit" name="submit1" value="Done" style="height: 3vw;width: auto;font-family: 'Roboto', sans-serif;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue; font-size:1.4vw; padding-right:1vw; cursor:pointer;">
                    </form>
                </center>
            </section>
        </section>
        <section class="prof" id="prof" style="display: none;color:#042A38;">
        <div class="container1">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>USN&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
            <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
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
    </div>
    <footer class="footer" style= "background: black; opacity: 0.9;  font-size: 1rem; height: 4rem;display:flex;margin-top:11rem;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:42rem; color:white;" >
             <p style="padding-top: 0.5rem;">Copyright &copy; Quiz Bee</p>
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
    "document.getElementById(\"score\").style=\"display: grid !important;\";" .
    "}" .
    "function dash(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function lo(){" .
    "alert(\"Thank You for Using our Quiz Bee\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");" .
    "}" .
    "function addquiz(){" .
    "document.getElementById(\"addq\").style=\"display: initial;\";" .
    "}" .

    "</script>";
?>
</html>