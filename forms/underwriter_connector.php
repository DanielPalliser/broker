<?php

function send_request($fields, $request_method) {
    include 'constants.php';
    $ch = curl_init($underwriter_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('HTTP_ACCEPT' => 'appllication/json'));
    $reply = curl_exec($ch);
   # if (curl_errno($ch)) {
  #      $reply = curl_error($ch);
#    } else{
        $reply = json_decode($reply, true);
        curl_close($ch);
 #   }
    return $reply;
}
