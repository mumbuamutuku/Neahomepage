<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);

  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "<script>alert('All fields are required!'); window.history.back();</script>";
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format!'); window.history.back();</script>";
    exit;
  }

  $to = "mumbuamutuku@gmail.com";
  $txt = "Name: " . $name . "\r\nEmail: " . $email . "\r\nMessage: " . $message;
  $headers = "From: noreply@neagiants.com" . "\r\n" . "CC: info@neagiants.com";

// if (!empty($email)) {
//     if (mail($to, $subject, $txt, $headers)) {
//         echo "<script>
//                 alert('Message sent successfully!');
//                 window.location.href = '/neagiants/route.php?page=contact';
//               </script>";
//     } else {
//         echo "<script>
//                 alert('Failed to send message. Please try again.');
//                 window.location.href = '/neagiants/route.php?page=contact';
//               </script>";
//     }
// } else {
//     echo "<script>
//             alert('Email is required!');
//             window.location.href = '/neagiants/route.php?page=contact';
//           </script>";
// }
  if (mail($to, $subject, $txt, $headers)) {
    echo "<script>alert('Message sent successfully!'); window.location.href = '/neagiants/route.php?page=contact';</script>";
  } else {
    echo "<script>alert('Failed to send message. Check server mail settings.'); window.history.back();</script>";
  }
}
?>
