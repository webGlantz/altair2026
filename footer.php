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
				<footer class="f py-24 lg:py-72">
					
					<div class="container layout-grid gap-24 lg:gap-48 xl:gap-72 items-start">
						
						<div class="f_left col-4 grid gap-24">
							<?php 
							include locate_template('partials/footer/logo-seo.php', false, false); 
							include locate_template('partials/footer/contact.php', false, false);
							?>
						</div>

						<div class="f_right col-4 lg:col-8 grid lg:block gap-24">
							<?php 
							include locate_template('partials/footer/quick-links.php', false, false);
							include locate_template('partials/footer/newsletter.php', false, false);
							include locate_template('partials/footer/utility.php', false, false);
							?>
						</div>
					</div>
					
				</footer>
		</div>

		<?php
		wp_footer();
		?>

	</body>
</html>
