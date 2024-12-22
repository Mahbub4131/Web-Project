<html>
<head>
    <title>
        Quiz Bee
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
require_once 'sql.php';
                $conn = mysqli_connect($servername, $username, $password, $dbname);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>
<link rel="stylesheet" href="./viewq.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Roboto', sans-serif;color: #fff;height:auto;">
    <div style="background-color: #042A38;height: auto;">
    <div class="navbar" style="display: grid;width: 85vw;height:4vw;color:#042A38;position:fixed;border-radius:10rem;margin-top:4vh;margin-left:6vw;">
        <section style="margin-left: 3vw;height:5vh;display:grid;padding-top: 0.5vh;padding-bottom: 1vh; font-size: 2vw;font-family: 'Libre Baskerville', serif;">Quiz Bee</section>
            <ul style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10vw;top:3vh;position: fixed;width: 40vw;">
                <li onclick="dash()"><span style="font-size: 1.2vw;">Dashboard</span></li>
                <li onclick="prof()"><span style="font-size: 1.2vw;">Profile</span></li>
                <li onclick="score()"><span style="font-size: 1.2vw;">Score</span></li>
                <li onclick="lo()"><span style="font-size: 1.2vw;">Sign Out</span></li>
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
        <section style="margin-top: 6vw;width:80vw;margin-left:10vw;margin-right:10vw;font-size :2vw;"> 
        <?php 
        if(isset($_GET["qid"])){
        $qid=$_GET["qid"];
            $sql ="select * from questions where quizid='{$qid}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if(mysqli_num_rows($res)==0)
                {
                    echo "No questions found under this quiz please come later";
                    echo "<form method=\"POST\">";
                echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Add Questions\"><br><br><br>";

                }else{
                $i=1;
                $j=0;
                echo "<form method=\"POST\">";
                echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"Add Questions\"><br>";
                echo "</form>";

                while ($row = mysqli_fetch_assoc($res)) { 
                    echo $i.". ".$row["qs"]."<br>";
                    echo "<input type=\"radio\" value=\"".$j."\" name=\"ans".$i.$j."\">".$row["op1"]."<br>";
                    echo "<input type=\"radio\" value=\"".($j+1)."\" name=\"ans".$i.$j."\">".$row["op2"]."<br>";               
                    echo "<input type=\"radio\" value=\"".($j+2)."\"name=\"ans".$i.$j."\">".$row["op3"]."<br>";               
                    echo "<input type=\"radio\"value=\"".($j+3)."\" name=\"ans".$i.$j."\">".$row["answer"]."<br><br>";  
                    $i++;                            
                }
                echo "</form><br><br>";
            }
            }
            else
            {
                echo "error".mysqli_error($conn).".";
            }
            if(isset($_POST["submit"])){
                echo "<script>window.location.replace(\"addq.php?qid=".$qid."\")</script>";
            }
     } ?>
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
            </section>
    </div>
    <footer class="footer" style= "background: black; opacity: 0.9;  font-size: 1rem; height: 3.5rem;display:flex;">
        <div class="footer_copyright" style=" text-align: center;position:absolute; margin-left:42rem; color:white;" >
             <p style="padding-top: 0.01rem;">Copyright &copy; Quiz Bee</p>
        </div>
    </footer>
</body>
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
"alert(\"Thank You for Using our Quizzy\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"index.php\");".
"}</script>";
?>

</html>