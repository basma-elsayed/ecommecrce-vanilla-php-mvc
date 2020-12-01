<?php
/**
 * No Result Page
 * 
 */
get_admin_file( "header" );
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo $data; ?>
        </div>
    </div>
</div>

<?php 
get_admin_file( "footer" );