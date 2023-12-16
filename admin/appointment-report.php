<?php
    require_once('../../TCPDF/tcpdf.php');
    // create new PDF document
    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //page orientation p for portrait and l for landscape
    //pdf unit mm for milimeter
    //page format sizes like A4, legal
    //tcpdf class is default kung gagamit ng header and footer need gumawa ng bagong class, use the class tapos extends si tcpdf
    $pdf = new TCPDF('l', PDF_UNIT, 'A4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Eye Vision');
    $pdf->SetTitle('Products');
    // $pdf->SetSubject('');
    // $pdf->SetKeywords('');
    //this is optional kung gagamit ng header or footer
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    //default font
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    //margin ng page(left, top, right)
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    //optional if isasama sila header at footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    //matic na adding ng page if ma reach yung sinet na footer margin
    $pdf->SetAutoPageBreak(TRUE, 10);
    //font ng buong page (font theme, font style, font size)
    $pdf->SetFont('helvetica', '', 9);
    //eto yung pag add ng page./no of page
    $pdf->AddPage();
    //dito yung mismong code
    $html = '
            <h1>Appointments Report</h1>
            <table style="border-top: 1px solid black;padding: 10px 0">
                <thead>
                    <tr >
                        <th width="30px" style="font-weight: bold;">ID</th>
                        <th width="90px" style="font-weight: bold;">Name</th>
                        <th width="140px" style="font-weight: bold;">Email</th>
                        <th width="80px" style="font-weight: bold;">Phone</th>
                        <th width="160px" style="font-weight: bold;">Purpose Of Visit</th>
                        <th style="font-weight: bold;">Schedule Date</th>
                        <th style="font-weight: bold;">Schedule Time</th>
                        <th style="font-weight: bold;">Status</th>

                    </tr>
                </thead>

                <tbody>';
                    include '../db_connection.php';
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $sql = "SELECT * FROM contact.appointments";

                    // Check for date conditions
                    if ($startDate && !$endDate) {
                        $sql .= " WHERE DateCreated >= '$startDate'";
                    } else if ($startDate && $endDate) {
                        $sql .= " WHERE DateCreated BETWEEN '$startDate' AND '$endDate'";
                    }

                    $result = mysqli_query($con, $sql);


                    while ($row = mysqli_fetch_array($result)) {
                        $html .='
                        <tr style="padding:10px">
                            <td width="30px">'.$row['ID'].'</td>
                            <td width="90px">'.$row['FullName'].'</td>
                            <td width="140px">'.$row['EmailAddress'].'</td> 
                            <td width="80px">'.$row['Phone'].'</td>               
                            <td width="160px">'.$row['PurposeOfVisit'].'</td>
                            <td>'.$row['Schedule'].'</td>
                            <td>'.$row['Time'].'</td>
                            <td>'.$row['Status'].'</td>
                        </tr>';
                    }  
            $html .='
                </tbody>
            </table>
';
    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->writeHTML($html);

    $pdf->Output('appointments-report	.pdf', 'I');
?>