<!DOCTYPE html>
<html lang="en">
<head>
  <title>Assitente Chat</title>
  <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- End JavaScript -->


  <!-- CSS -->
  <link rel="stylesheet" href="/style.css">
  <!-- End CSS -->

</head>

<body>
<div class="chat">

  <!-- Header -->
  <div class="top">
  <img src="https://media.licdn.com/dms/image/v2/C4E03AQGpumbLp5atHw/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1648647886701?e=1734566400&v=beta&t=rOz9QAmDdXN1QQ7_ly21q7zcA2i9l9LuMX7OLSh0t1Q" alt="Avatar" width="100" height="100" style="object-fit: cover;">
    <div>
      <p>Gabriel Macedo</p>
      <small>Online</small>
    </div>
  </div>
  <!-- End Header -->

  <!-- Chat -->
  <div class="messages">
    <div class="left message">
      <img src="https://cdn-icons-png.flaticon.com/512/11743/11743076.png" alt="Avatar">
      <p>Olá, Como Posse Te Ajudar hoje ?</p>
    </div>
  </div>
  <!-- End Chat -->

  <!-- Footer -->
  <div class="bottom">
    <form>
      <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
      <button type="submit"></button>
      <button type="button" id="voiceBtn">🎤</button>
    </form>
  </div>
  <!-- End Footer -->

</div>
</body>

<script>
  //Initialize Speech Recognition
  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  const recognition = new SpeechRecognition();

  recognition.onresult = function(event) {
    const transcript = event.results[0][0].transcript;
    $('#message').val(transcript);
    $("form").submit();
  };

  recognition.onerror = function(event) {
    console.error("Speech recognition error", event.error);
  };

  $('#voiceBtn').on('click', function() {
    recognition.start();
  });

  //Broadcast messages
  $("form").submit(function(event) {
    event.preventDefault();

    //Stop empty messages
    if ($("form #message").val().trim() === '') {
      return;
    }

    //Disable form
    $("form #message").prop('disabled', true);
    $("form button").prop('disabled', true);

    $.ajax({
      url: "/chat",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      },
      data: {
        "model": "gpt-3.5-turbo",
        "content": $("form #message").val()
      }
    }).done(function(res) {
      //Populate sending message
      $(".messages > .message").last().after('<div class="right message">' +
        '<p>' + $("form #message").val() + '</p>' +
        '<img src="https://media.licdn.com/dms/image/v2/C4E03AQGpumbLp5atHw/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1648647886701?e=1734566400&v=beta&t=rOz9QAmDdXN1QQ7_ly21q7zcA2i9l9LuMX7OLSh0t1Q" alt="Avatar" width="100" height="100" style="object-fit: cover;">' +
        '</div>');
        
      //Populate receiving message
      $(".messages > .message").last().after('<div class="left message">' +
        '<img src="https://cdn-icons-png.flaticon.com/512/11743/11743076.png" alt="Avatar">' +
        '<p>' + res + '</p>' +
        '</div>');

      //Cleanup
      $("form #message").val('');
      $(document).scrollTop($(document).height());

      //Enable form
      $("form #message").prop('disabled', false);
      $("form button").prop('disabled', false);
    });
  });

</script>
</html>
