<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<ul class="pagination">
    <?php echo $presenter->render(); ?>
</ul>