<?php

/*
 * This file is part of the sfZendOpenIdPlugin
 * (c) 2008 Bouke Haarsma <bouke@haarsma.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


/**
 * Links an OpenID identifier to an existing sf_guard_user
 * @package    symfony
 * @subpackage plugin
 * @author     Bouke Haarsma <bouke@haarsma.eu>
 * @version    SVN: $Id$
 */
class sfZendOpenIdLinkIdentifierTask extends sfPropelBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'The application name'),
      new sfCommandArgument('identifier',  sfCommandArgument::REQUIRED, 'The OpenID identifier'),
      new sfCommandArgument('username',    sfCommandArgument::REQUIRED, 'The username'),
    ));

    $this->addOptions(array(
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
    ));

    $this->namespace = 'guard';
    $this->name = 'link-identifier';
    $this->briefDescription = 'Links an OpenID Identifier';

    $this->detailedDescription = <<<EOF
The [guard:link-identifier|INFO] task links an OpenID Identifier to an existing user:

  [./symfony guard:link-identifier myopenid.com/bouke admin|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    /*$configuration = ProjectConfiguration::getApplicationConfiguration($arguments['application'], $options['env'], true);

    $databaseManager = new sfDatabaseManager($configuration);

    $user = new sfGuardUser();
    $user->setUsername($arguments['username']);
    $user->setPassword($arguments['password']);
    $user->save();

    $this->logSection('guard', sprintf('Create user "%s"', $arguments['username']));*/
    throw new sfException("Not yet implemented");
  }
}
