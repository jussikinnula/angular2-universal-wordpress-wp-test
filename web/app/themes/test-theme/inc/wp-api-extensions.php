<?php
/**
 * WP-API extensions
 *
 * @package frantic
 */

add_action( 'rest_api_init', function () {

    // Register ACF on all pages & posts
    $post_types = array( 'page', 'post' );
    foreach ($post_types as $type) {
        register_rest_field( $type,
            'acf',
            array(
                'get_callback' => 'get_acf_content',
                'update_callback' => null,
                'schema' => null,
            )
        );
    }

    register_rest_field( 'page',
        'is_home',
        array(
            'get_callback' => 'check_is_home',
            'update_callback' => null,
            'schema' => null,
        )
    );

    register_rest_field( 'page',
        'is_front_page',
        array(
            'get_callback' => 'check_is_front_page',
            'update_callback' => null,
            'schema' => null,
        )
    );

    register_rest_route( 'wp/v2', 'find', array(
        'methods' => 'GET',
        'callback' => 'find_post',
        'args' => array(
            'path' => array(
                'required' => false
            )
        )
    ) );

    // register_rest_route( 'acf/v2', 'options', array(
    //     'methods' => 'GET',
    //     'callback' => 'get_acf_options'
    // ) );
} );

function check_is_home( $object, $fieldName, $request ) {
    if ( $object ) {
        $home_post_id = get_option( 'page_for_posts' );
        $this_post_id = get_id_from_object( $object );
        return $home_post_id == $this_post_id;
    } else {
        return false;
    }
}

function check_is_front_page( $object, $fieldName, $request ) {
    if ( $object ) {
        $frontpage_post_id = get_option( 'page_on_front' );
        $this_post_id = get_id_from_object( $object );
        return $frontpage_post_id == $this_post_id;
    } else {
        return false;
    }
}

function get_id_from_object( $object ) {
    if ( isset( $object ) && is_array( $object ) && isset( $object["ID"] ) ) {
        return (int)$object["ID"];
    } else if ( isset( $object ) && is_array( $object ) && isset( $object["id"] ) ) {
        return (int)$object["id"];
    } else if ( isset( $object ) && is_object( $object ) && isset( $object->ID ) ) {
        return (int)$object->ID;
    }
}

function get_acf_content( $object, $fieldName, $request ) {
    return get_acf_content_callback( $object, null );
}

function get_acf_options( WP_REST_Request $request ) {
    $return['acf'] = get_acf_content_callback( null, 'option' );
    return new WP_REST_Response( $return );
}

function get_acf_content_callback( $object, $key = null) {
    $id = get_id_from_object( $object );
    if ( !$id && isset( $key ) ) {
        $id = $key;
    }

    $acf = new stdClass;
    if ( isset( $id ) ) {
        $fields = get_field_objects( $id );
        if ( $fields ) {
            foreach ( $fields as $field_name => $field ) {
                $acf->$field['name'] = add_permalink_to_post( $field['value'] );
            }
        }
    }
    return $acf;
}

function find_post( WP_REST_Request $request ) {
    if ( isset( $request['path'] ) ) {
        $post_types = array( 'page', 'post' );
        $object = get_page_by_path( $request['path'], ARRAY_A, $post_types );
    }

    if ( isset( $object ) ) {
        $object['acf'] = get_acf_content_callback( $object );
        if ( $object['post_type'] == 'page' ) {
            $object['is_home'] = check_is_home( $object, null, null );
            $object['is_front_page'] = check_is_front_page( $object, null, null );
        }
        $return = add_permalink_to_post( $object );
        $status = 200;
    } else if ( !isset( $error ) ) {
        $return = new stdClass;
        $return->code = 'not_found';
        $return->message = 'Path not found.';
        $status = 404;
    }

    $response = new WP_REST_Response( $return );
    $response->set_status( $status );
    return $response;
}

function add_permalink_to_post( $object ) {
    if ( isset( $object ) && is_array( $object ) ) {
        if ( isset( $object['ID'] ) ) {
            $id = (int)$object['ID'];
        } else if ( isset( $object['id'] ) ) {
            $id = (int)$object['id'];
        }
        $object['post_link'] = get_permalink( $id );
    } else if ( isset( $object ) && is_object( $object ) ) {
        $object->post_link = get_permalink( $object->ID );
    }
    return $object;
}