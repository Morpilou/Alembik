<footer>

  <div class="footer-container">
      <div class="footer-col left-footer-column">
        <div class="footer-widget area-one">
          <?php dynamic_sidebar( 'footer_area_one' ); ?>
        </div>
        <div class="footer-widget area-two">
            <?php dynamic_sidebar( 'footer_area_two' ); ?>
        </div>
      </div>
      <div class="footer-col right-footer-column">
        <div class="footer-widget area-three">
            <?php dynamic_sidebar( 'footer_area_three' ); ?>
        </div>
      </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
