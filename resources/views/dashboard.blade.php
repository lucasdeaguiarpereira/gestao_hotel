
<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:13%;padding-bottom:17%;">
        <div style="color:white;">
            <h3>Calendário</h3>
            <h5>Veja o calendario completo</h5>
        </div>
    </div>
    <div class="ms-5 me-5" style="margin-top:-10%;margin-bottom:5%;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:20px;">
                <div class="container mt-5 mb-5" style="max-width: 700px">
                    <div id='loading'>
                        Carregando ...
                    </div>
                    <div id='full_calendar_events' class="hidden"></div>
                </div>  
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
<div class="modal fade" id="modalAgendamento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pré-Agendamento <span id="dataInicio"></span> até <span id="dataFim"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="visitante" class="form-label">Cliente</label>
                        <select id="visitante" name="visitante" class="form-select">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="responsavel" class="form-label">Caseiro Reponsável</label>
                        <select id="responsavel" name="responsavel" class="form-select">
                        </select>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="quantidadePessoas" class="form-label">Quantidade de Visitantes</label>
                        <input type="number" min="0" class="rounded-3 form-control" name="quantidadePessoas" id="quantidadePessoas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="pacote" class="form-label">Pacote</label>
                        <select id="pacote" name="pacote" class="form-select">
                            <option value="0" selected>Pacote</option>
                            <option value="1">Fim de Ano - 25/12 até 31/12</option>
                            <option value="2">Finados - 01/11 até 03/11</option>
                        </select>
                    </div>
                </div>
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="rounded-3 form-control" name="preco" id="preco">
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="salvarAgendamento()" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";
    var agendamentosGlobal = "";
    var idPacote = "";
    var dataInicial = "";
    var dataFinal = "";

    var formatData = function(data){
            var dataFormatada = new Date(data);
            return(dataFormatada.toLocaleString());
    }

    var classAgendamentos = function () {

        var verificaUrl = function(){
            var url_atual = window.location.href;
            var variavel = "";
            url_atual = url_atual.split("?");
            console.log(url_atual);
            if(url_atual.length >1)
            {
                console.log("entrou aqui");
                url_atual = url_atual[1].split("&");
                
                url_atual.forEach(function(dados){
                    variavel = dados.split("=");
                    if(variavel[0] == "idPacote"){
                        idPacote = variavel[1];
                    }
                    if(variavel[0] == "dataInicial"){
                        dataInicial = variavel[1].replace("%20"," ");
                    }
                    if(variavel[0] == "dataFinal"){
                        dataFinal = variavel[1].replace("%20"," ");
                    }

                });
            }
           
        }

        var geraEventsCalendario = function(agendamentos){
            var eventos = [];
            if(agendamentos.length>0){
                console.log("entou afsda");
                agendamentos.forEach(function(agendamento){
                    eventos.push({start:agendamento.data_inicio.replace(" ","T"), end:agendamento.data_fim.replace(" ","T"), display:'teste'})
                });
            }
            console.log("eventos aqui");
            console.log(eventos);
            return eventos;

        }

        var geraCalendario = function(data){
            var eventos = geraEventsCalendario(data);
            $('#full_calendar_events').fullCalendar({
                editable: true,
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                buttonText: {
                    today: "Hoje",
                    month: "Mês",
                    week: "Semana",
                    day: "Dia"
                },
                displayEventTime: true,
                events: eventos,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (event_start, event_end, allDay) {
                    dataInicial = $.fullCalendar.formatDate(event_start, "Y-MM-DD");
                    dataFinal = $.fullCalendar.formatDate(event_end, "Y-MM-DD");
                    console.log(dataInicial);
                    console.log(dataFinal);
                    var event_start = $.fullCalendar.formatDate(event_start, "DD/MM/Y");
                    var event_end = $.fullCalendar.formatDate(event_end, "DD/MM/Y");
                    $("#dataInicio").html(event_start);
                    $("#dataFim").html(event_end);
                    
                    $('#modalAgendamento').modal('show');

                    // if (event_name) {
                    //     var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                    //     var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                    //     console.log("Inicio:",event_start);
                    //     console.log("Fim:",event_end);
                    //     console.log("Nome:",event_name);
                    //     var modalAgendamento = document.getElementById('modalAgendamento');



                    //     // $.ajax({
                    //     //     url: SITEURL + "/calendar-crud-ajax",
                    //     //     data: {
                    //     //         event_name: event_name,
                    //     //         event_start: event_start,
                    //     //         event_end: event_end,
                    //     //         type: 'create'
                    //     //     },
                    //     //     type: "POST",
                    //     //     success: function (data) {
                    //     //         displayMessage("Event created.");

                    //     //         calendar.fullCalendar('renderEvent', {
                    //     //             id: data.id,
                    //     //             title: event_name,
                    //     //             start: event_start,
                    //     //             end: event_end,
                    //     //             allDay: allDay
                    //     //         }, true);
                    //     //         calendar.fullCalendar('unselect');
                    //     //     }
                    //     // });
                    // }
                },
                eventDrop: function (event, delta) {
                    var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    // $.ajax({
                    //     url: SITEURL + '/calendar-crud-ajax',
                    //     data: {
                    //         title: event.event_name,
                    //         start: event_start,
                    //         end: event_end,
                    //         id: event.id,
                    //         type: 'edit'
                    //     },
                    //     type: "POST",
                    //     success: function (response) {
                    //         displayMessage("Event updated");
                    //     }
                    // });
                },
                eventClick: function (event) {
                    var eventDelete = confirm("Are you sure?");
                    if (eventDelete) {
                        // $.ajax({
                        //     type: "POST",
                        //     url: SITEURL + '/calendar-crud-ajax',
                        //     data: {
                        //         id: event.id,
                        //         type: 'delete'
                        //     },
                        //     success: function (response) {
                        //         calendar.fullCalendar('removeEvents', event.id);
                        //         displayMessage("Event removed");
                        //     }
                        // });
                    }
                }
            });
            $("#loading").hide();
            $('#full_calendar_events').show();
            verificaUrl();

        }
        
        var gerarOptionsUsuarios = function(dados){
            var htmlVisitante = '';
            var htmlResponsavel = '';
           
            dados.forEach(function(usuario){
                if(usuario.id_tipo_usuario == 1){
                    htmlResponsavel += '<option value="'+usuario.id+'" selected>'+usuario.name+'</option>';
                }else if(usuario.id_tipo_usuario == 2){
                    htmlVisitante += '<option value="'+usuario.id+'" selected>'+usuario.name+'</option>';
                } 
            });

            $("#responsavel").html(htmlResponsavel);
            $("#visitante").html(htmlVisitante);
        }

        var gerarUsuarios = function(){
            var url = SITEURL+"/api/users";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                console.log(dados);
                gerarOptionsUsuarios(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        var gerarOptionsPacotes = function(dados){
            var html = '<option value="0" selected>Sem Pacote</option>';
           
            dados.forEach(function(pacote){
                html += '<option value="'+pacote.id+'" selected>'+pacote.nome_pacote+'</option>';  
            });
            $("#pacote").html(html);
        }

        var gerarPacotes = function(){
            var url = SITEURL+"/api/pacotes";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                console.log(dados);
                gerarOptionsPacotes(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/agendamentos";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                console.log(dados);
                gerarUsuarios();
                gerarPacotes();
                geraCalendario(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        return {
            //main function to initiate the module
            init: function () {
                gerarDados();
            }
        };

    }();

    $(document).ready(function () {

        classAgendamentos.init();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#preco").mask("#.##0,00", {reverse: true});
    });

    var modalAgendamento = document.getElementById('modalAgendamento');
    
    modalAgendamento.addEventListener('shown.bs.modal', function () {
    
    });
    function displayMessage(message) {
        toastr.success(message, 'Event');            
    }

    function salvarAgendamento(){
        console.log("salvarAgendamento");
        var url= SITEURL+"/api/agendamentos";
        // console.log(url);
        var visitante = $("#visitante").val();
        var responsavel = $("#responsavel").val();
        var quantidadePessoas = $("#quantidadePessoas").val();
        var pacote = $("#pacote").val();
        var preco = $("#preco").val();
        var dadosAgendamento = {};

        
        console.log(visitante);
        console.log(responsavel);
        console.log(quantidadePessoas);
        console.log(pacote);
        console.log(dataInicial);
        console.log(dataFinal);
        console.log(preco);
      
        if(preco == ""){
            alert("Preço do Agendamento é um campo abrigatório");
            $("#preco").focus();
            return("Erro: Preço do Agendamento Obrigatório");
        }
        
        if(pacote ==0){
            dadosAgendamento =  {
                                    "data_inicio":dataInicial+" 00:01:01",
                                    "data_fim":dataFinal+" 23:59:59",
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "qtd_pessoas":quantidadePessoas,
                                    "status":1
                                };
        }else{
            dadosAgendamento =  {
                                    "data_inicio":dataInicial+" 00:01:01",
                                    "data_fim":dataFinal+" 23:59:59",
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "id_pacote":pacote,
                                    "qtd_pessoas":quantidadePessoas,
                                    "status":1
                                };
        }

        $.ajax({headers: {}, data:dadosAgendamento, method: "POST", url: url})
        .done(function (dados) {
            console.log(dados);
        })
        .fail(function () {
            //console.log("Requisição com falha. ");
        })
        .always(function() {});


        // dadosPreco =  {
        //                     "id_agendamento": 1,
        //                     "valor": 2250.75
        //               };

        // $.ajax({headers: {}, data:dadosAgendamento, method: "POST", url: url})
        // .done(function (dados) {
        //     console.log(dados);
        // })
        // .fail(function () {
        //     //console.log("Requisição com falha. ");
        // })
        // .always(function() {});

      
        alert("Agendamento criado com sucesso!");
        $('#modalAgendamento').modal('hide');
        $("#visitante").val("");
        $("#responsavel").val("");
        $("#quantidadePessoas").val("");
        $("#pacote").val("");
        $("#dataInicio").html("");
        $("#dataFim").html("") 
        $("#preco").val("");
        classAgendamentos.init();
 
    }

</script>
