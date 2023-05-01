<?php
include '../include/inc.php';

$out = array();

var_dump( $_POST );
exit;

try
{
    $cls_chatbot = new cls_chatbot();
    $cls_chatbot->test( $_POST );

    $out[ 'success' ] = "Message envoyé.";
}
catch( Exception $e )
{
    $out[ 'error' ] = $e->getMessage();
}

echo json_encode( $out );
exit;