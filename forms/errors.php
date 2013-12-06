<?php

function errors_to_html($error_arr) {
    $html = "<div class='form-group'>";
    $message = (sizeof($error_arr) > 1) ? 'There were problems with the form:<br/>' :'There was a problem with the form:<br/>';
     $html.=$message;
 if (isset($error_arr)) {
        $html.='<ul>';
        foreach ($error_arr as $key => $value) {
            $html.="<li>" . str_replace('_', ' ', ucfirst($key)) . " $value[0]</li>";
        }
        $html.='</ul>';
    }  else {
        $html.= 'No response from underwriter webapp';
    }
    $html.='</div>';
    return $html;
}
