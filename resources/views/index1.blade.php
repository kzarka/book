

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <link href="/css/vendor/jquery.ui.css" rel="stylesheet">
    <link href="/css/steve-jobs.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <script type="text/javascript" src="/js/vendor/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/vendor/jquery-ui-1.8.20.custom.min.js"></script>
    <script type="text/javascript" src="/js/vendor/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="/js/vendor/modernizr.2.8.3.min.js"></script>
    <script type="text/javascript" src="/js/vendor/hash.js"></script>
    <script type="text/javascript" src="/js/turnjs/turn.min.js"></script>
    <script type="text/javascript" src="/js/steve-jobs.js"></script>
    <script type="text/javascript" src="/js/book/book.js"></script>
</head>
<body>

<div id="canvas">
        <div class="sj-book">
            <div depth="5" class="hard"><div class="side"></div> </div>
            <div depth="5" class="hard front-side"> <div class="depth"></div> </div>
            <div class="hard fixed back-side p51 plast1"> <div class="depth"></div> </div>
            <div class="hard p52 plast2"></div>
        </div>
    <div id="slider-bar" class="turnjs-slider">
        <div id="slider"></div>
    </div>
</div>

<script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '290',
          width: '410',
          videoId: 'Z2JL9jKle5g',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
        }
      }
      function stopVideo() {
            player.stopVideo();
      }
    </script>
</body>
</html>