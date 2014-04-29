<?php

class ContactLibrary 
{
	public function sendMessage($post) {
		global $CORE;
		$mailcheck = $CORE->emailspamcheck($post['from_email']);
		if ($mailcheck) {
			$from = $post['from_email'];
			$subject = $post['subject'];
			$message = $post['message'];
			$to = getEmailTo();
			$CORE->sendemail($to, $subject, $message, $from);
		} else {
			echo "email was not sent due to spam mail entered";
		}
	}

	public function setEmailTo($post) {
		global $CORE;
		$table = $CORE->getTableFormat("contact");
		DB::update($table, array('value' => $post['emailto']), "name=%s", 'email_to');
	}

	public function getEmailTo() {
		global $CORE;
		$table = $CORE->getTableFormat("contact");
		return DB::queryFirstField("SELECT value FROM $table WHERE name=%s", 'email_to');
	}
	
}

?>