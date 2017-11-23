@extends('layouts.app')
@section('content')
<style>
    .header{
	background-color:#212F3C  ;
}
.header-top{
	padding:1% 0;
}
#h{
    background-color:white;
}
</style>
<div class="container">
@if (Auth::user()->is_admin == true)
        @if (Auth::user()->is_profesor == true)                                                        
            @if (Auth::user()->is_tutor == true)                
            <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/MisAlumnos/'.encrypt(Auth::user()->id))}}">Mis Alumnos</a></li>                    
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li> 
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                 </ul>
            </div>
            
            @else                
                <div class="navar">
                <ul class="nav nav-pills">
                    <li><a href="{{ url('/login') }}">Inicio</a></li>
                    <li><a href="{{ url('/Profesor/Informacion/'.encrypt(Auth::user()->id)) }}">Mi Informacion</a></li>
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>                                               
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                  </ul>
            </div>
           
            @endif                                        
        @else            
        <div class="navar">
                <ul class="nav nav-pills"> 
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/Admin/Alumnos') }}">Alumnos</a></li>
                    <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
                    <li><a href="{{ url('/Admin/Comentarios') }}">Comentarios</a></li>
                    <li><a href="{{ url('/Admin/Materias') }}">Materias</a></li>
                 </ul>
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
                    <li><a href="{{ url('/Profesor/MisComentarios/'.encrypt(Auth::user()->id)) }}">Mis Comentarios</a></li>                                                 
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

</div>
    
    
<div class="containter">
        <div   class="row">
                        
            <div id="hola" class="col-md-12 col-xs-1">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Materias', 'Porcentaje'],
                            
                            ['Materias aprobadas: {{$num}}', {{$num}}],
                            ['Materias por cursar: {{56-$num}}',    {{56-$num}}],            
                            ]);
                            ['Materias cursando actualmente', 0]
                            var options = {
                            title: 'Porcentaje',
                            is3D: true,
                            };
                            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                            chart.draw(data, options);
                        }
                        </script>
                        </head>
                        <body>
                        <div align="center" id="piechart_3d"  style="width: 100%; height: 80%;"></div>
                        
                    </body>                
        </div>
    </div>  
  
    <div class="container">
        <div class="row">
            <div id="h" class="col-md-12 col-xs-1">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "", { role: "style" } ],
                    ["Materias cursando actualmente", {{$num2}}, "#ffff4d"],
                    ["Materias aprobadas", {{$num}}, "#0066ff"],
                    ["Materias por cursar", {{56-$num}}, "color: #ff4d4d"],
                    ["Total materias", 56, "#00b33c"],
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);

                var options = {
                    title: "mi Progreso",
                    width: 900,
                    height: 500,
                    bar: {groupWidth: "100%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }
            </script>
            <div id="columnchart_values" style="width: 100%; height: 300px;"></div>
             </div>     
        </div>    
    </div>


    @endsection
