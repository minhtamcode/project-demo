	</div>
</div>

<a href="#0" class="to-top"></a>

<div id="footer">
	<div class="container">

		<?php if ( is_active_sidebar('footer_sidebar1') ) : ?>
			<div class="eight columns">
				<?php dynamic_sidebar('footer_sidebar1'); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar('footer_sidebar2') ) : ?>
			<div class="eight columns footer-menu">
				<?php dynamic_sidebar('footer_sidebar2'); ?>
			</div>
		<?php endif; ?>

	</div>
</div>

<div id="footer-trigger" class="toggled-up" <?php if (ot_get_option('super_footer') == "off") { ?>style="display:none;"<?php } ?>></div>

<div id="footer-<?php if (ot_get_option('show_footer') != "on") { ?>wrapper<?php } ?>">
	<div class="footer-bg">
		<div class="footer-height">
			<div class="container">
				<div class="footer-container">

					<div class="one-third column">
						<div class="footer-widget">
						<?php if ( is_active_sidebar('footer_overlay1') ) : ?>
							<?php dynamic_sidebar('footer_overlay1'); ?>
						<?php endif; ?>
						</div>
					</div>

					<div class="one-third column">
						<div class="footer-widget">
						<?php if ( is_active_sidebar('footer_overlay2') ) : ?>
							<?php dynamic_sidebar('footer_overlay2'); ?>
						<?php endif; ?>
						</div>
					</div>

					<div class="one-third column">
						<div class="footer-widget">
						<?php if ( is_active_sidebar('footer_overlay3') ) : ?>
							<?php dynamic_sidebar('footer_overlay3'); ?>
						<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
