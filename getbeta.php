<?php
session_start();
include("connect.php");
include("function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pocket Fighters | Request Beta</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  
  
  
  
<link rel="apple-touch-icon" sizes="57x57" href="fav/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="fav/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="fav/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="fav/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="fav/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="fav/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="fav/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="fav/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="fav/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="fav/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="fav/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
<link rel="manifest" href="fav/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="fav/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">  
  
<meta name="twitter:title" content="Pocket FighterZ ">
<meta name="twitter:description" content="Play and grind! Beat players and bosses! And get rewarded!!!!! Come on while its free!">
<meta name="twitter:image" content="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/social/social.png">
<meta name="twitter:card" content="summary_large_image"> 
  
<meta property="og:url" content="<?php echo $CurPageURL; ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Pocket FighterZ" />
<meta property="og:description" content="Play and grind! Beat players and bosses! And get rewarded!!!!! Come on while its free!" />
<meta property="og:image" content="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/social/social.png" /> 

<meta property="og:image" content="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/sprites/bg/Tower1.png" /> 
	<meta property="og:image:width" content="1200"/>
	<meta property="og:image:height" content="630"/>	
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4346027402657123"
     crossorigin="anonymous"></script>  
<meta name="description" content="Play and grind! Beat players and bosses! And get rewarded!!!!! Come on while its free!">
<meta name="robots" content="index,follow">  
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L70CN7PG1X"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-L70CN7PG1X');
</script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src='logo.png'>
  </div>
<div id="notibar">

</div>
<?php
if($_GET['error']==1)
{
  ?>
<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i> Please login before accessing that page.</li></ul></div>
  <?php
}
?>
  <!-- /.login-logo -->
  <div class="card">



    <div class="card-body login-card-body">
      <p class="login-box-msg">Here where you can request beta-keys (Take note it is limited).</p>


        <div class="input-group mb-3">
          <input id='email' type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button" onclick="processemail()"  class="btn btn-primary btn-block">Request Betakey</button>
          </div>
          <!-- /.col -->
        </div>


      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>



  <script>
  function processemail()
  {
    var email = $('#email').val();
    $('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Please wait.. Checking your acccount.</li></ul></div>');

    $.post("action/process-betakey.php",{email:email}, function(data, status){
    //alert(data);
    $('#notibar').html('');
    if(data=="0")
    {
      $('#notibar').html('<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i>Currently No Betakey Available.</li></ul></div>');
    }
    if(data=="1")
    {
      $('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i> Betakey will sent to email.</li></ul></div>');
    }
    });   
  }
  </script>
</body>
</html>
