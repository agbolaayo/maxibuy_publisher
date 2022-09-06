<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;
    var pusher = new Pusher('362427b91ad9b94baf10', {
      cluster: 'us2'
    });
    var channel = pusher.subscribe('{{$topic}}');
    channel.bind('Subscriber', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Subscription "{{$topic}}" is successful </h1>
  <p>
   you will receive alert with new data is publish to the topic
<br>  
  </p>
</body>