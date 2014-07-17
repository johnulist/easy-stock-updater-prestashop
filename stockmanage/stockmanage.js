$(document).ready(function(){

function convertTotable(result)
{
var output='<table class="table"><tr><th>Product Id(Combination ID)</th><th>Product/combination Name</th><th>In Stock</th></tr>';
$.each(result['products'],function(key,value){

  if(value['combinations']=="")
  {
  output = output + '<tr><td>'+value['id_product']+'</td><td>' + value['name'] + '</td><td><input type="text" value="'+value['stock'][0]+'" name="stock['+value['id_product']+']"></td></tr>';
 }
 else
 {
     $.each(value['combinations'],function(ks,values){
	      //console.log(values);
		  var keys=values['id_product_attribute'];
		
	  output = output + '<tr><td>'+value['id_product']+'('+keys+')</td><td>' + value['name'] + ' ' + values['attributes'] + '</td><td><input type="text" value="'+value['stock'][keys]+'" name="stock['+value['id_product']+']['+keys+']"/></td></tr>';
	  
	 });
 }
  
 
});

output= output+ '</table>';

$("#result_products").html(output);

}



$("#seach_product").keypress(function(){   
  
   var keyword=$(this).val();
   
   if(keyword.length>1)
   {   
        $("#stock_loader").show();
		$.ajax({
		type:'post',
		dataType: 'json',
		url:'index.php?controller=AdminOrders&token='+window.token_admin_orders,
		data:{
		'product_search' : keyword,
		'token' : window.token_admin_orders,
		'ajax': 1,
		'tab': 'AdminOrders',
		'action':'searchProducts'
		}
		}).done(function(response){
		   convertTotable(response);
		   $("#stock_loader").hide();
		});
   }

});


$("#update_stock").click(function(){

$("#stock_loader_update").show();
   $.ajax({
		type:'post',
		url:'/modules/stockmanage/ajax.php',
		data:$("#update_stock_form").serialize()
		}).done(function(response){
		
		console.log(response);
		 if(response=='success')
		{
		 $("#stock_loader_update").hide();
		}
		else
		{
		$("#stock_loader_update").hide();
		 $("#error").html("Some technical error. Please try again");
		}
		  
		});


});

});
