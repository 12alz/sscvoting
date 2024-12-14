<?php 	 	
include 'includes/session.php'; 	
include 'includes/slugify.php';  	
$output = array('error'=>false,'list'=>'');  	
$sql = "SELECT * FROM positions"; 
$query = $conn->query($sql);  	

while($row = $query->fetch_assoc()){ 		
    $position = slugify($row['description']); 		
    $pos_id = $row['id']; 		
    
    if(isset($_POST[$position])){ 			
        // Strictly enforce exactly 2 votes per position
        if($row['max_vote'] > 1){ 				
            // Check if exactly 2 candidates are selected
            if(count($_POST[$position]) != 2){ 					
                $output['error'] = true; 					
                $output['message'][] = '<li>You must select exactly 2 candidates for '.$row['description'].'</li>'; 				
            } 				
            else{ 					
                foreach($_POST[$position] as $key => $values){ 						
                    $sql = "SELECT * FROM candidates WHERE id = '$values'"; 						
                    $cmquery = $conn->query($sql); 						
                    $cmrow = $cmquery->fetch_assoc(); 						
                    $output['list'] .= " 							
                        <div class='row votelist'> 		                      	
                            <span class='col-sm-4'><span class='pull-right'><b>".$row['description']." :</b></span></span>  		                      	
                            <span class='col-sm-8'>".$cmrow['firstname']." ".$cmrow['lastname']."</span> 		                    
                        </div> 						
                    "; 					
                }  				
            } 				 			
        } 			
        else{ 				
            $candidate = $_POST[$position]; 				
            $sql = "SELECT * FROM candidates WHERE id = '$candidate'"; 				
            $csquery = $conn->query($sql); 				
            $csrow = $csquery->fetch_assoc(); 				
            $output['list'] .= " 					
                <div class='row votelist'>                       	
                    <span class='col-sm-4'><span class='pull-right'><b>".$row['description']." :</b></span></span>                        	
                    <span class='col-sm-8'>".$csrow['firstname']." ".$csrow['lastname']."</span>                     
                </div> 				
            "; 			
        }  		
    } 		 	
}  	

echo json_encode($output);   
?>