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

  if(!$_SESSION['username']) {
    $error = 1;
    if(password_verify($_POST['password'], fromDatabase($_POST['username'])['password'])) {
      $message = "You have successfully signed in as ".$_POST['username'];
      $error = 0;
    }
    else {
      if($_POST['username'] != "forum_json") {
        if(empty(fromDatabase($_POST['username']))) {
          toDatabase($_POST['username'], json_encode(array('password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'id' => time())));
          $message = "You have successfully registered as ".$_POST['username'];
          $error = 0;
        }
        else {
          $message = "That name is taken!";
        }
      }
      else {
        $message = "Nice try, friend!";
      }
    }
    if(!$error) {
      $_SESSION['username'] = $_POST['username'];
      header('location:/?type=account&username='.$_SESSION['username']);
    }
    else {
      header('location:/?type=login&message='.urlencode($message));
    }
  }
  else {
    if($_GET['logout'] == 'true') {
      session_destroy();
      header('location: /?type=login');
    }
    elseif($_GET['deleteAccount'] == 'true') {
      toDatabase($_SESSION['username'], '');
      session_destroy();
      header('location: /?type=login&message=You+have+successfully+deleted+your+account.');
    }
    elseif($action = $_POST['action']) {
      if($action['dest'] == 'account') {
        if($action['type'] == 'modify') {
          foreach($action['data'] as $key => $value) {
            if($key == 'password') {
              $action['data'][$key] = password_hash($value, PASSWORD_DEFAULT);
            }
          }
          $userdata = fromDatabase($_SESSION['username']);
          $userdata = array_merge($userdata, $action['data']);
          toDatabase($_SESSION['username'], json_encode($userdata));
          echo json_encode($action);
        }
        elseif($action['type'] == 'delete') {
          toDatabase($_SESSION['username'], '');
          session_destroy();
          echo "Deleted account successfully.";
        }
        elseif($action['type'] == 'logout') {
          session_destroy();
          echo "Logged out successfully.";
        }
      }
      elseif($action['dest'] == 'forum') {
        if($action['type'] == 'modify') {
          $forumdata = fromDatabase("forum_json");
          $forumdata = array_merge($forumdata, $action['data']);
          toDatabase('forum_json', json_encode($forumdata));
        }
      }
    }
    else {
      header('location:/?type=login&message=You+are+already+signed+in+as+'.$_SESSION['username'].'!');
    }
  }

  ob_end_flush();
?>