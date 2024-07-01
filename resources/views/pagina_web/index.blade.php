<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pagina web - HOTEL SAN ANTONIO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="images/favicon.ico" rel="icon" type="image/png">
    <link href="../../css?family=Domine:400,700%7CRoboto:400,300,500,700,900" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet" media="screen">
    <link href="css/owl.theme.default.min.css" rel="stylesheet" media="screen">
    <link href="css/datepicker.css" rel="stylesheet" media="screen">
    <link href="style.css" rel="stylesheet" media="screen">
    <style>
        .d-none {
            display: none !important;
        }
    </style>
</head>

<body>
    <div id="site">
        <header id="header" role="banner">
            <div class="header-row clearfix" style="">
                <div class="container" style="display: flex;width: 100%;margin-right:0 ">


                    <div style="width: 20%">
                        <img src="images/logiiito-Photoroom.png" alt="" style="height: 70% ">

                    </div>

                    <div class="pull-right"
                        style="width: 70%;display:grid ; grid-template-columns: repeat(3, 1fr);gap:2em;text-align: center">
                        <div>
                            <span class="weather">Miercoles <i data-icon="B"></i> 24&deg;C</span>
                            <span class="weather">Saturday <i data-icon="F"></i> 21&deg;C</span>
                        </div>
                        <a type="button" style="background:rgb(63, 42, 33);text-align: center" data-toggle="modal"
                            data-target="#exampleModal">
                            <span style="color: #f7fbfc; cursor: pointer;text-align: center"
                                onmouseover="this.style.color='#ff6600';"
                                onmouseout="this.style.color='#FFFFFF';"class="weather text-white">Iniciar
                                sesion</span>
                        </a>

                        <a style="color:white;background:rgb(63, 42, 33)"type="button"
                            href="{{ route('admin.session') }}">
                            <span style="color: #f0ebeb; cursor: pointer;" onmouseover="this.style.color='#ff6600';"
                                onmouseout="this.style.color='#FFFFFF';" class="weather text-white ">Ir como
                                administrador</span></a>
                    </div>
                    <div class="row" style="margin-right: 0;width: 20%">


                        <div class=" pull-left"
                            style="display:flex;border-top-left-radius: 40px 20px;margin-left: 20px">
                            <ul style="margin: 0;width: 25%;padding-left: 5px">
                                <i class=""
                                    style="display: flex; align-items: center; justify-content: center;background: #d4c1b5;width: 100%;font-size:24px;margin: 0;color: rgb(236, 65, 42);height: 100%;font-weight: bold;border-radius: 10px">{{ session('usuario')[0] ?? '' }}</i>

                            </ul>
                            <ul class=""
                                style="display: block;list-style: none;margin: 0;padding-left: 0;width: 75%">
                                <li class=""
                                    style="background-color: rgb(65, 30, 8);border-radius: 2px;width: 150px"
                                    href=""><i class="fa fa-user"></i> Bievenido(a) :
                                    {{ session('usuario') }}
                                    <hr style="margin: 0">

                                <li class=""
                                    style="background-color: rgb(187, 140, 40);border-radius: 2px;width:150px">
                                    <a href="{{ route('salir') }}"><i class="fa fa-power-off"> cerrar sesion</i></a>
                                </li>
                                </li>

                            </ul>





                        </div>

                    </div>
                </div>
                <hr style="margin: 0;">
                <nav role="navigation" id="secondary-nav">
                    <div class="container">
                        <input type="checkbox" class="toggle-nav-input" id="toggle-secondary-nav">
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="">Habitaciones <em>Simples</em></a>
                                <ul class="sub-menu bg-accomodation">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="#">Wifi + Cable</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="#">Ducha termica</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="#">Cama king</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="">Habitacion <em>Doble</em></a>
                                <ul class="sub-menu bg-accomodation">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Wifi + Cable</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Cama king</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Cochera</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Vista panoramica</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Desayuo ejecutivo</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="">Habitacion<em>Triple</em></a>
                                <ul class="sub-menu bg-tennis">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Wifi + ducha</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Cochera</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Desayuno</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Vista panoramica</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="">Establecimiento y recreacion</em></a>
                                <ul class="sub-menu bg-pool">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Campoc &amp; Piscina</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="">Juegos</a>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <label class="toggle-nav-label" for="toggle-main-nav"><i class="fa fa-bars fa-lg"></i> Menu</label>
                <label class="toggle-nav-label" for="toggle-secondary-nav"><i class="fa fa-info-circle fa-lg"></i>
                    Services</label>
            </div>
            <div class="booking-row content-padding-xs">
                <div class="container">
                    <div class="row">
                        <form id="booking-form" role="form">

                            <div class="col-md-3 col-sm-6 icon-calendar">
                                <label class="sr-only" for="arrival-date">Fecha inicio</label>
                                <input type="text" class="form-control" data-provide="datepicker"
                                    data-date-autoclose="true" data-date-format="mm/dd/yyyy" id="fecha_entrada"
                                    placeholder="Fecha inicio">
                            </div>
                            <div class="col-md-3 col-sm-6 icon-calendar">
                                <label class="sr-only" for="departure-date">Fecha culminar</label>
                                <input type="text" class="form-control" data-provide="datepicker"
                                    data-date-autoclose="true" data-date-format="mm/dd/yyyy" id="fecha_salida"
                                    placeholder="Fecha culminar">
                            </div>

                            <div class="col-md-3 col-sm-4 icon-arrow">
                                <label class="sr-only" for="room">Tipo habitacion</label>
                                <select class="form-control" id="tipo_habitacion"
                                    style="background-color: rgb(180, 178, 39);color: black">
                                    <option selected="" disabled="" id="tipo_habitacion">Tipo habitacion
                                    </option>
                                    <option style="background-color: rgb(179, 167, 190);" value="Simple">Simple
                                    </option>
                                    <option style="background-color: rgb(117, 120, 126);" value="Matrimonial">
                                        Matrimonial</option>
                                    <option style="background-color: rgb(170, 196, 155);" value="Triple">Triple
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input class="btn btn-primary btn-block btn_reservar" name="Book a Room"
                                    value="Reservar">
                                <input class="btn btn-primary btn-block d-none btn_reservando" name="Book a Room"
                                    value="Reservando...">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <article id="content">
            <section class="container content-padding-lg">
                <div class="row animated">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <h1 class="text-center"><small></small>Vive una experiencia unica!</h1>
                        <p class="lead">¡Te invitamos a sumergirte en una experiencia única en el mundo de la
                            hospitalidad! En nuestro hotel, no solo te ofrecemos un lugar para descansar, sino que te
                            brindamos la oportunidad de vivir momentos inolvidables y emocionantes. Desde el momento en
                            que entras por nuestras puertas, te sumergirás en un mundo de lujo, comodidad y atención
                            excepcional. Cada detalle está diseñado para cautivarte y hacerte sentir especial.
                            ¡Prepárate para descubrir un destino que no solo te alojará, sino que te dejará con
                            recuerdos que atesorarás para siempre!
                        </p>

                        </p>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary btn-block" name="Book a Room"
                                value="Reservar">
                        </div>

                    </div>
                </div>
            </section>
            <section class="fullwidth-row">
                <div class="container content-padding-xl">
                    <div class="row animated">
                        <div class="col-sm-12 parallax-container" data-stellar-offset-parent="true"
                            data-stellar-vertical-offset="150">
                            <div class="content-column half text-center">
                                <img src="images/3.png" class="parallax-image img-responsive"
                                    data-stellar-ratio="1.15123" alt="">
                                <img src="images/4.png" class="parallax-image img-responsive"
                                    data-stellar-ratio="0.94456456" alt="">
                                <img src="images/5.png" class="parallax-image img-responsive"
                                    data-stellar-ratio="1.111111" alt="">
                            </div>
                            <div class="content-column half last">
                                <h2><small></small>Nuestras habitaciones</h2>
                                <p>Reserva ahora y descubre por qué somos el destino preferido para aquellos que buscan
                                    confort, lujo y una atención excepcional. ¡Te garantizamos que tu experiencia en
                                    nuestro hotel será inigualable!
                                </p>
                                <p>¡No pierdas la oportunidad de ser parte de nuestra historia y reserva tu habitación
                                    hoy mismo! ¡Te esperamos con los brazos abiertos para que vivas momentos
                                    inolvidables con nosotros!
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="container content-padding-lg">
                <div class="row animated">
                    <aside class="col-sm-12">
                        <h2 class="text-center"><small>Algunas actividades </small>ESTO PUEDES HACER EN TU ESTANCIA
                        </h2>
                        <div class="services-carousel">
                            <div class="item">
                                <a href="" class="link-image"><img src="images/spa.jpg" alt=""></a>
                                <div class="item-content">
                                    <h4><a href="#">Bienestar y Fin de semana de escapada al spa</a></h4>

                                </div>
                            </div>
                            <div class="item">
                                <a href="#" class="link-image"><img src="images/pool.jpg" alt=""></a>
                                <div class="item-content">
                                    <h4><a href="">Interior y exterior. Piscinas al aire libre</a></h4>

                                </div>
                            </div>
                            <div class="item">
                                <a href="#" class="link-image"><img src="images/food.jpg" alt=""></a>
                                <div class="item-content">
                                    <h4><a href="#">Cocina internacional para todos tus gustos</a></h4>

                                </div>
                            </div>

                            <div class="item">
                                <a href="#" class="link-image"><img src="images/room.jpg" alt=""></a>
                                <div class="item-content">
                                    <h4><a href="#">Estudios y Apartamentos exclusivos VIP</a></h4>

                                </div>
                            </div>

                        </div>
                    </aside>
                </div>
            </section>
        </article>
        <footer id="footer" role="contentinfo">
            <div class="container">
                <div class="row" id="main-footer">
                    <aside class="col-lg-2 col-md-3 col-sm-4 widget">

                    </aside>
                    <aside class="col-lg-2 col-md-3 col-sm-4 widget">
                        <a href=""><img src="images/logo-leisure.png" alt=""></a>
                    </aside>
                </div>
                <div class="row" id="absolute-footer">
                    <div class="col-sm-12">
                        <aside class="widget">
                            <p>Hecho con amor<a href="#" target="_blank"><abbr
                                        title="Premium WordPress Themes & Plugins">Curly Themes</abbr></a>. All Rights
                                Reserved.
                                <span class="pull-right hidden-xs">
                                    <a href="#" class="fa fa-boxed fa-rss" data-toggle="tooltip"
                                        data-placement="left" title="Leisure RSS"></a>
                                    <a href="#" class="fa fa-boxed fa-pinterest" data-toggle="tooltip"
                                        data-placement="left" title="Leisure Pintrest Board"></a>
                                    <a href="#" class="fa fa-boxed fa-facebook" data-toggle="tooltip"
                                        data-placement="left" title="Leisure on Facebook"></a>
                                    <a href="#" class="fa fa-boxed fa-twitter" data-toggle="tooltip"
                                        data-placement="left" title="Leisure on Twitter"></a>
                                </span>
                            </p>
                        </aside>
                    </div>
                </div>
            </div>
        </footer>
    </div>




    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese sus credenciales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.html" method="post">
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control sty1" placeholder="Documento"
                                name="name_sesion" id="name_sesion">
                        </div>
                        <!--<div class="form-group has-feedback">
                            <input type="password" class="form-control sty1" placeholder="Contraseña"
                                name="contra_sesion" id="contra_sesion">
                        </div>-->

                        <div class="form-group has-feedback" style="display: flex">
                            <input type="password" class="form-control sty1" placeholder="Contraseña"
                                id="contra_sesion" name="contra_sesion" style="width:90%">
                            <button type="button" class="button" onclick="togglePassword('contra_sesion', this)"
                                style="width: 10%">
                                <img src="images/nover.jpg" alt="Mostrar">
                            </button>
                        </div>

                        <div>
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <button type="button" class="btn btn-success btn_session">Iniciar sesion</button>
                                    <button type="button"
                                        class="btn btn-success btn_session_r d-none">Iniciando...</button>

                                </div>
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn_registro"
                        style="background: #d4c1b5">Registrarme</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalregistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese sus datos de registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.html" method="post">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control sty1" placeholder="Nombre completo"
                                name="nombrep" id="nombrep">
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control sty1" placeholder="E-mail"id="correop"
                                name="correop">
                        </div>
                        <div class="form-group has-feedback">
                            <input type="number" class="form-control sty1" placeholder="Telefono" id="telefonop"
                                name="telefonop">
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control sty1" placeholder="N° Documento"
                                name="documentop" id="documentop">
                        </div>

                        <div class="form-group has-feedback" style="display: flex">
                            <input type="password" class="form-control sty1" placeholder="Contraseña"
                                id="contreseñap" name="contreseñap" style="width:90%">
                            <button type="button" class="button" onclick="togglePassword('contreseñap', this)"
                                style="width: 10%">
                                <img src="images/nover.jpg" alt="Mostrar">
                            </button>
                        </div>

                        <div class="form-group has-feedback" style="display: flex">
                            <input type="password" class="form-control sty1" placeholder="Confirmar Contraseña"
                                id="Confirmcontreseñap" name="Confirmcontreseñap" style="width:90%">
                            <button type="button" class="button"
                                onclick="togglePassword('Confirmcontreseñap', this)" style="width: 10%">
                                <img src="images/nover.jpg" alt="Mostrar">
                            </button>
                        </div>

                        <div>
                            <div class="col-xs-8">
                                <div class="checkbox icheck">

                                </div>
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn_save_registro">Registrarme</button>
                    <button type="button" class="btn btn-success btn_save_regsitrando d-none">Registrardo...</button>
                </div>
            </div>
        </div>
    </div>




    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dropdown-menu.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/waypoints-sticky.min.js"></script>
    <script src="js/jquery.velocity.min.js"></script>
    <script src="js/velocity.ui.js"></script>
    <script src="js/doubletaptogo.js"></script>

    <script src="js/bootstrap.datepicker.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
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


        $('body').on('click', '.btn_reservar', function(e) {
            e.preventDefault();
            let huesped = @json(session('usuario'));
            if (!huesped) {
                alert('debes iniciar sesion para poder reservar')
            } else {

                //let huesped = $('#huesped').val();
                fecha_i = $('#fecha_entrada').val();
                fecha_f = $('#fecha_salida').val();
                tipo = $('#tipo_habitacion').val();
                console.log(tipo);
                if (fecha_f == '' || fecha_i == '' || tipo == '') {
                    alert('llene todos los campos');
                    return;
                }
            }
            $.ajax({

                url: "{{ route('reservar_cli') }}",
                method: 'POST',
                beforeSend: function() {
                    $('.btn_reservar').prop('disabled', true);
                    $('.btn_reservar').addClass('d-none');
                    $('.btn_reservando').removeClass('d-none');
                },
                data: {
                    huesped: huesped,
                    fecha_i: fecha_i,
                    fecha_f: fecha_f,
                    tipo: tipo,
                    '_token': "{{ csrf_token() }}"
                },
                success: function(r) {
                    if (!r.status) {
                        $('.btn_reservar').prop('disabled', false);
                        $('.btn_reservar').removeClass('d-none');
                        $('.btn_reservando').addClass('d-none');
                        return;
                    }
                    $('.btn_reservar').prop('disabled', false);
                    $('.btn_reservar').removeClass('d-none');
                    $('.btn_reservando').addClass('d-none');
                    alert('Correo enviado al hotel San Antonio');

                },
                dataType: 'json',

            })

        });

        $('body').on('click', '.btn_registro', function() {

            $('#exampleModal').modal('hide');
            $('#modalregistro').modal('show');

        })

        $('body').on('click', '.btn_session', function() {

            let documento = $('#name_sesion').val();
            let contra = $('#contra_sesion').val();
            if (documento == '' || contra == '') {
                alert('llene todos los campos');
                return;
            }
            $.ajax({

                url: "{{ route('login_cli') }}",
                method: 'POST',
                beforeSend: function() {
                    $('.btn_session').prop('disabled', true);
                    $('.btn_session').addClass('d-none');
                    $('.btn_session_r').removeClass('d-none');
                },
                data: {
                    documento: documento,
                    contra: contra,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(r) {
                    if (!r.status) {
                        $('.btn_session').prop('disabled', false);
                        $('.btn_session').removeClass('d-none');
                        $('.btn_session_r').addClass('d-none');

                        alert('Registro no encontrado');
                        return;
                    }
                    $('.btn_session').prop('disabled', false);
                    $('.btn_session').removeClass('d-none');
                    $('.btn_session_r').addClass('d-none');
                    $('#modalregistro').modal('hide');
                    window.location.href = "{{ url('pagina_index') }}";
                },
                dataType: 'json'


            })

        });

    // -----------------
    function validarContraseña(contraseña) {
            // Expresión regular para verificar los requisitos
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
            return regex.test(contraseña);
        }

        // Función para validar la contraseña principal y mostrar alerta si es necesario
        function validarContraseñaPrincipal() {
            const contraseña = document.getElementById('contreseñap').value;
            if (contraseña === '') {
                alert('Por favor, ingrese primero la contraseña.');
                document.getElementById('contreseñap').focus();
                return false;
            }

            if (!validarContraseña(contraseña)) {
                alert('La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y caracteres especiales.');
                document.getElementById('contreseñap').focus();
                return false;
            }

            return true;
        }

        // Evento al hacer foco en el campo de confirmar contraseña
        document.getElementById('Confirmcontreseñap').addEventListener('focus', function () {
            if (!validarContraseñaPrincipal()) {
                // Cancelar el foco si la validación de la contraseña principal falla
                this.blur(); // Quitar el foco del campo de confirmar contraseña
            }
        });

        $('body').on('click', '.btn_save_registro', function() {
          
            let Confirmcontreseñap = $('#Confirmcontreseñap').val();
            contra = $('#contreseñap').val();
            console.log(Confirmcontreseñap)
            console.log(contra)

            if (Confirmcontreseñap != contra) {
                alert('las contraseñas no coinciden')
            } else {
            
                nombre = $('#nombrep').val();
                correo = $('#correop').val();
                telefono = $('#telefonop').val();
                documento = $('#documentop').val();

                if (nombre == '' || correo == '' || telefono == '' || documento == '' || contra == '') {
                    alert('llene todos los campos');
                    return;
                }
            }
            $.ajax({

                url: "{{ 'save_registre' }}",
                method: 'POST',
                beforeSend: function() {
                    $('.btn_save_registro').prop('disabled', true);
                    $('.btn_save_registro').addClass('d-none');
                    $('.btn_save_regsitrando').removeClass('d-none');
                },
                data: {
                    nombre: nombre,
                    correo: correo,
                    telefono: telefono,
                    documento: documento,
                    contra: contra,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(r) {
                    if (!r.status) {
                        $('.btn_save_registro').prop('disabled', false);
                        $('.btn_save_registro').removeClass('d-none');
                        $('.btn_save_regsitrando').addClass('d-none');
                        alert('intente nuevamente');
                        return;
                    }
                    $('.btn_save_registro').prop('disabled', false);
                    $('.btn_save_registro').removeClass('d-none');
                    $('.btn_save_regsitrando').addClass('d-none');
                    $('#modalregistro').modal('hide');
                    alert('registro exitoso');
                    window.location.href = "{{ url('pagina_index') }}";

                },
                dataType: 'json'




            })


        });
    </script>
</body>

</html>
