$(document).ready(function () {
    // Work With Us Form Submission
    $("#workWithUsForm").on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "includes/academy/workwithus.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                console.log("✅ Response Received:", response);

                if (response.status === "success") {
                    //alert("Form submitted successfully!");
                    alert(response.message);
                    $("#workWithUsForm")[0].reset();
                    $("#successMessage").text("Your request has been sent!").fadeIn();

                    setTimeout(function () {
                        $("#successMessage").fadeOut();
                    }, 3000);
                } else {
                    alert("Error: " + (response.message || "Something went wrong."));
                }
            },
            error: function (xhr, status, error) {
                alert("There was an error submitting the form.");
                console.log("❌ AJAX Error:", error);
                console.log("🔍 Response Text:", xhr.responseText);
            },
        });
    });



    // Newsletter Signup Form Submission
    $("#signupForm").on("submit", function (event) {
        event.preventDefault();

        let email = $("#emailInput").val().trim();

        if (!email) {
            alert("Please enter a valid email.");
            return;
        }

        $.ajax({
            url: "includes/academy/signUp.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({ email: email }),
            success: function (response) {
                console.log("✅ Newsletter Signup Response:", response);

                if (response.success) {
                    alert("Successfully signed up for the newsletter!");
                    $("#signupForm")[0].reset();
                } else if (response.status_code === 409) {
                    alert("⚠️ " + (response.message || "Email already registered"));
                } else {
                    alert(response.error || "Failed to sign up. Please try again.");
                }
            },
            error: function (xhr, status, error) {
                alert("An error occurred. Please check your connection.");
                console.log(xhr.responseText);
            },
        });
    });

});
