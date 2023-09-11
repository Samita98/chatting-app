$(document).ready(function() {
    setInterval(function() {
        loadXMLDoc();
     }, 1000)
    //loadXMLDoc();

    $("#send_msg_btn").click(function(event) {
        event.preventDefault();
      //  $(document).scrollTop($(document).height());
        var fromuser_id = $("#fromuser_id").val();
        var touser_id = $("#touser_id").val();
        var messages = $("#messages").val();


        $.ajax({
            url: "sendmessage.php",
            type: "POST",
            async: false,
            data: {
                "fromuser_id": fromuser_id,
                "touser_id": touser_id,
                "messages": messages

            },
            success: function(data) {
                loadXMLDoc();
               // if (data != "") scrollDown();
                $("#messages").val('');
            }
        });
    })

});

function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    // xhttp.responseType = 'json';
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         //   if (xhttp.response != "") scrollDown();
            $('#chatbox').html(xhttp.response);
        }
    };
    xhttp.open("GET", "getmessage.php?fromuser_id=" + fromuser_id + "&& touser_id=" + touser_id, true);
    xhttp.send();
}