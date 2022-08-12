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
          // Create $list - an array of all audio files, with just the words as the string
          $list_temp = scandir("assets/audio/");
          $excessfiletext = array('pronunciation_ja_','.mp3');
            for ($i = 0; $i < sizeof($list_temp); $i++) { 
              $list_temp[$i] = str_replace($excessfiletext,"",$list_temp[$i]);
          }
          // Remove first 2 entries (Because they're . and .. from the directory)
          $list = array_slice($list_temp,2);

          // Replace $list diacritics (濁点) with friendly counterparts because there's a dumb nuance when kana is processed by PHP (different byte values).
           $bad_diacritic = array('が','ぎ','ぐ','げ','ご','ば','び','ぶ','べ','ぼ','だ','ぢ','づ','で','ど','ざ','じ','ず','ぜ','ぞ','ぱ','ぴ','ぷ','ぺ','ぽ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ'); // Diacrities after processed by PHP
          $good_diacritic = array('が','ぎ','ぐ','げ','ご','ば','び','ぶ','べ','ぼ','だ','ぢ','づ','で','ど','ざ','じ','ず','ぜ','ぞ','ぱ','ぴ','ぷ','ぺ','ぽ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ');
          for ($i = 0; $i < sizeof($list); $i++) {
            $list[$i] = str_replace($bad_diacritic,$good_diacritic,$list[$i]);
          }
          // List all files
          foreach ($list as $i) {
            echo '<li><a href="assets/audio/pronunciation_ja_'.$i.'.mp3" target="_blank" rel="noopener noreferrer">'.$i;
          }
      ?>
    </ul>


  </body>
</html>
