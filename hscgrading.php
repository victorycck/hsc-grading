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
    //Select posts from  initiating page
    $theclass = $_POST['theclass'];
    $stream = $_POST['stream'];
    $theyear = $_POST['theyear'];

    //Select students to work on
    $sql = "SELECT student FROM students WHERE theclass='$theclass' AND stream='$stream' 
        AND theyear='$theyear'";
    $result = mysqli_query($conn, $sql);

    //Get number of students in stream
    $num_of_students = $result->rowCount();
   
    //Get array of students
    $student[] = mysqli_fetch_array($result);

    //For each student in the array
    foreach ($student) :

    //Get the subjects he offers
   
$sqlpapers = "SELECT subject, paper FROM marks WHERE student = $student AND theclass = $theclass AND  stream = $stream AND theyear = $theyear";
        
        $subjectpapers = $conn->query($sqlpapers);
        $num_of_papers = mysqli_num_rows($subjectpapers);
        $thissubjectpaper[] = mysqli_fetch_array($subjectpapers);

             if ($num_of_papers == 2) {
               foreach ($thissubjectpaper as $sp) : 
                   //Get marks for each paper
                   $subject_mark = "SELECT mark1 FROM marks WHERE  student = $student AND subject= $thissubjectpaper AND theclass = $theclass AND  stream = $stream ";
                   $result_mark = mysqli_query($conn, $subject_mark);
                    $marks = mysqli_fetch_row($result_mark));
                    
                   //Get aggregate per paper
                  // foreach ($studentmarks as $sf):
                         
                        // $marks = $sp['mark1'];

                         if($marks>=80 && $marks<=100){
                             $aggregate = 1;
                             
                         }else if($marks>=75 && $marks<=79){
                             $aggregate = 2;
                          
                         }else if($marks>=70 && $marks<=74){
                             $aggregate = 3;
                          
                         }else if($marks>=65 && $marks<=69){
                             $aggregate = 4;
                         
                         }else if($marks>=60 && $marks<=64){
                             $aggregate = 5;
                          
                         }else if($marks>=50 && $marks<=59){
                          $aggregate = 6;
                          
                         }else if($marks>=45 && $marks<=49){
                          $aggregate = 7;
                          
                         }else if($marks>=35 && $marks<=44){
                          $aggregate = 8;
                         
                         }else if($marks>=0 && $marks<=34){
                          $aggregate = 9;
                        
                         }else{
                          //Didn't sit for the paper
                          $aggregate = 9;

                      }
              //concatnate aggregates 
              $agg .= $aggregate;
            
              //convert concatnated aggregate number into string for comparison purposes with
              $aggr = strval($agg);
                    
                $sql5 = "SELECT CONCAT(paperone, papertwo) FROM twopapergrades";
                $result = mysqli_query($conn, $sql5);
                $preset_joined_aggregate[] = mysqli_fetch_array($result));
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
             }else{
              
              
             }        
            endforeach
                   
    endforeach
-------------------------------------
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
       
