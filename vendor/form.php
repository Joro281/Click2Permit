<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: lightgray;
        }

        .navbar {
            background-color: #333;
            height: 45px;
        }

        .navbar a {
            color: white !important;
            font-family: 'Times New Roman', Times, serif;
            margin-right: 20px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            padding-top: 60px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-signin {
            padding: 20px;
        }

        .form-label-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:3000/Downloads/Software%20Design/ViewEmployedProf.php">User Profile (Employed)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:3000/Downloads/Software%20Design/ViewNewEmployedProf.php">User Profile (Newly Employed)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:3000/Downloads/Software%20Design/adminemployed1.php">Document Requests (Employed)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:3000/Downloads/Software%20Design/adminemployed2.php">Document Requests (Newly Employed)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:3000/vendor/form.php">Send Email</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:3000/Downloads/Software%20Design/Logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Send Email</h5>
                    <form action="send-email.php" method="post" class="form-signin">
                        <div class="form-label-group">
                            <label for="inputEmail">From <span style="color: #FF0000">*</span></label>
                            <input type="text" name="fromEmail" id="fromEmail" class="form-control"  value="clarklim281@gmail.com" readonly required autofocus>
                        </div> <br/>
                        <div class="form-label-group">
                            <label for="inputEmail">To <span style="color: #FF0000">*</span></label>
                            <input type="text" name="toEmail" id="toEmail" class="form-control" placeholder="Email address" required autofocus>
                        </div> <br/>
                        <label for="inputPassword">Subject <span style="color: #FF0000">*</span></label>
                        <div class="form-label-group">
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required>
                        </div><br/>
                        <label for="inputPassword">Message <span style="color: #FF0000">*</span></label>
                        <div class="form-label-group">
                            <textarea  id="message" name="message" class="form-control" placeholder="Message" required ></textarea>
                        </div> <br/>
                        <button type="submit" name="sendMailBtn" class="btn btn-lg btn-primary btn-block text-uppercase" >Send Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>