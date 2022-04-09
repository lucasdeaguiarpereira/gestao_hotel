
<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:75px;padding-bottom:150px;">
        <div class="logoCentral" style="text-align:-webkit-center;align-self:center !important;">
            <img style="width:300px;height:200px;border-radius: 15px !important;" src='{{asset("assets\logo.png")}}'>
        </div>
        <div style="color:white;margin-top:30px;">
            <h3>Agendamentos</h3>
                <h5>Veja os pedidos e agendamentos futuros</h5>
        </div>
    </div>
    <div class="ms-5 me-5" style="margin-top:-120px;margin-bottom:30px;">
        <div>
            @if (Auth::user()->id_tipo_usuario == 1)
            <div class="row">
                <div class="col-12">
                    <a  href="/dashboard" style="color:#339FA3;display:inline-flex;" class="btn btn-light rounded-pill mb-3 pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Novo Agendamento
                    </a>
                </div>
            </div>
            @endif  
            <div id="loading">
               Carregando ...
            </div>
            <div id="agendamentosList">
                
            </div>
            
        </div>
    </div>
</x-app-layout>

<div class="modal fade" id="modalEnvio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Enviando e-mail para <span id="nomeUsuario"></span>...</h5>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";
    var agendamentosGlobal = "";
    var pacotesGlobal = "";
    var usuariosGlobal = "";
    var precosGlobal = "";



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
                var texto = "O agendamento do dia <b>"+moment(agendamento.data_inicio).format('DD/MM/YYYY')+" até "+moment(agendamento.data_fim).format('DD/MM/YYYY')+"</b> foi <b>confirmado</b> para o cliente com os seguintes dados:<br><br>"+
                            "<b>Nome</b>: "+visitante.name+"<br>"+          
                            "<b>Telefone</b>: "+visitante.telefone+"<br>"+
                            "<b>Quantidade de visitantes</b>: "+agendamento.qtd_pessoas+"<br>"+
                            "<b>Preço</b>: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>"+
                            "<b>Comentário</b>: "+agendamento.descricao+"<br>"+
                            "<b>Observação</b>: "+agendamento.comentario;
        
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
                    setTimeout(() => {
                        alert("Problema no envio do email!");
                        $('#modalEnvio').modal('hide');
                    }, 5000);
                })
                .always(function() {});


                var destinatario = visitante.email;
                var texto = "Olá "+visitante.name+", seu agendamento na Serra do Bené foi <b>confirmado</b>, segue as informações detalhadas para conferir:<br><br>"+
                            "<b>Início:</b> "+moment(agendamento.data_inicio).format('DD/MM/YYYY')+"<br>"+
                            "<b>Término:</b> "+moment(agendamento.data_fim).format('DD/MM/YYYY')+"<br>"+
                            "<b>Quantidade de visitantes:</b> "+agendamento.qtd_pessoas+"<br>"+
                            "<b>Preço:</b> R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>"+
                            "<b>Comentário</b>: "+agendamento.descricao+"<br>"+
                            "<b>Observação</b>: "+agendamento.comentario+"<br><br>"+
                            "Desde já agradecemos sua preferência pela Serra do Bené!";
        
        
                var dadosEmail =  {
                                    "destinatario":destinatario,
                                    "assunto":assunto,
                                    "texto":texto
                                };
            

                $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
                .done(function () {
                    setTimeout(() => {
                        alert("Email enviado com sucesso para o cliente!");
                        $('#modalEnvio').modal('hide');
                    }, 5000);
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                    setTimeout(() => {
                        alert("Problema no envio do email!");
                        $('#modalEnvio').modal('hide');
                    }, 5000);
                })
                .always(function() {});
                //fim envio de email salvamento responsavel
                
                var confirmacao = confirm("Orçamento Aprovado com sucesso!");
                if(confirmacao){
                    $("#agendamentosList").hide();
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
            var assunto = "Serra do Bené - Cancelamento Agendamento - "+visitante.name;
            var texto = "O agendamento do dia <b>"+moment(agendamento.data_inicio).format('DD/MM/YYYY')+" até "+moment(agendamento.data_fim).format('DD/MM/YYYY')+"</b> foi <b>cancelado</b> para o cliente com os seguintes dados:<br><br>"+
                        "<b>Nome</b>: "+visitante.name+"<br>"+          
                        "<b>Telefone</b>: "+visitante.telefone+"<br>"+
                        "<b>Quantidade de visitantes</b>: "+agendamento.qtd_pessoas+"<br>";
                        if(preco == undefined){
                            texto +="<b>Preço</b>: Não negociado.<br>";
                        }else{
                            texto +="<b>Preço</b>: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>";
                        }
                texto += "<b>Comentário</b>: "+agendamento.descricao+"<br>"+
                         "<b>Observação</b>: "+agendamento.comentario;
    
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
                setTimeout(() => {
                    alert("Problema no envio do email!");
                    $('#modalEnvio').modal('hide');
                }, 5000);
            })
            .always(function() {});


            var destinatario = visitante.email;
            var texto = "Olá "+visitante.name+", seu agendamento na Serra do Bené foi <b>cancelado</b>, segue as informações detalhadas para conferir:<br><br>"+
                        "<b>Início:</b> "+moment(agendamento.data_inicio).format('DD/MM/YYYY')+"<br>"+
                        "<b>Término:</b> "+moment(agendamento.data_fim).format('DD/MM/YYYY')+"<br>"+
                        "<b>Quantidade de visitantes</b>: "+agendamento.qtd_pessoas+"<br>";
                        if(preco == undefined){
                            texto +="<b>Preço</b>: Não negociado.<br>";
                        }else{
                            texto +="<b>Preço</b>: R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(preco.valor)+"<br>";
                        }
                texto += "<b>Comentário</b>: "+agendamento.descricao+"<br>"+
                         "<b>Observação</b>: "+agendamento.comentario+"<br><br>"+
                        "Esperamos contar com sua visita futura na Serra do Bené!";
        
    
    
            var dadosEmail =  {
                                "destinatario":destinatario,
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                setTimeout(() => {
                    alert("Email enviado com sucesso para o cliente!");
                    $('#modalEnvio').modal('hide');
                }, 5000);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                setTimeout(() => {
                    alert("Problema no envio do email!");
                    $('#modalEnvio').modal('hide');
                }, 5000);
            })
            .always(function() {});
            //fim envio de email salvamento responsavel
            var confirmacao = confirm("Orçamento Cancelado com sucesso!");
            if(confirmacao){
                $("#agendamentosList").hide();
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

        var formatData = function(data){
            var dataFormatada = new Date(data);
            return(dataFormatada.toLocaleString());
        }

        var gerarUsuarios = function(){
            var url = SITEURL+"/api/users";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                console.log(dados);
                usuariosGlobal = dados;
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        var gerarPacotes = function(){
            var url = SITEURL+"/api/pacotes";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                console.log(dados);
                pacotesGlobal = dados;
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        var gerarPrecos = function(){
            var url = SITEURL+"/api/precos";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                console.log(dados);
                precosGlobal = dados;
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }
        
        var geraAgendamentosList = function (dados){
            agendamentosGlobal = dados;
            var html = "";
            var contador = 1;
            var nomePacote = "";
            var nomeCliente = "";
            var telefoneCliente ="";
            var precoValido = "";
            var qtdDias = "";
            var statusNome = "";
            var botoes = "";
            var fundo = "white";

            // console.log(dados.length);
            if(dados.length>0){
                @if (Auth::user()->id_tipo_usuario == 1)
                dados.forEach(function(agendamento){

                    nomePacote = "";
                    nomeCliente = "";
                    telefoneCliente ="";
                    precoValido = "";
                    qtdDias = "";
                    statusNome = "";
                    botoes = "";
                    fundo = "white";

                    pacotesGlobal.forEach(function(pacote){
                        if(pacote.id == agendamento.id_pacote){
                            nomePacote = pacote.nome_pacote;
                            qtdDias = pacote.qtd_dias;
                        }
                    });

                    usuariosGlobal.forEach(function(usuario){
                        if(usuario.id == agendamento.id_visitante){
                            nomeCliente = usuario.name;
                            telefoneCliente = usuario.telefone;
                        }
                    });

                    precosGlobal.forEach(function(preco){
                        if(preco.id_agendamento == agendamento.id){
                            precoValido = preco.valor;
                        }
                    });
                    console.log(nomeCliente);


                    if(agendamento.status == 1){
                        statusNome = 'Aguardando aprovação';
                        fundo = "#ebedd0";
                        botoes =   `@if (Auth::user()->id_tipo_usuario == 1)
                                    <button type="button" onclick="confirmarAgendamento(`+agendamento.id+`)" style="margin-bottom:10px;color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                        Confirmar agendamento
                                    </button>
                                    <button type="button" onclick="cancelarAgendamento(`+agendamento.id+`)" style="color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#f75959;display:inline-flex;" class="btn rounded-pill">
                                        Cancelar agendamento
                                    </button>
                                    @endif`;
                    }else if(agendamento.status == 2){
                        statusNome = 'Aprovado';
                        fundo = "#d0efdd";
                        botoes =   `@if (Auth::user()->id_tipo_usuario == 1)
                                    <button type="button" onclick="cancelarAgendamento(`+agendamento.id+`)" style="color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#f75959;display:inline-flex;" class="btn rounded-pill">
                                        Cancelar agendamento
                                    </button>
                                    @endif`;
                    }else if(agendamento.status == 3){
                        statusNome = 'Cancelado';
                        fundo = "#edd0d0";
                        botoes =   `@if (Auth::user()->id_tipo_usuario == 1)
                                    <button type="button" onclick="confirmarAgendamento(`+agendamento.id+`)" style="margin-bottom:10px;color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                        Confirmar agendamento
                                    </button>
                                    @endif`;
                    }
                    html += `<div class="row mt-3">
                                <div class="row justify-content-md-center">
                                    <div class="col-12">
                                        <div class="overflow-hidden shadow-xl sm:rounded-lg" style="background-color:`+fundo+`;border-radius:20px;">
                                            <div class="row mt-5 mb-5 ms-3 me-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 style="font-weight:bold;">`+nomeCliente+`</h5>
                                                    </div>    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <!--<div class="mt-2" style="display:flex;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-seam me-2" viewBox="0 0 16 16">
                                                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                                            </svg>
                                                            Pacote: `+(nomePacote == "" ? "-" : nomePacote)+`
                                                        </div>-->
                                                        `+
                                                        `<div class="mt-2" style="display:flex;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-people me-2" viewBox="0 0 16 16">
                                                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                                            </svg>
                                                            Pessoas: `+agendamento.qtd_pessoas+`
                                                        </div>`
                                                        // (nomePacote == "" ? "" :
                                                        // `<div class="mt-2" style="display:flex;"> 
                                                        //     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-date me-2" viewBox="0 0 16 16">
                                                        //         <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                                        //         <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                        //     </svg>
                                                        //     `+qtdDias+` dias no pacote
                                                        // </div>`
                                                        // )
                                                        +`<div class="mt-2" style="display:flex;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-date me-2" viewBox="0 0 16 16">
                                                                <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                            </svg>
                                                            De: `+formatData(agendamento.data_inicio).split(" ")[0]+`-`+formatData(agendamento.data_fim).split(" ")[0]+`
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="mt-2" style="display:flex;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chat-quote me-2" viewBox="0 0 16 16">
                                                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                                                <path d="M7.066 6.76A1.665 1.665 0 0 0 4 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
                                                            </svg>
                                                            Contato feito em: `+formatData(agendamento.updated_at).split(" ")[0]+`
                                                        </div>
                                                        <div class="mt-2" style="display:flex;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clock me-2" viewBox="0 0 16 16">
                                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                                            </svg>
                                                            Status do agendamento:<br>`+statusNome+`
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 alinhaFim">
                                                        <h4 style="font-weight:bold;color:#71BF94;">
                                                            R$ `+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(precoValido)+`
                                                        </h4>
                                                        <a href="https://api.whatsapp.com/send?phone=55`+telefoneCliente+`&text=Gostaria de entrar em contato para ..." target="_blank" style="margin-bottom:10px;color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                                            Entrar em contato
                                                        </a>
                                                        `+botoes+`
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    // if(contador%2 == 0){
                    //     html += '</div>';
                    // }
                    contador++;
                });
                @endif
                @if (Auth::user()->id_tipo_usuario == 2)
                dados.forEach(function(agendamento){
                    if(agendamento.id_visitante == {{ Auth::user()->id }}){
                        nomePacote = "";
                        nomeCliente = "";
                        telefoneCliente ="";
                        precoValido = "";
                        qtdDias = "";
                        statusNome = "";
                        botoes = "";
                        fundo = "white";

                        pacotesGlobal.forEach(function(pacote){
                            if(pacote.id == agendamento.id_pacote){
                                nomePacote = pacote.nome_pacote;
                                qtdDias = pacote.qtd_dias;
                            }
                        });

                        usuariosGlobal.forEach(function(usuario){
                            if(usuario.id == agendamento.id_visitante){
                                nomeCliente = usuario.name;
                                telefoneCliente = usuario.telefone;
                            }
                        });

                        precosGlobal.forEach(function(preco){
                            if(preco.id_agendamento == agendamento.id){
                                precoValido = preco.valor;
                            }
                        });
                        console.log(nomeCliente);


                        if(agendamento.status == 1){
                            statusNome = 'Aguardando aprovação';
                            fundo = "#ebedd0";
                            botoes =   `@if (Auth::user()->id_tipo_usuario == 1)
                                        <button type="button" onclick="confirmarAgendamento(`+agendamento.id+`)" style="margin-bottom:10px;color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                            Confirmar agendamento
                                        </button>
                                        <button type="button" onclick="cancelarAgendamento(`+agendamento.id+`)" style="color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#f75959;display:inline-flex;" class="btn rounded-pill">
                                            Cancelar agendamento
                                        </button>
                                        @endif`;
                        }else if(agendamento.status == 2){
                            statusNome = 'Aprovado';
                            fundo = "#d0efdd";
                            botoes =   `@if (Auth::user()->id_tipo_usuario == 1)
                                        <button type="button" onclick="cancelarAgendamento(`+agendamento.id+`)" style="color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#f75959;display:inline-flex;" class="btn rounded-pill">
                                            Cancelar agendamento
                                        </button>
                                        @endif`;
                        }else if(agendamento.status == 3){
                            statusNome = 'Cancelado';
                            fundo = "#edd0d0";
                            botoes =   `@if (Auth::user()->id_tipo_usuario == 1)
                                        <button type="button" onclick="confirmarAgendamento(`+agendamento.id+`)" style="margin-bottom:10px;color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                            Confirmar agendamento
                                        </button>
                                        @endif`;
                        }
                        html += `<div class="row mt-3">
                                    <div class="row justify-content-md-center">
                                        <div class="col-12">
                                            <div class="overflow-hidden shadow-xl sm:rounded-lg" style="background-color:`+fundo+`;border-radius:20px;">
                                                <div class="row mt-5 mb-5 ms-3 me-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 style="font-weight:bold;">`+nomeCliente+`</h5>
                                                        </div>    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-12">
                                                            <!--<div class="mt-2" style="display:flex;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-seam me-2" viewBox="0 0 16 16">
                                                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                                                </svg>
                                                                Pacote: `+(nomePacote == "" ? "-" : nomePacote)+`
                                                            </div>-->
                                                            `+
                                                            `<div class="mt-2" style="display:flex;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-people me-2" viewBox="0 0 16 16">
                                                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                                                </svg>
                                                                Pessoas: `+agendamento.qtd_pessoas+`
                                                            </div>` 
                                                            // (nomePacote == "" ? "" :
                                                            // `<div class="mt-2" style="display:flex;"> 
                                                            //     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-date me-2" viewBox="0 0 16 16">
                                                            //         <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                                            //         <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                            //     </svg>
                                                            //     `+qtdDias+` dias no pacote
                                                            // </div>`
                                                            // )
                                                            +`<div class="mt-2" style="display:flex;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-date me-2" viewBox="0 0 16 16">
                                                                    <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                                </svg>
                                                                De: `+formatData(agendamento.data_inicio).split(" ")[0]+`-`+formatData(agendamento.data_fim).split(" ")[0]+`
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <div class="mt-2" style="display:flex;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chat-quote me-2" viewBox="0 0 16 16">
                                                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                                                    <path d="M7.066 6.76A1.665 1.665 0 0 0 4 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
                                                                </svg>
                                                                Contato feito em: `+formatData(agendamento.updated_at).split(" ")[0]+`
                                                            </div>
                                                            <div class="mt-2" style="display:flex;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clock me-2" viewBox="0 0 16 16">
                                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                                                </svg>
                                                                Status do agendamento:<br>`+statusNome+`
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 alinhaFim">
                                                            <h4 style="font-weight:bold;color:#71BF94;">
                                                                R$ `+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(precoValido)+`
                                                            </h4>
                                                            <a href="https://api.whatsapp.com/send?phone=5503196524030&text=Gostaria de entrar em contato para ..." target="_blank" style="margin-bottom:10px;color:white;width:80%;display:flex;align-items:center;justify-content:center;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                                                Entrar em contato
                                                            </a>
                                                            `+botoes+`
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        // if(contador%2 == 0){
                        //     html += '</div>';
                        // }
                        contador++;
                    }
                });
                @endif
            }
            // console.log(html);
            $("#agendamentosList").html(html);
            $("#loading").hide();
            $("#agendamentosList").show();
            console.log(dados);
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/agendamentos";
            var urlPreco = "";
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                setTimeout(() => {
                    geraAgendamentosList(dados);
                }, 500);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        return {
            //main function to initiate the module
            init: function () {
                gerarUsuarios();
                gerarPrecos();
                gerarPacotes();
                setTimeout(() => {
                    gerarDados();
                }, 500);
                
            }
        };

    }();

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });        
        classAgendamentos.init();

    });

</script>
