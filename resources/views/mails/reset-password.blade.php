<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .reset-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }

        .reset-button {
            background-color: #ce8460;
            border-color: #ce8460;
            transition: background-color 0.3s ease;
        }

        .reset-button:hover {
            background-color: #b6704b;
            border-color: #b6704b;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="reset-container">
                    <h2 class="text-center mb-4">Reset Password</h2>
                    <p>Dear User,</p>
                    <p>We have received a request to reset your password. Please click the link below to reset your
                        password:</p>
                    <div class="text-center">
                        <a type="button" href="{{ $url }}" class="btn btn-primary reset-button btn-block">Reset Password</a>
                    </div>
                    <p class="text-center mt-3">If you did not request a password reset, please ignore this email.</p>
                    <p class="text-center">Thank you,</p>
                    <p class="text-center">GG</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
