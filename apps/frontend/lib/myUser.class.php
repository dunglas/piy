<?php

class myUser extends sfGuardSecurityUser
{
	public function getId() {
		if ($this->isAuthenticated()) {
      return $this->getGuardUser()->getId();
    }
    
    return null;
	}
}
