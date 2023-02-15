<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Invoice</title>
</head>
<style>
@page { margin:0px; }
html { margin: 0px}
body { margin: 0px; }
</style>
<body style="margin: 0; padding: 0;">

	<div style="width:100%;margin: 0 auto;border:2px solid #ccc;padding:5px;">
		@if($order['order_status'] == ORDER_DELIEVERED)
		<div style="font-family: Arial;font-size:18px; line-height:18px;color:#000000;text-align: center;">فاتورة ضريبية</div>
		<div style="font-family: Arial;font-size:18px; line-height:18px;color:#000000;text-align: center;">Tax Invoice</div>
		@else
		<div style="font-family: Arial;font-size:18px; line-height:18px;color:#000000;text-align: center;">الفاتورة الأولية</div>
		<div style="font-family: Arial;font-size:18px; line-height:18px;color:#000000;text-align: center;">Proforma Invoice</div>
		@endif
		<div style="height:20px;width:100%;">&nbsp;</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial;font-size: 13px;line-height: 14px;color: #000;font-weight: 600;">
			<tbody>
				<tr>
					<td width="50%" scope="col">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td scope="col">&nbsp;</td>
								</tr>
								<tr>
									<th scope="row">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tbody>
												<tr>
													<td width="25%" scope="col" style="text-align: left;border: 2px solid #ccc;border-right:0px;">Invoice Number:</td>
													<td width="25%" scope="col" style="text-align: left;border: 2px solid #ccc;border-right:0px;">{{ $order->id }}</td>
													<td width="25%" scope="col" style="text-align: right;border: 2px solid #ccc;border-right:0px;">{{ $order->id }}</td>
													<td width="25%" scope="col" style="text-align: right;border: 2px solid #ccc;">رقم الفاتورة:</td>
												</tr>
											</tbody>
										</table>
									</th>
								</tr>
								<tr>
									<td scope="row">&nbsp;</td>
								</tr>
								<tr>
									<td scope="row">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tbody>
												<tr>
													@php
														$create_date = date('d M Y', strtotime($order->created_at));
													@endphp
													<td width="25%" scope="col" style="text-align: left;border: 2px solid #ccc;border-right:0px;">Invoice Issue Date:</td>
													<td width="25%" scope="col" style="text-align: left;border: 2px solid #ccc;border-right:0px;">{{ $create_date }}</td>
													<td width="25%" scope="col" style="text-align: right;border: 2px solid #ccc;border-right:0px;">{{ $create_date }}</td>
													<td width="25%" scope="col" style="text-align: right;border: 2px solid #ccc;">تاريخ إصدار الفاتورة:</td>
												</tr>
												<tr>
													<td scope="row" style="text-align: left;border: 2px solid #ccc;border-right:0px;border-top:0px;">Date of Supply:</td>
													<td style="text-align: left;border: 2px solid #ccc;border-right:0px;border-top:0px;"></td>
													<td style="text-align: right;border: 2px solid #ccc;border-right:0px;border-top:0px;"></td>
													<td style="text-align: right;border: 2px solid #ccc;border-top:0px;">تاريخ التوريد:</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<!-- <tr>
									<td scope="row">&nbsp;</td>
								</tr>
								<tr>
									<td scope="row">&nbsp;</td>
								</tr> -->
							</tbody>
						</table>
					</td>
					<td width="50%" scope="col" align="left" valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td width="54%" scope="col">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
					<div style="height:10px;width:100%;">&nbsp;</div>
				</tr>
			</tbody>
		</table>
		<div style="height:10px;width:100%;">&nbsp;</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial;font-size:14px; line-height:14px;color:#000000;font-weight: 600;">
			<tbody>
				<tr>
					<td width="50%" scope="col" align="left" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td scope="col" align="left" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td width="51%" style="text-align: left;padding: 5px;background: #999;color: #fff;border: 2px solid #bbb;border-right:0px;" scope="col">Seller:</td>
													<td width="49%" style="text-align:right;padding: 5px;background: #999;color: #fff;border: 2px solid #bbb;border-right:0px;" scope="col">:تاجر</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td scope="row" align="left" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td scope="col" align="left" valign="top">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tbody>
																<tr>
																	<td width="100%" scope="col" align="left" valign="top">
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
																			<tbody>
																				<tr>
																					<td scope="row" align="left" valign="top">
																						<table width="100%" border="0" cellspacing="0" cellpadding="5">
																							<tbody>
																								<tr>
																									<td width="25%" height="28px" style="text-align: left;border-left: 2px solid #ccc;" scope="col">Name:</td>
																									@if($itemUser->role == BUSINESS_ROLE)
																									<td width="25%" style="text-align: left;border-left: 2px solid #ccc;" scope="col">{{ $businessUser->company_name }}</td>
																									@else
																									<td width="25%" style="text-align: left;border-left: 2px solid #ccc;" scope="col">{{ $itemUser->first_name }}</td>
																									@endif
																									<td width="25%" scope="col" style="text-align: right;border-left: 2px solid #ccc;">&nbsp;</td>
																									<td width="25%" scope="col" style="text-align: right;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">:اسم</td>
																								</tr>
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Building No.</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">لا للبناء.</td>
																								</tr>
																								<tr>
																									<td scope="row" height="28px" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Street Name</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">اسم الشارع</td>
																								</tr>
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">District</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">مدينة</td>
																								</tr>
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">City</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $city->name }}</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">مدينة</td>
																								</tr>
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Country</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $country->name }}</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">دولة</td>
																								</tr>
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Additional No.</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;"></td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">رقم إضافي</td>
																								</tr>
																								@if($itemUser->role == BUSINESS_ROLE)
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">VAT Number:</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $businessUser->vat_number }}</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">:ظريبه الشراء</td>
																								</tr>
																								<tr>
																									<td scope="row" height="28px" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">Other Seller ID:</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">Commerial registration - </td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">:معرف البائع الآخر</td>
																								</tr>
																								@else
																								<tr>
																									<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">VAT Number:</td>
																									<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">&nbsp;</td>
																									<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">&nbsp;</td>
																									<td scope="row" style="text-align: right;border-bottom: 2px solid #ccc;border-top: 2px solid #ccc;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">:ظريبه الشراء</td>
																								</tr>
																								@endif
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
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="50%" scope="col" align="left" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td scope="col" align="left" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
												<tr>
													<td scope="col" align="left" valign="top">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tbody>
																<tr>

																	<td width="50%" style="text-align: left;padding: 5px;background: #999;color: #fff;border: 2px solid #bbb;border-right:0px;" scope="col">Buyer:</td>
																	<td width="50%" style="text-align:right;padding: 5px;background: #999;color: #fff;border: 2px solid #bbb;border-right:0px;" scope="col">:مشتر</td>

																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td scope="row">
														<table width="100%" border="0" cellspacing="0" cellpadding="5">
															<tbody>
																<tr>
																	<td width="25%" height="28px" scope="col" style="text-align: left;border-left: 2px solid #ccc;">Name:</td>
																	<td width="25%" scope="col" style="text-align: left;border-left: 2px solid #ccc;">{{ $getUserAddress->name }}</td>
																	<td width="25%" scope="col" style="text-align: right;border-left: 2px solid #ccc;">&nbsp;</td>
																	<td width="25%" scope="col" style="text-align: right;border-left: 2px solid #ccc;border-right: 2px solid #ccc;">:اسم</td>
																</tr>
																<tr>
																	<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Building No.</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">للبناء.</td>
																</tr>
																<tr>
																	<td scope="row" height="28px" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Street Name</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $getUserAddress->address }}</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">اسم الشارع</td>
																</tr>
																<tr>
																	<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">District</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $getUserAddress->locality }}</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">يصرف</td>
																</tr>
																<tr>
																	<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">City</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $getUserAddress->city }}</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">مدينة</td>
																</tr>
																<tr>
																	<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Country</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">دولة</td>
																</tr>
																<tr>
																	<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">Additional No.</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">{{ $getUserAddress->alternate_phone }}</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">رقم إضافي</td>
																</tr>
																<tr>
																	<td scope="row" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">VAT Number:</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-right: 2px solid #ccc;">:ظريبه الشراء</td>
																</tr>
																<tr>
																	<td scope="row" height="28px" style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">Other Buyer ID:</td>
																	<td style="text-align: left;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">&nbsp;</td>
																	<td style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;">&nbsp;</td>
																	<td scope="row" style="text-align: right;border-left: 2px solid #ccc;border-top: 2px solid #ccc;border-bottom:2px solid #ccc;border-right: 2px solid #ccc;">:معرف المشتري الآخر</td>
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
					</td>
				</tr>
			</tbody>
		</table>
		<div style="height:10px;width:100%;">&nbsp;</div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial;font-size:14px; line-height:14px;color:#000000;font-weight: 600;">
			<tbody>
				<tr>
					<td scope="col">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td scope="col">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tbody>
												<tr>
													<td width="50%" style="text-align: left; background:#999999;color:#ffffff;border: 2px solid #bbb;border-right:0px;" scope="col">Line Items:</td>
													<td width="50%" style="text-align: right; background:#999999;color:#ffffff;border: 2px solid #bbb;" scope="col">:البنود</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td scope="row">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tbody>
												<tr>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Nature of goods or services<br>طبيعة السلع أو الخدمات</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Unit Price<br>سعر الوحدة</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Quantity<br>كمية</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Taxable Amount<br>المبلغ الخاضع للضريبة</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Discount<br>تخفيض</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Tax Rate<br>معدل الضريبة</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Tax Amount<br>قيمة الضريبة</td>
													<td scope="col" style="text-align: center;background:#727272;color:#ffffff;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">Item Subtotal
														(Including VAT)<br>المجموع الفرعي للبند (متضمنًا ضريبة القيمة المضافة)</td>
												</tr>
												@if (!empty($itemArray) && count($itemArray) > 0)
												@foreach ($itemArray as $key => $value)
												<tr>
													<td scope="row" style="text-align: left;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">{{ $value['itemDetails']['what_are_you_selling'] }}</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">{{ $value['orderItem']['price'] }}</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">{{ $value['orderItem']['quantity'] }}</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">0</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">0</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">0</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">0</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">{{ $value['orderItem']['total_amount'] }}</td>
												</tr>
												@endforeach
                       							@endif
												<!-- <tr>
													<td scope="row">&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr> -->

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
		<div style="height:10px;width:100%;">&nbsp;</div> 

		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Arial;font-size:14px; line-height:14px;color:#000000;font-weight: 600;">
			<tbody>
				<tr>
					<th scope="col">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<th scope="col">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tbody>
												<tr>
													<th width="50%" style="text-align: left; background:#999999;color:#ffffff;border: 2px solid #bbb;border-right:0px;" scope="col">Total Amounts:</th>
													<th width="50%" style="text-align: right; background:#999999;color:#ffffff;border: 2px solid #bbb;" scope="col">:المبالغ الإجمالية</th>
												</tr>
											</tbody>
										</table>
									</th>
								</tr>
								<tr>
									<th scope="row">
										<table width="100%" border="0" cellspacing="0" cellpadding="5">
											<tbody>
												<tr>
													<th width="28%" style="text-align: left;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;" scope="row">&nbsp;</th>
													<td width="33%" style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Total (Excluding VAT)</td>
													<td width="26%" style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">الإجمالي (باستثناء ضريبة القيمة المضافة)</td>
													<td width="13%" style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">{{ round($order->grand_total) }} SAR</td>
												</tr>
												<tr>
													<th scope="row" style="text-align: left;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">&nbsp;</th>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Discount</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">تخفيض</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">0.00 SAR</td>
												</tr>
												<tr>
													<th scope="row" style="text-align: left;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">&nbsp;</th>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Total Taxable Amount (Excluding VAT)</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">إجمالي المبلغ الخاضع للضريبة (باستثناء ضريبة القيمة المضافة)</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">{{ round($order->grand_total) }} SAR</td>
												</tr>
												<tr>
													<th scope="row" style="text-align: left;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">&nbsp;</th>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Total VAT (%)</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">إجمالي ضريبة القيمة المضافة</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">{{ $order->sell_tax }}</td>
												</tr>
												<tr>
													<th scope="row" style="text-align: left;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">&nbsp;</th>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">Total Amount Due</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;">إجمالي المبلغ المستحق</td>
													<td style="text-align: right;color:#000000;border-bottom:2px solid #b7b7b7;border-left:2px solid #b7b7b7;border-right:2px solid #b7b7b7;">{{ round($order->grand_total) }} SAR</td>
												</tr>

											</tbody>
										</table>
									</th>
								</tr>
							</tbody>
						</table>
					</th>
				</tr>
			</tbody>
		</table>

	</div>
</body>

</html>