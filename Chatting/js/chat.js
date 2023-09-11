
$(document).ready(function() {

    $("#send_group_chat").click(function(event) {
        event.preventDefault();
        var message = $('#group_chat_message').html();
        var from_id = $("#from_id").val();
        var to_id = $("#to_id").val();


        if (message != '') {

            $.ajax({
                url: "insert.php",
                type: "POST",
                async: false,
                data: {
                    "from_id": from_id,
                    "to_id": to_id,
                    "message": message

                },
                success: function(data) {
                    $('#group_chat_message').html('');
                }
            });
        }
    })
    $("#uploadFile").click(function(event) {
        var image = $('#uploadImage').html();
        alert(suja);
        $('#group_chat_message').html(image);
    });
    

});