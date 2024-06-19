<?php

namespace App\Contracts;

interface IAuthenticator
{
   public function authenticate(string $login, string $password): bool;
}