    <?php
    // http://localhost/opl.php/search?term={term}&reading={reading}

    // Process url query
    $url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $term = $_GET['term'];
    $reading = $_GET['reading'];
    // Create $list - an array of all audio files, with just the words as the string
    $list = scandir("assets/audio/");
    $excessfiletext = array('pronunciation_ja_','.mp3');
    for ($i = 0; $i < sizeof($list); $i++) {
      $list[$i] = str_replace($excessfiletext,"",$list[$i]);
    }
    // Replace $list diacritics (濁点) with friendly counterparts because there's a stupid nuance when processed by PHP
     $bad_diacritic = array('が','ぎ','ぐ','げ','ご','ば','び','ぶ','べ','ぼ','だ','ぢ','づ','で','ど','ざ','じ','ず','ぜ','ぞ','ぱ','ぴ','ぷ','ぺ','ぽ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ'); // Diacrities after processed by PHP
    $good_diacritic = array('が','ぎ','ぐ','げ','ご','ば','び','ぶ','べ','ぼ','だ','ぢ','づ','で','ど','ざ','じ','ず','ぜ','ぞ','ぱ','ぴ','ぷ','ぺ','ぽ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ');
    for ($i = 0; $i < sizeof($list); $i++) {
      $list[$i] = str_replace($bad_diacritic,$good_diacritic,$list[$i]);
    }
    print_r($list);
    echo "<p>Term: ".$term."<p>"."Reading: ".$reading."<p>";

    $result = 0; // Changes to 1 if any result is found.
    $term_result = 0; // Changes to term.
    $reading_result = 0;

    // Search using Term

    if(in_array($term,$list)){
      $term_result = $term;
      $result = 1;
      echo $term;
    }
    foreach($list as $key=>$value){ // For searching words with Term&Reading
      $ex_val=explode('_',$value);
      if(count($ex_val) == 2){
        if($term == explode('_',$value)[0]){
          echo 'Term Result: '.$list[$key];
          $term_result = $list[$key];
          $result = 1;
        } else if($term == explode('_',$value)[1]){
          echo 'Term Result: '.$list[$key];
          $term_result = $list[$key];
          $result = 1;
        }
        }
    } 
    echo '<p>$result: '.$result.'<p>';

    // Redirect if a result is found
    if ($result ==! 0) {
      $target = "http://$_SERVER[HTTP_HOST]/opl/assets/audio/pronunciation_ja_$term_result.mp3";
      echo '$target: '.$target;
      header('Location: '.$target);
      exit();
    }
    ?>

<!DOCTYPE html>
<html>
  <head>
      <title>List</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <p>Uh, you're in the back end right now... Follow <a href=/opl>this</a> link to return to the main page.
    <!-- List files in html
    <ul id=audioList>
      <?php
        foreach (glob($dir."*.mp3") as $filename) {
          echo '<li><a href="'.$filename.'">';
          echo substr($filename.'</li>', 13);
        }
      ?>
    </ul>
    -->
  </body>
</html>