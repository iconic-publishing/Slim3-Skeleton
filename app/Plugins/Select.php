<?php

namespace Base\Plugins;

use Base\Plugins\Countries;

class Select {
	
    public function title() {
        return [
            'Mr',
            'Mrs',
            'Ms',
            'Miss'
        ];
    }

    public function country() {
        return Countries::get();
    }

    public function department() {
        return [
            'General Enquiry',
            'Order Enquiry',
            'Shipping Enquiry',
            'Other'
        ];
    }
	
}
