
$(document).ready(function (e) {

    $('#file').on('change', function () {
        var fileName = '';
        fileName = $(this).val();
        $('#file-selected').html(fileName);
    });

    function delayClear() {
        $("#message").empty();
        $("#file").empty();
        $("#file-selected").empty();
    }

    $("#uploadimage").on('submit', (function (e) {
        e.preventDefault();
        $("#message").empty();
        $.ajax({
            url: "ajax_php_file.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data) // A function to be called if request succeeds
            {
                $("#message").html(data);
            }
        });
        setTimeout(delayClear, 3000);
    }));

    var imageCount = 6;
    $("#show-more").click(function () {
        imageCount = imageCount + 3;
        $("#image-container").load("load-images.php", {
            imageNewCount: imageCount
        });
    });

});

