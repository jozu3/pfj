@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
<button id="guardar" class="btn btn-success btn-sm">Guardar cambios</button>
    <h2 class="txt-yellow-pfj font-weight-bold">{{ $programa->nombre }}</h2>
    <h1>Organizar Personal y Grupos</h1>
    <div class="result"></div>
    <div id="cont-progress" class="progress" style="height: 20px;">
        <div id="progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"  ></div>
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <section class="content pb-3">
        @livewire('admin.asignar-personal', ['programa' => $programa], key($programa->id))
    </section>
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <b>Se guardó correctamente!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }

        .bg-yellow-pfj {
            background-color: #fe9a18 !important
        }

        .txt-yellow-pfj {
            color: #fe9a18
        }

        #success-alert {
            position: fixed;
            top: 150px;
            right: 5px;
        }

        .companerismo,
        .inscripcione {
            padding: 3px 6px;
        }

        .card-primary.card-outline {
            border-top: 3px solid #ffc907;
        }
        
        .group {
            padding: 2px
        }
        .bg-cordauxiliar{
            border-top: 3px solid #40bf1f;
        
        }
        .img-personal{
            width: 120px;
            height: 120px;
            object-fit: cover;
        }

        .cont-psinasignar{
            position: fixed;
            bottom: 0;
            right: 0;
            margin-left: 250px;
        }
        .cont-psinasignar>.card>.card-body{
            height: 25vh;
            overflow-x: hidden;
            overflow-y: auto;
        }


        @media (max-width: 1470px) {
            .img-personal{
                width: 80px;
                height: 80px;
            }
        }
        @media (max-width: 1010px) {
            .img-personal{
                width: 80px;
                height: 80px;
            }
            .cont-psinasignar{
                margin-left: 0;
            }
        }
        @media (max-width: 767px) {
            .img-personal{
                width: 150px;
                height: 150px;
            }
        }
        @media (max-width: 457px) {
            .img-personal{
                width: 60px;
                height: 60px;
            }
        }

        
        </style>
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        $().ready(function() {
            $("#success-alert").hide();
            $('#cont-progress').hide();
            $('#guardar').attr('disabled','')

            

        });

        const grupos = document.getElementsByClassName('group');
        const compas = document.getElementsByClassName('companerismo');

        for (var i = 0; i < grupos.length; i++) {
            new Sortable(grupos[i], {
                group: 'grupo',
                sort: false,
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                filter: ".ignore-elements",
                onEnd: (sortable) => {
                    console.log('se inserto un compañerismo')
                    console.log(sortable.el)
                },
                store: {
                    //guardamos el orden
                    set: (sortable) => {
                        const orden = sortable.toArray();
                        localStorage.setItem(sortable.el.getAttribute('data-id'), orden.join('|'));
                        //Livewire.emit('moverCompanerismo')
                        if (localStorage.length>0) {
                            $('#guardar').removeAttr('disabled')
                        } else {
                            $('#guardar').attr('disabled', '')
                        }

                    },
                    // Obtenemos el orden de la lista
                    get: (sortable) => {
                        const orden = localStorage.getItem(sortable.el.getAttribute('data-id'));
                        return orden ? orden.split('|') : [];
                    }
                }

            });
        }


        for (var i = 0; i < compas.length; i++) {
            new Sortable(compas[i], {
                group: 'companerismo',
                sort: false,
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                ghostClass: "col-md-6", 
                onEnd: (sortable) => {
                    //console.log(sortable.to)
                    var data_id = sortable.to.getAttribute('data-id');
                    if(data_id.includes('com') || data_id.includes('cordis'))
                    {
                        //sortable.item.removeAttr('class')
                        sortable.item.setAttribute('class', 'col-6')
                        console.log('se movio un personal a un compañerismo')
                    } else if(sortable.to.getAttribute('data-id').includes('sinAsignar')) {
                        sortable.item.setAttribute('class', 'col-sm-2 col-md-1')
                        console.log('se movio un personal a sin asignar')
                        
                    }

                    console.log('se inserto un personal')
                },
                store: {
                    //guardamos el orden
                    set: (sortable) => {
                        const orden = sortable.toArray();
                        console.log(orden)
                        var iddata = sortable.el.getAttribute('data-id')
                        // if (iddata == 'sinAsignar') {
                        //     localStorage.setItem('quitarInsComp', orden.join('|'));
                        // } else {
                            localStorage.setItem(iddata, orden.join('|'));
                        // }


                        //console.log(sortable)
                        if (localStorage.length>0) {
                            $('#guardar').removeAttr('disabled')
                        } else {
                            $('#guardar').attr('disabled', '')
                        }
                    },
                    // Obtenemos el orden de la lista
                    get: (sortable) => {
                        const orden = localStorage.getItem(sortable.el.getAttribute('data-id'));
                        return orden ? orden.split('|') : [];
                    }
                }

            });
        }




        var cambios = 0;
        var prog = 0;
        var solucionados = 0;

        $('#guardar').click(function() {
            
            if(localStorage.length == 0){
                $('#success-alert').addClass("alert alert-warning");
                
                $('#success-alert').show().html("<b>No ha realizado cambios</b>");
                $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
                
                return;
            }
            
            
            for (let c = 0; c < localStorage.length; c++) {
                
                var k = localStorage.key(c)
                //if(k != 'sinAsignar'){
                    
                    var value = localStorage.getItem(k)
                    let arr = value.split('|');
                    if (arr[0] != '') {
                        cambios = cambios + arr.length
                    }
                //}
            }
            
            prog = 100/cambios;

            //termina si no hay cambios
            if(cambios == 0){
                localStorage.clear();
                return;
            }
            $('#cont-progress').show();
            
            $("#progress").css('width', "0%");
            solucionados = 0;
            
            for (let i = 0; i < localStorage.length; i++) {

                var k = localStorage.key(i)
                var value = localStorage.getItem(k)

                var role = 6
                if (k.includes('cordis')) {
                    role = 4
                }
                if (k.includes('auxiliar')) {
                    role = 5
                }
                if (k.includes('Consejero')) {
                    role = 6
                }

                
                if ((k.includes('com-') || k.includes('cordis')) && value != '' && !k.includes('sinAsignar')) {
                    result = false;
                    
                    //console.log('compañerimso' + k.split('com-')[1])
                    var com = 0;
                    
                    if (k != 'sinAsignar') {
                        com = k.split('-')[1]
                    }
                    console.log(com)
                    

                    let arr = value.split('|');
                    //console.log('cant inscripcioen:' + arr.length)

                    for (let j = 0; j < arr.length; j++) {
                        const ins = arr[j].split('ins-')[1];
                        console.log(ins+ '-' + com)
                        $.post(`{{ route('admin.index') }}/inscripcione_companerismos/updateInscripcione/` + ins, {
                                _token: "{{ csrf_token() }}",
                                companerismo_id: com,
                                role_id: role
                            },
                            function(data, status) {
                                console.log("Data: " + data + "\nStatus: " + status);
                                
                                if(status == 'success'){
                                    result = true;
                                    progressBar();
                                     
                                    // $("#success-alert").show();
                                    // $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                                    //     $("#success-alert").slideUp(500);
                                    // });
                                }
                            }
                        );
                    }
                }

                if (k.includes('sinAsignar')) {
                    let arr = value.split('|');

                    $.post(`{{ route('admin.index') }}/inscripcione_companerismos/deleteInscripcioneCompanerismo` , {
                            _token: "{{ csrf_token() }}",
                            ins_comps: value
                        },
                        function(data, status) {
                            console.log("Data: " + data + "\nStatus: " + status);
                            
                            if(status == 'success'){
                                result = true;
                                
                                for (let j = 0; j < arr.length; j++) {
                                    progressBar();
                                }
                                    
                                // $("#success-alert").show();
                                // $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                                //     $("#success-alert").slideUp(500);
                                // });
                            }
                        }
                    );
                }


                if (k.includes('grupo-') && value != '') {
                    result = false;
                   // console.log('grupo' + k.split('grupo-')[1])
                    let grupo = k.split('grupo-')[1]
                    let arr = value.split('|');
                    //console.log('cant compañerismos:' + arr.length)
                    for (let j = 0; j < arr.length; j++) {
                        const comp = arr[j].split('com-')[1];
                        //console.log(comp)

                        $.ajax({
                            type: "POST",
                            url: `{{ route('admin.companerismos.index') }}/`+ comp,
                            data: {
                                _method: 'PUT',
                                _token: "{{ csrf_token() }}",
                                grupo_id: grupo,
                                organigrama: 1
                            },
                            success: function(data, status) {
                                console.log("Data: " + data + "\nStatus: " + status);
                                if(status == 'success'){

                                    result = true;
                                    progressBar();
                                    // $("#success-alert").show();
                                    // $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                                    //     $("#success-alert").slideUp(500);
                                    // });
                                }
                            },
                            error : function( data ) {
                                if( data.status === 422 ) {
                                    var errors = $.parseJSON(data.responseText);
                                    $.each(errors, function (key, value) {
                                        // console.log(key+ " " +value);
                                    $('#success-alert').addClass("alert alert-danger");

                                        if($.isPlainObject(value)) {
                                            $.each(value, function (key, value) {                       
                                                console.log(key+ " " +value);
                                            $('#success-alert').show().append(value+"<br/>");

                                            });
                                        }else{
                                        $('#success-alert').show().append(value+"<br/>"); //this is my div with messages
                                        }
                                    });
                                }
                            }
                        });
                    }
                }

            }
           


        })

        var prog_actual = 0;

        function progressBar(){
            solucionados = solucionados+1
            prog_actual = (prog_actual + prog);
            $("#progress").css('width', prog_actual+"%");
            $("#progress").attr('aria-valuenow', prog_actual)
            $("#progress").html( Math.round(prog_actual*100)/100 +'%')

            if (Math.round(prog_actual) == 100 && cambios ==solucionados ) {
                
                $("#success-alert").show();
                $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
                
                $('#cont-progress').fadeTo(1000, 500).slideUp(500, function() {
                    $("#cont-progress").slideUp(500);
                });
                localStorage.clear();
                prog = 0
                cambios = 0
                prog_actual = 0
                $('#guardar').attr('disabled', '')
            }
        }
</script>
@stop
