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
            session_start();
            $form_header = "<div class='container'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>Incident</div>
        <div class='panel-body'>
            <form role='form' method='POST' action=new_incident.php id='incident' >";
            $form_html = "
                <div class='form-group'>
                    <label for='inputDate'>Date of Incident</label>
                    <input type='text' class='form-control' name='incident_date' id='inputDate'><br>
                </div>  
                <div class='form-group'>
                    <label for='inputType'>Type of Incident</label>
                    <input type='text' class='form-control' name='incident_type' id='inputType'><br>
                </div> 
                <div class='form-group'>
                    <label for='inputValue'>Value of Claim</label>
                    <input type='text' class='form-control' name='value' id='inputValue'><br>
                </div> 
                <div class='form-group'>
                    <label for='inputDescription'>Description</label>
                    <input type='text' class='form-control' name='description' id='inputDescription'><br>
                </div>
                <input type='hidden' name='REQUEST_METHOD' value='POST'/>
                <button type='submit' class='btn btn-default' name='submit_incident'>Submit</button>
            </form>
        </div>
    </div>
</div>
";
            if (isset($_POST['submit_incident'])) {
                include_once 'forms/constants.php';
                include 'forms/underwriter_connector.php';
                $fields = array(
                    'incident_date' => filter_input(INPUT_POST, 'incident_date'),
                    'incident_type' => filter_input(INPUT_POST, 'incident_type'),
                    'value' => filter_input(INPUT_POST, 'value'),
                    'description' => filter_input(INPUT_POST, 'description'),
                    'api_key' => $_SESSION['api_key']
                );
                $reply = send_request($fields, 'POST');
                if (isset($reply['created_at'])) {
                    header('location: new_desired_policy.php');
                    exit();
                } else {

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
