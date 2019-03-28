 <?php
  //connection to database
    $servername = "localhost";
    $username = "victorycck";
    $password = "Matthew24";
    $dbname = "frankhos_shulo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //get number of students
    $sql = "SELECT student FROM students WHERE theclass = $theclass AND  stream = $stream AND term = $term AND theyear = $theyear";
    $result = mysqli_query($conn, $sql);
    //$result = $conn->query($sql);
    $student[] = mysqli_fetch_array($result);
    //For each student in the class stream
    foreach ($student) :
        //Get  the subjects he does based on the exams he did
        $sqlsubject = "SELECT subject FROM marks WHERE student = $student AND theclass = $theclass AND  stream = $stream AND theyear = $theyear";
        $subject = $conn->query($sqlubject);
        //  $num_of_papers = mysqli_num_rows($subject);
        $thissubject[] = mysqli_fetch_array($subject);
        foreach ($thissubject as $ts) :
            //count $number_of_papers
            $sql2 = "SELECT COUNT(subject) FROM hscsubjects WHERE subject= $subject AND theclass = $theclass AND  stream = $stream ";
            $num_of_papers = $conn->query($sql2);
            // $paper_num_arr = array();
            if ($num_of_papers == 2) {
                //dynamic numbering of papers
                $sql3 = "SELECT subject FROM hscsubjects WHERE subject= $subject AND theclass = $theclass AND  stream = $stream ";
                //$num_of_papers = $conn->query($sql3);
                $result = mysql_query($sql3) or die(mysql_error());
                $row = mysql_fetch_array($result) or die(mysql_error());
                echo $row['subject'];
                // find aggregate for each paper
                foreach ($row['subject']) :
                    //find $subject_aggregate
                    $sql4 = "SELECT mark1 FROM marks WHERE  student = $student AND subject= $subject AND theclass = $theclass AND  stream = $stream ";
                    //$result=mysqli_query($con, $sql4);
                    $aggregate_arr[] = mysql_fetch_array($sql4) or die(mysql_error());
                    //build aggregate string
                    $students_joined_aggregates = join(array($aggregate_arr);
                endforeach;

                //Get preset aggregate marks
                $sql5 = "SELECT paperone, papertwo FROM twopapergrades";
                $result = mysqli_query($conn, $sql5);
                $preset_joined_aggregates[] = mysqli_fetch_array($result));
                foreach ($preset_joined_aggregates as $pjs) :
                    //Compare $students_joined_aggregates with $preset_joined_aggregate
                    if (strcmp($students_joined_aggregates, $pjs) == 0) {
                        //get grade for subject
                        $sql6 = "SELECT grade FROM twopapergrades WHERE $students_joined_aggregates = $pjs; ";
                        $result = mysqli_query($conn, $sql6);
                        $grade = mysqli_fetch_row($result));
                    } else {
                        echo 'Grade not found in system.';
                    }
                endforeach
            }
            // if its a 3 paper subject
            else if($num_of_papers==3) {
              $sql3papers = "SELECT subject FROM hscsubjects WHERE subject= $subject AND theclass = $theclass AND  stream = $stream ";
            //$num_of_papers = $conn->query($sql3);
            $result_for_three_papers = mysql_query($sql3papers) or die(mysql_error());
            $subject_paper_row = mysql_fetch_array($result_for_three_papers) or die(mysql_error());
            echo $subject_paper_row['subject'];
            // find aggregate for each paper
            foreach ($subject_paper_row['subject']) :
                //find $subject_aggregate
                $sql4marks = "SELECT mark1 FROM marks WHERE  student = $student AND subject= $subject AND theclass = $theclass AND  stream = $stream ";
                //$result=mysqli_query($con, $sql4);
                $aggregate_arr[] = mysql_fetch_array($sql4marks) or die(mysql_error());
                //build aggregate string
                $students_joined_aggregates = join(array($aggregate_arr);
            endforeach;

            //Get preset aggregate marks
            $sql5set_agg = "SELECT paperone, papertwo FROM twopapergrades";
            $result_set_agg = mysqli_query($conn, $sql5set_agg);
            $preset_joined_aggregates[] = mysqli_fetch_array($result_set_agg));
            foreach ($preset_joined_aggregates as $pjs) :
                //Compare $students_joined_aggregates with $preset_joined_aggregate
                if (strcmp($students_joined_aggregates, $pjs) == 0) {
                    //get grade for subject
                    $sql6grade = "SELECT grade FROM twopapergrades WHERE $students_joined_aggregates = $pjs; ";
                    $result_grade = mysqli_query($conn, $sql6grade);
                    $grade = mysqli_fetch_row($result_grade));
                } else {
                    echo 'Grade not found in system.';
                }
            endforeach
          }
        endforeach
        //----------------------------------------------

        /*if ($num_of_papers == 2) {
            $sql = "SELECT CONCAT(paperone, papertwo, grade) FROM twopapergrades";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                }
            } else {
                echo "0 results";
            }
        } else if ($num_of_papers == 3) {
            $sql = "SELECT CONCAT(paperone,papertwo,paperthree,grade) FROM threepapergrades";
            $result = $conn->query($s

            if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";

            } else
            echo "0 results";
        }*/


        $conn->close()
        ?>
