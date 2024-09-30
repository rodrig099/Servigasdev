<?php

namespace App\Services;

use Epayco\Epayco;

class EpaycoService
{
    protected $epayco;

    public function __construct()
    {
        $this->epayco = new Epayco([
            'apiKey' => config('epayco.public_key'),
            'privateKey' => config('epayco.private_key'),
            'lenguage' => 'ES',
            'test' => config('epayco.test')
        ]);
    }

    public function getEpayco()
    {
        return $this->epayco;
    }
}
