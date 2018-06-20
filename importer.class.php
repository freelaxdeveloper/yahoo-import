<?php
require_once('yos-social-php/lib/Yahoo.inc');

class ContactsImporter
{
	const APP_ID = 'Contacts';
	const APP_KEY = 'dj0yJmk9UzlpTnZWOEZaU2NoJmQ9WVdrOU1uaERjMGRHTTJNbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD1lOA--';
	const APP_SECRET = 'ecb12031fcd920bb6dbfdce3d10745282c82ddf2';

	static public function fetchYahooContacts()
	{
		if (!isset($_GET['oauth_token']) && !isset($_GET['yahoo'])) {
			return;
		}
		$session = YahooSession::requireSession(self::APP_KEY, self::APP_SECRET, self::APP_ID);
		
		$query = sprintf("select * from social.contacts where guid=me;");  
		$response = $session->query($query);
		
		$emailArray = [];
		foreach( $response->query->results->contact as $contact ) {
			if (is_array($contact)) {
				foreach($contact as $field) {
					if ($field->type != 'email') {
						continue;
					}
					array_push($emailArray, $field->value);
				}
			}
		}
		return $emailArray;
	}
	
}