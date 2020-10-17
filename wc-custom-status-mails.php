<?php
/*
Plugin Name: WooCommerce Custom Status emails
Plugin URI: http://webmania.cc
Description: Automatically send out emails on an order status is changed to a custom status
Author: rrd
Version: 0.0.2
*/

if (! defined('ABSPATH')) {
    exit;
}

add_action('woocommerce_order_status_shipping-problem', 'csm_shipping_problem', 20, 2);
function csm_shipping_problem($order_id, $order)
{
    $heading = $subject = 'Szállítási probléma';

    $mailer = setMailer($heading, $subject);

    $plugin_path = '../../wc-custom-status-mails/emails';
    $mailer["WC_Email_Customer_Completed_Order"]->template_plain = $plugin_path . '/plain/shipping-problem.php';
    $mailer["WC_Email_Customer_Completed_Order"]->template_html = $plugin_path . '/shipping-problem.php';

    // Send the email with custom heading & subject
    $mailer['WC_Email_Customer_Completed_Order']->trigger($order_id, $order);

    // To add email content use https://businessbloomer.com/woocommerce-add-extra-content-order-email/
    // You have to use the email ID chosen above and also that $order->get_status() == "refused"

    // set new note
    $order->add_order_note($subject . ' ' . __('mail sent to customer'));
}

add_action('woocommerce_order_status_payment-problem', 'csm_payment_problem', 20, 2);
function csm_payment_problem($order_id, $order)
{
    $heading = $subject = 'Fizetési probléma';

    $mailer = setMailer($heading, $subject);

    $plugin_path = '../../wc-custom-status-mails/emails';
    $mailer["WC_Email_Customer_Completed_Order"]->template_plain = $plugin_path . '/plain/payment-problem.php';
    $mailer["WC_Email_Customer_Completed_Order"]->template_html = $plugin_path . '/payment-problem.php';

    // Send the email with custom heading & subject
    $mailer['WC_Email_Customer_Completed_Order']->trigger($order_id, $order);

    $order->add_order_note($subject . ' ' . __('mail sent to customer'));
}

add_action('woocommerce_order_status_simplepay-success', 'csm_simplepay_success', 20, 2);
function csm_simplepay_success($order_id, $order)
{
    $heading = $subject = 'Megrendelésed beérkezett';

    $mailer = setMailer($heading, $subject);

    $plugin_path = '../../wc-custom-status-mails/emails';
    $mailer["WC_Email_Customer_Completed_Order"]->template_plain = $plugin_path . '/plain/simplepay-success.php';
    $mailer["WC_Email_Customer_Completed_Order"]->template_html = $plugin_path . '/simplepay-success.php';

    // Send the email with custom heading & subject
    $mailer['WC_Email_Customer_Completed_Order']->trigger($order_id, $order);

    $order->add_order_note($subject . ' ' . __('mail sent to customer'));
}

add_action('woocommerce_order_status_simplepay-error', 'csm_simplepay_error', 20, 2);
function csm_simplepay_error($order_id, $order)
{
    $heading = $subject = 'Fizetési hiba';

    $mailer = setMailer($heading, $subject);

    $plugin_path = '../../wc-custom-status-mails/emails';
    $mailer["WC_Email_Customer_Completed_Order"]->template_plain = $plugin_path . '/plain/simplepay-error.php';
    $mailer["WC_Email_Customer_Completed_Order"]->template_html = $plugin_path . '/simplepay-error.php';

    // Send the email with custom heading & subject
    $mailer['WC_Email_Customer_Completed_Order']->trigger($order_id, $order);

    $order->add_order_note($subject . ' ' . __('mail sent to customer'));
}

add_action('woocommerce_order_status_posted', 'csm_posted', 20, 2);
function csm_posted($order_id, $order)
{
    $heading = $subject = 'Feladva';

    $mailer = setMailer($heading, $subject);

    $plugin_path = '../../wc-custom-status-mails/emails';
    $mailer["WC_Email_Customer_Completed_Order"]->template_plain = $plugin_path . '/plain/posted.php';
    $mailer["WC_Email_Customer_Completed_Order"]->template_html = $plugin_path . '/posted.php';

    // Send the email with custom heading & subject
    $mailer['WC_Email_Customer_Completed_Order']->trigger($order_id, $order);

    $order->add_order_note($subject . ' ' . __('mail sent to customer'));
}

add_action('woocommerce_order_status_complaint', 'csm_complaint', 20, 2);
function csm_complaint($order_id, $order)
{
    $heading = $subject = 'Panasz kezelés alatt';

    $mailer = setMailer($heading, $subject);

    $plugin_path = '../../wc-custom-status-mails/emails';
    $mailer["WC_Email_Customer_Completed_Order"]->template_plain = $plugin_path . '/plain/complaint.php';
    $mailer["WC_Email_Customer_Completed_Order"]->template_html = $plugin_path . '/complaint.php';

    // Send the email with custom heading & subject
    $mailer['WC_Email_Customer_Completed_Order']->trigger($order_id, $order);

    $order->add_order_note($subject . ' ' . __('mail sent to customer'));
}

function setMailer($heading, $subject)
{
    // Get WooCommerce email objects
    $mailer = WC()->mailer()->get_emails();

    // Use one of the active emails e.g. "Customer_Completed_Order"
    // Wont work if you choose an object that is not active
    // Assign heading & subject to chosen object
    $mailer['WC_Email_Customer_Completed_Order']->heading = $heading;
    $mailer['WC_Email_Customer_Completed_Order']->settings['heading'] = $heading;
    $mailer['WC_Email_Customer_Completed_Order']->subject = $subject;
    $mailer['WC_Email_Customer_Completed_Order']->settings['subject'] = $subject;

    return $mailer;
}
