<?php

class SfGuardUserProfile extends BaseSfGuardUserProfile
{
  /**
   * Renews the hash associated with this account
   */
  public function renewHash() {
    $this->setHash(Utils::generateHash());
    $this->setHashCreatedAt(time());
  }
}
