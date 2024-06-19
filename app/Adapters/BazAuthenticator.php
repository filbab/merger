<?php

namespace App\Adapters;

use App\Contracts\IAuthenticator;
use External\Baz\Auth\Authenticator;
use External\Baz\Auth\Responses\Success;
use PhpParser\Node\Expr\Instanceof_;

class BazAuthenticator implements IAuthenticator
{
   private Authenticator $service;

   public function __construct()
   {
      $this->service = new Authenticator();
   }

   public function authenticate(string $login, string $password): bool
   {
      $response = $this->service->auth($login, $password);
      if (is_a($response, Success::class)) {
         return true;
      } else {
         return false;
      }
   }
}