$(document).ready(function() {
    // setInterval(function() {
    //     loadXMLDoc();
    // }, 1000);
    loadXMLDoc();


    $("#search_text").keyup(function() {

        var input = $(this).val();
        // alert(input);
        if (input != "") {
            $.ajax({
                url: "searchuser.php",
                method: "POST",
                data: { input: input },
                success: function(data) {
                    $("#userlist").html(data);
                    $("#userlist").css("dsiplay", "block");
                }

            });
        } else {
            $("#userlist").css("dsiplay", "none");
        }
    });




   



});

function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    // xhttp.responseType = 'json';
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $('#userlist').html(xhttp.response);


        }
    };
    xhttp.open("GET", "userindexfetch.php?u_id=" + u_id, true);
    xhttp.send();
};

