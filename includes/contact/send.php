<?php
// Get data from form  
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$to = "mumbuamutuku@gmail.com";
$txt = "Name: " . $name . "\r\nEmail: " . $email . "\r\nMessage: " . $message;
$headers = "From: noreply@demosite.com" . "\r\n" . "CC: somebodyelse@example.com";

if (!empty($email)) {
    if (mail($to, $subject, $txt, $headers)) {
        echo "<script>
                alert('Message sent successfully!');
                window.location.href = '/neagiants/route.php?page=contact';
              </script>";
    } else {
        echo "<script>
                alert('Failed to send message. Please try again.');
                window.location.href = '/neagiants/route.php?page=contact';
              </script>";
    }
} else {
    echo "<script>
            alert('Email is required!');
            window.location.href = '/neagiants/route.php?page=contact';
          </script>";
}
?>
