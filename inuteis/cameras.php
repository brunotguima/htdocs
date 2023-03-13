<!DOCTYPE html>
<html>
  <head>
    <title>Reproduzir câmera Hikvision</title>
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/7.14.3/video.js"></script>
  </head>
  <body>
  <video width="640" height="480" controls>
  <source src="rtsp://192.168.0.60:554/user=admin_password=abc123456_channel=1_stream=0.sdp?real_stream" type="video/mp4">
  Seu navegador não suporta o elemento de vídeo.
</video>
    <script>
      var player = videojs('my-player');
    </script>
  </body>
</html>
