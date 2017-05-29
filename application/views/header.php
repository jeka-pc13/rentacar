<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>publico/">Vale Rent a Car</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php echo setMenuActiveItem($active_menu=='home')?>>
          <a href="<?php echo base_url();?>publico/home/">Home</a>
        </li>
        <li <?php echo setMenuActiveItem($active_menu=='about')?>>
          <a href="<?php echo base_url();?>publico/sobre/">Sobre</a>
        </li>
        <li <?php echo setMenuActiveItem($active_menu=='books')?>>
          <a href="<?php echo base_url();?>frota/pesquisa/">Frota automóvel</a>
        </li>
        <li <?php echo setMenuActiveItem($active_menu=='contact')?>>
          <a href="<?php echo base_url();?>publico/contacto/">Contacto</a>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>