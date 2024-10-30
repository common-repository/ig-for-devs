<?php
//Instaham plugin backend Admin.

include_once 'vendor/autoload.php';
use MetzWeb\Instagram\Instagram as YDInstagram;//make sure we don't collide

// create custom plugin settings menu
add_action('admin_menu', 'ydinsta_create_menu');

function ydinsta_create_menu() {
	//create new top-level menu
	add_menu_page('Instagram Settings', 'Instagram Settings', 'administrator', __FILE__, 'ydinsta_settings_page','dashicons-admin-generic');

	//call register settings function
	add_action( 'admin_init', 'register_ydinsta_settings' );
}

function register_ydinsta_settings() {
	//register our settings
	register_setting( 'ydinsta-settings-group', 'insta_client_id' );
	register_setting( 'ydinsta-settings-group', 'insta_client_secret' );
	register_setting( 'ydinsta-settings-group', 'insta_default_limit' );
	register_setting( 'ydinsta-settings-group', 'insta_cache' );
	register_setting( 'ydinsta-settings-group', 'insta_access_token' );
	register_setting( 'ydinsta-settings-group', 'insta_user_id' );
}

function ydinsta_view_header() { ?>
			<h2>Instagram Plugin</h2>
			<p>By <a href="http://y-designs.com">Y-Designs, Inc | A Seattle Web Design Company</a></p>
			<p>To use this plugin, just place the shortcode below anywhere in your content. <pre>[insta_dev]</pre> </p>
<?php
}

function ydinsta_settings_page() { //yup, classc WP stuff. 

		//did we get the code?
		$code = false; 
		if( array_key_exists('code', $_GET) ) {
			$code = $_GET['code'];
		}

		//Load in the existing attributes
		$attr = shortcode_atts(array(
			'insta_client_id' => get_option('insta_client_id'),
			'insta_client_secret' => get_option('insta_client_secret'),
			'insta_limit' => get_option('insta_default_limit',10),
			'insta_cache' => get_option('insta_cache')
		), false);

		//Make a new instagram instance.
		$instagram = new YDInstagram(array(
			'apiKey' 	=> $attr['insta_client_id'],
			'apiSecret' => $attr['insta_client_secret'],
			'apiCallback' => admin_url( 'admin.php?page=ig-for-devs%2Fadmin.php')
		));

		if(get_option('insta_client_id') && get_option('insta_client_secret')):
			if( $code )://Gotta store that code.
				$data = $instagram->getOAuthToken($code);
				$token = $data->access_token;
				//$instagram->setAccessToken($token);
				$user_id = explode('.',$token)[0];
				update_option('insta_user_id',$user_id);
				update_option('insta_access_token',$token);
				?>
				<div class="wrap">
					<?php echo ydinsta_view_header()?>
					<p><strong>Step 3: </strong>Back to Settings:</p>
					<a class='button button-primary' href='<?php echo admin_url( 'admin.php?page=ig-for-devs%2Fadmin.php')?>'>Back to Instagram Settings!</a>
				</div>
			<?php
			elseif( !$code && !get_option('insta_user_id') )://Gotta run that query.
				$scope = array(
					    'basic',
					    'public_content'
					);
					?>
				<div class="wrap">
					<?php echo ydinsta_view_header()?>
					<p><strong>Step 2: </strong>Login:</p>
					<a class='button button-primary' href='<?php echo $instagram->getLoginUrl($scope)?>'>Login with Instagram</a>
				</div>
			<?php
			else:
				ydinsta_form();
			endif;
		else:
			ydinsta_form();
		endif;

}//end of ydinsta_settings_page

function ydinsta_form() {?>
	<div class="wrap">
			<?php echo ydinsta_view_header()?>
			<p><strong>Step 1: </strong>Fill out this form with API keys</p>
			<form method="post" action="options.php">
			    <?php settings_fields( 'ydinsta-settings-group' ); ?>
			    <?php do_settings_sections( 'ydinsta-settings-group' ); ?>
			    <table class="form-table">
			        <tr valign="top">
			        	<th scope="row">Client ID</th>
				        <td>
				        	<input type="text" name="insta_client_id" value="<?php echo esc_attr( get_option('insta_client_id') ); ?>" />
				        </td>
			        </tr>
			         
			        <tr valign="top">
			        	<th scope="row">Client Secret</th>
				        <td>
				        	<input type="text" name="insta_client_secret" value="<?php echo esc_attr( get_option('insta_client_secret') ); ?>" />
				        </td>
			        </tr>

			        <tr valign="top">
			        	<th scope="row">Default Limit</th>
				        <td>
				        	<input type="text" name="insta_default_limit" value="<?php echo esc_attr( get_option('insta_default_limit') ); ?>" />
				        </td>
			        </tr>

			        <tr valign="top">
				        <th scope="row">Cache for 10 min?</th>
				        <td>
				        	<input type="checkbox" name="insta_cache" <?php echo esc_attr( get_option('insta_cache') ) ? 'checked' : ''  ; ?> />
				        </td>
			        </tr>
			    </table>
			    
			    <?php submit_button(); ?>

			    
			</form>
		</div>

<?php
}
