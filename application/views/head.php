<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name ="description" content ="<?php echo $page_description??''?>">
  <meta name ="author"      content ="<?php echo $page_description??''?>">
  <link rel="icon" href="../../favicon.ico">

  <!-- Facebook metags -->
  <!-- Twiiter metags  -->
  <!-- Google metags   -->

  <title><?php echo $page_title??''?></title>

  <!-- Bootstrap core CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main style.css -->
  <link href="<?php echo base_url('/assets/css/style.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('/assets/css/theme.min.css')?>" rel="stylesheet">

  <!-- Custom CSS files -->
  <?php if($css_files ?? false){
        foreach ($css_files as $css_file) {?>
    <link href="<?php echo base_url('/assets/css/'.$css_file)?>" rel="stylesheet">
    <?php }
     }?>

  <!-- Jquery 3.2.1  -->
  <script src="<?php echo base_url('/assets/js/jquery-3.2.1.min.js')?>"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>