<?php

class ContactLibrary 
{
	public function sendMessage($post) {
		global $CORE;
		$mailcheck = $CORE->email_spam_check($post['from_email']);
		if ($mailcheck) {
			$from = $post['from_email'];
			$subject = "Inkstand Contact Component ";
			$subject .= $post['subject'];
			$message = $post['message'];
			$message .= "\r\n" . $post['name'];
			$to = $this->getEmailTo();
			$CORE->send_email($to, $subject, $message, $from);
		} else {
			echo "email was not sent due to spam mail entered";
		}
	}

	public function setEmailTo($post) {
		global $CORE;
		$table = $CORE->get_table_format("contact");
		DB::update($table, array('value' => $post['emailto']), "name=%s", 'email_to');
	}

	public function getEmailTo() {
		global $CORE;
		$table = $CORE->get_table_format("contact");
		return DB::queryFirstField("SELECT value FROM $table WHERE name=%s", 'email_to');
	}
	
}

?>