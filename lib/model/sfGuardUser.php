<?php
class sfGuardUser extends PluginsfGuardUser {
	public function getEmail() {
		return $this->getProfile()->getEmail();
	}
	
 /**
   * Return the Vote object related with this article.
   * 
   * @param Artucle $article
   * @return Vote
   */
  public function getVoteFor(Article $article, PropelPDO $con = null) {
    $c = new Criteria();
    $c->add(VotePeer::ARTICLE_ID, $article->getId());
    $c->add(VotePeer::USER_ID, $this->getId());
    
    return VotePeer::doSelectOne($c, $con);
  }
  
  /**
   * Vote for an article.
   * 
   * @param Article $article
   * @param bool $promote
   * @return void
   */
  public function voteFor(Article $article, PropelPDO $con = null) {
    if ($this->getVoteFor($article, $con)) return;
    
    $vote = new Vote();
	  $vote->setUserId($this->getId());
	  $vote->setArticleId($article->getId());
	  $vote->save($con);
  }
}

sfPropelBehavior::add('sfGuardUser', array('sfPropelActAsCommentableBehavior'));