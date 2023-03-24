<?php 
require_once( get_template_directory() . '/app/modules/myaccount/class-mona-myaccount-hooks.php' );
//require_once( get_template_directory() . '/app/modules/myaccount/class-mona-myaccount-address.php' );

function mona_is_wc_endpoint($endpoint) {
    // Use the default WC function if the $endpoint is not provided
    if ( empty($endpoint) ) 
        return is_wc_endpoint_url();

    // Query vars check
    global $wp;
    if ( empty($wp->query_vars) )
        return false;

    $queryVars = $wp->query_vars;
    if (
        !empty($queryVars['pagename'])
        // Check if we are on the Woocommerce my-account page
        && $queryVars['pagename'] == 'my-account'
    ) {
        // Endpoint matched i.e. we are on the endpoint page
        if (isset($queryVars[$endpoint])) 
            return true;
        // Dashboard my-account page special check - check whether the url ends with "my-account"
        if ($endpoint == 'dashboard') {
            $requestParts = explode('/', trim($wp->request, ' \/'));
            if (end($requestParts) == 'my-account') return true;
        }
    }
    return false;
}