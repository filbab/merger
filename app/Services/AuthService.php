<?php

namespace App\Services;

use App\Contracts\IAuthenticator;
use App\Adapters\BarAuthenticator;
use App\Adapters\BazAuthenticator;
use App\Adapters\FooAuthenticator;

class AuthService
{
   private IAuthenticator $authenticator;

   public function __construct(
      private JwtService $jwtService
   ) {}

   public function login(string $login, string $password): string
   {
      $this->setAuthenticator($login);

      if ($this->authenticator && $this->authenticator->authenticate($login, $password)) {
         $system = $this->getSystemFromLogin($login);
         return $this->jwtService->generateToken($login, $system);
      }

      throw new \Exception('Authentication failed.');
   }

   private function setAuthenticator(string $login): void
   {
      if (strpos($login, 'FOO_') === 0) {
         $this->authenticator = new FooAuthenticator();
      } elseif (strpos($login, 'BAR_') === 0) {
         $this->authenticator = new BarAuthenticator();
      } elseif (strpos($login, 'BAZ_') === 0) {
         $this->authenticator = new BazAuthenticator();
      } else {
         throw new \Exception('Authentication failed.');
      }
   }

   private function getSystemFromLogin(string $login): string
   {
      if (strpos($login, 'FOO_') === 0) {
         return 'FOO';
      } elseif (strpos($login, 'BAR_') === 0) {
         return 'BAR';
      } elseif (strpos($login, 'BAZ_') === 0) {
         return 'BAZ';
      }

      return 'UNKNOWN';
   }
}