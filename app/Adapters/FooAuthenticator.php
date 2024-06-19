<?php

namespace App\Adapters;

use App\Contracts\IAuthenticator;
use External\Foo\Auth\AuthWS;

class FooAuthenticator implements IAuthenticator
{
   private AuthWS $service;

   public function __construct()
   {
      $this->service = new AuthWS();
   }

   public function authenticate(string $login, string $password): bool
   {
      $this->service->authenticate($login, $password);
      
      return true;
   }
}