<?php 
//var_dump($pic);
//If you need to see what is or isn't available for the pic array, you can always dump it out like above.
?>
<div id="<?php echo $i?>-pic" class="picture">
	<img src="<?php echo $pic['images']['standard_resolution']['url']?>" alt="<?php echo $pic['caption']['text']?>">
</div>