<?php

namespace Src\Domain\User\Service;

use SlimSession\Helper;

final class UserDelogger
{
  public function DelogUser() {
    $session = new Helper();
    if (isset($session['id'])) {
        unset($session['id']);
        $session::destroy();
        return ['success' => 'user delogged'];
    }
    else
      return ['error' => 'No user logged'];
  }
}
