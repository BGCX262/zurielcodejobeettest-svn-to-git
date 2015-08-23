<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobeetCategoryTable extends Doctrine_Table {

	public function getWithJobs() {
		$query = $this->createQuery('c')
			->innerJoin('c.JobeetJobs j')
			->where('j.expires_at > ?', date('Y-m-d h:i:s', time()));
		
		return $query->execute();
	}
	
	public function getActiveJobs(Doctrine_Query $query = null){
		return $this->addActiveJobsQuery($query)->execute();
	}

	public function addActiveJobsQuery(Doctrine_Query $query = null){
		if ( is_null($query) ){
			$query = Doctrine_Query::create()->from('JobeetJob j');
		}

		$alias = $query->getRootAlias();

		$query->andWhere($alias . '.expires_at > ?', date('Y-m-d h:i:s', time()))
			->addOrderBy($alias . '.expires_at DESC');

		return $query;
	}
}