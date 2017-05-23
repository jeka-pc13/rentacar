<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('setMenuActiveItem'))
{	
	/**
	 * Sets the menu item active
	 *
	 * @return  string  add a css class to the item
	 */
	function setMenuActiveItem($flag = false)
	{	
		if($flag){
			return 'class="active"';
		}else{
			return '';
		}
	}   
}