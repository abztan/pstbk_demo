<?php/*
  $ curl -v -XPOST https://api.airtable.com/v0/appIvxQTXX3NOqjYo/airtable_faq_messages \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -H "Content-type: application/json" \
  -d '{
  "fields": {
    "message_id": "1"
  },
  "typecast": true
  }'

  EXAMPLE RESPONSE
  {
    "id": "reck5OsKKOl1zVKNW",
    "fields": {
        "message_id": "1"
    },
    "createdTime": "2017-06-09T16:09:55.000Z"
  }*/

  $key = "keyIbtc6DIW200L24";
  $domain = "appIvxQTXX3NOqjYo";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api_key:'.$key);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, 'https://api.airtable.com/v0/'.$domain.'/airtable_faq_messages');

  $curl_exec = curl_exec($ch);

  $info = curl_getinfo($ch);

  if($info['http_code'] != 200)
        error("Error");
  else {
    echo "Success!";
  }

  curl_close($ch);
?>
