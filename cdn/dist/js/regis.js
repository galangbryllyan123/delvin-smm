$(document).ready(function () {
  $('#username').focus();
  $("form#edit").submit(function () {
    if ($('#nama').val().length > 3 || $('#username').val().length > 3 || $('#password').val().length > 3 || $('#level').val.length > 3 || $('#saldo').val.length > 3 || $('#api').val.length > 3) {
      var pdata = $(this).serialize();
      var purl = $(this).attr('action');
      $.ajax({
        url: purl,
        data: pdata,
        timeout: false,
        type: 'POST',
        dataType: 'HTML',
        success: function (hasil) {
          $("input").removeAttr("disabled", "disabled");
          $("button").removeAttr("disabled", "disabled");
          $("#btn-login").html('Submit');
          $("#result").html('' + hasil + '')
        },
        error: function (a, b, c) {
          $("input").removeAttr("disabled", "disabled");
          $("button").removeAttr("disabled", "disabled");
          $("#btn-login").html('Submit');
          $("#result").html('<div class="alert alert-warning" role="alert">' + c + '</div>')
        },
        beforeSend: function () {
          $("input").attr("disabled", "disabled");
          $("#btn-login").html('Loading..');
          $("#result").html('');
          $("button").attr("disabled", "disabled")
        }
      })
    }
    return false
  })
});