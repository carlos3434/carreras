<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <title>Laravel PHP Framework</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body id='app'>
    <div class="welcome">
        <form method="post" enctype="multipart/form-data" @submit.prevent="registro">

            <label for="nombre">Apellidos:</label>
            <input class="form-control" type="text" v-model="alumno.apellidos"/>


            <label for="nombre">Nombres:</label>
            <input class="form-control" type="text" v-model="alumno.nombres"/>


            <label for="nombre">Dni:</label>
            <input class="form-control" type="text" v-model="alumno.dni"/>


            <label for="nombre">Direccion:</label>
            <input class="form-control" type="text" v-model="alumno.direccion"/>


            <label for="nombre">Distrito:</label>
            <input class="form-control" type="text" v-model="alumno.distrito"/>


            <label for="nombre">Provincia:</label>
            <input class="form-control" type="text" v-model="alumno.provincia"/>

            <label for="nombre">Departamento:</label>
            <input class="form-control" type="text" v-model="alumno.departamento"/>


            <label for="email">Carreras:</label>
            <select v-model="alumno.carrera" @change="cambiarCarrera">
                <option v-for="(key, val) in carreras" v-bind:value="key">
                  @{{ val }}
                </option>
            </select>


            <label for="email">Asignaturas:</label>
            <select v-model="alumno.asignatura">
                <option v-for="(key, val) in asignaturas" v-bind:value="val.id">
                  @{{ val.nombre }}
                </option>
            </select>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js') }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.min.js') }}

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var Usuario={
            MisDatos:function(accion,datos){
                $.ajax({
                    url         : accion,
                    type        : 'POST',
                    cache       : false,
                    dataType    : 'json',
                    data        : datos,
                    beforeSend : function() {
                        $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                    },
                    success : function(obj) {
                        $(".overlay,.loading-img").remove();
                        
                    },
                    error: function(){
                        $(".overlay,.loading-img").remove();
                    }
                });
            }
        };
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var accion="home/carreras";
            var datos = [];
            Usuario.MisDatos(accion,datos);
            Editar();
        });
        Editar=function(){
            console.log("editar");
        };
    </script>
    <script type="text/javascript">
        Vue.config.debug = true;

        var app = new Vue({
            http: {
                root: '/home',
                headers: {
                    'csrftoken': document.querySelector('#token').getAttribute('value')
                }
            },
            el: '#app',
            data: {
                carreras:[],
                asignaturas:[],
                alumno:{},
                alumnoReset:{
                    apellidos:'',
                    nombres:'',
                    dni:'',
                    direccion:'',
                    distrito:'',
                    provincia:'',
                    departamento:'',
                    carrera:'',
                    asignatura:'',
                },
            },
            methods: {
                showCarreras: function() {
                    this.$http.post('carreras', function (response) {
                        app.carreras=response;
                    });
                },
                registro: function() {
                    this.$http.post('registro',app.alumno, function (response) {
                        //app.carreras=response;
                    });
                },
                cambiarCarrera: function() {
                    var request = {
                        carrera_id: app.alumno.carrera,
                    };
                    this.$http.post('asignaturas',request, function (response) {
                        app.asignaturas=response;
                    });
                },
            },
            ready: function(){
                this.showCarreras();
            },
        });
    </script>
</body>
</html>