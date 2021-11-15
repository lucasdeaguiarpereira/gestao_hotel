
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
                    <div id='full_calendar_events'></div>
                </div>  
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pré-Agendamento <span id="dataInicio"></span> até <span id="dataFim"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="visitante" class="form-label">Cliente Reponsável</label>
                        <select id="visitante" name="visitante" class="form-select">
                            <option value="0" selected>Cliente Responsável</option>
                            <option value="1">José Ferreira</option>
                            <option value="2">Maria João</option>
                            <option value="3">Vicente de Paula</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="responsavel" class="form-label">Caseiro Reponsável</label>
                        <select id="responsavel" name="responsavel" class="form-select">
                            <option value="0" selected>Cliente Responsável</option>
                            <option value="1">Rogério</option>
                            <option value="2">Euzébio</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="quantidadePessoas" class="form-label">Quantidade de Visitantes</label>
                        <input type="number" min="0" class="rounded-3 form-control" name="quantidadePessoas" id="quantidadePessoas" placeholder="10">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="salvarAgendamento()" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        var SITEURL = "{{ url('/') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#full_calendar_events').fullCalendar({
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

                var event_start = $.fullCalendar.formatDate(event_start, "DD/MM/Y");
                var event_end = $.fullCalendar.formatDate(event_end, "DD/MM/Y");
                $("#dataInicio").html(event_start);
                $("#dataFim").html(event_end);
                
                $('#myModal').modal('show');

                // if (event_name) {
                //     var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                //     var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                //     console.log("Inicio:",event_start);
                //     console.log("Fim:",event_end);
                //     console.log("Nome:",event_name);
                //     var myModal = document.getElementById('myModal');



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
    });

    var myModal = document.getElementById('myModal');
    
    myModal.addEventListener('shown.bs.modal', function () {
    
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');            
    }

    function salvarAgendamento(){
        console.log("SalvarAgendamento");
        console.log($("#dataInicio").html());
        console.log($("#dataFim").html());
        console.log($("#pacote").val());
        console.log($("#responsavel").val());
        console.log($("#visitante").val());
        console.log($("#quantidadePessoas").val());

        $('#myModal').modal('hide');

    }

</script>
