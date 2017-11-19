@extends('layouts.app')
<style>
    #piechart_3d{
        background-color: none;
    }
    .header{
	background-color:#212F3C  ;
}
.header-top{
	padding:1% 0;
}
</style>
@section('content')
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
                    <li><a href="{{ url('/Profesor/MisAlumnos/'.encrypt(Auth::user()->id))}}">Mis Alumnos</a></li>                    
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>
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
    
    <div class="containter">
        <div   class="row">
            <div id="hola" class="col-md-6">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Materias', 'Progreso'],
                
                ['Materias aprobadas: {{$num}}', {{$num}}],
                ['Materias por cursar {{56-$num}}',    {{56-$num}}],
                
            
                ]);
                ['Materias cursando actualmente', 0]
                var options = {
                title: 'Mi progreso',
                is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
            </script>
            </head>
            <body>
            <div align="center" id="piechart_3d"  style="width: 90%; height: 60%;"></div>
            
          </body>   
            </div>

            <div id="hola2" class="col-md-6 col-xs-12">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Materias', 'Progreso'],
                
                ['Materias cursando actualmente: {{$num2}}', {{$num2}}],
                ['Materias por cursar {{56-$num}}',    {{56-$num}}- {{$num2}} ],
                
            
                ]);
                var options = {
                title: 'Materias Cursando',
                is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('cursando'));
                chart.draw(data, options);
            }
            </script>
            </head>
            <body>
            <div align="center" id="cursando"  style="width: 90%; height: 60%;"></div>
            
          </body>   
            </div>
        </div>

    </div>  
  
       
    
  
@endsection