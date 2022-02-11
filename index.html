<?php
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

  $user = fromDatabase($_SESSION['username']);
  $vieweduser = fromDatabase($_GET['username']);
  
  if($_GET['type'] == 'account' && !$vieweduser) {
    http_response_code(404);
  }

  if($_GET['type'] == 'forum') {
    $data = fromDatabase("forum_json");
    foreach(json_decode(fromDatabase("forum_json"), true) as $key => $value) {
      $forum_list = $forum_list."<li><h3><a>Test Post</a></h3><p>".$value['username']."</p><small><a class = 'link'>Danjaye</a> &middot; 100 views</small></li>";
    }
  }

  $pages = array("" => array("title" => "Welcome", "chat", "content" => "<h1>Welcome to Mansfield Tyger's Site</h1><p>In order to use the majority of it please <a href = '/?type=login'>log in/sign up</a></p>"), "login" => array("title" => (!$_SESSION['username'] ? "Sign in" : "Account"), "content" => (!$_SESSION['username'] ? ($_GET['message'] ? "<small style = 'color: indianred;border:1px solid indianred;padding:15px;margin-bottom: 20px;font-weight:bold;'>".$_GET['message']."</small>" : "")."<h1>Log In/Sign Up</h1><p>Here, you can make an account or log in to one.</p><form action = 'api.php' method = 'post'><input placeholder = 'Username...' name = 'username'><input placeholder = 'Password...' type = 'password' name = 'password'><button>continue</button></form>" : '<h1>Settings</h1><ul class = "list"><li><a href = "/?type=account&username='.$_SESSION['username'].'">View your profile</a></li><li style = "color: indianred;"><a href = "/api.php?logout=true">Log out</a></li><li style = "color: indianred;"><a href = "/api.php?deleteAccount=true">Delete account</a></li></ul>')), "account" => array("hidden" => true, "title" => "Account", "content" => ($vieweduser ? "<div style = 'display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid lightgray; margin-bottom: 20px;'><div><input type = 'file' accept = 'image/*' id = 'avatar' style = 'display: none;' onchange = 'upload(this.files);'><h1>".$_GET['username']."</h1><ul><li><b>Registered: </b> ".($vieweduser['id'] ? date('m/d/y', $vieweduser['id']) : 'Legacy')."</li></ul></div><label".($_SESSION['username'] == $_GET['username'] ? " for = 'avatar'" : "")." style = 'margin-left:25px;'><img class = 'pfp'".($vieweduser['pfp'] ? " src = '".$vieweduser['pfp']."'" : "")."></label></div><div id = 'bio' onfocusout = 'save(\"account\",\"bio\",this.innerText,function(){\$(\"#bio\").removeAttr(\"contentEditable\")});'>".($vieweduser['bio'] ? $vieweduser['bio'] : "<small>This user doesn't have a biography.".($user == $vieweduser ? " <a onclick = 'this.parentElement.parentElement.contentEditable = \"true\";this.parentElement.remove();'>Make one</a>" : "")."</small></div>") : "<small>User not found</small>")),"forum"=>array("title"=>"Forum","content"=>"<h1>Forum</h1><p>Below you'll find this site's posts, grand and in large quantity.</p><ul class = 'list'>".$forum_list."</ul>"));
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel = 'stylesheet' href = '/style.css' />
    <meta name = 'viewport' content = 'width=device-width,initial-scale=1.0' />
    <title><?php echo $pages[$_GET['type']]['title']; ?></title>
    <script src = '/script.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <nav>
      <?php foreach($pages as $type => $data){if(!$data['hidden']){echo "<a href = '/?type=".$type."'>".$data["title"]."</a>";}} ?>
    </nav>
    <center>
      <main>
        <?php
          if($pages[$_GET['type']]) {
            echo $pages[$_GET['type']]['content'];
          }
          else {
            http_response_code(404);
            echo "<h1>404</h1><p>Spooky... nothing's here!</p>";
          }
        ?>
      </main>
    </center>
  </body>
</html>
