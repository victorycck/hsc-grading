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
              $subject_mark = "SELECT mark1 FROM marks WHERE  student = $student AND subject= $thissubjectpaper AND theclass = $theclass AND  stream = $stream ";
              if ($resultmarks=mysqli_query($conn,$subject_mark))
              while ($marks = mysqli_fetch_row($resultmarks)){
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
                    }
                     //convert concatnated aggregate number into string for comparison purposes with
                    $aggr = strval($agg);
                  
                $papergradestring = "SELECT CONCAT(paperone, papertwo) FROM twopapergrades";
                $papergraderesult = mysqli_query($conn, $papergradestring);
                 while ($rowpapergrade=mysqli_fetch_row($papergraderesult)){
                    if (strcmp($rowpapergrade, $aggr) == 0) {
                      //determine grade
                     
                    }else{
                        echo 'Grade not found in system.';
                     }
                   }
                
                endforeach
             }else{
              
              
             }        
            endforeach
                   
    endforeach
?>
