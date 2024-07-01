<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de gestion hotelera</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner.">
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application">
    <meta name="author" content="uxliner">
    <!-- v4.1.3 -->
    <link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="dist/img/favicon-16x16.png">

    <!-- Google Font -->
    <link href="../../../css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/style.css">
    <link rel="stylesheet" href="dist/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/et-line-font/et-line-font.css">
    <link rel="stylesheet" href="dist/css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="dist/css/simple-lineicon/simple-line-icons.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="login-page sty1">
    <div class="login-box sty1">
        <div class="login-box-body sty1">
            <div class="login-logo"style="width:80%;align-items:center">
                <a href="index.html"><img src="dist/img/logo-leisure.png" alt=""  style="height: auto;width: 100%"></a>
            </div>
            <p class="login-box-msg">Ingrese sus credenciales</p>
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                @if (session()->has('success'))
                    <div class="alert alert-danger col-md-12">{{ session()->get('success') }}</div>
                @endif

                <div class="form-group has-feedback">
                    <input type="text" class="form-control sty1" name="usuario" placeholder="Usuario o DNI">
                </div>

                <div class="form-group has-feedback" style="display: flex">
                    <input type="password" class="form-control sty1" placeholder="Confirmar Contraseña" id="contraseña"
                        name="contraseña" style="width:87%">
                    <button type="button" class="button" onclick="togglePassword('contraseña', this)"
                        style="width: 10%">
                        <img src="images/nover.jpg" alt="Mostrar " style="height: auto;width: 100%">
                    </button>
                </div>

                <div>
                    <div class="col-xs-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4 m-t-1">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>

    <!-- template -->
    <script src="dist/js/bizadmin.js"></script>

    <!-- for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script>
        function togglePassword(inputId, button) {
            const passwordInput = document.getElementById(inputId);
            const buttonImage = button.querySelector('img');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                buttonImage.src = 'images/ver.jpg';
                buttonImage.alt = 'Ocultar';
            } else {
                passwordInput.type = 'password';
                buttonImage.src = 'images/nover.jpg';
                buttonImage.alt = 'Mostrar';
            }
        }
    </script>

</body>

</html>
