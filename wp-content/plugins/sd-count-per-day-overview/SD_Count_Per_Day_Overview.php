<?php
/*                                                                                                                                                                                                                                                             
Plugin Name: SD Count Per Day Overview
Plugin URI: http://it.sverigedemokraterna.se
Description: Shows an overview of the Count Per Day stats for all blogs in the network.
Version: 1.2
Author: Sverigedemokraterna IT
Author URI: http://it.sverigedemokraterna.se
Author Email: it@sverigedemokraterna.se
License: GPLv3
*/

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

/**
	SD Count Per Day Overview 
	
	@brief		Shows an overview of the Count Per Day stats for all blogs in the network.
	@author		Edward Plainview	edward.plainview@sverigedemokraterna.se
**/
require_once( 'SD_Count_Per_Day_Overview_Base.php' );
class SD_Count_Per_Day_Overview
	extends SD_Count_Per_Day_Overview_Base
{
	/**
		Local options.
		
		- @b role_use Minimum role needed to view the overview.
		
		@var	$local_options
	**/
	protected $site_options = array(
		'collect_minutes' => 360,		// 6 hours
		'hidden_blogs' => array(1),
		'overview_data' => false,
		'overview_data_collected' => false,
		'role_view' => 'administrator',
	);

	public function __construct()
	{
		parent::__construct( __FILE__ );

		add_action( 'admin_menu',									array( $this, 'admin_menu') );
		add_action( 'network_admin_menu',							array( $this, 'network_admin_menu') );
	}
	
	public function activate()
	{
		parent::activate();
		
		$data = $this->get_site_option( 'overview_data' );
		if ( $data === false )
		{
			if ( $this->cpd_installed() )
				$this->collect_data();
		}
	}

	// --------------------------------------------------------------------------------------------
	// ----------------------------------------- Admin
	// --------------------------------------------------------------------------------------------
	
	public function network_admin_menu()
	{
		if ( is_super_admin() )
		{
			$this->load_language();
			add_submenu_page(
				'index.php',
				$this->_('CPD overview'),
				$this->_('CPD overview'),
				'read',
				'sd_cpd_overview',
				array( &$this, 'admin' )
			);
		}
	} 
	
	public function admin_menu()
	{
		if ($this->role_at_least( $this->get_site_option('role_view') ))
		{
			$this->load_language();
			add_submenu_page(
				'index.php',
				$this->_('CPD overview'),
				$this->_('CPD overview'),
				'read',
				'sd_cpd_overview',
				array( &$this, 'admin' ),
				null
			);
		}
	}

	public function admin()
	{
		if ( ! $this->cpd_installed() )
		{
			$this->error( $this->_( "This plugin is useless without Count Per Day, which isn't installed. " ) );
			return;
		}

		$tab_data = array(
			'tabs'		=>	array(),
			'functions' =>	array(),
		);
				
		$tab_data['default'] = 'sessions_overview';

		$tab_data['tabs']['overview'] = $this->_( 'Overview' );
		$tab_data['functions']['overview'] = 'admin_overview';

		if ( $this->role_at_least( 'super_admin' ) )
		{
			$tab_data['tabs']['admin_settings'] = $this->_( 'Settings' );
			$tab_data['functions']['admin_settings'] = 'admin_settings';
			
			$tab_data['tabs']['admin_uninstall'] = $this->_( 'Uninstall' );
			$tab_data['functions']['admin_uninstall'] = 'admin_uninstall';
		}

		$this->tabs($tab_data);
	}
	
	/**
		@brief	The overview.
	**/
	public function admin_overview()
	{
		$overview_data_collected = $this->get_site_option( 'overview_data_collected' );
		
		$collect_minutes = $this->get_site_option( 'collect_minutes' );
		if ( strtotime( $this->now() ) - strtotime( $overview_data_collected ) > 60 * $collect_minutes )
			$this->collect_data();

		$overview_data = $this->get_site_option( 'overview_data' );
		
		$hidden_blogs = array_flip( $this->get_site_option( 'hidden_blogs' ) );

		$t_body = '';
		foreach( $overview_data as $blog_id => $data )
		{
			if ( ! is_super_admin() && isset( $hidden_blogs[ $blog_id ] ) )
				continue;
			$blog_name = '<a href="http://' . $data[ 'domain' ] . '">' . $data['blog_name'] . '</a>';
			$row = '<tr>';
			$row .= '<td>' . $blog_name . '</td>';
			$row .= '<td>' . $data[ 'ReadsToday' ] . '</td>';
			$row .= '<td>' . $data[ 'ReadsYesterday' ] . '</td>';
			$row .= '<td>' . $data[ 'ReadsLastWeek' ] . '</td>';
			$row .= '<td>' . $data[ 'ReadsThisMonth' ] . '</td>';
			$row .= '<td>' . $data[ 'ReadsAll' ] . '</td>';
			$row .= '<td>' . $data[ 'UserToday' ] . '</td>';
			$row .= '<td>' . $data[ 'UserYesterday' ] . '</td>';
			$row .= '<td>' . $data[ 'UserLastWeek' ] . '</td>';
			$row .= '<td>' . $data[ 'UserThisMonth' ] . '</td>';
			$row .= '<td>' . $data[ 'UserAll' ] . '</td>';
			$row .= '</tr>';
			$t_body .= $row;
		}
		
		$overview_data_collected = $this->get_site_option( 'overview_data_collected' );
		$returnValue = '
			<p>
				' . $this->_( 'Click on the column headers to sort the data. The data can be copied and pasted directly into a spreadsheet.' ) . '
			</p>
			<p>
				' . sprintf(
					$this->_( 'Last update: <span title="%s">%s</span>' ),
						$overview_data_collected,
						$this->ago( $overview_data_collected )
					) . '
			</p>
			<table class="widefat sd_count_per_day_overview">
				<thead>
					<tr>
						<th>' . $this->_( 'Blog' ) . '</th>
						<th>' . $this->_( 'Reads today' ) . '</th>
						<th>' . $this->_( 'Reads yesterday' ) . '</th>
						<th>' . $this->_( 'Reads last week' ) . '</th>
						<th>' . $this->_( 'Reads this month' ) . '</th>
						<th>' . $this->_( 'Total reads' ) . '</th>
						<th>' . $this->_( 'Visitors today' ) . '</th>
						<th>' . $this->_( 'Visitors yesterday' ) . '</th>
						<th>' . $this->_( 'Visitors last week' ) . '</th>
						<th>' . $this->_( 'Visitors this month' ) . '</th>
						<th>' . $this->_( 'Total visitors' ) . '</th>
					</tr>
				</thead>
				<tbody>
					' . $t_body . '
				</tbody>
			</table>
		';
		
		wp_enqueue_script( 'jquery-ui' );
		$returnValue .= '
			<script type="text/javascript" src="'. $this->paths["url"] . "/js/jquery.tablesorter.min.js" .'"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($)
				{
					$("table.sd_count_per_day_overview").tablesorter();
				}); 
			</script>
		';
		echo $returnValue;
	}
	/**
		@brief	Configure global Overview settings.
	**/
	public function admin_settings()
	{
		$form = $this->form();
		
		if ( isset( $_POST['collect'] ) )
		{
			$this->collect_data();
			$this->message( $this->_( 'The data has been collected from all the blogs!' ) );
		}
		
		if ( isset( $_POST['update'] ) )
		{
			foreach( $_POST['hidden_blogs'] as $index => $value )
				$_POST['hidden_blogs'][ $index ] = intval( $value );
			$this->update_site_option( 'hidden_blogs', $_POST['hidden_blogs'] );
			$this->update_site_option( 'role_view', $_POST['role_view'] );
			$this->message( $this->_( 'The settings have been updated!' ) );
		}
		
		$blogs = $this->get_all_blogs();
		$all_blogs = array();
		foreach( $blogs as $blog )
			$all_blogs[ $blog->blog_id ] = $blog->domain;
		asort( $all_blogs );
		
		$inputs = array(
			'collect_minutes' => array(
				'name' => 'collect_minutes',
				'type' => 'text',
				'label' => $this->_( 'Minutes between collections' ),
				'description' => $this->_( 'How long to wait between data collections. Note that this is very database-intensive and should be set to a high value of at least several hours.' ),
				'value' => $this->get_site_option( 'collect_minutes' ),
				'size' => 6,
			),
			'hidden_blogs' => array(
				'name' => 'hidden_blogs',
				'type' => 'select',
				'label' => $this->_( 'Hidden blogs' ),
				'description' => $this->_( 'Which blogs should be hidden in the overview from all users except network admins?' ),
				'options' => $all_blogs,
				'value' => $this->get_site_option( 'hidden_blogs' ),
				'multiple' => true,
				'css_style' => 'height: auto;',
				'size' => 5,
			),
			'collect' => array(
				'name' => 'collect',
				'type' => 'submit',
				'value' => $this->_( 'Collect data now' ),
				'css_class' => 'button-secondary',
			),
			'role_view' => array(
				'name' => 'role_view',
				'type' => 'select',
				'label' => $this->_( 'Role to view the overview' ),
				'description' => $this->_( 'What is the minimum use role needed to view the overview?' ),
				'options' => $this->roles_as_options(),
				'value' => $this->get_site_option( 'role_view' ),
			),
			'update' => array(
				'name' => 'update',
				'type' => 'submit',
				'value' => $this->_( 'Update settings' ),
				'css_class' => 'button-primary',
			),
		);
		
		$returnValue = $form->start();
		$returnValue .= $this->display_form_table( array(
			'inputs' => array(
				$inputs['role_view'],
				$inputs['collect_minutes'],
				$inputs['hidden_blogs'],
				$inputs['update'],
			),
		) );
		
		$returnValue .= $form->make_input( $inputs['collect'] );
		
		$returnValue .= $form->stop();

		echo $returnValue;
	}

	// --------------------------------------------------------------------------------------------
	// ----------------------------------------- Misc
	// --------------------------------------------------------------------------------------------
	
	/**
		Checks if Count Per Day is installed at all.
		
		@return		True, if CPD is installed.
	**/
	public function cpd_installed()
	{
		global $count_per_day;
		return ( $count_per_day !== null );
	}
	
	/**
		Goes through all the blogs and collects their domain and CPD data.
	**/
	public function collect_data()
	{
		global $count_per_day;

		$blogs = array();
		
		$network_blogs = $this->get_all_blogs();

		foreach( $network_blogs as $blog )
		{
			$blog_id = $blog->blog_id;
			
			$count_per_day->getReadsAll(true);
			
			switch_to_blog( $blog_id );
			
			$data = array(
				'domain' => $blog->domain,
				'blog_name' => get_bloginfo( 'blog_name' ),
			);
			
			// Just me trying to be effective.
			$types = array( 'Today', 'Yesterday', 'LastWeek', 'ThisMonth', 'All' );
			foreach( $types as $type )
			{
				foreach( array('Reads', 'User') as $what )
				{
					$function = 'get' . $what . $type;
					$data[ $what . $type ] = $count_per_day->$function( true );
				}
			}

			restore_current_blog();
			
			$blogs[ $blog_id ] = $data;
		}
		
		$this->update_site_option( 'overview_data', $blogs );
		$this->update_site_option( 'overview_data_collected', $this->now() );
	}
	
	/**
		@return		An array of all available blogs.
	**/
	public function get_all_blogs()
	{
		global $wpdb;
		return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_blogs ORDER BY blog_id" ) );
	}
}
$SD_Count_Per_Day_Overview = new SD_Count_Per_Day_Overview();
