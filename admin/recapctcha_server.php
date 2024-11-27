 <?php
 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $secretKey = '6LfuV4sqAAAAAKnaxu4Iqmpj7tlpR-nQlfQj0lqz'; 
      $response = $_POST['g-recaptcha-response'];  

      // Verify the reCAPTCHA response with Google
      $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
      $response = file_get_contents($verifyUrl . '?secret=' . $secretKey . '&response=' . $response);
      $responseKeys = json_decode($response, true);

      // Check if reCAPTCHA verification is successful
      if (intval($responseKeys["success"]) !== 1) {
         
          echo "reCAPTCHA verification failed. Please try again.";
      } else {
        
      }
  }
  ?> 