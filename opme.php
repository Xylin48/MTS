<?php
  ob_start();
  session_start();
  error_reporting(E_ERROR | E_PARSE);

  function toDatabase($key, $value) {
    $url = getenv('REPLIT_DB_URL');
    $data = array($key => $value);

    $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
  }

  function fromDatabase($key) {
    $url = getenv('REPLIT_DB_URL');
    return json_decode(file_get_contents($url.'/'.$key), true);
  }

  $userdata = fromDatabase($_SESSION['username']);
  $userdata['permissions'] = 0;
  // here, you can define permission level, read below
  if($_SESSION['username'] == 'bulletsforbrainz@gmail.com') {
    /*
    change above to desired username and have them visit this page, they will be given all permissions 

    levels:
    0 - everything

    other levels are being worked out
    */
    toDatabase($_SESSION['username'], json_encode($userdata));
  }
  echo json_encode(fromDatabase($_SESSION['username']));
?>