<?php
class articleComponents extends sfComponents {
	public function executeMostRecent() {
		$this->article_pager = ArticlePeer::getMostRecent();
	}
}