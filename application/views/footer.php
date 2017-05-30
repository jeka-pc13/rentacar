<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="footer text-center">
  <p>Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!-- Custom JS files -->
<?php if($js_files ?? false):?>
  <?php    foreach ($js_files as $js_file): ?>
    <link href="<?php echo base_url('/assets/js/'.$js_file)?>" rel="stylesheet">
  <?php endforeach; ?>
<?php endif; ?>



