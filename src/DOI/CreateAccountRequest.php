<?php 

namespace App\DOI;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAccountRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="6", max="7")
     * @Assert\Positive()
     * @var integer
     */
    public $number;
}