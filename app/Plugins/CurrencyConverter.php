<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 12th March, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

namespace Base\Plugins;

use Money\Money;
use Money\Converter;

use Money\Exchange\FixedExchange;
use Money\Currencies\ISOCurrencies;
use Money\Currency;

class CurrencyConverter {
	
	public function convert($amount, $from, $to) {
		$exchange = new FixedExchange([
			$from => [
				$to => 1
			]
		]);

		$converter = new Converter(new ISOCurrencies(), $exchange);

		$input = Money::$from($amount);
		$output = $converter->convert($input, new Currency($to));
		
		//dd($output);
		
		return $output;
	}
	
}