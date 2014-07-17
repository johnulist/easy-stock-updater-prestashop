<?php

class StockManage extends Module
{ 
    private $html;	
	private $_postErrors = array();
	
	public function __construct()
	{
		$this->name = 'stockmanage';
		$this->tab = 'administration';
		$this->version = '1.0';
		$this->author = 'Mathan raj';

		parent::__construct();

		$this->displayName = $this->l('Stock Management Easy');
		$this->description = $this->l('Easily manage all product stock in single page.');
	}


	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
 	$this->context->controller->addJS($this->_path.'stockmanage.js');
 	$this->context->controller->addCSS($this->_path.'stockmanage.css');
		$this->_html='<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Update stock').'</legend>
				<label>'.$this->l('Search product').'</label>
				<div class="margin-form">';
				
				$this->_html.='<input type="text" id="seach_product" name="search_product"/>';
				$this->_html.='<span id="stock_loader"><img src="'.$this->_path.'16.GIF"/></span>';
				
				
		$this->_html.='</div></fieldset></form>';	
		$this->_html.='<br /><fieldset>
		<input type="button" id="update_stock" value="Update Stock"/><span id="stock_loader_update"><img src="'.$this->_path.'16.GIF"/></span>
		<div id="error"></div>
		<form id="update_stock_form" action="" method="post">
		<div id="result_products">
				
		</div></form></fieldset><br />';	
     return $this->_html;		
	}

	public function install()
	{
		if(parent::install() == false || $this->registerHook('displayBackOfficeHeader') == false)
			return false;
		return true;
	}
    
	

}

