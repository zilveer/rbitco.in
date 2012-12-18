<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License

 */
 use lithium\storage\Session;
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Reserve BitCo.in&gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('/bootstrap/css/bootstrap')); ?>
	<?php echo $this->html->style(array('/bootstrap/css/bootstrap-responsive')); ?>	
	<?php echo $this->html->style(array('/bootstrap/css/docs')); ?>	
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	<?php
	$this->scripts('<script src="/bootstrap/js/jquery.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/application.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-affix.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-alert.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-button.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-carousel.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-collapse.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-dropdown.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-modal.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-popover.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-scrollspy.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-tab.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-tooltip.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-transition.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap-typeahead.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap.js"></script>'); 
	$this->scripts('<script src="/bootstrap/js/bootstrap.min.js"></script>'); 

	?>   		
	<?php echo $this->scripts(); ?>
</head>
<body>
	<div id="container" class="container"  style="width:90%">
		<?php 	echo $this->_render('element', 'header');?>			
		<?php 	echo $this->_render('element', 'ticker');?>					
		<div id="content" class="container"  style="width:90%">
			<?php echo $this->content(); ?>
		</div>
	</div>
		<div id="header">

			<h1>Reserve BitCoin</h1>
		<?php
				$user = Session::read('default');
				print_r($user['username']);
		?>
			<p>User is <?=$this->user->connected()?'':'not'?> connected</p>
		</div>

</body>
</html>