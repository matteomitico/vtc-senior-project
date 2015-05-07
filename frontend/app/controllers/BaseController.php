<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		View::share('menu_pages', ['home', 'about', 'products', 'support', 'contact', 'account']);
	}

	protected function make_a_link($value, $target_blank = false)
	{
		$target = ($target_blank) ? 'target="_blank"' : '';
	    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a ' . $target . 'href="$1">$1</a>', $value); 

	}



}
