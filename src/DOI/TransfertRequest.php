<?php

namespace App\DOI;

class TransfertRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Positive()
     * @var float
     */
    public $amount;
}