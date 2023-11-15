$(document).ready(function() {
  $('#login').click(function(e) {
    if($('#name').val() == '') {
      e.preventDefault();
    }
  });

  $('#submit').click(function(e) {
    e.preventDefault();

    if($('#usrmsg').val() == '') {
      e.preventDefault();
    } else {
      var msg = $('#usrmsg').val();

      $.ajax({
        url: 'src/post.php',
        type: 'POST',
        data: {text: msg},
        cache: false,
        success: function() {
          $('#usrmsg').val('');
        },
      });
    }
  });

  function loadChat() {
    var oldScrollHeight = $('.chatbox')[0].scrollHeight - 20;

    $.ajax({
      url: 'log.html',
      type: 'GET',
      cache: false,
      success: function(html) {
        $('.chatbox').html(html);

        var newScrollHeight = $('.chatbox')[0].scrollHeight - 20;

        if(newScrollHeight > oldScrollHeight) {
          $('.chatbox').animate({scrollTop: newScrollHeight}, 'normal');
        }
      },
    });
  }

  setInterval(loadChat, 10);

  $('#exit').click(function() {
    window.location = 'index.php?logout=true';
  });
});