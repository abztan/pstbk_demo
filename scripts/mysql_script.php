<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../keys/mysql_keys.php');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  $stmt = $conn->prepare('INSERT INTO faq_messages (
                        created_timestamp,
                        user_uri,
                        user_name,
                        email,
                        contact_number,
                        message_subject,
                        message_body
                      )
                      VALUES (?, ?, ?, ?, ?, ?, ?)');
  $stmt -> bind_param('sssssss',
              $created_timestamp,
              $uri,
              $name,
              $email,
              $contact_number,
              $subject,
              $body);

  $dt = new DateTime();
  $timestamp = $dt->format('Y-m-d H:i:s');

  $created_timestamp = $timestamp;
  $uri               = $_GET['uri'];
  $name              = $_GET['nam'];
  $email             = $_GET['ema'];
  $contact_number    = $_GET['num'];
  $subject           = $_GET['sub'];
  $body              = $_GET['bod'];

  $stmt->execute();
  $stmt->close();
  $conn->close();
?>
