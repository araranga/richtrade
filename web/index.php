<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
?>
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <title>Pocket Fighters: Grind and get rewarded!</title>
    <!--meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <?php
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

 
 ?>
    <meta name="twitter:title" content="Pocket FighterZ ">
    <meta name="twitter:description" content="Play and grind! Beat players and bosses! And get rewarded!!!!! Come on while its free!">
    <meta name="twitter:image" content="
							<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/social/social.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:url" content="
									<?php echo $CurPageURL; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Pocket FighterZ" />
    <meta property="og:description" content="Play and grind! Beat players and bosses! And get rewarded!!!!! Come on while its free!" />
    <meta property="og:image" content="
										<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/social/social.png" />
    <meta property="og:image" content="
											<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/sprites/bg/Tower1.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="../fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
    <link rel="manifest" href="../fav/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L70CN7PG1X"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'G-L70CN7PG1X');
    </script>
    <script>
      addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
        window.scrollTo(0, 1);
      }
    </script>
    <!--//meta tags ends here-->
    <!--booststrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <!--//booststrap end-->
    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
    <!-- //font-awesome icons -->
    <!-- Nav-CSS -->
    <link href="css/nav.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/modernizr.custom.js"></script>
    <!-- //Nav-CSS -->
    <!-- banner -->
    <link rel="stylesheet" type="text/css" href="css/uncover.css" />
    <!--//banner -->
    <!--stylesheets-->
    <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
    <!--//stylesheets-->
    <link href="//fonts.googleapis.com/css?family=Cinzel+Decorative:400,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
  </head>
  <body>
    <div class="header-outs" id="home">
      <div class="header-w3layouts">
        <div class="container">
          <div class="right-side">
            <p></p>
          </div>
          <!-- open/close -->
          <div class="overlay overlay-hugeinc">
            <button type="button" class="overlay-close">Close</button>
            <nav>
              <ul>
                <li>
                  <a href="index.php">Home</a>
                </li>
                <li>
                  <a href="about.php">About</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="hedder-logo">
            <h1>
              <a href="index.php">
                <img src="images/logo.png" class="img-fluid" alt="Responsive image">
              </a>
            </h1>
          </div>
          <!-- /open/close -->
          <!-- /navigation section -->
        </div>
        <div class="clearfix"></div>
      </div>
      <!--banner-->
      <div class="slides text-center">
        <div class="slide slide--current one-img ">
          <div class="slider-up">
            <h4>Pocket FighterZ</h4>
            <h5>POWER <span class="fab fa-d-and-d"></span>UP </h5>
            <div class="outs_more-buttn">
              <a href="/login.php">Join Now</a>
            </div>
          </div>
          <div class="slide__img"></div>
        </div>
        <div class="slide two-img">
          <div class="slider-up">
            <h4>Pocket FighterZ</h4>
            <h5>Be <span class="fab fa-d-and-d"></span>THE ONE </h5>
            <div class="outs_more-buttn">
              <a href="/login.php">Join Now</a>
            </div>
          </div>
          <div class="slide__img"></div>
        </div>
        <div class="slide three-img">
          <div class="slider-up">
            <h4>Pocket FighterZ</h4>
            <h5>Defeat <span class="fab fa-d-and-d"></span>Others </h5>
            <div class="outs_more-buttn">
              <a href="/login.php">Join Now</a>
            </div>
          </div>
          <div class="slide__img "></div>
        </div>
        <div class="slide four-img">
          <div class="slider-up">
            <h4>Pocket FighterZ</h4>
            <h5>Slay <span class="fab fa-d-and-d"></span>Bosses </h5>
            <div class="outs_more-buttn">
              <a href="/login.php">Join Now</a>
            </div>
          </div>
          <div class="slide__img "></div>
        </div>
        <div class="slide five-img">
          <div class="slider-up">
            <h4>Pocket FighterZ</h4>
            <h5>Level <span class="fab fa-d-and-d"></span>Up </h5>
            <div class="outs_more-buttn">
              <a href="/login.php">Join Now</a>
            </div>
          </div>
          <div class="slide__img "></div>
        </div>
        <div class="slide six-img">
          <div class="slider-up">
            <h4>Pocket FighterZ</h4>
            <h5>Get <span class="fab fa-d-and-d"></span>Rewarded </h5>
            <div class="outs_more-buttn">
              <a href="/login.php">Join Now</a>
            </div>
          </div>
          <div class="slide__img "></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <ul class="pagination">
        <li>
          <span class="pagination__item"></span>
        </li>
        <li>
          <span class="pagination__item"></span>
        </li>
        <li>
          <span class="pagination__item"></span>
        </li>
        <li>
          <span class="pagination__item"></span>
        </li>
        <li>
          <span class="pagination__item"></span>
        </li>
        <li>
          <span class="pagination__item"></span>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <!--//banner-->
    <!--Footer -->
    <section class="about-inner py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
        <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Pocket FighterZ</h3>
        <div class="row">
          <div class="col-lg-6 about-txt-left">
            <img src="/sprites/social/social.png" alt=" " class="img-fluid" style='width:100%;margin-top: 34px;'>
          </div>
          <div class="col-lg-6 about-txt-right">
            <div class="jst-wthree-text">
              <h2>What is this? </h2>
            </div>
            <div class="info-sub-w3">
              <p>We created a game which people can grind and level up , by defeating players and hunting boss. Eventually accumulated points can turn into Cash. </p>
              <div class="outs_more-buttn">
                <a href="/login.php">Join Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="feature-inner py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
        <h3 class="title text-center clr mb-lg-5 mb-md-4 mb-sm-4 mb-3">Our Features</h3>
        <div class="row text-center">
          <div class="col-md-4 mt-md-0 mt-4 service-icon-agile">
            <div class="feature-inner ">
              <h5>Speedy Process</h5>
            </div>
            <div class="address-left text-center">
              <span class="fab fa-asymmetrik"></span>
            </div>
            <div class="address-right">
              <p class="pt-2">Get betakey and register. </p>
            </div>
          </div>
          <div class="col-md-4 mt-md-0 mt-5 service-icon-agile">
            <div class="feature-inner">
              <h5>New Avatars</h5>
            </div>
            <div class="address-left text-center">
              <span class="fab fa-android"></span>
            </div>
            <div class="address-right">
              <p class="pt-2">Cute and lovable characters </p>
            </div>
          </div>
          <div class="col-md-4 mt-md-0 mt-5 service-icon-agile">
            <div class="feature-inner">
              <h5>Level Changes</h5>
            </div>
            <div class="address-left text-center">
              <span class="fas fa-reply-all"></span>
            </div>
            <div class="address-right">
              <p class="pt-2">Characters can be upgraded. </p>
            </div>
          </div>
        </div>
        <div class="row text-center mt-lg-4 mt-md-3 mt-3">
          <div class="col-md-4 mt-md-0 mt-5 service-icon-agile">
            <div class="feature-inner ">
              <h5>Customizable</h5>
            </div>
            <div class="address-left text-center">
              <span class="fas fa-cogs"></span>
            </div>
            <div class="address-right">
              <p class="pt-2">Skills, Elements and Names are yours to decide. </p>
            </div>
          </div>
          <div class="col-md-4 mt-md-0 mt-5 service-icon-agile">
            <div class="feature-inner">
              <h5>New Levels / Bosses</h5>
            </div>
            <div class="address-left text-center">
              <span class="fab fa-cloudsmith"></span>
            </div>
            <div class="address-right">
              <p class="pt-2">Boss hunt are daily! </p>
            </div>
          </div>
          <div class="col-md-4 mt-md-0 mt-5 service-icon-agile">
            <div class="feature-inner">
              <h5>Cash out</h5>
            </div>
            <div class="address-left text-center">
              <span class="fas fa-cogs"></span>
            </div>
            <div class="address-right">
              <p class="pt-2">Cashing out is too Easy we use GCASH. </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="select-hero py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-4">
        <h3 class="title text-center  mb-lg-5 mb-md-4 mb-sm-4 mb-3">Latest Characters</h3>
        <div class="state-us ">
          <div class="row">

<style>
.mainchar {
  width: 64px;
  height: 64px;
}

.battle{
	background-position: 263px 384px!important;
}


.death{
	background-position: 64px 64px!important;
}

.pain{
	
background-position: 570px 127px!important;	
}
.win{
	background-position: 256px 63px!important;
}



.card {
    padding: 25px;
}

.col-lg-4.col-md-4.col-sm-4.latest-jewel-grid {
    height: 604px;
}
</style>

<?php

$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users ORDER by id DESC LIMIT 50");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>	

            <div class="col-lg-4 col-md-4 col-sm-4 latest-jewel-grid">
              <figure class="snip1321">

		<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
		<div class='typedataholder'>
			<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
				
				<div class='typesdata <?php echo $tt; ?>'><img src='../sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
			<?php } ?>	
		</div>
		
		   <div class="image" style='margin: 0 auto;'>  
				<div class='mainchar flipme showchar' style='background: url(../actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>		   
		   </div>
		   <h4><?php echo $rowqpokes['pokename']; ?></h4>
		   <p class='idsdata'>ID:#<?php echo $rowqpokes['hash']; ?></p>
		   <span>Level:<?php echo $rowqpokes['level']; ?></span>
		   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
		   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
		   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
		   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
		   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
		   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span><br/>	



		   
			<?php
			$sc = 0;
			$skillq1 = mysql_query_md("SELECT * FROM `tbl_movesreindex` WHERE pokehash='{$rowqpokes['hash']}' ORDER by id ASC");
			while($skillq = mysql_fetch_md_assoc($skillq1)) {
				$sc++;
		   ?>

		   <p>Skill <?php echo $sc; ?>:
		   <img src='../sprites/type/<?php echo strtolower($skillq['typebattle']); ?>.png' style='width:25px;margin-right:1px;'>
		   <?php echo ($skillq['title']); ?>(PWR:<?php echo ($skillq['power']); ?>)
		   </p>
		   <?php
			}
		   ?>		   
   
		   
		   
		</div>
				<figcaption>
				<i class="ion-upload"></i>
				   <?php 
				   $games = $rowqpokes['win'] + $rowqpokes['lose'];
				   
					if(!empty($games)) {
						echo "Win Rate:".number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
						echo "<br>"."W/L:".$rowqpokes['win']."/".$games;
					}


					
				   ?>
	

				</figcaption>			  
              </figure>
            </div>		
		
<?php
	}
?>			  
			  

          </div>
        </div>
      </div>
    </section>
    <footer class="py-2">
      <div class="icons text-center py-md-3 pb-2">
        <ul>
          <li>
            <a href="#">
              <span class="fab fa-facebook-f"></span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="fas fa-envelope"></span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="fas fa-rss"></span>
            </a>
          </li>
          <li>
            <a href="#">
              <span class="fab fa-vk"></span>
            </a>
          </li>
        </ul>
      </div>
      <div class="footer-below text-center">
        <p>©2023 Pocket FighterZ. All Rights Reserved</p>
      </div>
    </footer>
    <!-- //Footer -->
    <!-- js working-->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!--//js working-->
    <!-- For-Banner -->
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/anime.min.js"></script>
    <script src="js/uncover.js"></script>
    <script src="js/demo1.js"></script>
    <!-- //For-Banner -->
    <!--nav menu-->
    <script src="js/classie.js"></script>
    <script src="js/demonav.js"></script>
    <!-- //nav menu-->
    <!-- bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- // bootstrap working-->
  </body>
</html>