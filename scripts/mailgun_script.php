<?php
  require('../keys/mailgun_keys.php');

  $user_uri       = $_GET['uri'];
  $user_name      = $_GET['nam'];
  $email          = $_GET['ema'];
  $contact_number = $_GET['num'];
  $subject        = $_GET['sub'];
  $content        = $_GET['bod'];

  $url            = 'https://api.mailgun.net/v3/' . MG_DOMAIN . '/messages';
  $from           = 'Pastbook Support Team <' . MG_STAFF . '>';
  $to             = $user_name . '<' . $email . '>';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:' . MG_KEY);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'from' => $from,
        'to' => $to,
        'subject' => $subject,
        'text' => $content . " Contact Number: " . $contact_number));

  $curl_exec = curl_exec($ch);

  $info = curl_getinfo($ch);

  if($info['http_code'] != 200)
        error("Error");
  else {
    echo "Success!";
  }

  curl_close($ch);
  //$json = json_decode($curl_exec);
  //return $json;*/
?>
