<footer class="footer">
         <div class="top">
            <?php wp_nav_menu( ['menu' => '6', 'container_class' => 'navigation', 'menu_class' => 'menu-wp',]);?>
         </div>
         <div class="bottom">
         <?php the_custom_logo();?>
            <div class="partners">
                <img class="banner" src="<?php bloginfo('template_url') ?>/assets/images/partners.png" alt="">
            </div>
            <?php wp_nav_menu( ['menu' => '5', 'container' => 'false', 'menu_class' => 'menu-wp',]);?>
         </div>
      </footer>


    </div>
   <script>
      document.querySelector('.burger').addEventListener('click', function() {
         this.classList.toggle('active');
         document.querySelector('.navigation.mobile').classList.toggle('open');
         document.querySelector('.manual.mobile').classList.toggle('open');
         document.querySelector('.bottom').classList.toggle('open');
      })
   </script>
   <?php wp_footer();?>
</body>
</html>