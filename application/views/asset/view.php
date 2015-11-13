<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// view.php Chris Dart Mar 17, 2015 2:45:59 PM chrisdart@cerebratorium.com
if (! isset ( $inline_edit )) {
	$inline_edit = FALSE;
}
?>

<div>
<?php
$buttons [] = array (
		"text" => "Edit",
		"href" => site_url ( "asset/edit/$asset->id" ),
		"class" => array (
				"edit",
				"dialog" 
		),
		"style" => "edit" 
);
if ($this->ion_auth->in_group(1)) {
	$buttons [] = array (
			"text" => "Delete",
			"href" => site_url ( "asset/delete" ),
			"id" => sprintf ( "delete-asset_%s", $asset->id ),
			"class" => array (
					"asset-delete",
					"delete",
					implode ( " ", get_button_style ( "delete" ) ) 
			) 
	);
}
if (! $is_inline) {
	echo create_button_bar ( $buttons );
}
?>
<h4 class='asset-header' id='asset-header_<?=$asset->id; ?>'>
		<a href="<?php echo site_url("asset/view/$asset->id");?>" id='<?=$asset->id?>'>
<?=$asset->product;?>&nbsp;
<?=$asset->version != ''?$asset->version:"";?>
<?=$asset->name!=''?"&nbsp;($asset->name)":""; ?></a>
	</h4>
	<div class='asset-details' id='details_<?=$asset->id?>'>
		<p>
			<b>Developer:</b>&nbsp;
			<a href="<?=site_url("vendor/view/$asset->vendor_id"); ?>"><?=$asset->vendor?></a>
		</p>
	<?=edit_field("product",$asset->product,"Product","asset",$asset->id);?>
	<?=edit_field("name",$asset->name,"Name","asset",$asset->id);?>
	<?=edit_field("version",$asset->version,"Version","asset",$asset->id);?>
	<?=edit_field("type",$asset->type,"Type","asset",$asset->id);?>
		
<? if(!empty($asset->serial_number)): ?>
	<?=edit_field("serial_number",$asset->serial_number,"Serial Number","asset",$asset->id);?>
<? endif; ?>
<?=edit_field("year_acquired",$asset->year_acquired,"Year Acquired","asset",$asset->id);?>
<?=edit_field("source",$asset->source,"Source","asset",$asset->id);?>
<?=edit_field("purchase_price",number_format($asset->purchase_price,2),"Purchase Price","asset",$asset->id,array("money"=>TRUE));?>
		<p>
<?=edit_field("status",$asset->status,"Status","asset",$asset->id,array("envelope"=>"span"));?>
		
	<? if ($asset->status != "Active" && $asset->status != "Inactive"):?>
   <?php echo edit_field("year_removed",$asset->year_removed," in ","asset",$asset->id,array("envelope"=>"span"));?>
		<?php if ($asset->status == "Sold"):?>
		<?php echo edit_field("sale_price",$asset->sale_price," for ","asset",$asset->id,array("money"=>TRUE,"envelope"=>"span"));?>
		<?php endif;?>
	<?php endif; ?>
	</p>

<? if(get_value($asset,"po")):?>

<p>
			<b>Purchase Order: </b>&nbsp;
			<a href="<?=site_url("po/view/$asset->po");?>"><?=$asset->po;?></a>
		</p>
<? endif; ?>

</div>


	<fieldset class='code-list list'>
		<legend>Codes</legend>
		<div id='codes_<?=$asset->id?>' class="rows code-rows"><?php
		$data ['asset_id'] = $asset->id;
		$data ['codes'] = $asset->codes;
		$this->load->view ( 'code/list', $data );
		
		?>
</div>
	</fieldset>

	<fieldset class="code-list list">
		<legend>Files</legend>
		<div id='files_<?=$asset->id?>' class='rows file-rows'>
<?php
$data['entity_type'] = "asset";
$data ['id'] = $asset->id;
$data ['files'] = $asset->files;
$this->load->view ( 'file/list', $data );
?>
</div>
	</fieldset>
</div>