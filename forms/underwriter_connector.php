<?php

function send_request($fields, $request_method, $target) {
    include 'constants.php';
    $full_url = $underwriter_url.$target;
    var_dump($full_url);
    $ch = curl_init($full_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $reply = curl_exec($ch);
   # if (curl_errno($ch)) {
  #      $reply = curl_error($ch);
#    } else{
        $reply = json_decode($reply, true);
        curl_close($ch);
 #   }
    return $reply;
}
