<?php if ( get_option( 'other_options_ga' ) ) : ?>
<!-- GAタグ -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option( 'other_options_ga' ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo get_option( 'other_options_ga' ); ?>');
</script>
<?php endif; ?>

<?php echo get_option( 'other_options_headcode' ); ?>