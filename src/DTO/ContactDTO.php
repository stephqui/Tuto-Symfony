<?php

namespace App\Contact;
use Symfony\Component\Validator\Constraints as Assert;
class ContactDTO
{
  #[Assert\NotBlank]
  #[Assert\Length(min: 3, max: 60)]
  public string $name = '';

  #[Assert\NotBlank]
  #[Assert\Email]
  public string $mail = '';

  #[Assert\NotBlank]
  #[Assert\Length(min: 3, max: 200)]
  public string $message = '';

  #[Assert\NotBlank]
  public string $service ='';

}
