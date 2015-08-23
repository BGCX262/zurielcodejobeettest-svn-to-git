<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseJobeetCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jobeet_category');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => '255',
             ));
    }

    public function setUp()
    {
        $this->hasMany('JobeetJob as JobeetJobs', array(
             'local' => 'id',
             'foreign' => 'category_id'));

        $this->hasMany('JobeetAffiliate as JobeetAffiliates', array(
             'refClass' => 'JobeetCategoryAffiliate',
             'local' => 'category_id',
             'foreign' => 'affiliate_id'));

        $this->hasMany('JobeetCategoryAffiliate', array(
             'local' => 'id',
             'foreign' => 'category_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}