<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $phone = trim($_POST['phone']);
  $project = trim($_POST['project']);
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);

  if (empty($name) || empty($email) || empty($subject) || empty($message)  || empty($phone) || empty($project)) {
    echo "<script>alert('All fields are required!'); window.history.back();</script>";
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format!'); window.history.back();</script>";
    exit;
  }

  $to = "mumbuamutuku@gmail.com";
  $txt = "Name: " . $name . "\r\nEmail: " . $email . "\r\nMessage: " . $message . "\r\nPhone: " . $phone . "\r\nProject: " . $project;
  $headers = "From: noreply@neagiants.com" . "\r\n" . "CC: info@neagiants.com";

  if (mail($to, $subject, $txt, $headers)) {
    echo "<script>alert('Message sent successfully!'); window.location.href = '/neagiants/health/contact.html';</script>";
  } else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            Swal.fire({
              title: 'Error!',
              text: 'Failed to send message. Check server mail settings.',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then(() => {
              window.history.back();
            });</script>";  
            // alert('Failed to send message. Check server mail settings.'); window.history.back();</script>";
  }
}
?>
