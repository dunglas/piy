<?php

class SfGuardUserProfilePeer extends BaseSfGuardUserProfilePeer
{
  /**
   * Retrieves a profile by its associated email address
   *
   * @param string $email
   * @param PropelPDO $con
   *
   * @return SfGuardUserProfile
   */
  public static function retrieveByEmail($email, PropelPDO $con = null) {
    $criteria = new Criteria();
    $criteria->addJoin(self::USER_ID, sfGuardUserPeer::ID);
    $criteria->add(self::EMAIL, $email);

    return self::doSelectOne($criteria, $con);
  }

  public static function retrieveByHash($hash, $timestamp = null) {
    if (!$timestamp) $timestamp = time();

    $criteria = new Criteria();
    $criteria->addJoin(self::USER_ID, sfGuardUserPeer::ID);
    $criteria->add(self::HASH, $hash);
    $criteria->add(self::HASH_CREATED_AT, $timestamp - (24 * 3600), Criteria::GREATER_EQUAL);

    return self::doSelectOne($criteria);
  }
}
