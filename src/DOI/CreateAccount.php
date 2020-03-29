<?php 

namespace App\DOI;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAccount
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="11", max="13")
     * @Assert\Positive()
     * @var integer
     */
    public $number;

}