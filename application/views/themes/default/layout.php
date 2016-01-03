<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DBlog : Material Style Personal Blog Theme from Wowbootstrap">
    <meta name="author" content="wowbootstrap.com">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Merriweather:400,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,500,400italic,700,700italic,900,900italic,300,300italic,500italic" rel="stylesheet" type="text/css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title?> - CI Blog</title>

    <!-- Bootstrap -->
    <link href="<?php echo $base_assets_url;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design for Bootstrap -->
    <link href="<?php echo $base_assets_url;?>plugins/material-design/css/roboto.min.css" rel="stylesheet">
    <link href="<?php echo $base_assets_url;?>plugins/material-design/css/material-fullpalette.min.css" rel="stylesheet">
    <link href="<?php echo $base_assets_url;?>plugins/material-design/css/ripples.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <link href="<?php echo $base_assets_url;?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Main Css -->
    <link href="<?php echo $base_assets_url;?>main/css/style1.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrapper">
      <?php echo $header;?>
      <section class="main">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
            <?php echo $content;?>
            </div>
            <div class="col-md-4">
            <?php echo $right_sidebar;?>
            </div>
          </div>
        </div>
      </section>
      <?php echo $footer;?>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo $base_assets_url;?>plugins/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $base_assets_url;?>bootstrap/js/bootstrap.min.js"></script>

    <!-- Material Design for Bootstrap -->
    <script src="<?php echo $base_assets_url;?>plugins/material-design/js/material.min.js"></script>
    <script src="<?php echo $base_assets_url;?>plugins/material-design/js/ripples.min.js"></script>
    <script>
      $.material.init();
    </script>

    <?php if(!empty($home_page)):?>
    <script type="text/javascript">

      $(window).scroll(function(){
        if ($(this).scrollTop() > 1){
          $('.top-navbar').removeClass('navbar-transparent');
        }else{
          $('.top-navbar').addClass('navbar-transparent');
        }
      });
    </script>
    <?php endif;?>

    <script type="text/javascript">
      $(document).ready(function () {
          $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
    
    <!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=10765102; 
var sc_invisible=1; 
var sc_security="6f05b87b"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="shopify
analytics" href="http://statcounter.com/shopify/"
target="_blank"><img class="statcounter"
src="http://c.statcounter.com/10765102/0/6f05b87b/1/"
alt="shopify analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
  </body>
</html>