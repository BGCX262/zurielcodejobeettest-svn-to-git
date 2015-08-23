<?php
// lib/Jobeet.class.php

class Jobeet{
	
	static public function slugfy($text){
		// replace allnon letters or digits by -
		$text = preg_replace('/\W+/', '-', $text);
		
		// trim and lowercase
		$text = strtolower(trim($text, '-'));
		
		return $text;
	}
	
	public function save(Doctrine_Connection $conn = null) {
		if ($this->isNew() && !$this->getExpiresAt()) { //si se esta creando y no se especificó la fecha de expiración
			$now = $this->getCreatedAt() ? strtotime($this->getCreatedAt()) : time();
			//$this->setExpiresAt(date('Y-m-d h:i:s', $now + 86400 * 30));
			//Actualizamos el valor del tiempo con el especificado en la config. de la app.
			$this->setExpiresAt(date('Y-m-d h:i:s', $now + 86400 * sfConfig::get('app_active_days')));
		} 
		return parent::save($conn);
	}
}
?>