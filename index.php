<?php 
    $page="";
    if(isset($_GET["page"]))
    {
        $page=$_GET["page"];
    }
    else
    {
        $page="about";
    }


    /* Page map
    *  pages[page_from_GET][n]
    *  n=0 : page containing content
    *  n=1 : Argument for uuuMenuSetBreadcrumbs
    */
    $pages = Array(
        "about" => Array("about.htm","About"),
        "accommodation" => Array("accommodation.htm","Accommodation"),
        "contact" => Array("contact.htm","Contact"),
        "competitions" => Array("competitions.htm","Competitions"),
        "dylan" => Array("dylan.htm","Dylan"),
        "events" => Array("events.htm","Events"),
        "food" => Array("food.htm","Food"),
        "registration" => Array("registration.htm","Registration"),
        "results" => Array("results.htm","Results"),
        "location" => Array("location.htm","Location")
        );

    //Hacky check
    $validPage=false;
    if(strlen($page) > 0)
    {
        /* Walk through supported
        *  pages and check we're being asked for
        *  a valid page.
        */
        $validPage=false;
        foreach($pages as $key => $value)
        {
            if($key == $page)
            {
                $validPage=true;
                break;
            }
        }

        if(! $validPage)
            $page="about";
    }
?>
<!DOCTYPE html>
<!--[if lte IE 7]> <html lang="en-GB" class="no-js lte-ie7"> <![endif]-->
<!--[if IE 8]> <html lang="en-GB" class="no-js ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en-GB" class="no-js ie9"> <![endif]-->
<!--[if IE 10]><!--> <html lang="en-GB" class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="favicon.ico">
    <title>British Unicycle Convention 2013 | Cardiff</title>
    <!--[if lt IE 9]>
    <script src="js/html5shiv/html5shiv.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Fjalla+One|Rambla' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery/jquery-1.8.3.min.js"><\/script>')</script>
  </head>
  <body>
  <script src="js/uuu-menu/uuu-menu.js"></script>
  <script>
  $(document).ready(function()
  {
    /* Set Default menu setup */
    uuuMenuSetBreadcrumbs('<?php echo($pages[$page][1]);  ?>');
  });
  </script>
        <div id="container">
          <header>
            <div id="uuu_logo">
              <div id="reginfo"><p>Registration is now CLOSED</p></div>
              <div id="social_container">
              <a href="https://www.facebook.com/theunionofukunicyclists"><img src="img/facebook-icon.png"></a>
              <a href="https://twitter.com/UUUnicyclists"><img src="img/twitter-icon.png"></a>
              <a href="http://www.nofitstate.org/community"><img src="img/nofitstate-logo-small.png"></a>
              <a href="http://www.unicycle.uk.com/"><img src="img/udc-logo.png"></a>
              <a href="http://www.voodoounicycles.com"><img src="img/voodoo-logo.png"></a>
              </div>
            </div>
          </header>

          <nav>
            <ul id="top_level_nav">
              <li><a href="?page=about">About</a>
              </li>

              <li><a href="?page=accommodation">Accommodation</a>
              </li>
              <li><a href="?page=contact">Contact</a>
              </li>
              <li><a href="?page=competitions">Competitions</a>
              </li>
              <li><a href="?page=dylan">Dylan</a>
              </li>
              <li><a href="?page=events">Events</a>
              </li>
              
              <li><a href="?page=food">Food</a>
              </li>
              
              <li><a href="?page=location">Location</a>
              </li>
              <li><a href="?page=results">Results</a>
              </li>
            </ul>
          </nav>
          <section id="content">
          <noscript id="noscript_msg">We've detected Javascript is disabled in your browser. To get the best experience using this website please enable Javascript.
          </noscript>
          <?php include($pages[$page][0]); ?>
          </section>
        
        </div>
        <footer>
        &copy; Copyright 2013 Union of UK Unicyclists</br>
        <a href="https://github.com/delcypher/buc2013-website">Get the source code</a>
        </footer>
  </body>
</html>
