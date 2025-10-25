<?php
/**
 * Footer
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

		
?>

			</main>



				<!-- footer -->
				<footer class="f">
					
					<div class="container">
						
						<?php include locate_template('partials/footer/logo.php', false, false); ?>

						<div class="pb-gutter-y grid gap-48 lg:flex items-start lg:justify-between">
							<?php 
							include locate_template('partials/footer/cta.php', false, false);
							include locate_template('partials/footer/quick-links.php', false, false);
							include locate_template('partials/footer/social.php', false, false);
							include locate_template('partials/footer/contact.php', false, false);
				
							?>
						</div>
					</div>


					<?php include locate_template('partials/footer/utility.php', false, false); ?>
				</footer>
		</div>

		<?php
		wp_footer();
		?>

	</body>
</html>
