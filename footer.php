</div>
<footer>
<div class="wrap">
	<?php if ( get_field( 'copyright', 'options' ) ): ?>
	<div class="copyright">
		Copyright &copy; <?php echo date( "Y" ); ?> <?php the_field( 'copyright', 'options' ); ?>
	</div>
	<?php endif; ?>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>