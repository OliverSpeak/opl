<?php include('scripts/head.php') ?>
      <title>Oliver's Pronunciation Library</title>
      <meta name="googlebot" content="notranslate" />
      <meta name="description" content="This is a collection of Japanese pronunciation audio files made to cover words, expressions and onomatopoeia that JapanesePod101 doesn't.">
  </head>
  <body>
    <!-- Background Image -->
    <div>
      <img src="assets/images/otobg.png" alt="Background Image" id="bg">
      <style>
        @media (min-width: 840px) {
        #bg {
          transform: rotate(10deg);
          width: 700px;
          top: -80px;
          right: -10px;
        }
        }
        @media (max-width: 839px) {
        #bg {
          transform: rotate(10deg);
          width: 300px;
          top: -80px;
          right: 50px;
        }
        }
        @media (prefers-color-scheme: dark) {
          #bg {
            opacity: 10%;
          }
        }
      </style>
    </div>
    <div class="secondpage"><h1>Oliver's Pronunciation Library</h1></div>
    <div class=page>  
      <p>This is a collection of Japanese pronunciation audio files made to cover words, expressions and onomatopoeia that JapanesePod101 doesn't (such as 大貧民, 伝家の宝刀, and ふかふか). This library is optimised for use with <a href="https://apps.ankiweb.net">Anki</a>, and can be hooked up to <a href="https://foosoft.net/projects/yomichan">Yomichan</a>.</p>
      <label for="toggle" class="toggle_text"><h3>Further Reading</h3></label>
      <input type="checkbox" id="toggle"/>
      <div class="toggle_reading" id="collapse">
        <p>This library was curated while using Yomichan in conjunction with JMdict. <strong>It is far from comprehensive</strong>, and so should be viewed as a supplemental library.</p>
        <p>Audio files here were derived from <a href="https://forvo.com">Forvo</a>. Having some knowledge in sound design, I've edited a lot of pronunciations to be more consistent and usable in Anki.</p>
        <p>Here are some comparisons between original and edited pronunciations sourced from Forvo.</p>
        <audio><strong>Warning: It seems that your browser does not support the audio element.</strong></audio>
        <div class="audiocomparison">
          <p>期末テスト:</p>
          <audio controls>
            <source src="assets/audio_comparison/期末テスト_original.mp3" type="audio/mpeg">
          </audio>
          <audio controls>
            <source src="assets/audio_comparison/期末テスト_edited.mp3" type="audio/mpeg">
          </audio>
          <p>あんさん:</p>
          <audio controls>
            <source src="assets/audio_comparison/あんさん_original.mp3" type="audio/mpeg">
          </audio>
          <audio controls>
            <source src="assets/audio_comparison/あんさん_edited.mp3" type="audio/mpeg">
          </audio>
          <p>ドット絵:</p>
          <audio controls>
            <source src="assets/audio_comparison/ドット絵_original.mp3" type="audio/mpeg">
          </audio>
          <audio controls>
            <source src="assets/audio_comparison/ドット絵_edited.mp3" type="audio/mpeg"> <!-- The nuance is back!!! -->
          </audio>
        </div>
        <p>Generally, all audio files will peak around -6db, which is consistent with JapanesePod101's audio.</p>
        <p>While this library is curated by myself, I can accept additional pronunciation files provided they meet the basic sound consistency found in this library. Please <a href="https://oliverspeak.com/contact">contact me</a> for this, and preferably include licenses and sources if applicable.</p>
      </div>
      <label for="toggle2" class="toggle_text"><h3>Connect Yomichan to OPL</h3></label>
      <input type="checkbox" id="toggle2"/>
      <div class="toggle_reading2" id="collapse2">
        <style>
          .darkimg {
            display: none;
          }
          @media (prefers-color-scheme: dark) {
            .darkimg {
              display: block;
            }
            .lightimg {
              display: none;
            }
          }
        </style>
        <p>Connecting via Yomichan is simple:
          <ol>
            <li><p>Open Yomichan's settings and navigate to "Configure audio playback sources...".</p><img src="assets/images/pic1.png" alt="Image 1" width="700" class="lightimg"><img src="assets/images/pic1_dark.png" alt="Image 1" width="700" class="darkimg"></li>
            <li><p>Add a new audio source and select Custom URL.</p><img src="assets/images/pic2.png" alt="Image 2" width="700" class="lightimg"><img src="assets/images/pic2_dark.png" alt="Image 2" width="700" class="darkimg"></li>
            <li><p>Input: https://opl.oliverspeak.com/search?term={term}&reading={reading} as the URL.</p><img src="assets/images/pic3.png" alt="Image 3" width="700" class="lightimg"><img src="assets/images/pic3_dark.png" alt="Image 3" width="700" class="darkimg"></li>
          </ol>
          <p>Note that OPL has some words that JapanesePod101 already has, so it's up to you if OPL takes priority over JapanesePod101.</p>
        </p>
      </div>
    </div>
    <style>
      iframe {
        display: block;
        margin: auto;
        margin-top: 20px;
        margin-bottom: 20px;
        width: 700px;
        height: 400px;
        max-width: 84%;
        border: 0px;
        box-shadow: 0px 0px 7px rgb(90, 90, 90);
        background-color: var(--color-body);
      }
    </style>
    <iframe src="list.php" name="Audio List"></iframe>
    <div class="oplfooter">
      <p>Return to <a href="https://oliverspeak.com/">oliverspeak.com</a></p>
      <p>This page is licenced under the Apache License 2.0. The source code can be found <a href="https://github.com/OliverSpeak/opl">here</a>.</p>
      <p>All pronunciations sourced from Forvo are subject to the Forvo Media S.L. license, which can be found <a href="https://forvo.com/license">here</a>.</p>
    </div>
  </body>
</html>
