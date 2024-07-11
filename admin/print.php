<?php
  include 'includes/session.php';

  function generateRow($conn){
    $contents = '';
    
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);

    while($row = $query->fetch_assoc()){
      $id = $row['id'];
      $contents .= '
        <tr>
          <td colspan="3" align="center" style="font-size:15px;"><b>'.$row['description'].'</b></td>
        </tr>
        <tr>
          <td width="60%"><b>Candidates</b></td>
          <td width="20%"><b>Votes</b></td>
          <td width="20%"><b>Status</b></td>
        </tr>
      ';

      // Get the highest number of votes for the current position
      $maxVotes = 0;
      $candidates = [];
      $sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY lastname ASC";
      $cquery = $conn->query($sql);

      while($crow = $cquery->fetch_assoc()){
        $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
        $vquery = $conn->query($sql);
        $votes = $vquery->num_rows;

        if ($votes > $maxVotes) {
          $maxVotes = $votes;
        }

        $candidates[] = [
          'id' => $crow['id'],
          'name' => $crow['lastname']." ".$crow['firstname'],
          'votes' => $votes
        ];
      }

      // Determine if there's a tie
      $maxVoteCount = 0;
      foreach ($candidates as $candidate) {
        if ($candidate['votes'] == $maxVotes) {
          $maxVoteCount++;
        }
      }

      // Generate table rows for each candidate
      foreach ($candidates as $candidate) {
        $isWinner = $candidate['votes'] == $maxVotes;
        $isTie = $isWinner && $maxVoteCount > 1;
        $rowStyle = $isWinner ? 'style="background-color:lightgreen;"' : '';
        $status = $isTie ? 'Tie' : ($isWinner ? 'Winner' : ' ');

        $contents .= '
          <tr '.$rowStyle.'>
            <td>'.$candidate['name'].'</td>
            <td>'.$candidate['votes'].'</td>
            <td>'.$status.'</td>
          </tr>
        ';
      }
    }

    return $contents;
  }
    
  $parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
  $title = $parse['election_title'];

  require_once('../tcpdf/tcpdf.php');  
  $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
  $pdf->SetCreator(PDF_CREATOR);  
  $pdf->SetTitle('Result: '.$title);  
  $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $pdf->SetDefaultMonospacedFont('helvetica');  
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
  $pdf->setPrintHeader(false);  
  $pdf->setPrintFooter(false);  
  $pdf->SetAutoPageBreak(TRUE, 10);  
  $pdf->SetFont('helvetica', '', 11);  
  $pdf->AddPage();  
  $content = '';  
  $content .= '
      <h2 align="center">'.$title.'</h2>
      <h4 align="center">Tally Result</h4>
      <table border="1" cellspacing="0" cellpadding="3">  
    ';  
  $content .= generateRow($conn);  
  $content .= '</table>';  
  $pdf->writeHTML($content);  
  $pdf->Output('election_result.pdf', 'I');

?>
