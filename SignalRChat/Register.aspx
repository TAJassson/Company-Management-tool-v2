<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Register.aspx.cs" Inherits="SignalRChat.Register" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Register @ SignalR Chat</title>
    <link href="Content/bootstrap.css" rel="stylesheet" />
    <link href="Content/style.css" rel="stylesheet" />
    <link href="Content/icheck-bootstrap.css" rel="stylesheet" />
    <link href="Content/font-awesome.css" rel="stylesheet" />
    <style>
        .register-logo img {
            width: 150px; /* Adjust the width as needed */
            height: auto;
            vertical-align: middle;
        }
        .WebMessage {
            text-align: center;
            font-size: 20px;
        }
        body {
            background-color: white;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .register-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-box {
            width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="register-page">
    <form id="form1" runat="server">
        <div class="register-box">
            <div class="register-logo">
                <a href="https://localhost">
                    <img src="images/icon1.png" alt="Icon">
                </a>
            </div>
            <p class="WebMessage">Green Building Material live chat</p>
            <div class="register-box-body">
                <p class="login-box-msg">Register a new membership</p>
                <div class="form-group has-feedback">
                    <input id="txtName" type="text" class="form-control" placeholder="Full name" required="required" runat="server">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="txtEmail" type="email" class="form-control" placeholder="Email" runat="server">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck-primary">
                            <input type="checkbox" id="chkTerms" required="required" runat="server" />
                            <label for="chkTerms">I agree to the <a href="https://localhost/privacy">terms</a></label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="btnRegister" runat="server" onserverclick="btnRegister_ServerClick">Register</button>
                    </div>
                </div>
                <a href="Login.aspx" class="text-center">Staff Login</a>
            </div>
            <!-- /.form-box -->
        </div>
    </form>

    <script src="Scripts/jquery-1.9.1.min.js"></script>
    <script src="Scripts/bootstrap.min.js"></script>

</body>
</html>