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
			$table = $CORE->getTableFormat('contact');
			$to = DB::queryFirstField("SELECT value FROM $table WHERE name=%s", 'email_to');
			$CORE->sendemail($to, $subject, $message, $from);
		} else {
			echo "email was not sent due to spam mail entered";
		}
	}
	
}

?>