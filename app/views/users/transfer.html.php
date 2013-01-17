<?php
if(isset($error)){
?>
<div class="alert alert-error">
<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Unsuccessful transfer</h4>
	<p><?=$error['message']?></p>
</div>
<?php }?>
<?php
if(isset($success)){
?>
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Transfered</h4>
	<p>Amount transfered to <?=$success?>. It may take about 10 to 20 minutes to reflect in the new account. </p>
</div>
<?php }?>

<h4>Transfer</h4>
<p>You can transfer a maximum of <strong><?=number_format($wallet['wallet']['balance'],8)?></strong> your funds to any other bitcoin address.</p>
<p>Transaction fees may be included with any transfer of Bitcoins. Many transactions are processed in a way which makes no charge for the transaction. For transactions which consume or produce many coins (and therefore have a large data size), a small transaction fee is usually expected. </p>
<?=$this->form->create("",array('url'=>'/users/transfer/')); ?>
<?=$this->form->field('amount', array('label'=>'Amount','placeholder'=>'0.1' )); ?>
<?=$this->form->field('address', array('label'=>'Bitcoin Address','placeholder'=>'Bitcoin address')); ?>
<?=$this->form->field('verifyAddress', array('label'=>'Verify Bitcoin Address','placeholder'=>'Bitcoin address')); ?>
<?=$this->form->field('comment', array('label'=>'Comment','placeholder'=>'comment')); ?>
<?=$this->form->hidden('maxAmount', array('value'=>number_format($wallet['wallet']['balance'],8))); ?>
<?=$this->form->submit('Transfer',array('class'=>'btn btn-primary','OnClick'=>'return CompareAmount();')); ?>
<?=$this->form->end(); ?>