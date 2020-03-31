<?php

namespace App\DOI;

use Symfony\Component\Validator\Constraints as Assert;

class TransactionRequest
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Positive()
     * @var integer
     */
    public $price;

     /**
     * @var boolean
     */
    public $status;
}