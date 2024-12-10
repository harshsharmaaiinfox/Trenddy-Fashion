<?php
/*
Plugin Name: Custom Payment Gateway
Description: A custom payment gateway using recopays API.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Ensure WooCommerce is active
add_action('plugins_loaded', 'check_if_woocommerce_is_active', 0);
function check_if_woocommerce_is_active() {
    if (class_exists('WC_Payment_Gateway')) {
        // Add custom payment gateway to WooCommerce
        add_filter('woocommerce_payment_gateways', 'add_custom_payment_gateway_class');
        add_action('plugins_loaded', 'init_custom_payment_gateway_class');
    } else {
        // WooCommerce is not active, show an admin notice
        add_action('admin_notices', 'woocommerce_inactive_notice');
    }
}

function woocommerce_inactive_notice() {
    ?>
    <div class="error">
        <p><?php _e('Custom Payment Gateway requires WooCommerce to be active. Please install and activate WooCommerce.', 'custom-payment-gateway'); ?></p>
    </div>
    <?php
}

// Add custom payment gateway to WooCommerce
function add_custom_payment_gateway_class($gateways) {
    $gateways[] = 'WC_Custom_Gateway'; // Add our custom gateway to WooCommerce
    return $gateways;
}

// Initialize custom payment gateway class
function init_custom_payment_gateway_class() {
    if (class_exists('WC_Payment_Gateway')) {
        class WC_Custom_Gateway extends WC_Payment_Gateway {
            // Declare the $log property
            private $log;

            public function __construct() {
                $this->id = 'custom_gateway';
                $this->icon = ''; // You can add an image here for your gateway
                $this->has_fields = true;
                $this->method_title = 'Custom Payment Gateway';
                $this->method_description = 'Custom Payment Gateway using recopays API';

                // Load settings
                $this->init_form_fields();
                $this->init_settings();

                $this->enabled = $this->get_option('enabled');
                $this->title = $this->get_option('title');

                // Initialize logger
                if (class_exists('WC_Logger')) {
                    $this->log = new WC_Logger();
                }

                // Save admin options
                add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            }

            // Form fields for admin configuration
            public function init_form_fields() {
                $this->form_fields = array(
                    'enabled' => array(
                        'title' => 'Enable/Disable',
                        'type' => 'checkbox',
                        'label' => 'Enable Custom Payment Gateway',
                        'default' => 'no'
                    ),
                    'title' => array(
                        'title' => 'Title',
                        'type' => 'text',
                        'description' => 'Title shown during checkout.',
                        'default' => 'Pay with Custom Gateway'
                    )
                );
            }

            // Fields to be displayed on the checkout page
            public function payment_fields() {
                $order_id = absint(WC()->session->get('order_awaiting_payment'));
                $order = wc_get_order($order_id);

                $qr_upi = $order->get_meta('qr_upi');
                $qr_url = $order->get_meta('qr_url');

                if ($qr_upi && $qr_url) {
                    echo '<p>Scan the QR code below or click on the UPI link to pay:</p>';
                    echo '<img src="' . esc_url($qr_url) . '" alt="QR Code for UPI Payment" />';
                    echo '<p><a href="' . esc_url($qr_upi) . '" target="_blank">Pay with Paytm, PhonePe, or Google Pay</a></p>';
                } else {
                    echo '<p>Click below to generate your UPI payment link.</p>';
                    echo '<button id="open-payment-dialog">Generate Payment Link</button>';
                }

                // JavaScript for the payment dialog if needed
                echo '
                <script type="text/javascript">
                    jQuery("#open-payment-dialog").on("click", function() {
                        alert("This will generate a UPI link via AJAX in the future.");
                        // Implement additional AJAX or UI logic here to fetch payment link
                    });
                </script>';
            }

            // Handle payment processing
            public function process_payment($order_id) {
                $order = wc_get_order($order_id);

                // Log the beginning of the payment process
                if ($this->log) {
                    $this->log->add($this->id, 'Processing payment for order ID: ' . $order_id);
                }

                // Static Payload from your input, for testing purposes
                $payload = array(
                    "qr_Link_type" => "Base64",
                    "qr_url" => "https://recopay-docs-bucket.s3.ap-south-1.amazonaws.com/202410/GIGAPAY3428852151895603ce76375.png",
                    "qr_upi" => "upi://pay?pa=gig.codecraft@finobank&pn=CODEFRAFTIT%20%20PVT%20LTD&mc=5691&tr=GIGAPAY3428852151895603ce76375&tn=34288521518&am=400&cu=INR&mode=05&orgid=187064&catagory=01&url=https://www.finobank.com/&sign=MEUCIQCcj30leWUTU+PI75TjhbmJrKL2enjUkXKWBQIJXTvqQQIgagQP+DXjkCQHeCq0epEtVEMKebgtX7xM0+ICkj+xWmw=",
                    "refid" => "GIGAPAY3428852151895603ce76375",
                    "status" => "Success",
                );

                // Handle the response from the API or static payload
                if ($payload['status'] === 'Success') {
                    // Update order meta with the UPI payment details
                    $order->update_meta_data('qr_upi', $payload['qr_upi']);
                    $order->update_meta_data('refid', $payload['refid']);
                    $order->update_meta_data('qr_url', $payload['qr_url']);
                    
                    // Log payment success
                    if ($this->log) {
                        $this->log->add($this->id, 'Payment success for order ID: ' . $order_id);
                    }

                    // Mark order as on-hold (waiting for the customer to pay)
                    $order->update_status('on-hold', __('Waiting for UPI payment', 'woocommerce'));

                    // Empty the cart
                    WC()->cart->empty_cart();

                    // Return thank you page redirect URL
                    return array(
                        'result' => 'success',
                        'redirect' => $this->get_return_url($order),
                    );
                } else {
                    // Log payment failure
                    if ($this->log) {
                        $this->log->add($this->id, 'Payment failed for order ID: ' . $order_id);
                    }

                    wc_add_notice('Error generating UPI payment link. Please try again.', 'error');
                    return array(
                        'result' => 'failure',
                        'redirect' => '',
                    );
                }
            }
        }
    }
}
