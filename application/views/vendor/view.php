<?php
$buttons[] = array("text"=>"Edit Vendor","style"=>"edit","class"=>"edit-vendor btn-sm","id"=>"edit-vendor_$order->vendor_id","href"=>site_url("vendor/edit/$order->vendor_id"));
$buttons[] = array("text"=>"View Orders","style"=>"default","class"=>"view-orders btn-sm","id"=>"view-orders_$order->vendor_id","href"=>site_url("vendor/view/$order->vendor_id"));
$buttons[] = array("text"=>"New Order","style"=>"new","class"=>"new-order btn-sm","id"=>"new-po_$order->vendor_id","href"=>site_url("po/create/$order->vendor_id"));


?><fieldset><legend><?=$order->vendor; ?>
</legend>
 <?=create_button_bar($buttons);?>
<div id="vendor-view">
<? if($contact = get_value($order,"contact",FALSE)):?>
<div class="attribute contact"><?=$contact; ?></div>
<? endif; ?>
<? if($address = get_value($order,"address",FALSE)): ?>
<div class='attribute address'><?$address;?>
<? if($locality = get_value($order,"locality",FALSE)): ?>
<br/><?=$order->locality;?>
<? endif; ?>
</div>
<? endif; ?>
<? if($url = get_value($order,"url",FALSE)): ?>
<div class="attribute url">
<a href='$order->url' target='_blank'><?=$url;?></a>
</div>
<? endif; ?>
<? if($phone = get_value($order,"phone",FALSE)): ?>
<div class="attribute phone">
<label for="phone">Phone: </label>
<?=$phone; ?>
</div>
<? endif; ?>
<? if($fax = get_value($order,"fax",FALSE)): ?>
<div class="attribute fax">
<label for="fax">Fax: </label>
<?=$fax; ?>
</div>
<? endif; ?>
<? if($customer_id = get_value($order,"customer_id",FALSE)): ?>
<div class="attribute customer-id">
<label for="customer_id">Customer ID: </label>
<?=$customer_id; ?>
</div>
<? endif; ?>
</div>

</fieldset>