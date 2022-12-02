<?php
  $to = $_POST['to'];
  $subject =  $_POST['title'];
  $message =  $_POST['message'];
  $email = $_POST['email'];
  $headers = "From: $email.\r\n";
mail($to, $subject, $message, $headers);
 ?>
