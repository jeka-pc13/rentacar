<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
	<?php $this->load->view('header'); ?>
	<?php $this->load->view($content); ?>
	<?php $this->load->view('footer');?>
</body>