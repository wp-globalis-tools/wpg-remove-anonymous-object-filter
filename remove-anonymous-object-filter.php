<?php

function remove_anonymous_object_filter($tag, $class, $method) {
    $filters = $GLOBALS['wp_filter'][$tag];

    if (empty($filters)){
        return;
    }

 	if(get_bloginfo('version') < 4.7) {
      	$callbacks = $filters;
 	}
    else {
      	$callbacks = $filters->callbacks;
    }

    foreach ($callbacks as $priority => $filter) {
        foreach ($filter as $identifier => $function) {
            if (is_array( $function) && is_a( $function['function'][0], $class ) && $method === $function['function'][1]) {
              remove_filter($tag, array ( $function['function'][0], $method ), $priority);
            }
        }
    }
}
