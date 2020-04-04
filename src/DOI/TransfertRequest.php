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

     /**
     * @Assert\Positive()
     * @var integer
     */
    public $account_to_debit;

     /**
     * @Assert\Positive()
     * @var integer
     */
    public $account_to_credit;
}