<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <title></title>
    </head>
    <body>
        <div>
            <?php
            $form_header = "<div class='container'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>Desired Policy</div>
        <div class='panel-body'>
            <form role='form' method='POST' action=new_desired_policy.php id='desired_policy' >";
            $form_html = "
                <div class = 'form-group'>
                    <label for = 'inputExcess'>Policy Excess</label>
                    <input type = 'text' class = 'form-control' name = 'excess' id = 'inputExcess'><br>
                </div>         
                <div class = 'form-group'>
                    <label for = 'inputBreakdown'>Breakdown cover type</label>
                    <input type = 'text' class = 'form-control' name = 'breakdown' id = 'inputBreakdown'><br>
                </div>         
                <div class = 'form-group'>
                    <label for = 'inputWindscreen'>Windscreen Repair Cover</label>
                    <input type = 'text' class = 'form-control' name = 'windscreen' id = 'inputWindscreen'><br>
                </div>         
                <div class = 'form-group'>
                    <label for = 'inputWindscreenExcess'>Windscreen Repair Excess</label>
                    <input type = 'text' class = 'form-control' name = 'windscreen_excess' id = 'inputWindscreenExcess'><br>
                </div>
                <input type='hidden' name='REQUEST_METHOD' value='POST'/>
                <button type='submit' class='btn btn-default' name='submit_policy'>Submit</button>
            </form>
        </div>
    </div>
</div>
";

            if (isset($_POST['submit_policy'])) {

                include 'forms/underwriter_connector.php';
                $fields = array(
                    'excess' => filter_input(INPUT_POST, 'excess'),
                    'breakdown' => filter_input(INPUT_POST, 'breakdown'),
                    'windscreen' => filter_input(INPUT_POST, 'windscreen'),
                    'windscreen_excess' => filter_input(INPUT_POST, 'windscreen_excess'),
                    'api_key' => $_SESSION[$api_key]
                );
                $reply = send_request($fields, 'POST');
                if (isset($reply['created_at'])) {
                    echo 'SUCCESSS!!!!';
                    header('location: new_address.php');
                } else {
            include 'forms/errors.php';
                    #PRINT FORM WITH ERRORS
                    echo $form_header;
                    echo errors_to_html($reply);
                    echo $form_html;
                }
            } else {
                echo $form_header;
                echo $form_html;
            }
            ?>
        </div>
    </body>
</html>
