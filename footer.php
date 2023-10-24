<footer class="footer">
         <div class="top">
            <nav class="navigation">
               <a class="link" href="">Главная</a>
               <a class="link" href="">Расписание</a>
               <a class="link" href="">Монитор</a>
               <a class="link" href="">Дополнительные материалы</a>
               <a class="link" href="">Поддержка</a>
            </nav>
         </div>
         <div class="bottom">
         <?php the_custom_logo();?>
            <div class="partners"></div>
            <a class="phone" href="tel:88007070711">8 (800) <b>707-07-11</b> </a>
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
</body>
</html>