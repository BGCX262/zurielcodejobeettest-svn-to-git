<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class jobActions extends sfActions {
	public function executeIndex(sfWebRequest $request) {
		/*	El requisito del proyecto dice "mostrar los trabajos disponibles". Un trabajo deja de estar disponible al haber
		transcurrido 30 d�as desde la alta.

		$this->jobeet_job_list = Doctrine::getTable('JobeetJob')
		  ->createQuery('a')
		  ->execute();
		  */
		//$query = Doctrine_Query::Create()->from('JobeetJob j')->where('j.expires_at > ?', date('Y-m-d h:i:s', time()));

		$this->categories = Doctrine::getTable('JobeetCategory')->getWithJobs();
		//$this->jobeet_job_list = Doctrine::getTable('JobeetJob')->getActiveJobs();
	}
  
	public function executeShow(sfWebRequest $request) {
		//$this->jobeet_job = Doctrine::getTable('JobeetJob')->find($request->getParameter('id'));
		$this->jobeet_job = $this->getRoute()->getObject();
		// getRoute() autom�ticamente lanza un 404 si no existe el objeto
		//$this->forward404Unless($this->jobeet_job);
	}

	public function executeNew(sfWebRequest $request) {
		$job = new JobeetJob();
		$job->setType('full-time');

		$this->form = new JobeetJobForm($job);
	}

	public function executeCreate(sfWebRequest $request) {
		$this->form = new JobeetJobForm();
		$this->processForm($request, $this->form);
		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request) {
		$this->form = new JobeetJobForm($this->getRoute()->getObject());
	}

	public function executeUpdate(sfWebRequest $request) {
		$this->form = new JobeetJobForm($this->getRoute()->getObject());
		$this->processForm($request, $this->form);
		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request) {
		$request->checkCSRFProtection();

		$job = $this->getRoute()->getObject();
		$job->delete();

		$this->redirect('job/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form) {
		$form->bind(
			$request->getParameter($form->getName()),
			$request->getFiles($form->getName())
		);

		if ($form->isValid()) {
			$job = $form->save();
			$this->redirect($this->generateUrl('job_show', $job));
		}
	}

	public function executePublish(sfWebRequest $request) {
		$request->checkCSRFProtection();

		$job = $this->getRoute()->getObject();
		$job->publish();

		$this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));

		$this->redirect($this->generateUrl('job_show_user', $job));
	}
}