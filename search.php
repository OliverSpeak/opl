<?php
  // For dev insight, remove all '//##' tags and disable header().
  // /search?term={term}&reading={reading} <- URI
  error_reporting(E_ALL & ~E_NOTICE);
  ini_set("display_errors", 1);

  // Process url query
  $term = $_GET['term'];
  $reading = $_GET['reading'];
  // Create $list - an array of all audio files, with just the words as the string
  $list = scandir("assets/audio/");
  $excessfiletext = array('pronunciation_ja_','.mp3');
  for ($i = 0; $i < sizeof($list); $i++) {
    $list[$i] = str_replace($excessfiletext,"",$list[$i]);
  }
  // Replace $list diacritics (濁点) with friendly counterparts because there's a dumb nuance when kana is processed by PHP (different byte values).
   $bad_diacritic = array('が','ぎ','ぐ','げ','ご','ば','び','ぶ','べ','ぼ','だ','ぢ','づ','で','ど','ざ','じ','ず','ぜ','ぞ','ぱ','ぴ','ぷ','ぺ','ぽ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ'); // Diacrities after processed by PHP
  $good_diacritic = array('が','ぎ','ぐ','げ','ご','ば','び','ぶ','べ','ぼ','だ','ぢ','づ','で','ど','ざ','じ','ず','ぜ','ぞ','ぱ','ぴ','ぷ','ぺ','ぽ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ');
  for ($i = 0; $i < sizeof($list); $i++) {
    $list[$i] = str_replace($bad_diacritic,$good_diacritic,$list[$i]);
  }
  //##print_r($list); echo "<p>Term: ".$term."<p>"."Reading: ".$reading."<p>";

  // Searching 
  $term_result = 0; // Changes to 1 if term result is found.
  $term_answer = 0; // Changes to $term for injecting into $target.

  $reading_result = 0; // Changes to 1 if reading result is found.
  $reading_answer = 0; // Changes to $reading for injecting into $target.

    // Search using $reading
    if(in_array($reading,$list)){
      $reading_answer = $reading;
      $reading_result = 1;
      //##echo $reading;
    }
    foreach($list as $key=>$value){ // For searching words with term and reading (e.g. 前々から_まえまえから)
      $ex_val=explode('_',$value);
      if(count($ex_val) == 2){
        if($reading == explode('_',$value)[0]){
          //##echo 'Reading Result: '.$list[$key];
          $reading_answer = $list[$key];
          $reading_result = 1;
        } else if($reading == explode('_',$value)[1]){
          //##echo 'Reading Result: '.$list[$key];
          $reading_answer = $list[$key];
          $reading_result = 1;
        }
        }
    } 
    //##echo '<p>$reading_result: '.$term_result.'<p>';
  
    // Redirect if a reading result is found
    if ($reading_result ==! 0) {
      $reading_answer_conv = str_replace($good_diacritic,$bad_diacritic,$reading_answer); // Reverts diacritic nuance to match files.
      $target = "https://$_SERVER[HTTP_HOST]/assets/audio/pronunciation_ja_$reading_answer_conv.mp3";
      header('Location: '.$target);
      exit();
    }


  // Search using $term
  if(in_array($term,$list)){
    $term_answer = $term;
    $term_result = 1;
    //##echo $term;
  }
  foreach($list as $key=>$value){ // For searching words with term and reading (e.g. 前々から_まえまえから)
    $ex_val=explode('_',$value);
    if(count($ex_val) == 2){
      if($term == explode('_',$value)[0]){
        //##echo 'Term Result: '.$list[$key];
        $term_answer = $list[$key];
        $term_result = 1;
      } else if($term == explode('_',$value)[1]){
        //##echo 'Term Result: '.$list[$key];
        $term_answer = $list[$key];
        $term_result = 1;
      }
      }
  } 
  //##echo '<p>$term_result: '.$term_result.'<p>';

  // Redirect if a term result is found
  if ($term_result ==! 0) {
    $term_answer_conv = str_replace($good_diacritic,$bad_diacritic,$term_answer); // Reverts diacritic nuance again to match files.
    $target = "https://$_SERVER[HTTP_HOST]/assets/audio/pronunciation_ja_$term_answer_conv.mp3";
    header('Location: '.$target);
    exit();
  }  else {
    exit();
  }
  
?>
