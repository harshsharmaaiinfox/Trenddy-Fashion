<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$footer_columns = 0;

foreach ( range( 1, 4 ) as $i ) {
	if ( is_active_sidebar( 'footer-'. $i ) ){
		$footer_columns++;
	}
}

switch ( $footer_columns ) {
	case '1':
	$footer_class = 'col-sm-12 col-12';
	break;
	case '2':
	$footer_class = 'col-sm-6 col-12';
	break;
	case '3':
	$footer_class = 'col-md-4 col-sm-12 col-12';
	break;
	default:
	$footer_class = 'col-lg-3 col-sm-6 col-12';
	break;
}
$copyright_class = RDTheme::$options['payment_icons'] ? '' : ' copyright-no-payments';
$socials = Helper::socials();

$footer_separator = '';
if ( RDTheme::$options['footer_area'] && $footer_columns && RDTheme::$options['copyright_area'] ) {
	$footer_separator = '<div class="footer-sep"></div>';
}
?>
</div><!-- #content -->

<?php if ( RDTheme::$options['mail_chimp_layout'] ): ?>
	<div class="footer-top-mail-chimp footer-top-layout<?php echo esc_attr( RDTheme::$options['mail_chimp_styles'] ); ?>"> 
		<?php  get_template_part( 'template-parts/mail-chimp', RDTheme::$options['mail_chimp_styles'] ); ?>
	</div>
<?php endif; ?>

<footer class="site-footer">
	<?php if ( RDTheme::$options['footer_area'] && $footer_columns ): ?>
		<div class="footer-top-area">
			<div class="container">
				<div class="row">
					<?php
					foreach ( range( 1, 4 ) as $i ) {
						if ( !is_active_sidebar( 'footer-'. $i ) ) continue;
						echo '<div class="' . esc_attr( $footer_class ) . '">';
						dynamic_sidebar( 'footer-'. $i );
						echo '</div>';
					}
					?>
				</div>
			</div>
		</div>			
	<?php endif; ?>

<?php echo wp_kses_post( $footer_separator ); ?>

<?php if ( RDTheme::$options['footer_bottom_styles'] == '1' ): ?>
	<?php if ( RDTheme::$options['copyright_area'] ): ?>
		<div class="footer-bottom-area<?php echo esc_attr( $copyright_class ); ?>">
			<div class="container">
				<div class="footer-bottom-inner">
					<div class="copyright-area">						
						<?php if ( RDTheme::$options['social_icons'] && $socials ): ?>
							<ul class="footer-social">
								<?php foreach ( $socials as $social ): ?>
									<li><a target="_blank" href="<?php echo esc_url( $social['url'] );?>"><span class="fa <?php echo esc_attr( $social['icon'] );?>"></span></a></li>
								<?php endforeach; ?>					
							</ul>
						<?php endif; ?>
						<div class="copyright-text"><?php echo wp_kses_post( RDTheme::$options['copyright_text'] );?></div>
					</div>
					<?php if ( RDTheme::$options['payment_icons'] ): ?>
						<ul class="payment-icons">
							<?php if ( RDTheme::$options['payment_img'] ) : ?>
								<?php
								$rdtheme_cards = explode( ',', RDTheme::$options['payment_img'] );
								?>
								<?php foreach ( $rdtheme_cards as $rdtheme_card ): ?>
									<li><?php echo wp_get_attachment_image( $rdtheme_card );?></li>
								<?php endforeach; ?>
							<?php else: ?>
								<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment1.png' ) ); ?>"></li>
								<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment2.png' ) ); ?>"></li>
								<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment3.png' ) ); ?>"></li>
								<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment4.png' ) ); ?>"></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>					
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php else: ?>
		<?php if ( RDTheme::$options['copyright_area'] ): ?>
			<div class="footer-bottom-area<?php echo esc_attr( $copyright_class ); ?> footer-bottom-area-new-2">
				<div class="container">
					<div class="footer-bottom-inner">
						<div class="copyright-area">
							<div class="copyright-text"><?php echo wp_kses_post( RDTheme::$options['copyright_text'] );?></div>
						</div>
						<div class="copyright-area">							
							<?php if ( RDTheme::$options['social_icons'] && $socials ): ?>
								<ul class="footer-social">
									<?php foreach ( $socials as $social ): ?>
										<li><a class="hddn-txt" target="_blank" href="<?php echo esc_url( $social['url'] );?>" title="<?php echo esc_attr( $social['icon'] );?>"><span class="fa <?php echo esc_attr( $social['icon'] );?>"></span></a></li>
									<?php endforeach; ?>					
								</ul>
							<?php endif; ?>							
						</div>
						<?php if ( RDTheme::$options['payment_icons'] ): ?>
							<ul class="payment-icons payment-icons-grayscale">
								<?php if ( RDTheme::$options['payment_img'] ) : ?>
									<?php
									$rdtheme_cards = explode( ',', RDTheme::$options['payment_img'] );
									?>
									<?php foreach ( $rdtheme_cards as $rdtheme_card ): ?>
										<li><?php echo wp_get_attachment_image( $rdtheme_card );?></li>
									<?php endforeach; ?>
								<?php else: ?>
									<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment1.png' ) ); ?>"></li>
									<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment2.png' ) ); ?>"></li>
									<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment3.png' ) ); ?>"></li>
									<li><img width="60px" height="36px" alt="<?php esc_attr_e( 'payment', 'metro' ); ?>" src="<?php echo esc_url( Helper::get_img( 'payment4.png' ) ); ?>"></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>					
					</div>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		</footer>
	</div>
<?php wp_footer();?>



   <script>
document.addEventListener("DOMContentLoaded", function () {
    const nameField = document.getElementById("hdd-name");
    const phoneField = document.getElementById("hdd-phone");
    const nameError = document.getElementById("name-error");
    const phoneError = document.getElementById("phone-error");

    // Restrict Name Field
    nameField.addEventListener("input", function () {
        const regex = /^[a-zA-Z\s]*$/; // Only letters and spaces
        if (!regex.test(nameField.value)) {
            nameError.style.display = "block";
            nameError.textContent = "Name can only contain letters and spaces.";
            nameField.value = nameField.value.replace(/[^a-zA-Z\s]/g, ""); // Remove invalid characters
        } else {
            nameError.style.display = "none";
        }
    });

    // Restrict Phone Field
    phoneField.addEventListener("input", function () {
        const regex = /^[0-9]*$/; // Only numbers
        if (!regex.test(phoneField.value)) {
            phoneError.style.display = "block";
            phoneError.textContent = "Phone number can only contain digits.";
            phoneField.value = phoneField.value.replace(/[^0-9]/g, ""); // Remove invalid characters
        } else {
            phoneError.style.display = "none";
        }
    });
});
</script>

        
 <script>
document.addEventListener("DOMContentLoaded", function () {
    const phoneField = document.getElementById("hdd-phone");
    const phoneError = document.getElementById("phone-error");

    phoneField.addEventListener("input", function () {
        let phoneValue = phoneField.value;

        // Remove non-digit characters
        phoneValue = phoneValue.replace(/\D/g, "");

        // Limit input to 10 digits
        if (phoneValue.length > 10) {
            phoneValue = phoneValue.substring(0, 10);
        }

        phoneField.value = phoneValue;

        // Check if input is not exactly 10 digits
        if (phoneValue.length !== 10 && phoneValue.length > 0) {
            phoneError.textContent = "Phone number must be exactly 10 digits.";
            phoneError.style.display = "block";
        } else {
            phoneError.style.display = "none";
        }
    });
});

</script>



</body>
</html>