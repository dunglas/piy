<?php

/**
 * Subclass for representing a row from the 'sf_comment' table.
 *
 * 
 *
 * @package piy
 */ 
class sfComment extends BasesfComment
{
  // TODO: write unit test and fixtures
  /**
   * Gets the comentable object
   * @return mixed
   */
  public function getCommentable() {
    return call_user_func_array($this->getCommentableModel().'Peer::retrieveByPK', array($this->getCommentableId()));
  }

  public function __toString() {
    return $this->getTitle();
  }
}
