<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobeetJobTable extends Doctrine_Table {

	//Si la fecha de expiración ha sobrepasado la fecha actual, esto indica que el mismo ha expirado
	public function getActiveJobs(Doctrine_Query $query = null){
		/*$query = Doctrine_Query::Create()
			->from('JobeetJob j')
			->where('j.expires_at > ?', date('Y-m-d h:i:s', time()))
			->orderBy('j.expires_at DESC');*/
		if ( $query == null ){
			$query = $this->createQuery('j');
		}
		
		$query->addWhere('j.expires_at > ?', date('Y-m-d h:i:s', time()))
			->addOrderBy('j.expires_at DESC');
			
		return $query->execute();
	}	
	
	
	public function retrieveActiveJob(Doctrine_Query $query){
		$query->andWhere('a.expires_at > ?', date('Y-m-d h:i:s', time()))->limit(1);		
		return $query->execute();
	}
}