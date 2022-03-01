
<x-app-layout>
    <div class="tituloSuperior text-center">
        <div style="color:white;">
            <h3>Calendário</h3>
            <h5>Veja o calendário completo</h5>
        </div>
    </div>
    <div class="row" style="--bs-gutter-x: 0 !important;margin-top:-10%;margin-bottom:5%;justify-content: center!important;">
        <div class="row bg-white overflow-hidden shadow-xl sm:rounded-lg calendario" style="border-radius:20px;justify-content: center!important;">
            <div class="row container mt-5 mb-5 calendario" style="justify-content: center!important;">
                <div id='loading'>
                    Carregando ...
                </div>
                <div id='full_calendar_events' class="hidden"></div>
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
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="pacote" class="form-label">Pacote</label>
                        <select id="pacote" onchange="setPrecoPacote($(this).val(),1)" name="pacote" class="form-select">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="rounded-3 form-control" name="preco" id="preco">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="comentario" class="form-label">Comentário do caseiro (oculto pra cliente)</label>
                        <input type="text" class="rounded-3 form-control" name="comentario" id="comentario">
                    </div>
                </div>
                @endif
                @if (Auth::user()->id_tipo_usuario == 2)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="pacote" class="form-label">Pacote</label>
                        <select id="pacote" onchange="setPrecoPacoteCliente($(this).val(),1)" name="pacote" class="form-select">
                        </select>
                    </div>
                </div>
                <div class="row" id="precoClienteRow" style="display:none;">
                    <div class="col-12 mb-3"> 
                        <label for="precoCliente" class="form-label">Preço</label>
                        <input type="text" class="rounded-3 form-control" name="precoCliente" id="precoCliente" readonly>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="descricao" class="form-label">Descrição do cliente</label>
                        <input type="text" class="rounded-3 form-control" name="descricao" id="descricao">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                @if (Auth::user()->id_tipo_usuario == 1)
                    <button type="button" onclick="salvarAgendamento()" class="btn btn-primary">Confirmar</button>
                @endif
                @if (Auth::user()->id_tipo_usuario == 2)
                    <button type="button" onclick="salvarAgendamentoCliente()" class="btn btn-primary">Confirmar</button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAgendamentoEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agendamento <span id="dataInicioEdit"></span> até <span id="dataFimEdit"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="display:none;">
                    <div class="col-12 mb-3"> 
                        <label for="idAgendamentoEdit" class="form-label">Id</label>
                        <input type="number" min="0" class="rounded-3 form-control" name="idAgendamentoEdit" id="idAgendamentoEdit">
                    </div>
                </div>
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="statusEdit" class="form-label">Status</label>
                        <select id="statusEdit" name="statusEdit" class="form-select">
                            <option value='1'>Pré-Agendamento</option>
                            <option value='2'>Agendamento Confirmado</option>
                            <option value='3'>Agendamento Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="visitanteedit" class="form-label">Cliente</label>
                        <select id="visitanteEdit" name="visitanteEdit" class="form-select">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="responsavelEdit" class="form-label">Caseiro Reponsável</label>
                        <select id="responsavelEdit" name="responsavelEdit" class="form-select">
                        </select>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="quantidadePessoasEdit" class="form-label">Quantidade de Visitantes</label>
                        <input type="number" min="0" class="rounded-3 form-control" name="quantidadePessoasEdit" id="quantidadePessoasEdit">
                    </div>
                </div>
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="pacoteEdit" class="form-label">Pacote</label>
                        <select id="pacoteEdit" onchange="setPrecoPacote($(this).val(),2)" name="pacoteEdit" class="form-select">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="precoEdit" class="form-label">Preço</label>
                        <input type="text" class="rounded-3 form-control" name="precoEdit" id="precoEdit">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="comentarioEdit" class="form-label">Comentário do caseiro:</label>
                        <input type="text" class="rounded-3 form-control" name="comentarioEdit" id="comentarioEdit">
                    </div>
                </div>
                @endif
                @if (Auth::user()->id_tipo_usuario == 2)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="pacoteEdit" class="form-label">Pacote</label>
                        <select id="pacoteEdit" onchange="setPrecoPacoteCliente($(this).val(),2)" name="pacoteEdit" class="form-select">
                        </select>
                    </div>
                </div>
                <div class="row" id="precoEditClienteRow">
                    <div class="col-12 mb-3"> 
                        <label for="precoEditCliente" class="form-label">Preço</label>
                        <input type="text" class="rounded-3 form-control" name="precoEditCliente" id="precoEditCliente" readonly>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="descricaoEdit" class="form-label">Descrição do cliente</label>
                        <input type="text" class="rounded-3 form-control" name="descricaoEdit" id="descricaoEdit">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                @if (Auth::user()->id_tipo_usuario == 1)
                    <button type="button" onclick="editarAgendamento()" class="btn btn-primary">Salvar</button>
                @endif
                @if (Auth::user()->id_tipo_usuario == 2)
                    <button type="button" onclick="editarAgendamentoCliente()" class="btn btn-primary">Salvar</button>
                @endif
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
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Preço: <span id="precoAgendamentoDetalhe"></span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Descrição do cliente: <span id="descricaoAgendamentoDetalhe"></span></label>
                    </div>
                </div>
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label class="form-label">Comentário do caseiro: <span id="comentarioAgendamentoDetalhe"></span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3 text-center"> 
                        <button type="button" id="confirmarAgendamento" onclick="confirmarAgendamento()" style="margin-bottom:10px;color:white;width:80%;align-items:center;justify-content:center;background-color:#71BF94;display:none;" class="btn rounded-pill">
                            Confirmar
                        </button>
                    </div>
                    <div class="col-6 mb-3 text-center"> 
                        <button type="button" id="cancelarAgendamento" onclick="cancelarAgendamento()" style="color:white;width:80%;align-items:center;justify-content:center;background-color:#f75959;display:none;" class="btn rounded-pill">
                            Cancelar
                        </button>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" id="editarDetalhe" onclick="editarAgendamentoModal()" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEnvio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Enviando para <span id="nomeUsuario"></span>...</h5>
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
    var cores = ['#D9CCBA','#8EDB5C','#D9943B','#2599D9','#D64DDB','#DB9C5C','#4DBADB','#D4BAD9','#0aad33'];
    var usuarioCores = [];

    var formatData = function(data){
        var dataFormatada = new Date(data);
        return(dataFormatada.toLocaleString());
    }
    
    function setPrecoPacote(idPacote, tipoModal){
        var pacote = "";
        var precoPacote = "";
        if(idPacote != 0 ){
            pacote = pacotesGlobal.find(pacote => pacote.id == idPacote);
            precoPacote = new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(pacote.preco_padrao);
        }else{
            precoPacote = "";
        }
        if(tipoModal == 1){
            $("#preco").val(precoPacote);
        }else if(tipoModal == 2){
            $("#precoEdit").val(precoPacote);
        }
    }

    function setPrecoPacoteCliente(idPacote, tipoModal){
        var pacote = "";
        var precoPacote = "";
        if(idPacote != 0 ){
            pacote = pacotesGlobal.find(pacote => pacote.id == idPacote);
            precoPacote = new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(pacote.preco_padrao);
        }else{
            precoPacote = "";
        }
        if(tipoModal == 1){
            $("#precoCliente").val(precoPacote);
            if(precoPacote == ""){
                $("#precoClienteRow").css("display", "none");;     
            }else{
                $("#precoClienteRow").css("display", "block");;
            }
        }else if(tipoModal == 2){
            $("#precoEditCliente").val(precoPacote);
            if(precoPacote == ""){
                $("#precoEditClienteRow").css("display", "none");;     
            }else{
                $("#precoEditClienteRow").css("display", "block");;
            }
        }
      
    }

    function editarAgendamentoModal(){
        $('#modalDetalhamento').modal('hide');
        $('#modalAgendamentoEdit').modal('show');
    }

    function confirmarAgendamento(idAgendamento){
        var url = SITEURL+"/api/agendamentos/"+idAgendamento;
        var agendamento = agendamentosGlobal.find(agendamento => agendamento.id == idAgendamento);    
        var visitante = usuariosGlobal.find(usuario => usuario.id == agendamento.id_visitante);    
        var preco = precosGlobal.find(preco => preco.id_agendamento == agendamento.id);    
        if(preco == undefined){
            alert("Necessário colocar um preço para confirmar o agendamento.");
        }else{
            // console.log("CONFIRMAÇÕES");
            // console.log(agendamento);
            // console.log(visitante);
            // console.log(preco);
    
            console.log(url);
            $.ajax({headers: {},data:{"status":2},method: "PUT", url: url})
            .done(function () {
                
                //inicio envio de email salvamento responsavel
                var urlEmail= SITEURL+"/api/enviarEmail";
                $("#nomeUsuario").html(visitante.name);
                $('#modalEnvio').modal('show');
                // console.log(url);
                var destinatario = "serradobene@gmail.com";
                var assunto = "Serra do Bené - Confirmação Agendamento - "+visitante.name;
                var texto = "O seu agendamento na Serra do Bené foi confirmado.<br>"+
                            "Cliente: "+visitante.name+"<br>"+
                            "Quantidade de visitantes: "+agendamento.qtd_pessoas+"<br>"+
                            "Preço: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>"+
                            "Descrição: "+agendamento.descricao;
        
                var dadosEmail =  {
                                    "destinatario":destinatario,
                                    "assunto":assunto,
                                    "texto":texto
                                };
            

                $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
                .done(function () {
                
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                    alert("Problema no envio do email!");
                })
                .always(function() {});


                var destinatario = visitante.email;
                var texto = "O seu agendamento na Serra do Bené foi confirmado.<br>"+
                            "Cliente: "+visitante.name+"<br>"+
                            "Quantidade de visitantes: "+agendamento.qtd_pessoas+"<br>"+
                            "Preço: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>"+
                            "Descrição: "+agendamento.descricao;
        
        
                var dadosEmail =  {
                                    "destinatario":destinatario,
                                    "assunto":assunto,
                                    "texto":texto
                                };
            

                $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
                .done(function () {
                    $('#modalEnvio').modal('hide');
                    alert("Email enviado com sucesso para o cliente!");
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                    alert("Problema no envio do email!");
                })
                .always(function() {});
                //fim envio de email salvamento responsavel
                
                var confirmacao = confirm("Orçamento Aprovado com sucesso!");
                if(confirmacao){
                    $('#modalDetalhamento').modal('hide');
                    $("#loading").show();                
                    classAgendamentos.init();
                }
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }
    }

    function cancelarAgendamento(idAgendamento){
        var url = SITEURL+"/api/agendamentos/"+idAgendamento;
        var agendamento = agendamentosGlobal.find(agendamento => agendamento.id == idAgendamento);    
        var visitante = usuariosGlobal.find(usuario => usuario.id == agendamento.id_visitante);    
        var preco = precosGlobal.find(preco => preco.id_agendamento == agendamento.id);  
            // console.log(url);
        $.ajax({headers: {},data:{"status":3},method: "PUT", url: url})
        .done(function () {

            //inicio envio de email salvamento responsavel
            var urlEmail= SITEURL+"/api/enviarEmail";
            $("#nomeUsuario").html(visitante.name);
            $('#modalEnvio').modal('show');
            // console.log(url);
            var destinatario = "serradobene@gmail.com";
            var assunto = "Serra do Bené - Cancelamento de Agendamento - "+visitante.name;
            var texto = "O seu agendamento na Serra do Bené foi CANCELADO.<br>"+
                        "Cliente: "+visitante.name+"<br>"+
                        "Quantidade de visitantes: "+agendamento.qtd_pessoas+"<br>"+
                        "Preço: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>"+
                        "Descrição: "+agendamento.descricao;
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
            
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});


            var destinatario = visitante.email;
            var texto = "O seu agendamento na Serra do Bené foi cancelado.<br>"+
                        "Cliente: "+visitante.name+"<br>"+
                        "Quantidade de visitantes: "+agendamento.qtd_pessoas+"<br>"+
                        "Preço: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>"+
                        "Descrição: "+agendamento.descricao;
    
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                $('#modalEnvio').modal('hide');
                alert("Email enviado com sucesso para o cliente!");
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});
            //fim envio de email salvamento responsavel
            var confirmacao = confirm("Orçamento Cancelado com sucesso!");
            if(confirmacao){
                $('#modalDetalhamento').modal('hide');    
                $("#loading").show();            
                classAgendamentos.init();
            }
        })
        .fail(function () {
            //console.log("Requisição com falha. ");
        })
        .always(function() {});
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
        //INICIO ADM
        @if (Auth::user()->id_tipo_usuario == 1)
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
        @endif
        //FIM ADM
        //INICIO USUARIO COMUM
        @if (Auth::user()->id_tipo_usuario == 2)
        var geraEventsCalendario = function(agendamentos){
            var idUsuario = {{ Auth::user()->id }};
            var eventos = [];
            var nomeVisitante = "";
            var nomeResponsavel = "";
            var nomePacote = "";
            var status = "";
            var cor = "";
            var objeto = "";
            
            if(agendamentos.length>0){
                agendamentos.forEach(function(agendamento){
                    if(agendamento.id_visitante == idUsuario){
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

                        eventos.push({start:agendamento.data_inicio.replace(" ","T"), end:agendamento.data_fim.replace(" ","T"), title:nomeVisitante+" - "+status, color: cor, dados:objeto});
                    }else if(agendamento.status == 2){
                        objeto = "";
                        status = "Agendamento Confirmado";
                        objeto ={
                                    id:agendamento.id,
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

                        eventos.push({start:agendamento.data_inicio.replace(" ","T"), end:agendamento.data_fim.replace(" ","T"), title:"Data indisponível", color: "gray", dados:objeto})
                    }
                });
            }
            console.log("eventos aqui");
            console.log(eventos);
            return eventos;

        }
        @endif
        //FIM USUARIO COMUM

        var geraCalendario = function(data){

            $('#full_calendar_events').fullCalendar('destroy');
            var eventos = geraEventsCalendario(data);
            $('#full_calendar_events').fullCalendar({
                editable: false,
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
                    var prosseguir = 1;
                    // console.log("Eventos criados");
                    // console.log(eventos);
                    event_end.subtract(1, 'days');
                    dataInicial = $.fullCalendar.formatDate(event_start, "Y-MM-DD");
                    dataFinal = $.fullCalendar.formatDate(event_end, "Y-MM-DD");
                    var data_inicial_comp = $.fullCalendar.formatDate(event_start, "Y-MM-DD 00:01:01");
                    var data_final_comp = $.fullCalendar.formatDate(event_end, "Y-MM-DD 23:59:59");
                    data_inicial_comp = data_inicial_comp.replace(" ","T");
                    data_final_comp = data_final_comp.replace(" ","T");
                    eventos.forEach(function(evento){
                        if(data_inicial_comp >= evento.start && data_final_comp <= evento.end){
                            prosseguir = 0;
                            console.log("Não pode! data no meio de um evento");
                            return;
                        }else if(data_inicial_comp <= evento.start && data_final_comp >= evento.end){
                            prosseguir = 0;
                            console.log("Não pode! Tem evento no meio dessa data");
                            return;
                        }else if(data_inicial_comp <= evento.start && data_final_comp >= evento.start){
                            prosseguir = 0;
                            console.log("Não pode! Tem evento começando no meio dessa data");
                            return;
                        }else if(data_inicial_comp <= evento.end && data_final_comp >= evento.end){
                            prosseguir = 0;
                            console.log("Não pode! Tem evento terminando no meio dessa data");
                            return;
                        }
                    });

                    if(prosseguir == 1){    
                        var event_start_format = $.fullCalendar.formatDate(event_start, "DD/MM/Y");
                        var event_end_format = $.fullCalendar.formatDate(event_end, "DD/MM/Y");
                        $("#dataInicio").html(event_start_format);
                        $("#dataFim").html(event_end_format);
                        $('#modalAgendamento').modal('show');
                    }else{
                        alert("Período selecionado já possui agendamento");
                    }
                },
                eventDrop: function (event, delta) {
                    var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                },
                //INICIO ADM
                @if (Auth::user()->id_tipo_usuario == 1)
                eventClick: function (event) {
                    
                    precosGlobal.forEach(function(preco){
                        if(preco.id_agendamento == event.dados.id){
                            event.dados.preco = preco.valor;
                        }
                    });
                    console.log(event.dados);
                    dataInicial = event.dados.data_inicio;
                    dataFinal = event.dados.data_fim;
                    $('#tipoAgendamentoDetalhe').html(event.dados.status_nome);
                    $('#dataInicioDetalhe').html(formatData(event.dados.data_inicio).split(" ")[0]);
                    $('#dataFimDetalhe').html(formatData(event.dados.data_fim).split(" ")[0]);
                    $('#nomeClienteDetalhe').html(event.dados.nome_visitante);
                    $('#nomeCaseiroDetalhe').html(event.dados.nome_responsavel);
                    $('#qtdPessoasDetalhe').html(event.dados.qtd_pessoas);
                    $('#nomePacoteDetalhe').html((event.dados.nome_pacote == "" ? "Não informado." : event.dados.nome_pacote));
                    if(event.dados.preco == null){
                        $('#precoAgendamentoDetalhe').html("Não confirmado");
                    }else{
                        $('#precoAgendamentoDetalhe').html("R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(event.dados.preco));
                    }
                    $('#descricaoAgendamentoDetalhe').html((event.dados.descricao == null ? "Não informado." : event.dados.descricao));
                    $('#comentarioAgendamentoDetalhe').html((event.dados.comentario == null ? "Não informado." : event.dados.comentario));

                    if(event.dados.status ==1){
                        $('#confirmarAgendamento').attr('onclick', 'confirmarAgendamento('+event.dados.id+')');
                        $('#cancelarAgendamento').attr('onclick', 'cancelarAgendamento('+event.dados.id+')');
                        $('#confirmarAgendamento').show();
                        $('#cancelarAgendamento').show();
                    }else if(event.dados.status ==2){
                        $('#confirmarAgendamento').attr('onclick', 'confirmarAgendamento()');
                        $('#cancelarAgendamento').attr('onclick', 'cancelarAgendamento('+event.dados.id+')');
                        $('#confirmarAgendamento').hide();
                        $('#cancelarAgendamento').show();
                    }else if(event.dados.status ==3){
                        $('#confirmarAgendamento').attr('onclick', 'confirmarAgendamento('+event.dados.id+')');
                        $('#cancelarAgendamento').attr('onclick', 'cancelarAgendamento()');
                        $('#confirmarAgendamento').show();
                        $('#cancelarAgendamento').hide();
                    }
                    
                    $('#dataInicioEdit').html(formatData(event.dados.data_inicio).split(" ")[0]);
                    $('#dataFimEdit').html(formatData(event.dados.data_fim).split(" ")[0]);
                    $("#idAgendamentoEdit").val(event.dados.id);
                    $("#statusEdit").val(event.dados.status);
                    $("#visitanteEdit").val(event.dados.id_visitante);
                    $("#responsavelEdit").val(event.dados.id_responsavel);
                    $("#quantidadePessoasEdit").val(event.dados.qtd_pessoas);
                    $("#pacoteEdit").val(event.dados.id_pacote == null ? 0 : event.dados.id_pacote);
                    if(event.dados.preco == null){
                        $('#precoEdit').val("");
                    }else{
                        $("#precoEdit").val(new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(event.dados.preco));
                    }
                    $('#descricaoEdit').val((event.dados.descricao == null ? "" : event.dados.descricao));
                    $('#comentarioEdit').val((event.dados.comentario == null ? "" : event.dados.comentario));
                  
                    $('#modalDetalhamento').modal('show');

                }
                @endif
                //FIM ADM
                // INICIO USUARIO COMUM
                @if (Auth::user()->id_tipo_usuario == 2)
                eventClick: function (event) {
                    var idUsuario = {{ Auth::user()->id }};
                    if(event.dados.id_visitante == idUsuario){
                        precosGlobal.forEach(function(preco){
                            if(preco.id_agendamento == event.dados.id){
                                event.dados.preco = preco.valor;
                            }
                        });
                        console.log(event.dados);
                        dataInicial = event.dados.data_inicio;
                        dataFinal = event.dados.data_fim;
                        $('#tipoAgendamentoDetalhe').html(event.dados.status_nome);
                        $('#dataInicioDetalhe').html(formatData(event.dados.data_inicio).split(" ")[0]);
                        $('#dataFimDetalhe').html(formatData(event.dados.data_fim).split(" ")[0]);
                        $('#nomeClienteDetalhe').html(event.dados.nome_visitante);
                        $('#nomeCaseiroDetalhe').html(event.dados.nome_responsavel);
                        $('#qtdPessoasDetalhe').html(event.dados.qtd_pessoas);
                        $('#nomePacoteDetalhe').html((event.dados.nome_pacote == "" ? "Não informado." : event.dados.nome_pacote));
                        if(event.dados.preco == null){
                            $('#precoAgendamentoDetalhe').html("Não confirmado");
                        }else{
                            $('#precoAgendamentoDetalhe').html("R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(event.dados.preco));
                        }
                        $('#descricaoAgendamentoDetalhe').html((event.dados.descricao == null ? "Não informado." : event.dados.descricao));
                        $('#comentarioAgendamentoDetalhe').html((event.dados.comentario == null ? "Não informado." : event.dados.comentario));

                        if(event.dados.status ==1){
                            $('#confirmarAgendamento').attr('onclick', 'confirmarAgendamento('+event.dados.id+')');
                            $('#cancelarAgendamento').attr('onclick', 'cancelarAgendamento('+event.dados.id+')');
                            $('#editarDetalhe').show();
                            $('#confirmarAgendamento').show();
                            $('#cancelarAgendamento').show();
                        }else if(event.dados.status ==2){
                            $('#confirmarAgendamento').attr('onclick', 'confirmarAgendamento()');
                            $('#cancelarAgendamento').attr('onclick', 'cancelarAgendamento('+event.dados.id+')');
                            $('#editarDetalhe').hide();
                            $('#confirmarAgendamento').hide();
                            $('#cancelarAgendamento').show();
                        }else if(event.dados.status ==3){
                            $('#confirmarAgendamento').attr('onclick', 'confirmarAgendamento('+event.dados.id+')');
                            $('#cancelarAgendamento').attr('onclick', 'cancelarAgendamento()');
                            $('#editarDetalhe').hide();
                            $('#confirmarAgendamento').show();
                            $('#cancelarAgendamento').hide();
                        }
                        
                        $('#dataInicioEdit').html(formatData(event.dados.data_inicio).split(" ")[0]);
                        $('#dataFimEdit').html(formatData(event.dados.data_fim).split(" ")[0]);
                        $("#idAgendamentoEdit").val(event.dados.id);
                        $("#statusEdit").val(event.dados.status);
                        $("#visitanteEdit").val(event.dados.id_visitante);
                        $("#responsavelEdit").val(event.dados.id_responsavel);
                        $("#quantidadePessoasEdit").val(event.dados.qtd_pessoas);
                        $("#pacoteEdit").val(event.dados.id_pacote == null ? 0 : event.dados.id_pacote);
                        if(event.dados.preco == null){
                            $('#precoEditCliente').val("");
                        }else{
                            $("#precoEditCliente").val(new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(event.dados.preco));
                        }
                        $('#descricaoEdit').val((event.dados.descricao == null ? "" : event.dados.descricao));
                    
                        $('#modalDetalhamento').modal('show');
                    }
                }
                @endif
                //FIM USUARIO COMUM
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
            $("#responsavelEdit").html(htmlResponsavel);
            $("#visitanteEdit").html(htmlVisitante);
        }

        var gerarUsuarios = function(){
            var url = SITEURL+"/api/users";
            usuariosGlobal = "";
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
            var html = '<option value="0" selected>Sem Pacote (Valores serão negociados)</option>';
           
            dados.forEach(function(pacote){
                html += '<option value="'+pacote.id+'">'+pacote.nome_pacote+'</option>';  
            });
            $("#pacote").html(html);
            $("#pacoteEdit").html(html);
        }

        var gerarPacotes = function(){
            var url = SITEURL+"/api/pacotes";
            pacotesGlobal = "";
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
            agendamentosGlobal ="";
            precosGlobal = [];
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
                setTimeout(() => {
                    geraCalendario(dados);
                }, 1000);
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
        $("#precoEdit").mask("#.##0,00", {reverse: true});
    });

    var modalAgendamento = document.getElementById('modalAgendamento');
    
    modalAgendamento.addEventListener('shown.bs.modal', function () {
    
    });

    var modalEnvio = document.getElementById('modalEnvio');
    
    modalEnvio.addEventListener('shown.bs.modal', function () {
    
    });

    var modalAgendamentoEdit = document.getElementById('modalAgendamentoEdit');
    
    modalAgendamentoEdit.addEventListener('shown.bs.modal', function () {
    
    });
    function displayMessage(message) {
        toastr.success(message, 'Event');            
    }

    function salvarAgendamentoCliente(){
        console.log("salvarAgendamento");
        var urlAgendamento= SITEURL+"/api/agendamentos";
        var urlPreco= SITEURL+"/api/precos";
        // console.log(url);
        var visitante = {{ Auth::user()->id }};
        var responsavel = 1;
        var quantidadePessoas = $("#quantidadePessoas").val();
        var pacote = $("#pacote").val();
        var preco = $("#precoCliente").val();
        var descricao = $("#descricao").val();
        var comentario = "";
        var dadosAgendamento = {};
        var dadosPreco = {};

        var visitanteDados = usuariosGlobal.find(usuario => usuario.id == visitante);
        var responsavelDados = usuariosGlobal.find(usuario => usuario.id == responsavel);
        var dataInicioFormatada = $("#dataInicio").html();
        var dataFimFormatada = $("#dataFim").html();

        
        console.log(visitante);
        console.log(responsavel);
        console.log(quantidadePessoas);
        console.log(pacote);
        console.log(dataInicial);
        console.log(dataFinal);
        console.log(preco);
        console.log(descricao);
      
        
        if(pacote ==0){
            dadosAgendamento =  {
                                    "data_inicio":dataInicial+" 00:01:01",
                                    "data_fim":dataFinal+" 23:59:59",
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "qtd_pessoas":quantidadePessoas,
                                    "descricao":descricao,
                                    "comentario":comentario,
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
                                    "descricao":descricao,
                                    "comentario":comentario,
                                    "status":1
                                };
        }

        $.ajax({headers: {}, data:dadosAgendamento, method: "POST", url: urlAgendamento})
        .done(function (dados) {
            console.log("salvando agendamento");
            console.log(dados.id);

            //inicio envio email cliente
            var urlEmail= SITEURL+"/api/enviarEmail";
            $("#nomeUsuario").html(visitanteDados.name);
            $('#modalEnvio').modal('show');
            // console.log(url);
            var destinatario = "serradobene@gmail.com";
            var assunto = "Cadastro de Pré Agendamento - "+visitanteDados.name;
            if(pacote ==0){
                var texto = "O cliente "+visitanteDados.name+" criou um Pré-Agendamento na data de "+dataInicioFormatada+" até "+dataFimFormatada+", para "+quantidadePessoas+" pessoas.";
            }else{
                var texto = "O cliente "+visitanteDados.name+" criou um Pré-Agendamento na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
            }
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {

            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});


            var destinatario = visitanteDados.email;
            var assunto = "Serra do Bené - Cadastro de Pré Agendamento - "+visitanteDados.name;
            if(pacote ==0){
                var texto = "O cliente "+visitanteDados.name+" criou um Pré-Agendamento na data de "+dataInicioFormatada+" até "+dataFimFormatada+", para "+quantidadePessoas+" pessoas.";
            }else{
                var texto = "O cliente "+visitanteDados.name+" criou um Pré-Agendamento na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
            }
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                $('#modalEnvio').modal('hide');
                alert("Email enviado com sucesso para o cliente!");
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});
            //fim envio email cliente

            if(preco != ""){
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
                    alert("Problema no salvamento do preço do agendamento!");
                    $('#modalAgendamento').modal('hide');
                    $("#visitante").val("");
                    $("#responsavel").val("");
                    $("#quantidadePessoas").val("");
                    $("#pacote").val("");
                    $("#dataInicio").html("");
                    $("#dataFim").html("") 
                    $("#preco").val("");
                    $("#descricao").val("");
                    classAgendamentos.init();
                })
                .always(function() {});
            }
            console.log(dados);
            alert("Agendamento criado com sucesso!");
            $('#modalAgendamento').modal('hide');
            $("#visitante").val("");
            $("#responsavel").val("");
            $("#quantidadePessoas").val("");
            $("#pacote").val("");
            $("#dataInicio").html("");
            $("#dataFim").html("") 
            $("#preco").val("");
            $("#descricao").val("");
            classAgendamentos.init();
        })
        .fail(function () {
            //console.log("Requisição com falha. ");
            alert("Problema no salvamento do agendamento!");
            $('#modalAgendamento').modal('hide');
            $("#visitante").val("");
            $("#responsavel").val("");
            $("#quantidadePessoas").val("");
            $("#pacote").val("");
            $("#dataInicio").html("");
            $("#dataFim").html("") 
            $("#preco").val("");
            $("#descricao").val("");
            classAgendamentos.init();
        })
        .always(function() {});

 
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
        var comentario = $("#comentario").val();
        var descricao = $("#descricao").val();
        var dadosAgendamento = {};
        var dadosPreco = {};
        var visitanteDados = usuariosGlobal.find(usuario => usuario.id == visitante);
        var responsavelDados = usuariosGlobal.find(usuario => usuario.id == responsavel);
        var dataInicioFormatada = $("#dataInicio").html();
        var dataFimFormatada = $("#dataFim").html();

        
        console.log(visitante);
        console.log(responsavel);
        console.log(quantidadePessoas);
        console.log(pacote);
        console.log(dataInicial);
        console.log(dataFinal);
        console.log(preco);
        console.log(comentario);
        console.log(descricao);
      
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
                                    "descricao":descricao,
                                    "comentario":comentario,
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
                                    "descricao":descricao,
                                    "comentario":comentario,
                                    "status":1
                                };
        }

        $.ajax({headers: {}, data:dadosAgendamento, method: "POST", url: urlAgendamento})
        .done(function (dados) {
            console.log("salvando agendamento");
            console.log(dados.id);

            //inicio envio de email salvamento responsavel
            var urlEmail= SITEURL+"/api/enviarEmail";
            $("#nomeUsuario").html(visitanteDados.name);
            $('#modalEnvio').modal('show');
            // console.log(url);
            var destinatario = "serradobene@gmail.com";
            var assunto = "Cadastro de Pré Agendamento - "+visitanteDados.name;
            var texto = "O responsável "+responsavelDados.name+" criou um Pré-Agendamento para o cliente "+visitanteDados.name+" na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
              
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});


            var destinatario = visitanteDados.email;
            var assunto = "Serra do Bené - Cadastro de Pré Agendamento - "+visitanteDados.name;
            var texto = "O responsável "+responsavelDados.name+" criou um Pré-Agendamento para o cliente "+visitanteDados.name+" na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                $('#modalEnvio').modal('hide');
                alert("Email enviado com sucesso para o cliente!");
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});
            //fim envio de email salvamento responsavel

            dadosPreco =  {
                        "id_agendamento": dados.id,
                        "valor": preco.replaceAll(".","").replace(",","."),
                        "valido": 1
                    };

         
            $.ajax({headers: {}, data:dadosPreco, method: "POST", url: urlPreco})
            .done(function (dados) {
                console.log(dados);
                alert("Agendamento criado com sucesso!");
                $('#modalAgendamento').modal('hide');
                $("#visitante").val("");
                $("#responsavel").val("");
                $("#quantidadePessoas").val("");
                $("#pacote").val("");
                $("#dataInicio").html("");
                $("#dataFim").html("");
                $("#comentario").val("");
                $("#descricao").val("");
                $("#preco").val("");
                classAgendamentos.init();
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no salvamento do preço!");
                $('#modalAgendamento').modal('hide');
                $("#visitante").val("");
                $("#responsavel").val("");
                $("#quantidadePessoas").val("");
                $("#pacote").val("");
                $("#dataInicio").html("");
                $("#dataFim").html("");
                $("#comentario").val("");
                $("#descricao").val("");
                $("#preco").val("");
            })
            .always(function() {});

            })
        .fail(function () {
            //console.log("Requisição com falha. ");
            alert("Problema no salvamento do agendamento!");
            $('#modalAgendamento').modal('hide');
            $("#visitante").val("");
            $("#responsavel").val("");
            $("#quantidadePessoas").val("");
            $("#pacote").val("");
            $("#dataInicio").html("");
            $("#dataFim").html("");
            $("#comentario").val("");
            $("#descricao").val("");
            $("#preco").val("");
        })
        .always(function() {});
 
    }

    function editarAgendamento(){
        console.log("editarAgendamento");
        var idAgendamento = $("#idAgendamentoEdit").val();
        var status = $("#statusEdit").val();
        var visitante = $("#visitanteEdit").val();
        var responsavel = $("#responsavelEdit").val();
        var quantidadePessoas = $("#quantidadePessoasEdit").val();
        var pacote = $("#pacoteEdit").val();
        var preco = $("#precoEdit").val();
        var comentario = $("#comentarioEdit").val();
        var descricao = $("#descricaoEdit").val();
        var dadosAgendamento = {};
        var dadosPreco = {};
        var urlAgendamento= SITEURL+"/api/agendamentos/"+idAgendamento;
        var urlPreco= SITEURL+"/api/precos";

        var visitanteDados = usuariosGlobal.find(usuario => usuario.id == visitante);
        var responsavelDados = usuariosGlobal.find(usuario => usuario.id == responsavel);
        var dataInicioFormatada = $("#dataInicioEdit").html();
        var dataFimFormatada = $("#dataFimEdit").html();
        // console.log(url);

        console.log(idAgendamento);
        console.log(status);
        console.log(visitante);
        console.log(responsavel);
        console.log(quantidadePessoas);
        console.log(pacote);
        console.log(dataInicial);
        console.log(dataFinal);
        console.log(preco);
        console.log(comentario);
        console.log(descricao);
      
        if(preco == ""){
            alert("Preço do Agendamento é um campo abrigatório");
            $("#preco").focus();
            return("Erro: Preço do Agendamento Obrigatório");
        }
        
        if(pacote ==0){
            dadosAgendamento =  {
                                    "data_inicio":dataInicial,
                                    "data_fim":dataFinal,
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "id_pacote":'',
                                    "qtd_pessoas":quantidadePessoas,
                                    "descricao":descricao,
                                    "comentario":comentario,
                                    "status":status
                                };
        }else{
            dadosAgendamento =  {
                                    "data_inicio":dataInicial,
                                    "data_fim":dataFinal,
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "id_pacote":pacote,
                                    "qtd_pessoas":quantidadePessoas,
                                    "descricao":descricao,
                                    "comentario":comentario,
                                    "status":status
                                };
        }

        $.ajax({headers: {}, data:dadosAgendamento, method: "PUT", url: urlAgendamento})
        .done(function (dados) {
            console.log("editando agendamento");
            console.log(dados.id);
            console.log(idAgendamento);


            //inicio envio email edicao
            var urlEmail= SITEURL+"/api/enviarEmail";
            // console.log(url);
            $("#nomeUsuario").html(visitanteDados.name);
            $('#modalEnvio').modal('show');
            var destinatario = "serradobene@gmail.com";
            var assunto = "Alteração no Agendamento - "+visitanteDados.name;
            var texto = "O responsável "+responsavelDados.name+" realizou uma alteração no agendamento para o cliente "+visitanteDados.name+" na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
              
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});

            var destinatario = visitanteDados.email;
            var assunto = "Serra do Bené - Alteração Agendamento - "+visitanteDados.name;
            var texto = "O responsável "+responsavelDados.name+" realizou uma alteração no agendamento para o cliente "+visitanteDados.name+" na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                $('#modalEnvio').modal('hide');
                alert("Email enviado com sucesso para o cliente!");
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});
            //fim envio email edicao

            //buscando preco anterior
            console.log(precosGlobal);
            var precoAnterior = precosGlobal.find(preco => preco.id_agendamento == idAgendamento);
           
            if(precoAnterior !== undefined){
                // editando preco anterior
                $.ajax({headers: {}, data:{"valido": 0}, method: "PUT", url: urlPreco+"/"+precoAnterior.id})
                .done(function () {
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                })
                .always(function() {});
                // fim editando preco anterior
            }

            //adicionando novo preco
            dadosPreco =  {
                        "id_agendamento": dados.id,
                        "valor": preco.replaceAll(".","").replace(",","."),
                        "valido": 1
                    };
            $.ajax({headers: {}, data:dadosPreco, method: "POST", url: urlPreco})
            .done(function () {
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
            //fim adicionando novo preco

            alert("Agendamento alterado com sucesso!");
            $('#modalAgendamentoEdit').modal('hide');
            $("#idAgendamentoEdit").val(0);
            $("#statusEdit").val(1);
            $("#visitanteEdit").val("");
            $("#responsavelEdit").val("");
            $("#quantidadePessoasEdit").val("");
            $("#pacoteEdit").val("");
            $("#precoEdit").val("");
            $("#comentarioEdit").val("");
            $("#descricaoEdit").val("");
            classAgendamentos.init();
        })    
        .fail(function () {
            alert("Não foi possível alterar o agendamento!");
            $('#modalAgendamentoEdit').modal('hide');
            $("#idAgendamentoEdit").val(0);
            $("#statusEdit").val(1);
            $("#visitanteEdit").val("");
            $("#responsavelEdit").val("");
            $("#quantidadePessoasEdit").val("");
            $("#pacoteEdit").val("");
            $("#precoEdit").val("");
            $("#comentarioEdit").val("");
            $("#descricaoEdit").val("");
            //console.log("Requisição com falha. ");
        })
        .always(function() {});

 
    }

    function editarAgendamentoCliente(){
        console.log("editarAgendamentoCliente");
        var idAgendamento = $("#idAgendamentoEdit").val();
        var visitante = {{ Auth::user()->id }};
        var responsavel = 1;
        var quantidadePessoas = $("#quantidadePessoasEdit").val();
        var pacote = $("#pacoteEdit").val();
        var preco = $("#precoEditCliente").val();
        var descricao = $("#descricaoEdit").val();
        var dadosAgendamento = {};
        var dadosPreco = {};
        var urlAgendamento= SITEURL+"/api/agendamentos/"+idAgendamento;
        var urlPreco= SITEURL+"/api/precos";
        // console.log(url);
        var visitanteDados = usuariosGlobal.find(usuario => usuario.id == visitante);
        var responsavelDados = usuariosGlobal.find(usuario => usuario.id == responsavel);
        var dataInicioFormatada = $("#dataInicioEdit").html();
        var dataFimFormatada = $("#dataFimEdit").html();

        console.log(idAgendamento);
        console.log(visitante);
        console.log(responsavel);
        console.log(quantidadePessoas);
        console.log(pacote);
        console.log(dataInicial);
        console.log(dataFinal);
        console.log(preco);
        console.log(descricao);
        
        if(pacote ==0){
            dadosAgendamento =  {
                                    "data_inicio":dataInicial,
                                    "data_fim":dataFinal,
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "id_pacote":'',
                                    "qtd_pessoas":quantidadePessoas,
                                    "descricao":descricao,
                                    "status":1
                                };
        }else{
            dadosAgendamento =  {
                                    "data_inicio":dataInicial,
                                    "data_fim":dataFinal,
                                    "id_visitante":visitante,
                                    "id_responsavel":responsavel,
                                    "id_pacote":pacote,
                                    "qtd_pessoas":quantidadePessoas,
                                    "descricao":descricao,
                                    "status":1
                                };
        }

        $.ajax({headers: {}, data:dadosAgendamento, method: "PUT", url: urlAgendamento})
        .done(function (dados) {
            console.log("editando agendamento");
            console.log(dados.id);
            console.log(idAgendamento);

            //inicio envio email editar cliente
            var urlEmail= SITEURL+"/api/enviarEmail";
            $("#nomeUsuario").html(visitanteDados.name);
            $('#modalEnvio').modal('show');
            // console.log(url);
            var destinatario = "serradobene@gmail.com";
            var assunto = "Alteração no Agendamento - "+visitanteDados.name;
            var texto = "O cliente "+visitanteDados.name+" alterou o agendamento na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
              
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});

            var destinatario = visitanteDados.email;
            var assunto = "Serra do Bené - Alteração Agendamento - "+visitanteDados.name;
            var texto = "O cliente "+visitanteDados.name+" alterou o agendamento na data de "+dataInicioFormatada+" até "+dataFimFormatada+", no valor de R$ "+preco+" para "+quantidadePessoas+" pessoas.";
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                $('#modalEnvio').modal('hide');
                alert("Email enviado com sucesso para o cliente!");
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
            })
            .always(function() {});
            //fim envio email editar cliente

            if(preco != ""){
                //buscando preco anterior
                console.log(precosGlobal);
                var precoAnterior = precosGlobal.find(preco => preco.id_agendamento == idAgendamento);
                console.log(precoAnterior);
                if(precoAnterior !== undefined){
                    // editando preco anterior
                    $.ajax({headers: {}, data:{"valido": 0}, method: "PUT", url: urlPreco+"/"+precoAnterior.id})
                    .done(function () {
                    })
                    .fail(function () {
                        //console.log("Requisição com falha. ");
                    })
                    .always(function() {});
                    // fim editando preco anterior
                }

                //adicionando novo preco
                dadosPreco =  {
                            "id_agendamento": dados.id,
                            "valor": preco.replaceAll(".","").replace(",","."),
                            "valido": 1
                        };
                $.ajax({headers: {}, data:dadosPreco, method: "POST", url: urlPreco})
                .done(function () {
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                })
                .always(function() {});
                //fim adicionando novo preco
            }else{
                //buscando preco anterior
                console.log(precosGlobal);
                var precoAnterior = precosGlobal.find(preco => preco.id_agendamento == idAgendamento);
                console.log(precoAnterior);
                if(precoAnterior !== undefined){
                    // editando preco anterior
                    $.ajax({headers: {}, data:{"valido": 0}, method: "PUT", url: urlPreco+"/"+precoAnterior.id})
                    .done(function () {
                    })
                    .fail(function () {
                        //console.log("Requisição com falha. ");
                    })
                    .always(function() {});
                    // fim editando preco anterior
                }
            }

            alert("Agendamento alterado com sucesso!");
            $('#modalAgendamentoEdit').modal('hide');
            $("#idAgendamentoEdit").val(0);
            $("#statusEdit").val(1);
            $("#visitanteEdit").val("");
            $("#responsavelEdit").val("");
            $("#quantidadePessoasEdit").val("");
            $("#pacoteEdit").val("");
            $("#precoEdit").val("");
            $("#descricaoEdit").val("");
            classAgendamentos.init();
        })    
        .fail(function () {
            alert("Não foi possível alterar o agendamento!");
            $('#modalAgendamentoEdit').modal('hide');
            $("#idAgendamentoEdit").val(0);
            $("#statusEdit").val(1);
            $("#visitanteEdit").val("");
            $("#responsavelEdit").val("");
            $("#quantidadePessoasEdit").val("");
            $("#pacoteEdit").val("");
            $("#precoEdit").val("");
            $("#descricaoEdit").val("");
            //console.log("Requisição com falha. ");
        })
        .always(function() {});

 
    }

</script>
