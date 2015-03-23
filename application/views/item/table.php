<?php

if(!isset($print)){
	$print = "FALSE";
}
?>
<table class="item-list list table table-hover">
	<thead>
		<tr>
			<th class='count'>CT</th>
			<th class='item-number'>Item#</th>
			<th class='description'>Description</th>
			<th class='category'>Category</th>
			<th class='price currency'>Price</th>
			<th class='total currency'>Total</th>
    			<th class="clear"></th>


		</tr>
	</thead>
	<?php
	$grand_total = 0;
		foreach ( $items as $item ) :
			$buttons = array ();
			$buttons [] = array (
					"text" => "Edit",
					"style" => "edit",
					"class" => "edit-item btn-xs",
					"id" => "edit-item_$item->id",
					"href" => site_url ( "item/edit/$item->id" )
			);
			$buttons [] = array (
					"text" => "Delete",
					"style" => "delete",
					"class" => "delete-item btn-xs",
					"id" =>  "delete-item_$item->id",
					"url" => site_url ( "item/delete/$item->id" ) ,
			);
			$total = strval ( $item->item_count ) * strval ( $item->price );
			?>

		<tr class="list" id="item-row_<?=$item->id?>">
		<td><?=$item->item_count;?></td>
		<td><?=$item->sku;?></td>
		<td><?=$item->description;?></td>
		<td><?=$item->category;?></td>
		<td style="text-align: right"><?=get_as_price($item->price);?></td>
		<td style="text-align: right"><?=get_as_price(strval($item->item_count)*strval($item->price));?></td>

			<? $grand_total += $total;?>

			<td class="clear">
			<?=create_button_bar($buttons); ?>

			</td>
	</tr>


			<? endforeach; 	?>
		 <tr>
		<td style="text-align: right" colspan="6">Total: <span
			id="total_<?=$item->po?>"><?=get_as_price($grand_total);?></span></td>
			<td></td>
	</tr>

</table>