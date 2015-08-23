<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobeetCategory extends BaseJobeetCategory
{
	public function __toString(){
		return $this->getName();
	}
	
	public function getActiveJobs ($max = 10){
		$query = $this->getActiveJobsQuery()->limit($max);
			
		return $query->execute();
	}


	public function countActiveJobs(){
		$query = $this->getActiveJobsQuery();

		return $query->count();
	}

	public function getActiveJobsQuery(){
		$q = Doctrine_Query::create()
			->from('JobeetJob j')
			->where('j.category_id = ?', $this->getId());

		return Doctrine::getTable('JobeetJob')->addActiveJobsQuery($q);
	}
}