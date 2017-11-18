
<div class="fondo">


@extends('layouts.app')

@section('content')
<div class="container">
@if(Auth::guest())
<!--
<div class="row logindiv6 letra3">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default ">
            <center><div class="panel-heading intro">Bienvenido</div></center>
                <div class="panel-body ">
                    <center>Hola Usuario no registrado.</center>
                </div>
            </div>
        </div>
    </div>
</div>  
-->
<div class="logindiv5 letra3 ">
<br>
<center><div class="panel-heading intro">Bienvenido...</div></center>
<center>Hola usuario no registrado.</center>

</div>



<!------ Slider ------------>
<div id ="contenedor">
	      	<ul><li><img src="../assets/img/finalm.png" alt="" /></li><!--800x426-->
                <li><img src="../assets/img/finaln.png" alt="" /></li>
                <li><img src="../assets/img/finalb.png" alt="" /></li>
                <!--<li><img src="../assets/img/xx.jpg" alt="" /></li>-->
                
               
	                
           </ul>
    </div>
       
         
  <!------End Slider ------------>   
  <!--------------Empezando div que somos-------->
  <br><br>
 <div style="width: 400px; height: 800px ; "  class="derecha" >
      <center><h1 class="letra3">StudentsWatch</h1></center>
     <p>StudentsWatch es una aplicación BUAP que permite al alumno tener una mejor visión sobre las materias que puede tomar y con que profesor podra hacerlo, así como tambien ayuda al tutor a cargo del alumno a tener una mejor visión sobre como va el alumno y así
          poder guiarlo en su proceso de aprendizaje</p>
     <h2>¿De que forma StudentsWatch puede hacer eso?... </h2>
     <p>El alumno podra calificar a diferentes profesores, estas calificacion y observaciones estaran a disposición de todos los alumnos y profesores.</p>
     <p>Por parte del profesor tutorado se llevara un seguimiento del alumno, en el que se podra observar como va el alumno de acuerdo a los periodos que debería ir cursando</p>
     <h2>¿Pero como puede el tutor dar seguimiento a traves de StudentsWatch?... </h2>
     <p>El profesor tutorado podra enviarle un correo al estudiante de acuerdo a su historial academico, a manera que el mismo tutor aconseje y oriente al alumno.</p>
     
    </div>
 

 <!---------------fin de div --------------------> 

  <!------End Slider ------------>    


  

  <!--CUADROS-->
  <div class="col-2 menu">
                    <div class"cuadros" align="center">
                         <a href="{{ url('http://www.cs.buap.mx/') }}"><img class="cuadro1 " src="../assets/img/Cs.png"></a>
                         <a href="{{ url('http://www.autoservicios.buap.mx') }}"><img class="cuadro3" src="../assets/img/auto.png"></a>
                         <a href="{{ url('http://www.becas.buap.mx/') }}"><img class="cuadro4" src="../assets/img/becas.png"></a>
                         <a href="{{ url('http://cmas.siu.buap.mx/portal_pprd/wb/Servicio_Social/inicio') }}"><img class="cuadro5" src="../assets/img/ss.png"></a>

                    </div>
                </div>
        <!--FIN CUADROS-->
       
  @else
    @if (Auth::user()->is_admin == true)
        @if (Auth::user()->is_profesor == true)                                                        
            @if (Auth::user()->is_tutor == true)                
            <div class="navar">
                
                <ul class="nav nav-pills "> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mis alumnos</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/login') }}">Mi Información</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                 </ul>
            </div>
            <div class="row intro">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading intro">Bienvenido</div>
                            <div class="panel-body">
                                Hola [Administrador][Profesor][Tutor].
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @else                
                <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>                                                
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores/') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                  </ul>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bienvenido</div>
                            <div class="panel-body">
                                Hola [Administrador][Profesor].
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            @endif                                        
        @else            
            <div style="center" class="navar">
                <ul class="nav nav-pills logindiv7 navbar-brand"> 
                   <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                 </ul>
            </div>

            <!--intro administrador-->
            
            <div class="row intro2 ">
            
                
                       <center> <div class="  ">Hola Administrador</div></center>
                            <div class="panel-body  letra3">
                                
                            
                               <center> "BIENVENIDO"</center>
                              
                               <img class="imagenUsuario" src="../assets/img/admin.jpg" alt="Imagen Usuario">
                         
                    </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                                  
        @endif                                        
    @else
        @if (Auth::user()->is_profesor == true)
            @if (Auth::user()->is_tutor == true)                
            <div class="navar ">
                <ul class="nav nav-pills logindiv7 navbar-brand"> 
                    <li ><a href="{{ url('/login') }}" >Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mis Alumnos</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
            <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>  
                 </ul>
            </div>
            <div class="row intro2">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading intro2">Bienvenido</div>
                            <div class="panel-body">
                                Hola Tutor.
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                                   
            @else            
            <div class="navar">
                <ul class="nav nav-pills logindiv7 navbar-brand">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>                                                
                  </ul>
            </div>
            <div class="row intro2 ">
            
                
                       <center> <div class="  ">Hola Profesor</div></center>
                            <div class="panel-body  letra3">
                                
                            
                               <center> "BIENVENIDO"</center>
                              
                               <img class="imagenUsuario" src="../assets/img/admin.jpg" alt="Imagen Usuario">
                         
                    </div>                                          
            @endif
        @else            
            <div class="navar">
                <ul class="nav nav-pills logindiv7_1 navbar-brand">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mi Mapa Curricular</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/Usuario/Profesores') }}">Ver Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Ver Comentarios</a></li>
                 </ul>
            </div>
            <!--intro alumno-->
            <div class="row intro2 ">
            
                
                       <center> <div class="  ">Hola Alumno</div></center>
                            <div class="panel-body  letra3">
                                
                            
                               <center> "BIENVENIDO"</center>
                              
                               <img class="imagenUsuario" src="../assets/img/admin.jpg" alt="Imagen Usuario">
                         
                    </div>


            
                                                                 
        @endif                                        
    @endif 
@endif       
@endsection
