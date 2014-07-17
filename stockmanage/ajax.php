<?php
include '../../config/config.inc.php';
include '../../init.php';

$post=Tools::getValue('stock');

foreach($post as $id_product=>$stocks)
{
   if(is_array($stocks))
   {
     foreach($stocks as $id_product_attribute=>$value)
	 {
	   $query="update ps_stock_available set quantity=".$value." where id_product=".$id_product." and id_product_attribute=".$id_product_attribute;
	   
	   DB::getInstance()->execute($query);
	 }
   
   }
   else
   {
     $query="update ps_stock_available set quantity=".$stocks." where id_product=".$id_product;
	  DB::getInstance()->execute($query);
   }
}
echo 'success';
?>