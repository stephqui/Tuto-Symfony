<?php

namespace App\Contact;
class ContactFormDTO
{

  private $mail;
  private $name;
  private $message;
  public function __construct()
  {
  }
  function getMail()
  {
    return $this->mail;
  }
  function getName()
  {
    return $this->name;
  }
  function getMessage()
  {
    return $this->message;
  }
}
