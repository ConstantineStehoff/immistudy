<?php
session_start();

class Docothemes_Post_Type{
	
	private $post_type_name;
	private $post_type_args;
	
	function __construct($name, $post_type_args = array()){
		if (!isset($_SESSION["taxonomy_data"])){
			$_SESSION['taxonomy_data'] = array();
		}
		$this->post_type_name = $name;
		$this->post_type_args = (array)$post_type_args;
		$this->init(array(&$this, "register_post_type"));
		
		$this->save_post();
	}

	public function init($func){
		add_action('init', $func);
	}
	
	function admin_init($cb){
	    add_action("admin_init", $cb);
	}
	
	public function register_post_type(){
		$n = $this->post_type_name;
		$labels = array(
			'name' => _x($n, 'post type general name'), 
			'singular_name' => _x(substr($n, 0, strlen($n) - 1), 'post type singular name'), 	
			'add_new' => _x('Add New', substr($n, 0, strlen($n) - 1)),
			'add_new_item' => __('Add New ' . substr($n, 0, strlen($n) - 1)),
			'edit_item' => __('Edit ' . substr($n, 0, strlen($n) - 1)),
			'new_item' => __('New ' . substr($n, 0, strlen($n) - 1)),
			'view_item' => __('View ' . substr($n, 0, strlen($n) - 1)),
			'search_items' => __('Search ' . $n),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''		
		);
	
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			//'menu_icon' =&gt; get_stylesheet_directory_uri() . '/article16.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail')
		);
		
		$args = array_merge($args, $this->post_type_args);
		
		register_post_type(strtolower(str_replace(' ', '_', $this->post_type_name)), $args);
	}
	
	public function register_taxonomy($taxonomy_name, $taxonomy_args = array()){
		$this->init(function() use ($taxonomy_name, $taxonomy_args){
			$labels = array(
			    'name' => _x( $taxonomy_name . 's', 'taxonomy general name' ),
			    'singular_name' => _x( $taxonomy_name, 'taxonomy singular name' ),
			    'search_items' =>  __( 'Search ' . $taxonomy_name . 's' ),
			    'popular_items' => __( 'Popular ' . $taxonomy_name . 's' ),
			    'all_items' => __( 'All ' . $taxonomy_name . 's' ),
			    'parent_item' => null,
			    'parent_item_colon' => null,
			    'edit_item' => __( 'Edit ' . $taxonomy_name ), 
			    'update_item' => __( 'Update ' . $taxonomy_name ),
			    'add_new_item' => __( 'Add New ' . $taxonomy_name ),
			    'new_item_name' => __( 'New ' . $taxonomy_name . ' Name' ),
			    'separate_items_with_commas' => __( 'Separate ' . $taxonomy_name . 's' . ' with commas' ),
			    'add_or_remove_items' => __( 'Add or remove ' . $taxonomy_name . 's' ),
			    'choose_from_most_used' => __( 'Choose from the most used ' . $taxonomy_name . 's' ),
			    'menu_name' => __( $taxonomy_name . 's' ),
			  ); 
			
			  $args = array(
			    'hierarchical' => false,
			    'labels' => $labels,
			    'show_ui' => true,
			    'update_count_callback' => '_update_post_term_count',
			    'query_var' => true,
			    'rewrite' => array( 'slug' =>  strtolower($taxonomy_name)),
			  );
			  $args = array_merge($args, $taxonomy_args);
			  
			  register_taxonomy(strtolower(str_replace(' ', '_', $taxonomy_name)), strtolower($this->post_type_name), $args);
		});
	}	
	
	
	/**
	* Creates a new custom meta box in the New 'post_type' page.
	*
	* @param string $title
	* @param array $form_fields Associated array that contains the label of the input, and the desired input type. 'Title' => 'text'
	*/
	 function add_meta_box($title, $form_fields = array()){
	 	$post_type_name = $this->post_type_name;
	
	    // end update_edit_form
	    add_action('post_edit_form_tag', function(){
	                echo 'enctype="multipart/form-data"';
	            });
	
	
	        // At WordPress' admin_init action, add any applicable metaboxes.
	        $this->admin_init(function() use($title, $form_fields, $post_type_name)
	            {
	                add_meta_box(
	                    strtolower(str_replace(' ', '_', $title)), // id
	                    $title, // title
	                    function($post, $data)
	                    { // function that displays the form fields
	                        global $post;
	
	                        wp_nonce_field(plugin_basename(__FILE__), 'docothemes_nonce');
	
	                        // List of all the specified form fields
	                        $inputs = $data['args'][0];
	
	                        // Get the saved field values
	                        $meta = get_post_custom($post->ID);
	
	                        // For each form field specified, we need to create the necessary markup
	                        // $name = Label, $type = the type of input to create
	                        foreach ($inputs as $name => $type) {
	                            #'Happiness Info' in 'Snippet Info' box becomes
	                            # snippet_info_happiness_level
	                            $id_name = $data['id'] . '_' . strtolower(str_replace(' ', '_', $name));
	
	                            if (is_array($inputs[$name])) {
	                                // then it must be a select or file upload
	                                // $inputs[$name][0] = type of input
	
	                                if (strtolower($inputs[$name][0]) === 'select') {
	                                    // filter through them, and create options
	                                    $select = "<select name='$id_name' class='widefat'>";
	                                    foreach ($inputs[$name][1] as $option) {
	                                        // if what's stored in the db is equal to the
	                                        // current value in the foreach, that should
	                                        // be the selected one
	
	                                        if (isset($meta[$id_name]) && $meta[$id_name][0] == $option) {
	                                            $set_selected = "selected='selected'";
	                                        } else $set_selected = '';
	
	                                        $select .= "<option value='$option' $set_selected> $option </option>";
	                                    }
	                                    $select .= "</select>";
	                                    array_push($_SESSION['taxonomy_data'], $id_name);
	                                }
	                            }
	
	                            // Attempt to set the value of the input, based on what's saved in the db.
	                            $value = isset($meta[$id_name][0]) ? $meta[$id_name][0] : '';
	
	                            $checked = ($type == 'checkbox' && !empty($value) ? 'checked' : '');
	
	                            // Sorta sloppy. I need a way to access all these form fields later on.
	                            // I had trouble finding an easy way to pass these values around, so I'm
	                            // storing it in a session. Fix eventually.
	                            array_push($_SESSION['taxonomy_data'], $id_name);
	
	                            // TODO - Add the other input types.
	                            $lookup = array(
	                                "text" => "<input type='text' name='$id_name' value='$value' class='widefat' />",
	                                "textarea" => "<textarea name='$id_name' class='widefat' rows='10'>$value</textarea>",
	                                "checkbox" => "<input type='checkbox' name='$id_name' value='$name' $checked />",
	                                "select" => isset($select) ? $select : '',
	                                "file" => "<input type='file' name='$id_name' id='$id_name' />"
	                            );
	                            ?>
	
								<p>
								<label><?php echo ucwords($name) . ':'; ?></label>
								<?php echo $lookup[is_array($type) ? $type[0] : $type]; ?>
								</p>
								
								<p>
	
									<?php
	                                    // If a file was uploaded, display it below the input.
	                                    $file = get_post_meta($post->ID, $id_name, true);
	                                    if ( $type === 'file' ) {
	                                        // display the image
	                                        $file = get_post_meta($post->ID, $id_name, true);
	
	                                        $file_type = wp_check_filetype($file);
	                                        $image_types = array('jpeg', 'jpg', 'bmp', 'gif', 'png');
	                                        if ( isset($file) ) {
	                                            if ( in_array($file_type['ext'], $image_types) ) {
	                                                echo "<img src='$file' alt='' style='max-width: 400px;' />";
	                                            } else {
	                                                echo "<a href='$file'>$file</a>";
	                                            }
	                                        }
	                                    }
	                                ?>
								</p>
	
								<?php
	
	                        }
	                    },
	                    $post_type_name, // associated post type
	                    'normal', // location/context. normal, side, etc.
	                    'default', // priority level
	                    array($form_fields) // optional passed arguments.
	                ); // end add_meta_box
	            });

		}

	 /**
	* When a post saved/updated in the database, this methods updates the meta box params in the db as well.
	*/
	    function save_post()
	    {
	        add_action('save_post', function()
	            {
	                // Only do the following if we physically submit the form,
	                // and now when autosave occurs.
	                if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
	                global $post;
					
					if ($_POST && !wp_verify_nonce($_POST['docothemes_nonce'], plugin_basename(__FILE__))) {
	                    return;
	                }
	
	                // Get all the form fields that were saved in the session,
	                // and update their values in the db.
	                if (isset($_SESSION['taxonomy_data'])) {
	                    foreach ($_SESSION['taxonomy_data'] as $form_name) {
	                        if (!empty($_FILES[$form_name]) ) {
	                            if ( !empty($_FILES[$form_name]['tmp_name']) ) {
	                                $upload = wp_upload_bits($_FILES[$form_name]['name'], null, file_get_contents($_FILES[$form_name]['tmp_name']));
	
	                                if (isset($upload['error']) && $upload['error'] != 0) {
	                                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
	                                } else {
	                                    update_post_meta($post->ID, $form_name, $upload['url']);
	                                }
	                            }
	                       } else {
	                            // Make better. Have to do this, because I can't figure
	                            // out a better way to deal with checkboxes. If deselected,
	                            // they won't be represented here, but I still need to
	                            // update the value to false to blank in the table. Hmm...
	                            if (!isset($_POST[$form_name])) $_POST[$form_name] = '';
	                            if (isset($post->ID) ) {
	                                update_post_meta($post->ID, $form_name, $_POST[$form_name]);
	                            }
	                        }
	                    }
	
	                    $_SESSION['taxonomy_data'] = array();
	
	                }
	
	            });
	    }
}

// $product->add_meta_box('Movie Info', array(
// 'name' => 'text',
// 'rating' => 'text',
// 'review' => 'textarea',
// 'Profile Image' => 'file'

?>