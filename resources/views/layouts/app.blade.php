<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Font Awesome -->    
    
    <link rel="stylesheet" href="{{ asset('../assets/css/font-awesome.min.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="../css/estilos.css" type="text/css" >
    <!-- Styles -->    
   
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   <!--ESTILOS MIOS-->
   <link rel="stylesheet" href="../assets/css/estilos.css">
    {{-- <link href="{{ elixir('../assets/css/estilos.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            font-family: 'Lato';
           /*background-color:#AED6F1; */
          /*<img src="../assets/img/book.jpg">*/
        
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<!--<body background ="../assets/img/hu.jpg" id="app-layout">-->
<body id="app-layout">
    <nav class=" header header-top">
        <div class="container">
            <div class="navbar-header  ">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand " href="{{ url('/') }}">
                   <div class="letra"> StudentsWatch</div>
                <!--<img  class="pequeña" style="float:left;"  src="../assets/img/logo.png">-->
              
                
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar 
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">StudentsWatch</a></li>
                </ul>
                -->
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-user"></i>Iniciar sesión</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa fa-id-card-o" aria-hidden="true"> </i> Registrarse</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                                    @if (Auth::user()->is_admin == true)
                                        @if (Auth::user()->is_profesor == true)                                                                                        
                                            @if (Auth::user()->is_tutor == true)
                                            [Administrador][Profesor][Tutor]
                                            @else
                                            [Administrador][Profesor]
                                            @endif                                        
                                        @else
                                            [Administrador]                                              
                                        @endif                                        
                                    @else
                                        @if (Auth::user()->is_profesor == true)
                                            @if (Auth::user()->is_tutor == true)
                                                [Tutor]                                                
                                            @else
                                                [Profesor]                                                                                              
                                            @endif
                                        @else
                                            [Alumno]                                                
                                        @endif                                        
                                    @endif                                    
                            </a>                           
                                <ul class="dropdown-menu" role="menu">                                
                                <li value="{{Auth::user()->id}}" class="configuracion"><a href="{{ url('/configuracion/'.encrypt(Auth::user()->id)) }}"><i class="fa fa-btn fa-cog"></i>Configuración</a></li>                                                                                                
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>    
   <!--FOOTER-->
   <footer style="padding-bottom: 0;">
                <div class="container">
                    <div class="row ">
                        <div class="col-xs-12 col-sm-6 ">
                            <div class="nav  ">


                            
                                <img  style="float:left;" class="mediana" src="../assets/img/escudo.png">
                                <a class="letra" target="blank" href="{{ url('http://www.buap.mx') }}">Benemérita Universidad Autonoma de Puebla <br> 4 Sur 104 Centro Historico <br>CP. 72000 Teléfono +52(222) 2295500<br>ext.5013</a>
                              

                            </div>
                            
                        </div>



                        
                       
                        <div class="col-xs-12 col-sm-4 col-md-4 col-sm-offset-2">
                            
                            <div class="logo letra"><li><div class="footer-box">
                                
                            
	     <div class="wrap">
	     
	    	<div id="slideshow">
			 	<div class="f-desc1">
					<p align="center" class="letra">"Pensar bien para vivir mejor"</p>
				</div>
				<div class="f-desc1">
			 		<p align="center" class="letra">"Pensar bien para vivir mejor"</p>
				</div>
            </div>
            
		<script>
			$("#slideshow > div:gt(0)").hide();
			setInterval(function() { 
			  $('#slideshow > div:first')
			    .fadeOut(00)
			    .next()
			    .fadeIn(500)
			    .end()
			    .appendTo('#slideshow');
			},  2000);
		</script>
		
	
            </footer>
         <!--finFOOTER-->
</body>    
</html>