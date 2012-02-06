<?php
/* including local app config */
require_once(dirname(__FILE__).'/config.php');

/**
 * You must fill it in with some random string
 * this protects some of your user's data when sent over the network
 * and must be different from other sites
 */
UserConfig::$SESSION_SECRET = $randomness;

/**
 * Database connectivity 
 */
UserConfig::$mysql_db = $mysql_db;
UserConfig::$mysql_user = $mysql_user;
UserConfig::$mysql_password = $mysql_password;
#UserConfig::$mysql_host = 'localhost';
#UserConfig::$mysql_port = '...port...';

/**
 * Username and password registration configuration
 * just have these lines or comment them out if you don't want regular form registration
 */
UserConfig::loadModule('usernamepass');
new UsernamePasswordAuthenticationModule();

/**
 * User IDs of admins for this instance (to be able to access dashboard at /users/admin/)
 */
UserConfig::$admins = array( 1 ); // usually first user has ID of 1

/**
 * Set these to point at your header and footer or leave them commented out to use default ones
 */
UserConfig::$header = dirname(__FILE__).'/header.php';
UserConfig::$footer = dirname(__FILE__).'/footer.php';

/**
 * Let's have a few custom plans
*/
$individual_plan = new Plan(1, 'Individual', true);
$team_plan = new Plan(2, 'Team');

/**
 * When user is registered, let's create some dummy accounts for him so we can look at different states of the account
 */
UserConfig::$onCreate = 'initSampleSubscriptionAppUser';
function initSampleSubscriptionAppUser($user)
{
	global $individual_plan, $team_plan;

	// assume that current account is default account for newly created user
	$account = Account::getCurrentAccount($user);

	// Creating dummy single-user account with this user being an admin	
	Account::createAccount($user->getName()."'s Personal Account", $individual_plan, $user, Account::ROLE_ADMIN);

	// Creating dummy account with this user being an admin	
	Account::createAccount($user->getName()."'s Business Account", $team_plan, $user, Account::ROLE_ADMIN);

	// Creating dummy account with this user being regular user
	Account::createAccount("Somebody else's account", $team_plan, $user);
}

/**
 * Facebook Connect configuration
 * Register your app here: http://www.facebook.com/developers/createapp.php
 * Click "Edit settings" -> "Web Site" and enter your site's URL
 * And then uncomment two lines below and copy API Key and App Secret
 */
#UserConfig::loadModule('facebook');
#new FacebookAuthenticationModule('...api.key.goes.here...', '...api.secret.goes.here...');

/**
 * Twitter Authentication configuration
 * Register your app here: https://dev.twitter.com/apps/new
 * And then uncomment two lines below and copy API Key and App Secret
 */
#UserConfig::loadModule('twitter');
#UserConfig::$modules[] = new TwitterAuthenticationModule('...api.key.goes.here...', '...api.secret.goes.here...');

/**
 * Status.Net Authentication configuration
 * Register your app with your Status.Net installation
 * And then uncomment two lines below and copy API Key, App Secret
 * as well as provider name and root URL for the site and API
 */
#UserConfig::loadModule('statusnet');
#new StatusNetAuthenticationModule('...api.key.goes.here...', '...api.secret.goes.here...', '...provider.name...', '...base.app.url...', '...base.api.url...');

# Identi.ca's simplified setup (get your keys here: http://identi.ca/settings/oauthapps)
#UserConfig::loadModule('statusnet');
#new StatusNetAuthenticationModule('...identi.ca.api.key.goes.here...', '...identi.ca.api.secret.goes.here...');

/**
 * Google Friend Connect configuration
 * Register your app here: http://www.google.com/friendconnect/admin/site/setup
 * And then uncomment two lines below and copy the site ID from the URL
 */
#UserConfig::loadModule('google');
#new GoogleAuthenticationModule('...site.id.goes.here...');

/**
 * Google OAuth Authentication configuration
 * Register your app here: https://www.google.com/accounts/ManageDomains
 * Add URL for your site, verify it using one of the methods provided
 * And then uncomment lines below and copy API Key and App Secret
 * Optional 3rd parameter is an array of API scopes you need authorization for.
 * 	See up-to-date list of scopes here: http://code.google.com/apis/gdata/faq.html#AuthScopes
 *	(Google Contacts API scope is required and is included by default)
 */
#UserConfig::loadModule('google_oauth');
#new GoogleOAuthAuthenticationModule(
#	'...OAuth.key.goes.here...',
#	'...OAuth.secret.goes.here...',
#	array(
#		'https://www.google.com/analytics/feeds/',		// Google Analytics Data API
#		'http://www.google.com/base/feeds/',			// Google Base Data API
#		'https://sites.google.com/feeds/',			// Google Sites Data API
#		'http://www.blogger.com/feeds/',			// Blogger Data API
#		'http://www.google.com/books/feeds/',			// Book Search Data API
#		'https://www.google.com/calendar/feeds/',		// Calendar Data API
#		'https://docs.google.com/feeds/',			// Documents List Data API
#		'http://finance.google.com/finance/feeds/',		// Finance Data API
#		'https://mail.google.com/mail/feed/atom/',		// Gmail Atom feed
#		'http://maps.google.com/maps/feeds/',			// Maps Data API
#		'http://picasaweb.google.com/data/',			// Picasa Web Albums Data API
#		'http://www.google.com/sidewiki/feeds/',		// Sidewiki Data API
#		'https://spreadsheets.google.com/feeds/',		// Spreadsheets Data API
#		'http://www.google.com/webmasters/tools/feeds/',	// Webmaster Tools API
#		'http://gdata.youtube.com'				// YouTube Data API
#	)
#);

/**
 * Meetup Authentication configuration
 * Register your app here: http://www.meetup.com/meetup_api/oauth_consumers/
 * Click red "Register OAuth Consumer" button on the right and enter your site's name and URL
 * And then uncomment two lines below and copy API Key and App Secret
 */
#UserConfig::loadModule('meetup');
#new MeetupAuthenticationModule('...OAuth.key.goes.here...', '...OAuth.secret.goes.here...');

