public function generate_pdf() {
        //load pdf library
        $this->load->library('Pdf');
        
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('https://www.frankhost.pw');
        $pdf->SetTitle('Student Report');
        $pdf->SetSubject('Report generated powered by FRANKHOST.PW');
        $pdf->SetKeywords('TCPDF, PDF, MySQL, Codeigniter');
    
        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        // remove default header/footer
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
    
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
        // set font
        $pdf->SetFont('helvetica', '', 11);
        
        // ---------------------------------------------------------
        
        // create some HTML content
        $names = $this->input->post('names');
        $theclass = $this->input->post('theclass');
		    $theyear = $this->input->post('theyear');
        $stream = $this->input->post('stream');
        $semester = $this->input->post('term');

        $html2 = '<h1 style="text-align:center;">AVEMA SECONDARY & VOCATION SCHOOL</h1>
                  <p style="text-align:center;"> P.O. Box 406, Mityana, Uganda</p>
                  <p>&nbsp;</p>
                  <img src="images/logo_example.png" alt="test alt attribute" width="30" height="30" border="0" /><br/>
                  <h2 style="text-align:center;">END OF TERM REPORT</h2><p>&nbsp;</p>
                              
        $template2 = array('table_open' => '<table border="1" cellpadding="3" cellspacing="1">',);
        
        $this->table->set_template($template2);
        $this->table->add_row('Total: ', 'Out of: ', 'Average: ');
        $this->table->add_row('Position by Total: ', 'Out of: ', 'Best in 8: ');
        $this->table->add_row('Position by Total: ', 'Out of: ' );
        $html3 = $this->table->generate();
        
        //Generate HTML table data from MySQL - start
        $template = array(
             'table_open' => '<table border="1" cellpadding="3" cellspacing="1">',
        );
    
        $this->table->set_template($template);
        
        $this->table->set_heading('Subject', 'BOT (100)', 'Grade', 'Remarks', 'Subject Teacher');
        
        $studentmarks = $this->Mark_model->get_student_marks();
      
            
        foreach ($studentmarks as $sf):
           //find grade
           $marks = $sf['mark1'];
           
           if($marks>=80 && $marks<=100){
               $grade = "D 1";
               $d1 = 1;
           }else if($marks>=75 && $marks<=79){
            $grade = "D 2";
            $d2= 2;

           }else if($marks>=70 && $marks<=74){
            $grade = "C 3";
            $c3=3;
           }else if($marks>=65 && $marks<=69){
            $grade = "C 4";
            $c4=4;
           }else if($marks>=60 && $marks<=64){
            $grade = "C 5";
            $c5=5;
           }else if($marks>=50 && $marks<=59){
            $grade = "C 6";
            $c6=6;
           }else if($marks>=45 && $marks<=49){
            $grade = "P 7";
            $p7=7;
           }else if($marks>=35 && $marks<=44){
            $grade = "P 8";
            $p8=8;
           }else if($marks>=0 && $marks<=34){
            $grade = "F 9";
            $f9=9;
           }else{
            //Didn't sit for the paper
            $grade = "F 9";
            
        }
      
        $this->table->add_row($sf['subject'], $sf['mark1'],$grade, $sf['comment'], $sf['subjectteacher']);
        
        endforeach;
      //  }
      
        $subject_number= $this->Mark_model->number_of_subjects_offered();
        $marks_out_of= $subject_number*100;

        $total_marks = $this->Mark_model->get_total_marks();
        $average_marks = $this->Mark_model->get_average_marks();
        $num_of_students_in_stream = $this->Student_model->get_all_students_count_in_stream();

        $html = $this->table->generate();
        //Generate HTML table data from MySQL - end
        
        // add a page
        $pdf->AddPage();

        // set cell padding
       // $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
       // $pdf->setCellMargins(1, 1, 1, 1);

        // set color for background
        $pdf->SetFillColor(255, 255, 127);

        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
 
        // output the HTML content
        
        
       // $pdf->Cell(0, 0, $subject_number, 1, 1, 'C', 0, '', 0);
        $pdf->writeHTML($html2,true,false,true,false,'');
        $pdf->Ln(1);
        $pdf->MultiCell(60, 5, 'Names: '.$names, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 5, 'Class: '.$theclass, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 5, 'Stream: '.$stream, 1, 'L', 1, 0, '', '', true);
        $pdf->Ln(7);
        $pdf->MultiCell(60, 5, 'Student Number: '.$names, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 5, 'Term: '.$semester, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 5, 'Year: '.$theyear, 1, 'L', 1, 0, '', '', true);

        $pdf->Ln(7);

       // $pdf->MultiCell(55, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
       //$pdf->writeHTML($names,true, false, true, false, '');
      
        $pdf->writeHTML($html, true, false, true, false, '');
       

        $pdf->Ln(4);
        $pdf->MultiCell(60, 7, 'Total: '.$total_marks, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Out of: '.$marks_out_of, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Average Mark: '. round($average_marks), 1, 'L', 1, 0, '', '', true);

        $pdf->Ln(9);
        $pdf->MultiCell(60, 7, 'Position by Total: '.$total_marks, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Out of: '.$num_of_students_in_stream, 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Division: '. '', 1, 'L', 1, 0, '', '', true);

        $pdf->Ln(18);
        $pdf->MultiCell(60, 7, 'Class Teacher: '.'Noah Kirigwajjo', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Comment: '.'__________________', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Signature: '. '__________________', 0, 'L', 0, 0, '', '', true);

        $pdf->Ln(12);
        $pdf->MultiCell(60, 7, 'Head Teacher: '.'Job Kafeero', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Comment: '.'__________________', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(60, 7, 'Signature: '. '__________________', 0, 'L', 0, 0, '', '', true);

    
        $pdf->Ln(15);
        $pdf->MultiCell(90, 7, 'Next term starts on: '.'________________________', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(90, 7, 'Next term ends on: '.'_________________________', 0, 'L', 0, 0, '', '', true);

        $pdf->Ln(15);
        $pdf->MultiCell(90, 7, 'Fees Balance        : '.'________________________', 0, 'L', 0, 0, '', '', true);

        $pdf->Ln(19);
        $pdf->MultiCell(90, 7, 'Note: This report card is invalid without a stamp', 0, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(90, 7, 'System developed by AiconNet.com', 0, 'R', 0, 0, '', '', true);
        


       // $pdf->writeHTML($html3, true, false, true, false, '');

        
        // reset pointer to the last page
        $pdf->lastPage();
    
        //Close and output PDF document
        //$pdf->Output(md5(time()).'.pdf', 'D');
        //$pdf->Output(md5(Semester Report.'.pdf', 'D');
        $pdf->Output('Semester Report.pdf', 'I');
      }
