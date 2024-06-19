<?php

namespace App\Adapters;

use App\Contracts\IAuthenticator;
use External\Bar\Auth\LoginService;

class BarAuthenticator implements IAuthenticator
{
   private LoginService $service;

   public function __construct()
   {
      $this->service = new LoginService();
   }

   public function authenticate(string $login, string $password): bool
   {
      return $this->service->login($login, $password);
   }
}