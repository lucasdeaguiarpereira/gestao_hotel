
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
<!-- Modal -->
<div class="modal fade" id="modalDetalhamento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="tipoAgendamentoDetalhe"></span> <span id="dataInicioDetalhe"></span> até <span id="dataFimDetalhe"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Cliente: <span id="nomeClienteDetalhe"></span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Caseiro Reponsável: <span id="nomeCaseiroDetalhe"></span></label>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Quantidade de Visitantes: <span id="qtdPessoasDetalhe"></span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Pacote: <span id="nomePacoteDetalhe"></span></label>
                    </div>
                </div>
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Preço: R$ <span id="precoAgendamentoDetalhe"></span></label>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Descrição: <span id="descricaoAgendamentoDetalhe"></span></label>
                    </div>
                </div>
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Comentário: <span id="comentarioAgendamentoDetalhe"></span></label>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";
    var agendamentosGlobal = "";
    var precosGlobal = [];
    var usuariosGlobal = "";
    var pacotesGlobal = "";
    var idPacote = "";
    var dataInicial = "";
    var dataFinal = "";
    var cores = ['#D9CCBA','#8EDB5C','#D9943B','#2599D9','#D64DDB','DB9C5C','4DBADB','D4BAD9'];
    var usuarioCores = [];

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
            var nomeVisitante = "";
            var nomeResponsavel = "";
            var nomePacote = "";
            var status = "";
            var cor = "";
            var objeto = "";
            
            if(agendamentos.length>0){
                console.log("entou afsda");
                agendamentos.forEach(function(agendamento){
                    nomeVisitante = "";
                    nomeResponsavel = "";
                    nomePacote = "";
                    status = "";
                    cor = "";
                    objeto = "";

                    usuariosGlobal.forEach(function(usuario){
                        if(usuario.id == agendamento.id_visitante){
                            nomeVisitante = usuario.name;
                        }
                    });

                    usuariosGlobal.forEach(function(usuario){
                        if(usuario.id == agendamento.id_responsavel){
                            nomeResponsavel = usuario.name;
                        }
                    });

                    usuarioCores.forEach(function(usuario){
                        if(usuario.id_usuario == agendamento.id_visitante){
                            cor = usuario.cor;
                        }
                    });

                    pacotesGlobal.forEach(function(pacote){
                        if(pacote.id == agendamento.id_pacote){
                            nomePacote = pacote.nome_pacote;
                        }
                    });
     
                    if(agendamento.status == 1){
                        status = "Pré-Agendamento";
                    }
                    if(agendamento.status == 2){
                        status = "Agendamento Confirmado";
                    }
                    if(agendamento.status == 3){
                        status = "Agendamento Cancelado";
                    }

                    objeto ={
                                id:agendamento.id,
                                id_pacote:agendamento.id_pacote,
                                nome_pacote:nomePacote,
                                id_pesquisa_satisfacao:agendamento.id_pesquisa_satisfacao,
                                id_responsavel:agendamento.id_responsavel,
                                nome_responsavel:nomeResponsavel,
                                id_visitante:agendamento.id_visitante,
                                nome_visitante:nomeVisitante,
                                qtd_pessoas:agendamento.qtd_pessoas,
                                status:agendamento.status,
                                status_nome:status,
                                comentario:agendamento.comentario,
                                descricao:agendamento.descricao,
                                data_fim:agendamento.data_fim,
                                data_inicio:agendamento.data_inicio,
                                created_at:agendamento.created_at,
                                updated_at:agendamento.updated_at
                            };

                    eventos.push({start:agendamento.data_inicio.replace(" ","T"), end:agendamento.data_fim.replace(" ","T"), title:nomeVisitante+" - "+status, color: cor, dados:objeto})
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
                displayEventTime: false,
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
                    event_end.subtract(1, 'days');
                    dataFinal = $.fullCalendar.formatDate(event_end, "Y-MM-DD");
                    console.log(dataInicial);
                    console.log(dataFinal);
                    console.log("event_end",event_end);
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

                    precosGlobal.forEach(function(preco){
                        if(preco.id_agendamento == event.dados.id){
                            event.dados.preco = preco.valor;
                        }
                    });
                    console.log(event.dados);

                    $('#tipoAgendamentoDetalhe').html(event.dados.status_nome);
                    $('#dataInicioDetalhe').html(formatData(event.dados.data_inicio).split(" ")[0]);
                    $('#dataFimDetalhe').html(formatData(event.dados.data_fim).split(" ")[0]);
                    $('#nomeClienteDetalhe').html(event.dados.nome_visitante);
                    $('#nomeCaseiroDetalhe').html(event.dados.nome_responsavel);
                    $('#qtdPessoasDetalhe').html(event.dados.qtd_pessoas);
                    $('#nomePacoteDetalhe').html((event.dados.nome_pacote == "" ? "Não informado." : event.dados.nome_pacote));
                    $('#precoAgendamentoDetalhe').html(new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(event.dados.preco));
                    $('#descricaoAgendamentoDetalhe').html((event.dados.descricao == 'null' ? event.dados.descricao : "Não informado."));
                    $('#comentarioAgendamentoDetalhe').html((event.dados.comentario == 'null' ? event.dados.comentario : "Não informado."));

                    $('#modalDetalhamento').modal('show');

                    // var eventDelete = confirm("Are you sure?");
                    // if (eventDelete) {
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
                    // }
                }
            });
            $("#loading").hide();
            $('#full_calendar_events').show();
            verificaUrl();

        }
        
        var gerarOptionsUsuarios = function(dados){
            var htmlVisitante = '';
            var htmlResponsavel = '';
            var i =0;
            dados.forEach(function(usuario){
                if(usuario.id_tipo_usuario == 1){
                    htmlResponsavel += '<option value="'+usuario.id+'" selected>'+usuario.name+'</option>';
                }else if(usuario.id_tipo_usuario == 2){
                    usuarioCores.push({id_usuario:usuario.id,cor:cores[i],nome:usuario.name});
                    htmlVisitante += '<option value="'+usuario.id+'" selected>'+usuario.name+'</option>';
                } 
                i++;
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
                usuariosGlobal = dados;
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
                pacotesGlobal = dados;
                gerarOptionsPacotes(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

       

        var gerarDados = function(){
            var url = SITEURL+"/api/agendamentos";
            var urlPreco = "";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                console.log(dados);
                dados.forEach(function(agendamento){
                    setTimeout(() => {
                        urlPreco = "";
                        urlPreco += SITEURL+"/api/precoValido/"+agendamento.id
                        $.ajax({headers: {},method: "GET", url: urlPreco})
                        .done(function (preco) {
                            agendamento.valor = preco;
                            if(preco[0] !== undefined){
                                precosGlobal.push(preco[0]);
                            }
                        })
                        .fail(function () {
                            //console.log("Requisição com falha. ");
                        })
                        .always(function() {});
                    }, 500);
                });
                agendamentosGlobal = dados;
                geraCalendario(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});

            setTimeout(() => {
                
            }, 4000);
            
        }

        return {
            //main function to initiate the module
            init: function () {
                gerarUsuarios();
                gerarPacotes();
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
        var urlAgendamento= SITEURL+"/api/agendamentos";
        var urlPreco= SITEURL+"/api/precos";
        // console.log(url);
        var visitante = $("#visitante").val();
        var responsavel = $("#responsavel").val();
        var quantidadePessoas = $("#quantidadePessoas").val();
        var pacote = $("#pacote").val();
        var preco = $("#preco").val();
        var dadosAgendamento = {};
        var dadosPreco = {};

        
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

        $.ajax({headers: {}, data:dadosAgendamento, method: "POST", url: urlAgendamento})
        .done(function (dados) {
            console.log("salvando agendamento");
            console.log(dados.id);
            dadosPreco =  {
                        "id_agendamento": dados.id,
                        "valor": preco.replaceAll(".","").replace(",","."),
                        "valido": 1
                    };

         
            $.ajax({headers: {}, data:dadosPreco, method: "POST", url: urlPreco})
            .done(function (dados) {
                console.log(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});

            })
        .fail(function () {
            //console.log("Requisição com falha. ");
        })
        .always(function() {});


     
      
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
