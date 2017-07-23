<?php

/**
 * This is a simple, (mostly) JSONRPC 2.0 compliant PHP wrapper.
 *
 * @author  Automated Response <automated-response@protonmail.com>
 * @version 0.0.1
 *
 */


function curl( $url, $http_method='GET', $fields=NULL ) {
  $ch = curl_init();

  // HTTP method (GET, POST, PUT, etc)
  switch( strtoupper($http_method) ) {
    case 'POST' :
      curl_setopt( CURLOPT_POST, true );
      curl_setopt( CURLOPT_POSTFIELDS, $fields );
      break;
    default :
      curl_setopt( CURLOPT_HTTPGET, true );
      break;
  }

  curl_setopt_array( $ch, array(
    CURLOPT_URL => $url,		// url
    CURLOPT_RETURNTRANSFER => true,	// return the output of the http request
    CURLOPT_FOLLOWLOCATION => false,	// do not follow redirects (security issue)
    CURLOPT_TCP_FASTOPEN => true,	// php7+
    CURLOPT_CONNECTTIMEOUT => 30,	// make sure this is set to something shorter than forever (0)
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_NONE, // let curl decide 1.0/1.1 version
    CURLOPT_USERAGENT => 'JSONRPC'	// the http user-agent presented by client
  ) );

  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
