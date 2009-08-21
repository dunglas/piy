<?php
/**
 * Article components
 *
 * @package piy
 * @subpackage article
 * @author Kévin Dunglas <dunglas@gmail.com>
 */

class articleComponents extends sfComponents {
	public function executeMostRecent() {
		$this->article_pager = ArticlePeer::getMostRecent();
	}
}