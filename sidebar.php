
<?php if ( is_active_sidebar( 'wp_calendar' ) ) : ?>
 
 <div id="true-side" class="sidebar">

     <?php dynamic_sidebar( 'wp_calendar' ); ?>
     <hr>
     <?php echo Calendar::getMonth(date('n'), date('Y'), $events); ?>

 </div>



<?php endif; ?>
