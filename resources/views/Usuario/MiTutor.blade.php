@extends('layouts.app')
@section('content')
<style>
    @import url('http://fonts.googleapis.com/css?family=Julius+Sans+One');
    @import url('https://fonts.googleapis.com/css?family=Anton'); 
    /*----- Banner -----*/
    .profesor{
        color: #3385ff;
        font-family: 'Anton', sans-serif;
        letter-spacing: 2px;
        font-size: 50px;
    }    
</style>
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<div class="container">
 @if (Auth::user()->is_admin == true)
        @if (Auth::user()->is_profesor == true)                                                        
            @if (Auth::user()->is_tutor == true)                
                <div class="navar">
                    <ul class="nav nav-pills"> 
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
            @endif                                        
        @else            
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/login') }}">Comentarios</a></li>
                 </ul>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Bienvenido</div>
                            <div class="panel-body">
                                Hola Administrador.
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                                  
        @endif                                        
    @else
        @if (Auth::user()->is_profesor == true)
            @if (Auth::user()->is_tutor == true)                
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/login') }}">Mis Alumnos</a></li>
                    <li><a href="{{ url('/login') }}">Mi Progreso</a></li>
                    <li><a href="{{ url('/login') }}">Mi Información</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>
                 </ul>
            </div>
                                                       
            @else            
            <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/login') }}">Mis Comentarios</a></li>                                                
                  </ul>
            </div>
                                          
            @endif
        @else            
        <div class="navar">
           <ul class="nav nav-pills">
            <li><a href="{{ url('/login') }}">Inicio</a></li>
            <li><a href="{{ url('/Usuario/Mimapa/'.encrypt(Auth::user()->id)) }}">Mi Mapa Curricular</a></li>
            <li><a href="{{ url('/Usuario/Progreso/'.encrypt(Auth::user()->id)) }}">Mi Progreso</a></li>
            <li><a href="{{ url('/Usuario/Profesores') }}">Ver Profesores</a></li>
            <li><a href="{{ url('/Usuario/Materias') }}">Ver materias</a></li>
            <li><a href="{{ url('/Usuario/MiTutor/'.encrypt(Auth::user()->id)) }}">Mi Tutor</a></li>
           </ul>
        </div>                                                     
        @endif                                        
    @endif  
    <div class="col-12 col-md-12">
        <div align="center" >
            <p class="profesor">Mi Tutor</p>
        </div>    
            @if($mitutor->statusMiTutor=="Solicitud")
                <div class="panel panel-default">  
                <div class="panel-heading"></div>                              
                    <div class="panel-body">                    
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form id="editarInformacionPersonal" class="form-horizontal" action="" method="POST">                                                                                                     
                                    
                                    <div class="form-group success">
                                        <label class="col-sm-2 control-label">Estado</label>
                                            <div class="col-sm-10">                                                                                                                                                                        
                                                <input type="text" class="form-control" id="nombreTutor" name="nombreTutor" placeholder="No se ha elegido a un tutor..." readonly>                                                
                                            </div>                                    
                                    </div> 

                                </form>
                            </div>
                        </div>
                    </div>
                </div>             
            @elseif($mitutor->statusMiTutor=="Revision")
                <div class="panel panel-info">                                
                    <div class="panel-body">                    
                        <div class="panel panel-info">
                        <div class="panel-heading"></div> 
                            <div class="panel-body">
                                <form id="editarInformacionPersonal" class="form-horizontal" action="{{ url('/Usuario/MiTutor/'.encrypt($mitutor->user_id).'/cancelarTutor') }}" method="POST">                                                                                                     
                                    {{ csrf_field() }}
                                    <div class="form-group success">
                                        <label class="col-sm-2 control-label">Nombre de mi tutor</label>
                                            <div class="col-sm-10">                                                                                                                                                                        
                                                <input type="text" class="form-control" id="nombreTutor" name="nombreTutor" value="{{$mitutor->nombreTutor}}" readonly>                                                
                                            </div>                                            
                                    </div>
                                  
                                    <div class="form-group success">
                                        <label class="col-sm-2 control-label">Estado</label>
                                            <div class="col-sm-10">                                                                                                                                                                        
                                                <input type="text" class="form-control" id="estado" name="estado" placeholder="Solicitud de tutor enviada..." readonly>                                                
                                            </div>                                            
                                    </div> 

                                    <div class="form-group success">
                                        <div class="panel-heading">
                                            <button class="btn btn-danger" style="width:100%;">Cancelar Solicitud a Tutor</button>
                                        </div>
                                    <div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else  
                <div class="panel panel-success">                                                
                    <div class="panel-body">                                                           
                        <div class="panel panel-success">                        
                            <div class="panel-heading"></div>  
                                <div class="panel-body">
                                    <form id="editarInformacionPersonal" class="form-horizontal" action="" method="POST">                                                                                                     
                                        <div class="form-group success">
                                            <label class="col-sm-2 control-label">Nombre de mi tutor</label>
                                            <div class="col-sm-10">                                                                                                                                                                        
                                                <input type="text" class="form-control" id="nombreTutor" name="nombreTutor" value="{{$mitutor->nombreTutor}}" readonly>                                                
                                            </div>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
              
            @endif                      
        </div>                   
        <!--Inicio Lista de Tutores-->
        <div align="center" >
            <p class="profesor">Tutores</p>
        </div> 
        <div class="panel panel-default">                            
                <div class="panel-body">                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                        @if($mitutor->statusMiTutor=="Solicitud")                        
                            <table class="table table-hover">
                                <thread>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Ver mas</th>
                                        <th>Convertir en Mi Tutor</th>                                    
                                    </tr>
                                </thread>
                                <tbody>                             
                                    @if($tutores)
                                        @foreach($tutores as $tutores)
                                            <tr>
                                                <th scope="row">{{$tutores->idProfesor}}</th>                                    
                                                <th>{{$tutores->name}} </th>
                                                <th>{{$tutores->email}} </th>
                                                <th><i class="fa fa-plus-circle fa-2x" aria-hidden="true" value="{{$tutores->idProfesor}}"></i></th>
                                                <th><center><i class="fa fa-graduation-cap fa-2x" aria-hidden="true" id="{{$mitutor->idAlumno}}" value="{{$mitutor->statusMiTutor}}" name="{{$tutores->user_id}}"></i></center></th>                                    
                                            </tr>
                                        @endforeach
                                    @endif                            
                                </tbody>
                            </table>                         
                            @elseif($mitutor->statusMiTutor=="Revision")
                            <div class="alert alert-info" align="center">                                                       
                                Hola <strong>{{Auth::user()->name}}</strong>! Tu Solicitud se ha enviado con <strong>éxito</strong> al Tutor <strong>{{$mitutor->nombreTutor}}</strong>.                                                           
                            </div>                                                        
                            @else
                            <div class="alert alert-success" align="center">                                                       
                                Hola <strong>{{Auth::user()->name}}</strong>! Tu Actual Tutor es <strong>{{$mitutor->nombreTutor}}</strong>.                                                           
                            </div>
                            @endif                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Lista de Tutores-->
</div>
<script>
    $(document).ready(function(){               
        $('i.fa-plus-circle').click(function(){
            window.location.href = '/Usuario/Profesores/'+$(this).attr('value')+'/Ver';
         } );
             
        $('i.fa-graduation-cap').each(function(){
            if($(this).attr('value') == "Solicitud"){
                $(this).css("color","black");    
             }
             else{
                 $(this).css("color","#ffcc66");
             }
         });
         $('i.fa-graduation-cap').click(function(){            
             if($(this).attr('value') == "Solicitud"){                 
                 $(this).css("color","#ffcc66");
                 $(this).attr('value',"Revision");                
             }
             else{                
                $(this).css("color","black")   
                $(this).attr('value',"Solicitud");                 
             }
             $.ajax({
                 url:'/Usuario/MiTutor/'+$(this).attr("id")+'/hacermitutor',
                 type:'POST',
                 dataType:'json',
                 data:{                                 
                     'idTutor': $(this).attr('name'),
                     'statusMiTutor': $(this).attr('value')                    
                 },beforeSend: function (xhr) {                                      //Antes de enviar la peticion AJAX se incluye el csrf_token para validar la sesion.
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                 success:function(response){
                     alert(response);
                    location.reload();
                 }
             });
         });  
    });
</script>
@endsection