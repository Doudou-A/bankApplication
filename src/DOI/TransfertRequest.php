<?php

namespace App\DOI;

use Symfony\Component\Validator\Constraints as Assert;

class TransfertRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Positive()
     * @var float
     */
    public $amount;
}