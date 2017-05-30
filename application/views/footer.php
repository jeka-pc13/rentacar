<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="footer text-center">
  <p>Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>


<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->



<!-- Custom JS files -->
<?php if($js_files ?? false):?>
  <?php    foreach ($js_files as $js_file): ?>
    <link href="<?php echo base_url('/assets/js/'.$js_file)?>" rel="stylesheet">
  <?php endforeach; ?>
<?php endif; ?>



