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
        <?php
        $form_header = "<div class='container'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>Register</div>
                <div class='panel-body'>
                    <form role='form' action='new_user.php' method='POST' id='user' >
                    <div class='form-group'>
                Please enter your personal details
                </div>
                        ";
        $form_html = <<<'EOT'
                        
                        <div class='form-group'>
                            <label for='inputTitle'>Title</label>
                            <select class='form-control' name='title' id='inputTitle'>
                                <option value='Mr'>Mr</option>
                                <option value='Ms'>Ms</option>
                                <option value='Mrs'>Mrs</option>
                                <option value='Miss'>Miss</option>
                                <option value='Dr'>Dr</option>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label class='form-label' for='inputForename'>Forename</label>
                            <input type='text' class='form-control' name='forename' id='inputForename'><br>
                        </div>
                        <div class='form-group'>
                            <label for='inputSurname' class='control-label'>Surname</label>
                            <input type='text' class='form-control' name='surname' id='inputSurname'><br>
                        </div>      
                        <div class='form-group'>
                            <label for='inputEmail'>Email</label>
                            <input type='text' class='form-control' name='email' id='inputEmail'><br>
                        </div> 
                        <div class='form-group'>
                            <label for='inputDOB'>Date of Birth</label>
                            <input type='date' class='form-control' name='dob' id='inputDOB'><br>
                        </div>
                        <div class='form-group'>
                            <label for='inputPhone'>Phone</label>
                            <input type='text' class='form-control' name='phone' id='inputPhone'><br>
                        </div>
                        <div class='form-group'>
                            <label for='inputLicencePeriod'>Licence Period</label>
                            <input type='text' class='form-control' name='licencePeriod' id='inputLicencePeriod'><br>
                        </div>
                        <div class='form-group'>
                            <label for='inputLicenceType'>Licence Type</label>
                               <select class='form-control' name='licenceType' id='inputLicenceType'>
                                <option value='full'>Full</option>
                                <option value='provisional'>Provisional</option>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label for='inputOccupation'>Occupation</label>
                            <input type='text' class='form-control' name='occupation' id='inputOccupation'><br>
                        </div>
                        <div class='form-group'>
                        <button type='submit' class='btn btn-primary' name='submit_person'>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                
EOT;

        #<input type='text' class='form-control' name='licenceType' id='inputLicenceType'><br>
        #var_dump($_POST);
        if (isset($_POST['submit_person'])) {
            include 'forms/errors.php';
            include 'forms/underwriter_connector.php';
            $fields = array(
                'title' => filter_input(INPUT_POST, 'title'),
                'forename' => filter_input(INPUT_POST, 'forename'),
                'surname' => filter_input(INPUT_POST, 'surname'),
                'email' => filter_input(INPUT_POST, 'email'),
                'dob' => filter_input(INPUT_POST, 'dob'),
                'phone' => filter_input(INPUT_POST, 'phone'),
                'licence_period' => filter_input(INPUT_POST, 'licencePeriod'),
                'licence_type' => filter_input(INPUT_POST, 'licenceType'),
                'occupation' => filter_input(INPUT_POST, 'occupation')
            );
            $reply = send_request($fields, 'POST');
            if (isset($reply['created_at'])) {
                $_SESSION['api_key'] = $reply[$api_key];
                header('location: new_address.php');
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
    </body>
</html>
