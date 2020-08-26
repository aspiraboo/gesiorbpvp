$(document).ready(function() {
    var ajaxCall = function() {
        $.get("count.php", function( data ) { $( "#thePlayersOnline" ).html( data ); });
    };
    setInterval(ajaxCall, 30000);
  });