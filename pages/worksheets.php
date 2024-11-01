<?php

session_start(); 

?>

<?php
// worksheets.php

// Define a valid request path
$validPath = '/pages/worksheets.php';

// Get the current request path
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the request path is valid
if ($requestPath !== $validPath) {
    // If the request path is not valid, return a 404 response
    header("HTTP/1.1 404 Not Found");
    echo "404 Not Found";
    exit();
}

// Your normal script processing goes here
?>


<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Worksheets</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icons/pencil.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/worksheets.css">
  </head>
  <body>
  <?php include("../bars/navbar.php") ?>
  
  <div class="main-section">
  <?php include("../bars/worksheet_sidebar.php") ?>
  <div class="worksheet-wrapper">
      <?php include("../includes/fetchWorksheets.php")?>
  </div>
  </div>
  
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>

    if (performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD) {
            window.location.reload();
    }
        document.addEventListener('DOMContentLoaded', function() {

        const images = document.querySelectorAll('.worksheet-image');

        images.forEach(image => {
            image.addEventListener('load', function() {
                const worksheetDiv = image.parentElement.parentElement;
                worksheetDiv.classList.remove('worksheetLoad');
            });
        });

        const worksheetTitles = document.querySelectorAll('.worksheet-title');

        worksheetTitles.forEach((p_el)=>{
          p_el.classList.add('textLoad')
          images.forEach((img)=>{
            img.addEventListener('load',function(){
              p_el.classList.remove('textLoad')
            })
          })
        }) 
    });


    function sendWorksheetId(getParent){
      const sendData = getParent.firstElementChild.href;
      const filename = sendData.split('/').pop();
      fetch('../includes/saveWorksheets.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ url: filename })
        }
      )
      .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('worksheet saved successfully!');
          } else {
            alert('Error saving worksheet: ' + data.error);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        }); 
    }


    const worksheets = document.querySelectorAll('.worksheet-image');

worksheets.forEach((worksheet) => {
    worksheet.addEventListener('mouseover', () => {
        const getParent = worksheet.parentElement.parentElement;

        // Prevent duplicates
        if (!getParent.querySelector('.add-icon')) {
            const icon = document.createElement('img');
            icon.src = '../icons/star.png';
            icon.classList.add('add-icon');

            // Style the icon as needed
            icon.style.position = 'absolute';
            icon.style.top = '10px';
            icon.style.right = '10px';
            icon.style.cursor = 'pointer';

            getParent.appendChild(icon);

            // Prevent icon from disappearing when hovered
            icon.addEventListener('mouseover', () => {
                icon.style.opacity = '1';
                icon.classList.add('icon-hover')
            });

            icon.addEventListener('mouseleave',e=>{
              icon.classList.remove('icon-hover')
            })

            // Add click event to the icon
            icon.addEventListener('click', () => {
                // alert('Added to saved materials');
                // add here to saved 
                sendWorksheetId(getParent)
            });

            // Add a mouseleave event to the parent to remove the icon when leaving the parent div
            getParent.addEventListener('mouseleave', () => {
                icon.remove();
            });
        }
    });
});
    

    </script>
  </body>
</html>