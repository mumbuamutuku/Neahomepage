$(document).ready(function() {
    $('#workWithUsForm').on('submit', function(e) {
        e.preventDefault();

        // Prepare JSON data
        var formData = {
            fullname: $('#gname').val(),
            email: $('#gmail').val(),
            phone_number: $('#cname').val(),
            country: $('#cage').val(),
            message: $('#message').val()
        };
        // console.log(formData)

        $.ajax({
            url: 'includes/academy/workwithus.php', 
            type: 'POST',
            contentType: 'application/json', 
            data: JSON.stringify(formData), 
            success: function(response) {
                console.log("✅ Response Received:", response);

                var statusCode = response?.body?.status_code;
                console.log(statusCode);

                if (statusCode === 200) {
                    alert('Form submitted successfully!');
                    $('#workWithUsForm')[0].reset();

                    $('#successMessage').text("Your request has been sent!").fadeIn();

                    setTimeout(function() {
                        $('#successMessage').fadeOut();
                    }, 3000);

                } else {
                    alert('Error: ' + (response.body?.error || 'Something went wrong.'));
                }
            },
            error: function(xhr, status, error) {
                alert('There was an error submitting the form.');
                console.log(xhr.responseText);
            }
        });
    });
});
