 <?php
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
    //iterate through the students
    foreach ($student) :
        //foreach $subject_offered_by_student
        $sqlsubject = "SELECT subject FROM marks WHERE student = $student AND theclass = $theclass AND  stream = $stream AND theyear = $theyear";
        $subject = $conn->query($sqlubject);

        $num_of_papers = mysqli_num_rows($subject);

        $thissubject[] = mysqli_fetch_array($subject);
        foreach ($thissubjects) :
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
                    $students_joined_aggregates[] = mysql_fetch_array($sql4) or die(mysql_error());
                    //build aggregate string
                    $students_joined_aggregates = join(array($row);
                endforeach;

                //Get 
                $sql5 = "SELECT paperone, papertwo FROM twopapergrades";
                $result = mysqli_query($conn, $sql5);
                $preset_joined_aggregates[] = mysqli_fetch_array($result));
                foreach ($preset_joined_aggregates) :
                    //Compare $students_joined_aggregates with $preset_joined_aggregate
                    if (strcmp($students_joined_aggregates, $preset_joined_aggregate) == 0) {
                        //get grade for subject
                        $sql6 = "SELECT grade FROM twopapergrade WHERE $students_joined_aggregates[] = $preset_joined_aggregates[]; ";
                        $result = mysqli_query($conn, $sql6);
                        $grade = mysqli_fetch_row($result));
                    } else {
                        echo 'Grade not found in system.';
                    }
                endforeach
            } else { }
        endforeach
        //----------------------------------------------

        if ($num_of_papers == 2) {
            $sql = "SELECT CONCAT(paperone, papertwo, grade) FROM twopapergrades";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                    //compare set grades with grades attained by student in each subject
                }
            } else {
                echo "0 results";
            }
        } else if ($num_of_papers == 3) {
            $sql = "SELECT CONCAT(paperone,papertwo,paperthree,grade) FROM threepapergrades";
            $result = $conn->query($s

            if ($resul t->num_rows > 0)
            // output data     of each
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                //compare set grades with grades attained by studen        t in eac 
            } else
            echo "0 results";
        }


        $conn->close()
        ?>