<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       meccaproduction-nc-coatal
 * @since      1.0.0
 *
 * @package    Meccaproduction_Nc_Coatal
 * @subpackage Meccaproduction_Nc_Coatal/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Meccaproduction_Nc_Coatal
 * @subpackage Meccaproduction_Nc_Coatal/admin
 * @author     Mecca Production  <contact@meccaproduction.com>
 */
class Meccaproduction_Nc_Coatal_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meccaproduction_Nc_Coatal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meccaproduction_Nc_Coatal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/meccaproduction-nc-coatal-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meccaproduction_Nc_Coatal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meccaproduction_Nc_Coatal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meccaproduction-nc-coatal-admin.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js', array( '' ), $this->version, false );

	}


	/* public function team_post_meta(){
	
		$labels = array(
			"name" => __( "Team Start Dates", "playhockey" ),
			"singular_name" => __( "Team Start Date", "playhockey" ),
		);

		$args = array(
			"label" => __( "Team Start Dates", "playhockey" ),
			"labels" => $labels,
			"public" => true,
			"hierarchical" => false,
			"label" => "Team Start Dates",
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'team_start_date', 'with_front' => true, ),
			"show_admin_column" => false,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => false,
		);
		register_taxonomy( "team_start_date", array( "team" ), $args );
	}*/ 

	public function team_meta_installments($object)
	{
	    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

	    $oInstallMentObject = get_post_meta($object->ID, "team-installment-object", true) ; 

	    if($oInstallMentObject == ""){
	    	$oInstallMentObject = "[]";
	    }

	    ?>
	        <div ng-app="installmentApp">
	            <label for="team-installment-object">Installment Dates / Price:</label>
	             <div ng-controller="InstallmentController as todoList">
	             	  <div>
		             	  <input hidden name="team-installment-object" id="list_container" value="{{todoList.todos}}">
		             	  <input type="date" ng-model="todoList.date"  size="30" placeholder="Date">
					      <input type="number" ng-model="todoList.price"  size="30" placeholder="Price" min="0.00" max="10000.00" step="0.01">
					      <btn class="button button-primary" ng-disabled="todoList.disableAdd()" value="add" ng-click="todoList.addTodo()" ng-hide="todoList.editing">Add</btn>

					      <btn class="button button-primary" value="add" ng-click="todoList.addTodo()" ng-show="todoList.editing">Update</btn> 
					      <btn class="button button-primary" value="add" ng-click="todoList.undoTodo()" ng-show="todoList.editing">Undo</btn>
				      </div>
				      <ul class="unstyled">
				        <li ng-repeat="todo in todoList.todos | orderBy: 'date' ">
				          <label class="checkbox">
				            <span>Date : {{todo.date | date:'MM/dd/yyyy'}}</span>
				            <span>Price : {{todo.price | currency }}</span>
				            <btn class="button " value="add" ng-click="todoList.edit(todo)">Edit</btn>
				            <btn class="button " value="add" ng-click="todoList.removeTodo(todo)">Remove</btn>
				          </label>
				        </li>
				      </ul>
				    </div>
	        </div>

	        <script> 
	        	angular.module('installmentApp', [])
					  .controller('InstallmentController', function() {
					    var todoList = this;
					    todoList.todos = <?php echo $oInstallMentObject; ?> ;
					    todoList.date = ''; 
					    todoList.price = ''; 
					    todoList.dateBackUp = ''; 
					    todoList.priceBackUp = ''; 

					    todoList.editing = false; 
					 	todoList.disableAdd = function(){
					 		console.log(todoList.price); 
					 		if (todoList.date == '' || todoList.price == ''){
					 			return true; 
					 		}else{
					 			return false; 
					 		}
					 	}
					    todoList.addTodo = function() {
					      todoList.todos.push({date:todoList.date, price:todoList.price});
					      todoList.date = '';
					      todoList.price = ''; 
					      todoList.editing = false; 
					    };
					    todoList.undoTodo = function() {
					      todoList.todos.push({date:todoList.dateBackUp, price:todoList.priceBackUp});
					      todoList.date = '';
					      todoList.price = ''; 
					      todoList.dateBackUp = '';
					      todoList.priceBackUp = ''; 
					      todoList.editing = false; 
					    };
					 
					    todoList.edit = function(todo){
							todoList.date = todo.date; 
							todoList.price = todo.price; 
							todoList.dateBackUp = todoList.date; 
							todoList.priceBackUp = todoList.price;  
							todoList.editing = true; 
					    	todoList.removeTodo(todo); 
					    }; 

					    todoList.removeTodo = function(todo){
					    	var index = todoList.todos.indexOf(todo);
					    	todoList.todos.splice(index, 1);
					    };
					  });
	        </script>
	    <?php  
	}

	public function team_meta_team_members($object)
	{
	    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

	}



	public function add_custom_meta_box(){
		add_meta_box("nc-coastal-team-meta-installments", "Installments", array( $this, 'team_meta_installments' ), "team", "normal", "high", null);
		add_meta_box("nc-coastal-team-meta-team-members", "Team Members", array( $this, 'team_meta_team_members' ), "team", "normal", "high", null);
	}



	public function save_custom_meta_box($post_id, $post, $update){
	    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
	        return $post_id;

	    if(!current_user_can("edit_post", $post_id))
	        return $post_id;

	    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
	        return $post_id;

	    $slug = "team";
	    if($slug != $post->post_type)
	        return $post_id;

	    $meta_box_dropdown_value = "";


	    if(isset($_POST["team-installment-object"]))
	    {
	        $meta_box_dropdown_value = $_POST["team-installment-object"];
	    }   
	    update_post_meta($post_id, "team-installment-object", $meta_box_dropdown_value);

	}

	public function user_meta_team($user){ 
		$iTeamId = esc_attr(get_user_meta($user->ID, 'team_assignment', true)); ?>
		<h3>Team Assignment</h3>
		<table class="form-table">
		    <tr>
		        <th>
		            <label for="team_assignment">Team</label>
		        </th>
		        <td>
		        	<select id="team_assignment" name="team_assignment" value="<?= esc_attr(get_user_meta($user->ID, 'team_assignment', true)); ?>">
		        		<option> Select a Team </option><?php 

			        	$args = array( 'post_type' => 'team', 'posts_per_page' => -1, 'post_status' => 'any', 'post_parent' => null ); 
						$attachments = get_posts( $args );
						if ( $attachments ) {
							$sPostTitle = "";
							foreach ( $attachments as $post ) {
								//setup_postdata( $post );
								$sPostTitle = get_the_title($post->ID);

								if($sPostTitle != ""){ 
									if($iTeamId == $post->ID){?>
										<option selected="selected" value="<?php echo $post->ID; ?>"><?php echo $sPostTitle; ?></option><?php
									}else{ ?>
										<option value="<?php echo $post->ID; ?>"><?php echo $sPostTitle; ?></option>
									<?php }
									$sPostTitle = "";
								}
							}
							wp_reset_postdata();
						}
						?>
					</select>
		        </td>
		    </tr>
		</table>
		<?php
	}
	function user_meta_team_update($user_id){
	    // check that the current user have the capability to edit the $user_id
	    if (!current_user_can('edit_user', $user_id)) {
	        return false;
	    }
	 
	    // create/update user meta for the $user_id
	    return update_user_meta(
	        $user_id,
	        'team_assignment',
	        $_POST['team_assignment']
	    );
	}
 

}
