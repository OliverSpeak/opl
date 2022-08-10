<!DOCTYPE html>
<html>
  <head>
      <title>List</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/normalize.css" />
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="css/list.css" />
  </head>
  <body>
    <noscript>
      <style>
        /* if Javascript is disabled */
        #search {
          display: none;
        }
      </style>
      <input type="text" id="nojs" placeholder="Search library... (Requires Javascript)"/>
    </noscript>
    <input type="text" id="search" placeholder="Search library..." onkeyup="searchFunction()"/>
    <script>
      // Searching
      function searchFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        ul = document.getElementById("audioList");
        li = ul.getElementsByTagName('li');

        // Loop through list items and hide those that don't match search query
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
    </script>
    <div class="backBit">
    text to show the backbit blah blah blah
    </div>
    
    
    <ul id=audioList>
      <?php
        foreach (glob("assets/audio/*.mp3") as $filename) {
          echo '<li><a href="'.$filename.'" target="_blank" rel="noopener noreferrer">';
          echo substr($filename.'</li>', 13);
        }
      ?>
    </ul>


  </body>
</html>