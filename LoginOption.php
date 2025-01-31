<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="icon" href="images/mict-logo4.jpg">
    <style>
        body {
            background-image: url("images/mict-logo3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .form-group {
            margin-bottom: 30px;
        }
        h2 {
            text-align: center;
        }
        .form-btn {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action=" " method="post">
            <div class="form-group">
                <div class="form-btn">
                    <input type="button"  value="Login as Applicant" name="login" class="btn btn-primary"  onclick="redirectToApplicant()">
                    <input type="button" value="Login as Employer" name="login" class="btn btn-primary" onclick="redirectToEmployer()">
                </div>
            </div>
        </form>
    </div>

    <script>
        function redirectToApplicant() {
            window.location.href = 'LoginApplicant.php';
        }

        function redirectToEmployer(){
            window.location.href = 'LoginHR.php';
        }
               //Prevent user from using the click to go forward arrow
window.onload = function() {

window.history.pushState(null, null, window.location.href);


window.onpopstate = function() {

    window.history.pushState(null, null, window.location.href);
};
};

    </script>
</body>

</html>
