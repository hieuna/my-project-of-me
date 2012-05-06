<?php
function libsEmailBody($hotel, $booking, $rooms, $services, $payment)
{
	$body .= '<style type="text/css">th, td {font-size:11px;}.box-bg {background-color: '.$hotel->th_bgcolor.'}.box-bg {color: '.$hotel->th_textcolor.'}.box-border {border-color: '.$hotel->th_bgcolor.'}.border-bottom {border-bottom-style: solid; border-bottom-width:1px;}.border-top {border-top-style: solid; border-top-width:1px;}.border-left {border-left-style: solid; border-left-width:1px;}.border-right {border-right-style: solid; border-right-width:1px;}.box-list-rooms {margin: 10px 0;font-size: 11px;}.box-list-rooms .inputbox {font-size: 11px;}.hidden {display: none;}#payment-box ul {list-style: none; padding: 0; margin: 0;}#payment-box ul li {float: left; display:block; padding:4px 10px; margin-right: 2px; font-weight: 700; cursor: pointer;}</style>';
	$body .= '<div style="color: '.$hotel->textcolor.';width: 100%; margin:0 auto; font-family: Helvetica,Arial,sans-serif; font-size:11px;"><div class="box-border border-bottom" style="padding: 10px;"><img src="'.JURI::root().'images/stories/logos/'.$hotel->image_logo.'" alt="'.$hotel->name.'" /></div>';
	$body .= '<div class="box-list-rooms" align="center"><p><b>'.JText::_('Note: Please print and keep this information as your reservation reference!!!').'</b></p></div>';
	$body .= '<div style="font-size: 13px; margin: 20px 0 10px 0;"><b>'.JText::_('Room').'</b> <i>'.($hotel->vat>0?JText::sprintf('included %s%% taxes and service fees', $hotel->vat):'').'</i></div>';
	$body .= '<div class="box-list-rooms" style="margin-top:1px;"><table cellpadding="5" cellspacing="0" border="0" width="100%">
		<tr class="box-bg">
			<th class="box-bg">'.JText::_('No. Room').'</th>
			<th class="box-bg">'.JText::_('Type of Room').'</th>
			<th class="box-bg">'.JText::_('Arrival Date').'</th>
			<th class="box-bg">'.JText::_('No. nights').'</th>
			<th class="box-bg">'.JText::_('No. adults').'</th>
			<th class="box-bg">'.JText::_('No. children').'</th>
			<th class="box-bg">'.JText::_('Arrival time').'</th>
			<th class="box-bg">'.JText::_('No smoking').'</th>
			<th class="box-bg">'.JText::_('Extra bed').'</th>
			<th class="box-bg">'.JText::_('Cost').'</th>
		</tr>';
	$totalRoomRate = 0; $totalFirstNight = 0;
	for ($i=0; $i<count($rooms); $i++) {
		$room = $rooms[$i];
		$body .= '
		<tr id="tdRoom_'.$i.'">
			<td class="box-border border-left" valign="top" nowrap="nowrap"><b>'.JText::_('Room').' '.($i+1).'</b></td>
			<td valign="top">'.$room->type.'</td>
			<td valign="top" nowrap>'.$room->arrival_format.'</td>
			<td valign="top" align="center" nowrap>'.$room->nights.'</td>
			<td valign="top" align="center" nowrap>'.$room->adults.'</td>
			<td valign="top" align="center" nowrap>'.$room->children.'</td>
			<td valign="top" align="center" nowrap>'.$room->arrival_time.' '.JText::_('pm').'</td>
			<td valign="top" align="center" nowrap>'.( $room->nosmoking?JText::_('Yes'):JText::_('No') ).'</td>
			<td valign="top" align="center" nowrap>'.( $room->extrabed?JText::_('Yes'):JText::_('No') ).'</td>
			<td class="box-border border-right" valign="top" align="right" nowrap><b>'.formatMoney($room->price_total).' '.$booking->currency.'</b></td>
		</tr>';
		$totalFirstNight += $room->first_night;
		$totalRoomRate = $totalRoomRate+$room->price_total;
	
	if ($hotel->payment_method==1) {
		$body .= '
		<tr>
			<td colspan="9" class="box-border border-top border-left"><b>'.JText::_('First night deposit').' (*)</b></td>
			<td class="box-border border-top border-right" align="right"><b>'.formatMoney($totalFirstNight).' '.$this->booking->currency.'</b></td>
		</tr>
		<tr>
			<td colspan="9" class="box-border border-top border-left"><b>'.JText::_('Balance payment').'</b></td>
			<td class="box-border border-top border-right" align="right"><b>'.formatMoney($totalRoomRate-$totalFirstNight).' '.$this->booking->currency.'</b></td>
		</tr>';
	}
	$body .= '
		<tr>
			<td colspan="9" class="box-border border-top border-bottom border-left"><b>'.JText::_('Total of Rooms').'</b></td>
			<td class="box-border border-top border-bottom border-right" align="right"><b>'.formatMoney($totalRoomRate).' '.$booking->currency.'</b></td>
		</tr>';
	if ($this->hotel->payment_method==1) {
		$body .= '
		<tr>
			<td colspan="10"><i>(*): '.JText::_("A first night deposit is required to secure your hotel booking. This prepaid deposit will be deducted from your hotel bill when checking out from the hotel. Additional expenses must be paid directly to the hotel when checking out.").'</i></td>
		</tr>';
	}
	$body .= '
    </table>
	</div>';
	
	if (!empty($services))
	{
		$body .= '
		<div style="font-size: 13px; margin: 20px 0 10px 0;">
			<b>'.JText::_('Additional Service').'</b> <i>('.JText::_('Included taxes and service fees').')</i>
		</div>
		<div class="box-list-rooms">
		<table cellpadding="5" cellspacing="0" border="0" width="100%">
			<tr class="box-bg">
				<th class="box-bg">'.JText::_('Name').'</th>
				<th class="box-bg">'.JText::_('Description').'</th>
				<th class="box-bg" nowrap>'.JText::_('Quantity').'</th>
				<th class="box-bg" nowrap>'.JText::_('Cost/Unit').'</th>
				<th class="box-bg" nowrap>'.JText::_('Cost/Service').'</th>
			</tr>';
		$totalRoomService = 0;
		for ($i=0; $i<count($services); $i++) {
			$service = $services[$i];
			$body .= '
				<tr>
					<td valign="top" class="box-border border-left">'.$service->name.'</td>
					<td valign="top">'.$service->description.'</td>
					<td valign="top" align="center" nowrap>'.$service->quantity.'</td>
					<td valign="top" align="right" nowrap>'.formatMoney($service->price).' '.$booking->currency.'</td>
					<td valign="top" align="right" class="box-border border-right" nowrap><b>'.formatMoney($service->price*$service->quantity).' '.$booking->currency.'</b></td>
				</tr>
			';
			$totalRoomService = $totalRoomService+($service->price*$service->quantity);
		}
		$body .= '
			<tr>
				<td colspan="4" class="box-border border-bottom border-top border-left"><b>'.JText::_('Total of Additional Service').'</b></td>
				<td align="right" class="box-border border-bottom border-right border-top" nowrap>
					<b><span id="priceservicetotal">'.formatMoney($totalRoomService).'</span> '.$booking->currency.'</b>
				</td>
			</tr>
		</table>
		</div>';
	}
	
	$body .= '<div class="box-list-rooms">
	<table cellpadding="5" cellspacing="0" border="0" width="100%">
		<tr class="box-bg">
			<td class="box-bg" align="left"><b>'.JText::_('Total of booking').'</b></td>
			<td class="box-bg" align="right" nowrap><b>'.formatMoney($totalRoomRate+$totalRoomService).' '.$booking->currency.'</b></td>
		</tr>
		<input type="hidden" name="payment_total" value="'.($totalRoomRate+$totalRoomService).'" />
	</table>
	</div>';
	
	$body .= '<div class="box-list-rooms" style="margin-top: 30px;">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<td width="50%" valign="top">
			<table cellpadding="5" cellspacing="0" border="0" width="100%">
				<tr class="box-bg">
					<td colspan="2" class="box-bg"><b>'.JText::_('Customer Information').'</b></td>
				</tr>
				<tr>
					<td width="120" align="right">'.JText::_('Full Name').' :</td>
					<td>
					'.$booking->title.". ".$booking->firstname." ".$booking->lastname.'
					</td>
				</tr>';
				if ($booking->company) {
				$body .= '<tr>
					<td align="right">'.JText::_('Company').' :</td>
					<td>'.$booking->company.'</td>
				</tr>';
				}
				$body .= '
				<tr>
					<td align="right">'.JText::_('Address').' :</td>
					<td>'.$booking->address.'</td>
				</tr>';
				if ($booking->zipcode) {
				$body .= '<tr>
					<td align="right">'.JText::_('Zip code').' :</td>
					<td>'.$booking->zipcode.'</td>
				</tr>';
				}
				$body .= '
				<tr>
					<td align="right">'.JText::_('City').' :</td>
					<td>'.$booking->city.'</td>
				</tr>';
				if ($booking->state) {
				$body .= '<tr>
					<td align="right">'.JText::_('State').' :</td>
					<td>'.$booking->state.'</td>
				</tr>';
				}
				$body .= '
				<tr>
					<td align="right">'.JText::_('Country').' :</td>
					<td>'.$booking->country_name.'</td>
				</tr>
				<tr>
					<td align="right">'.JText::_('Email').' :</td>
					<td>'.$booking->email.'</td>
				</tr>
				<tr>
					<td align="right">'.JText::_('Tel').' :</td>
					<td>'.$booking->telephone.'</td>
				</tr>';
				if ($booking->fax) {
				$body .= '<tr>
					<td align="right">'.JText::_('Fax').' :</td>
					<td>'.$booking->fax.'</td>
				</tr>';
				}
				if ($booking->flight) {
				$body .= '<tr>
					<td align="right">'.JText::_('Flight Details').' :</td>
					<td>'.$booking->flight.'</td>
				</tr>';
				}
				if ($booking->comments) {
				$body .= '<tr>
					<td align="right" valign="top">'.JText::_('Comments').' :</td>
					<td>'.str_replace(array("\r\n", "\n", "\r"), "<br />", $booking->comments).'</td>
				</tr>';
				}
				$body .= '<tr>
					<td align="right" valign="top">'.JText::_('Confirmation number').' :</td>
					<td>'.$booking->code.'</td>
				</tr>
			</table>
			<table cellpadding="5" cellspacing="0" border="0" width="100%">
				<tr class="box-bg">
					<td colspan="2" class="box-bg"><b>'.$hotel->name." ".JText::_('Information').'</b></td>
				</tr>
				<tr>
					<td width="120" align="right">'.JText::_('Name').' :</td>
					<td>'.$hotel->name.'</td>
				</tr>
				<tr>
					<td align="right">'.JText::_('Address').' :</td>
					<td>'.$hotel->address.'</td>
				</tr>
				<tr>
					<td align="right">'.JText::_('Phone').' :</td>
					<td>'.$hotel->phone.'</td>
				</tr>';
				if ($hotel->fax) {
				$body .= '<tr>
					<td align="right">'.JText::_('Fax').' :</td>
					<td>'.$hotel->fax.'</td>
				</tr>';
				}
				if ($hotel->email) {
				$body .= '<tr>
					<td align="right">'.JText::_('Email').' :</td>
					<td>'.$hotel->email.'</td>
				</tr>';
				}
				if ($hotel->website) {
				$body .= '<tr>
					<td align="right">'.JText::_('Website').' :</td>
					<td>'.$hotel->website.'</td>
				</tr>';
				}
		$body .= '
			</table>
		</td>
		<td width="20"></td>
		<td valign="top">
		<div id="payment-box">
			<ul>
				<li class="box-bg box-border border-top border-left border-right">
					'.JText::_('Paid by ').' '.($booking->payment_type==1?$payment->card_type:JText::_('Local Debit Card')).'
				</li>
			</ul>
			<div class="clr"></div>
			<div style="padding: 10px;" id="cc-box" class="box-border border-bottom border-top border-left border-right">';
		
			if ($booking->payment_type==1) {
				$body .= '
				<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr>
						<td align="right">'.JText::_('Card Type').' :</td>
						<td>'.$payment->card_type.'</td>
					</tr>
					<tr>
						<td align="right">'.JText::_('Card Number').' :</td>
						<td>'.subCardNumber($payment->card_number).'</td>
					</tr>
					<tr>
						<td align="right">'.JText::_('Name on Card').' :</td>
						<td>'.$payment->card_name.'</td>
					</tr>
					<tr>
						<td align="right">'.JText::_('Paid at').' :</td>
						<td>'.(date("H:i d F Y", $payment->time)).'</td>
					</tr>
				</table>';
			}
			else {
				$body .= '<table cellpadding="5" cellspacing="0" border="0" width="100%">
					<tr>
						<td align="right">'.JText::_('Card Type').' :</td>
						<td>'.JText::_('Local Debit Card').' </td>
					</tr>
					<tr>
						<td align="right">'.JText::_('Paid at').' :</td>
						<td>'.(date("H:i d F Y", $payment->time)).'</td>
					</tr>
				</table>';
			}
			$body .= '
			</div>
			<div style="margin: 10px 0;">
				<p><b>'.JText::_('Term and Conditions').':</b></p>
				<div class="box-border border-right border-bottom border-left border-top" style="padding: 10px; margin-bottom: 5px;">
					'.($hotel->terms?str_replace(array("\r\n", "\n", "\r"), "<br />", $hotel->terms):JText::_('n/a')).'
				</div>
				
			</div>
		</div>
		</td>
	</table>
	</div>
	</div>';
			
	return $body;
}
?>