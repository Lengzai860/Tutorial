<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewVoucher
{
    use SerializesModels;

    public $voucher;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($voucher)
    {
        $this->voucher = $voucher;
    }
}
