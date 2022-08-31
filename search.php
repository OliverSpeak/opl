<?php
  // Version 1.1
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
  }

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
?>
<!DOCTYPE html>
<html>
  <head>
      <title>The Back End - OPL</title>
      <meta name="robots" content="noindex">
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="googlebot" content="notranslate" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link href="css/normalize.css" rel="stylesheet" type="text/css"/>
  </head>
  <style>
    body {
    font-family: "Arial", sans-serif;
    font-size: 1em;
    }
    a:link {
      color: black;
      font-family: "Arial", sans-serif;
    }
    a:visited {
      color: black;
    }
    a:hover {
      text-decoration: none;
    }
  </style>
  <body>
    <p>Welcome to the back end.<br>Your curiosity paid off, for here is a cat!</p>
    <p>&emsp;^•ﻌ•^ฅ - meow</p><p>Follow <a href="/">this</a> link to return to the main page.</p>
  </body>
</html>
