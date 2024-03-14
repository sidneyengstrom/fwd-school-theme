<?php
function fwd_register_custom_post_types() {
    
    // Register Staff
    $labels = array(
        'name'                  => _x( 'Staff', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name'),
        'menu_name'             => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'staff' ),
        'add_new_item'          => __( 'Add Title' ),
        'new_item'              => __( 'New Staff' ),
        'edit_item'             => __( 'Edit Staff' ),
        'view_item'             => __( 'View Staff' ),
        'all_items'             => __( 'All Staff' ),
        'search_items'          => __( 'Search Staff' ),
        'parent_item_colon'     => __( 'Parent Staff:' ),
        'not_found'             => __( 'No staff found.' ),
        'not_found_in_trash'    => __( 'No staff found in Trash' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-forms',
        'supports'           => array( 'title'),
    );

    register_post_type( 'fwd-staff', $args );


 // Register Students
 $labels = array(
    'name'                  => _x( 'Students', 'post type general name' ),
    'singular_name'         => _x( 'Student', 'post type singular name'),
    'menu_name'             => _x( 'Student', 'admin menu' ),
    'name_admin_bar'        => _x( 'Student', 'add new on admin bar' ),
    'add_new'               => _x( 'Add New', 'student' ),
    'add_new_item'          => __( 'Add student name' ),
    'new_item'              => __( 'New Student' ),
    'edit_item'             => __( 'Edit Student' ),
    'view_item'             => __( 'View Student' ),
    'all_items'             => __( 'All Students' ),
    'search_items'          => __( 'Search Students' ),
    'parent_item_colon'     => __( 'Parent Student:' ),
    'not_found'             => __( 'No student found.' ),
    'not_found_in_trash'    => __( 'No student found in Trash' ),
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'show_in_nav_menus'  => true,
    'show_in_admin_bar'  => true,
    'show_in_rest'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'student' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'menu_icon'          => 'dashicons-admin-users',
    'supports'           => array( 'title'),
    'template' => array(
        
        array( 
            'core/paragraph', 
            array(
                'placeholder' => 'Add Bio...',
            )
        ),
        array( 
            'core/button', 
            array(
                'placeholder' => 'Portfolio',
            )
        ),
    ),
    'template_lock' => 'all'
);

register_post_type( 'fwd-students', $args );
}


add_action( 'init', 'fwd_register_custom_post_types' );

function fwd_register_taxonomies() {
    // Add Staff Category taxonomy
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Category' ),
        'parent_item'       => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'view_item'         => __( 'View Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'         => __( 'Staff Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-categories' ),
    );
    register_taxonomy( 'fwd-staff-category', array( 'fwd-staff' ), $args );}

add_action( 'init', 'fwd_register_taxonomies');

function fwd_rewrite_flush() {
    fwd_register_custom_post_types();
    fwd_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fwd_rewrite_flush' );

