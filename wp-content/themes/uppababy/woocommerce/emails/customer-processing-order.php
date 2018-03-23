<?php	// Customer processing order email

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}
?>

<?php	//  @hooked WC_Emails::email_header() Output the email header

	//do_action( 'woocommerce_email_header', $email_heading, $email );

	$ny_customer_full_name = $order->billing_first_name .' '.$order->billing_last_name;

	if ( get_post_meta($order->id, 'shopatron_order_ID', true) ) {

		$ny_shopatron_order_ID = get_post_meta($order->id, 'shopatron_order_ID', true);
		$ny_strpos = strpos($ny_shopatron_order_ID, "_");
	}

	if ( $ny_shopatron_order_ID && $ny_strpos !== false ) {

		$ny_post_and_order_ids = explode( "_", $ny_shopatron_order_ID );

		$ny_order_id = $ny_post_and_order_ids[1];

	} else {

		if ( $order->get_order_number() ) {

			$ny_order_id = $order->get_order_number();

		} else {

			$ny_order_id = $order->id;
		}
	}

	$ny_totals = $order->get_order_item_totals();

	$ny_shipping = $ny_totals["shipping"]["value"];

	$ny_shipping = str_replace( 'via Flat Rate','', $ny_shipping );
	$ny_shipping = str_replace( 'Flat Rate','0', $ny_shipping );

	$ny_card_number = sanitize_text_field( str_replace(' ','', $_POST['rzt_shopatron-card-number']) );

	$ny_card_number_last_digits = substr( $ny_card_number, -4 );

	$ny_card_type = rzt_get_card_type_from_number ( $ny_card_number );

?>

<!DOCTYPE html>
<html dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
</head>

<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

	<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">

		<div align="center">

			<table width="600" border="0" cellspacing="0" cellpadding="0">
			  <tbody>

				<tr>

					<td style="border:1px solid #ccc;">

						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tbody>

							<tr>

								<td align="center" width="130" style="border-bottom:1px solid #ccc; line-height:0px;">
									<a href="http://app.bronto.com/t/l?ssid=17">
										<img src="http://hosting.fyleio.com/17205/internal/templates/108972/uppababy-logo.jpg" border="0" alt="<?php echo $ny_customer_full_name; ?>">
									</a>
								</td>

								<td align="left" valign="top" bgcolor="#F5F5F5" style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;" height="95">

									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody>

										<tr>
											<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#5b656d; padding:35px 0 6px 17px; line-height:14px; text-align:left;">

												<?php echo $ny_customer_full_name; ?>

											</td>
										</tr>

										<tr>
											<td style="font-family:'Arial Black', Arial, Helvetica, sans-serif; font-size:22px; color:#5b656d; padding:0px 0 14px 17px; text-align:left; line-height:24px;">

											<div>
											<div>Order Confirmation</div>
											</div>

											</td>
										</tr>

									  </tbody>
									</table>

								</td>
							</tr>
						  </tbody>
						</table>

						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tbody>

							<tr>

								<td style="padding:0 16px 46px 17px;">
									<div align="right">

										<table border="0" cellspacing="0" cellpadding="0" bgcolor="#5B656D">
										  <tbody>

											<tr>

												<td style="line-height:0;">
													<img src="http://uppababy.com/wp-content/themes/UPPAbaby_2017/img/email/info-gray.gif" width="38" height="31" border="0" style="line-height:0;" alt="Order Status Icon">
												</td>

												<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FFFFFF;">
													<div>
														<div>Get Order Status</div>
													</div>
												</td>

												<td style="line-height:0;">
													<img src="http://uppababy.com/wp-content/themes/UPPAbaby_2017/img/email/question-gray.gif" width="49" height="31" border="0" style="line-height:0;" alt="Order Help Icon">
												</td>

												<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FFFFFF;">
													<div>
														<div>Get Order Help</div>
													</div>
												</td>

												<td style="line-height:0;">
													<img src="http://uppababy.com/wp-content/themes/UPPAbaby_2017/img/email/end-cap.gif" width="12" height="31" border="0" style="line-height:0;">
												</td>

											</tr>
										  </tbody>
										</table>

									</div>

									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody>

										<tr>

											<td style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px; line-height:17px; padding:11px 0 23px 0; text-align:left;">

												<div>
													<div>Dear&nbsp;<?php echo $ny_customer_full_name; ?>,</div>
													<div>&nbsp;</div>
													<div>Thank you for placing UPPAbaby order&nbsp;# <?php echo $ny_order_id; ?>.</div>
												</div>
											</td>
										</tr>
									  </tbody>
									</table>

									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody>

										<tr>
											<td valign="top" width="185" bgcolor="#F5F5F5" style="border:1px solid #dfdfdf; padding:14px 14px 16px;">

												<table width="155" border="0" cellspacing="0" cellpadding="0">
												  <tbody>

													<tr>
														<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#5b656d; line-height:18px; text-align:left;">
															<div>
																<div>Ship to:</div>
															</div>
														</td>
													</tr>

													<tr>
														<td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#5b656d; line-height:18px; padding-top:3px; text-align:left;">

														<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>
															<p class="text"><?php echo $shipping; ?></p>

														<?php endif; ?>

														</td>
													</tr>
												  </tbody>
												</table>
											</td>

											<td style="line-height:0;">&nbsp;
												<!-- img src="http://hosting.fyleio.com/17205/internal/templates/108972/spacer.gif" width="5" height="5" -->
											</td>

											<td valign="top" width="185" bgcolor="#F5F5F5" style="border:1px solid #dfdfdf; padding:14px 14px 16px;">

												<table width="155" border="0" cellspacing="0" cellpadding="0">
												  <tbody>

													<tr>
														<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#5b656d; line-height:18px; text-align:left;">
															<div>
																<div>Bill to:</div>
															</div>
														</td>
													</tr>

													<tr>
														<td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#5b656d; line-height:18px; padding-top:3px; text-align:left;">

														<p class="text"><?php echo $order->get_formatted_billing_address(); ?>
														</p>

														</td>
													</tr>

												  </tbody>
												</table>
											</td>

											<td style="line-height:0;">&nbsp;
												<!-- img src="http://hosting.fyleio.com/17205/internal/templates/108972/spacer.gif" width="5" height="5" -->
											</td>

											<td valign="top" width="185" bgcolor="#F5F5F5" style="border:1px solid #dfdfdf; padding:14px 14px 16px;">

												<table width="155" border="0" cellspacing="0" cellpadding="0">
												  <tbody>

													<tr>
														<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#5b656d; line-height:18px; text-align:left;">
															<div>
																<div>Payment Method</div>
															</div>
														</td>
													</tr>

													<tr>
														<td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#5b656d; line-height:18px; padding-top:3px; text-align:left;">
															<div><?php echo $ny_card_type.'xxxxx'.$ny_card_number_last_digits; ?></div>
														</td>
													</tr>
												  </tbody>
												</table>
											</td>

										</tr>
									  </tbody>
									</table>


									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody>

										<tr>
											<td style="border-bottom:1px dotted #999; padding-top:10px;">&nbsp;</td>
										</tr>

										<tr>
											<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000; font-weight:bold; padding:25px 0 15px 0; text-align:left;">
												<div>
													<div>Your order includes the following item(s):</div>
												</div>
											</td>
										</tr>
									  </tbody>
									</table>


									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #dfdfdf;">
									  <tbody>

										<tr>
											<td>

												<table width="100%" border="0" cellspacing="0" cellpadding="0">
												  <tbody>

													<tr>
														<td bgcolor="#F5F5F5" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#5b656d; padding:11px 15px 11px; border-bottom:1px solid #dfdfdf; text-align:left;">
															<div>
																<div>Item</div>
															</div>
														</td>

														<td align="right" bgcolor="#F5F5F5" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#5b656d; padding:11px 15px 11px; border-bottom:1px solid #dfdfdf;">
															<div>
																<div>Subtotal</div>
															</div>
														</td>
													</tr>

												  </tbody>
												</table>
											</td>
										</tr>

										<tr>
											<td><!----><!---->

												<?php	//  @hooked WC_Emails::order_details() Shows the order details table.
														//  @hooked WC_Emails::order_schema_markup() Adds Schema.org markup.

													// do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
												?>

												<?php
													echo $order->email_order_items_table( array(
														'show_sku'      => $sent_to_admin,
														'show_image'    => true,
														'image_size'    => array( 64, 64 ),
														'plain_text'    => $plain_text,
														'sent_to_admin' => $sent_to_admin
													) );
												?>

												<?php	//  @hooked WC_Emails::order_meta() Shows order meta data.

													//do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
												?>


												<?php	//  @hooked WC_Emails::customer_details() Shows customer details
														//  @hooked WC_Emails::email_address() Shows email address

													// do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
												?>


												<div style="border-bottom:1px solid #dfdfdf; line-height:0;">&nbsp;
													<!-- img src="http://hosting.fyleio.com/17205/internal/templates/108972/spacer.gif" width="1" height="1" -->
												</div>

											<!----><!---->
											</td>
										</tr>


										<tr>
											<td align="right" bgcolor="#F5F5F5" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#5b656d; padding:11px 15px 11px; border-bottom:1px solid #dfdfdf;">

												<div>
													<div>Estimated Shipping &amp; Handling: <?php echo $ny_shipping; ?> </div>
												</div>

											</td>
										</tr>

									  </tbody>
									</table>



									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tbody>

										<tr>
											<td>&nbsp;</td>
										</tr>

										<tr>
											<td align="left" valign="top" width="185" bgcolor="#F5F5F5" style="border:1px solid #dfdfdf;">

												<table border="0" cellspacing="0" cellpadding="0">
												  <tbody>

													<tr>
														<td style="line-height:0; text-align:left;">
															<img src="http://uppababy.com/wp-content/themes/UPPAbaby_2017/img/email/question-white.gif" width="49" height="43" alt="Help Icon">
														</td>

														<td style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#000; text-align:left;">

															<div>
																<div>Important notes about your order:</div>
															</div>
														</td>
													</tr>
												  </tbody>
												</table>
											</td>

										</tr>

										<tr>
											<td style="border:1px solid #dfdfdf; border-top:none; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000; line-height:16px; padding:14px 14px 16px; text-align:left;">

												<div>
													<div>
														<p>
															<span xml="lang">&bull; &nbsp; Your order may be shipped to you by UPPAbaby or by an authorized UPPAbaby retailer.</span>
														</p>
														<p>
															<span xml="lang">&bull; &nbsp; If sales tax is required, it will be added to the order.</span>
														</p>
														<p>
															<span xml="lang">&bull; &nbsp; If your order includes a pre-ordered item, visit the <a href="https://uppababy.com">
														<span xml="lang">UPPAbaby</span></a> website to view its expected release date. We will send email when the item is available.</span>
														</p>
														<span xml="lang">&bull; &nbsp; The charge will appear on your billing statement as: SPN*UPPAbaby.</span>
													</div>

												</div>
											</td>

										</tr>
									  </tbody>
									</table>


									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tbody>

										<tr>
											<td style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px; padding:20px 0 0 0; text-align:left; line-height:17px;">
												<div>
													<div>Thank you for shopping with UPPAbaby!</div>
												</div>
											</td>
										</tr>

									  </tbody>
									</table>

								</td>
							</tr>
						  </tbody>
						</table>

					</td>
				</tr>

			  </tbody>
			</table>

		</div>

		<img src="http://app.bronto.com/t/o?ssid=17205" width="0" height="0" border="0" style="visibility: hidden !important; display:none !important; max-height: 0; width: 0; line-height: 0; mso-hide: all;" alt="">

	</div>
<?php 
?>
</body>
</html>

<?php	//  @hooked WC_Emails::email_footer() Output the email footer

	// do_action( 'woocommerce_email_footer', $email );
?>