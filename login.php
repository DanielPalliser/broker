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
            session_start();
            $form_header = "<div class='container'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>Log in</div>
        <div class='panel-body'>
            <form role='form' method='POST' action=login.php id='login' >
                ";
            $form_html = "
<div class = 'form-group'>
                    <label for = 'inputEmail'>Email address</label>
                    <input type = 'text' class = 'form-control' name = 'email' id = 'inputEmail'><br>
                </div>
                <div class = 'form-group'>
                    <label for = 'inputPassword'>Password</label>
                    <input type = 'password' class = 'form-control' name = 'password' id = 'inputPassword'><br>
                </div>
                <button type='submit' class='btn btn-primary' name='submit_login'>Log In</button>
            </form>
        </div>
    </div>
</div>
";
            if (isset($_POST['submit_login'])) {
                include 'forms/errors.php';
                include 'forms/underwriter_connector.php';
                $fields = array(
                    'email' => filter_input(INPUT_POST, 'people/authenticate')
                );
                $reply = send_post_request('people', $fields);
                var_dump($reply);
            } else {
                echo $form_header;
                echo $form_html;
            }
            ?>
            ?>
        </div>
    </body>
</html>

