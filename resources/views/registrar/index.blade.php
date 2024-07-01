<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sistema de gestion hotelera</title>
<!-- Tell the browser to be responsive to screen width -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner.">
<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application">
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
  <div class="login-logo">
    <a href="index.html"><img src="dist/img/logo-leisure.png" alt=""></a>
  </div>
    <p class="login-box-msg">Ingrese sus datos</p>
    <form>
      <div class="form-group has-feedback">
        <input type="text"  name="documentop" id="documentop"class="form-control sty1" placeholder="N° Documento">
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="nombrep" id="nombrep" class="form-control sty1" placeholder="Nombre">
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="apellidop" id="apellidop" class="form-control sty1" placeholder="Apellidos">
      </div>
      <div class="form-group has-feedback">
        <input type="text" id="correop" name="correop" class="form-control sty1" placeholder="E-mail">
      </div>
      <div class="form-group has-feedback">
        <input type="text" id="telefonop" name="telefonop" class="form-control sty1" placeholder="Telefono">
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="contreseñap" name="contraseñap" class="form-control sty1" placeholder="Password">
      </div>
      
      <div>
        <div class="col-xs-4 m-t-1">
          <button type="button" class="btn btn-primary btn-block btn-flat btn_registrar_web">Registrar</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>

    
    <div class="m-t-2">Ya tiene una cuenta?<a href="{{ route('admin') }}" class="text-center"> Ir a al inicio</a></div>
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
    $('body').on('click', '.btn_registrar_web', function(){
      var documento     = $('#documentop').val();
      var nombre        = $('#nombrep').val();
      var apellido      = $('#apellidop').val();
      var correo        = $('#correop').val();
      var telefono      = $('#telefonop').val();
      var contreseña    = $('#contreseñap').val();
      if(documento == ''){$('#documentop').focus();return;}if(nombre == ''){$('#nombrep').focus();return;}if(apellido == ''){$('#apellidop').focus();return;}
      if(correo == ''){$('#correop').focus();return;}if(telefono == ''){$('#telefonop').focus();return;}if(contreseña == ''){$('#contreseñap').focus();return;}
      $.ajax({

        url     : "{{ route('save_registre') }}",
        method  : 'POST',
        data    : {documento:documento,
                   nombre   :nombre,
                   apellido :apellido,
                   correo   :correo,
                   telefono :telefono,
                   contreseña:contreseña,
                   '_token'   : '{{ csrf_token() }}'
                },
        success: function(r)
        {
            if(!r.status)
            {
                alert('Intente nuevamente');
                return;
            } 
            alert('Usted se a registrado');
            setTimeout(function(){
              window.location.href = "{{ url('/') }}"; 
            }, 200); 

        },
        dataType: 'json'

      })

    })
</script>

</body>
</html>
