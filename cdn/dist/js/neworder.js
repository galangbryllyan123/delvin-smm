$(document).ready(function(){
  $("#category").change(function(){
    var category = $("#category").val();
    $.ajax({
        url: "require/service.php", // Produk
        data: "category="+category,
        cache: false,
        success: function(msg){
            $("#service").html(msg);
        }
    });
  });
  $("#service").change(function(){
    var service = $("#service").val();
    $.ajax({
        url: "require/min.php", // Produk
        data: "service="+service,
        cache: false,
        success: function(msg){
            $("#min").val(msg);
        }
    });
  });
  $("#service").change(function(){
    var service = $("#service").val();
    $.ajax({
        url: "require/max.php", // Produk
        data: "service="+service,
        cache: false,
        success: function(msg){
            $("#max").val(msg);
        }
    });
  });
  $("#service").change(function(){
    var service = $("#service").val();
    $.ajax({
        url: "require/pricek.php", // Produk
        data: "service="+service,
        cache: false,
        success: function(msg){
            $("#pricek").val(msg);
        }
    });
  });
  $("form#order").submit(function () {
    if ($('#category').val().length > 0 || $('#service').val.length > 1 || $('#data').val.length > 6 || $('#jumlah').val.length > 1) {
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