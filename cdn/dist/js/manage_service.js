$(document).ready(function () {
  $('#username').focus();
  $("form#edit").submit(function () {
    if ($('#id').val().length > 0 || $('#api_id').val().length > 0 || $('#api_s_id').val().length > 0 || $('#service_name').val().length > 2 || $('#service_min').val().length > 2 || $('#service_max').val().length > 2 || $('#service_price').val().length > 2 || $('#service_category').val().length > 0 || $('#closed').val().length > 0) {
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