<?php

//Objet qui représente les données de pagination, que je peut transférer et
//envoyer à mes différents services.

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class PaginationDTO
{
    public function __construct(
        #[Assert\Positive()]
        public readonly ?int $page = 1
    ) {

    }
}