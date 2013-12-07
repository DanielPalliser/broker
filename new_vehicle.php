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
        <div class='panel-heading'>Vehicle</div>
        <div class='panel-body'>
            <form role='form' method='POST' action=new_vehicle.php id='vehicle' >";
            $form_html = "
                <div class='form-group'>
                    <label for='inputRegistration'>Vehicle Registration</label>
                    <input type='text' class='form-control' name='registration' id='inputRegistration'><br>
                </div> 
                <div class='form-group'>
                    <label for='inputMileage'>Estimated Annual Mileage</label>
                    <input type='number' class='form-control' name='mileage' id='inputMileage'><br>
                </div> 
                <div class='form-group'>
                    <label for='inputValue'>Estimated vehicle value</label>
                    <input type='number' class='form-control' name='vehicle_value' id='inputValue'><br>
                </div> 
                <div class='form-group'>
                    <label for='inputParcingLoc'> Parking location</label>
                    <input type='text' class='form-control' name='parking_loc' id='inputParcingLoc'><br>
                </div>
                <input type='hidden' name='REQUEST_METHOD' value='POST'/>
                <button type='submit' class='btn btn-default' name='submit_vehicle'>Submit</button>
            </form>
        </div>
    </div>
</div>
";
            if (isset($_POST['submit_vehicle'])) {

                include 'forms/underwriter_connector.php';
                $fields = array(
                    'registration' => filter_input(INPUT_POST, 'registration'),
                    'mileage' => filter_input(INPUT_POST, 'mileage'),
                    'vehicle_value' => filter_input(INPUT_POST, 'vehicle_value'),
                    'parking_loc' => filter_input(INPUT_POST, 'parking_loc'),
                    'api_key' => $_SESSION['api_key']
                );
                $reply = send_request($fields, 'POST');
                if (isset($reply['created_at'])) {
                    header('location: new_incident.php');
                } else {
                    include 'forms/underwriter_connector.php';
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
