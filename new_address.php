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
        <link rel="stylesheet" href="./css/mystyle.css">
        <title></title>
    </head>
    <body>
        <div>
            <?php
            $form_header = "<div class='container'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>Address</div>
        <div class='panel-body'>
            <form role='form' action=new_address.php id='new_address' >
                ";
            $form_html = "
<div class = 'form-group'>
                    <label for = 'inputNameNumber'>Name or Number</label>
                    <input type = 'text' class = 'form-control' name = 'name_number' id = 'inputNameNumber'><br>
                </div>
                <div class = 'form-group'>
                    <label for = 'inputStreet'>Street</label>
                    <input type = 'text' class = 'form-control' name = 'street' id = 'inputStreet'><br>
                </div><div class = 'form-group'>
                    <label for = 'inputCity'>City</label>
                    <input type = 'text' class = 'form-control' name = 'city' id = 'inputCity'><br>
                </div><div class = 'form-group'>
                    <label for = 'inputCountry'>County</label>
                    <input type = 'text' class = 'form-control' name = 'county' id = 'inputCountry'><br>
                </div><div class = 'form-group'>
                    <label for = 'inputPoscode'>Postcode</label>
                    <input type = 'text' class = 'form-control' name = 'postcode' id = 'inputPoscode'><br>
                </div>
                <input type='hidden' name='REQUEST_METHOD' value='POST'/>
                <button type='submit' class='btn btn-primary' name='submit_address'>Submit</button>
            </form>
        </div>
    </div>
</div>
";
            if (isset($_POST['submit_address'])) {

                include 'forms/underwriter_connector.php';
                $fields = array(
                    'name_number' => filter_input(INPUT_POST, 'name_number'),
                    'street' => filter_input(INPUT_POST, 'street'),
                    'city' => filter_input(INPUT_POST, 'city'),
                    'postcode' => filter_input(INPUT_POST, 'postcode'),
                    'api_key' => $_SESSION[$api_key]
                );
                $reply = send_request($fields, 'POST');
                if (isset($decoded_reply['created_at'])) {
                    header('location: new_vehicle.php');
                } else {
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
