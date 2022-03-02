
<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:13%;padding-bottom:17%;">
        <div style="color:white;">
            <h3>Pacotes</h3>
            @if (Auth::user()->id_tipo_usuario == 1)
                <h5>Veja todos os pacotes registrados no sistema.</h5>
            @endif
            @if (Auth::user()->id_tipo_usuario == 2)
                <h5>Confira os pacotes promocionais!</h5>
            @endif
        </div>
    </div>
    <div class="ms-5 me-5" style="margin-top:-10%;margin-bottom:5%;">
        <div>
            @if (Auth::user()->id_tipo_usuario == 1)
            <div class="row">
                <div class="col-12">
                    <button type="button" onclick="modalNovoPacote()" style="color:#339FA3;display:inline-flex;" class="btn btn-light rounded-pill mb-3 pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Novo Pacote
                    </button>
                </div>
            </div>
            @endif  
            <div id="loading">
               Carregando ...
            </div>
            <div id="pacotesList">
               
            </div>
            
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Pacotes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                <div class="form-group">
                    <label for="nome_pacote" class="form-label">Nome</label>
                    <input type="text" id="nome_pacote" name="nome_pacote" class="rounded-3 form-control" placeholder="Pacote Natalino">
                </div>
                <div class="form-group">
                    <label for="preco_padrao" class="form-label mt-2">Preço</label>
                    <input type="text" id="preco_padrao" name="preco_padrao" class="rounded-3 form-control" />
                </div>
                <div class="form-group">
                    <label for="qtd_dias" class="form-label mt-2">Quantidade de Dias</label>
                    <input type="number" min="0" class="rounded-3 form-control" name="qtd_dias" id="qtd_dias" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="desc_pacote" class="form-label mt-2">Descrição</label>
                    <input type="text" id="desc_pacote" name="desc_pacote"  class="rounded-3 form-control"  placeholder="Pacote natalino com aquele preço especial!!!">
                </div>
                <div class="form-group">
                    <label for="data_inicio" class="form-label mt-2">Data Inicio</label>
                    <input type="datetime-local" min="0" class="rounded-3 form-control" name="data_inicio" id="data_inicio" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="data_fim" class="form-label mt-2">Data Fim</label>
                    <input type="datetime-local" min="0" class="rounded-3 form-control" name="data_fim" id="data_fim" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="img" class="form-label mt-2">Imagem</label>
                    <input type="file" accept="image/*" id="img" name="img"  class="rounded-3 form-control">
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="salvarPacote()" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Pacotes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                <div class="form-group hidden">
                    <label for="id_pacote_edit" class="form-label">Id</label>
                    <input type="text" id="id_pacote_edit" name="id_pacote_edit" class="rounded-3 form-control">
                </div>
                <div class="form-group">
                    <label for="nome_pacote_edit" class="form-label">Nome</label>
                    <input type="text" id="nome_pacote_edit" name="nome_pacote_edit" class="rounded-3 form-control" placeholder="Pacote Natalino">
                </div>
                <div class="form-group">
                    <label for="preco_padrao_edit" class="form-label mt-2">Preço</label>
                    <input type="text" id="preco_padrao_edit" name="preco_padrao_edit" class="rounded-3 form-control" />
                </div>
                <div class="form-group">
                    <label for="qtd_dias_edit" class="form-label mt-2">Quantidade de Dias</label>
                    <input type="number" min="0" class="rounded-3 form-control" name="qtd_dias_edit" id="qtd_dias_edit" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="desc_pacote_edit" class="form-label mt-2">Descrição</label>
                    <input type="text" id="desc_pacote_edit" name="desc_pacote_edit"  class="rounded-3 form-control"  placeholder="Pacote natalino com aquele preço especial!!!">
                </div>
                <div class="form-group">
                    <label for="data_inicio_edit" class="form-label mt-2">Data Inicio</label>
                    <input type="datetime-local" min="0" class="rounded-3 form-control" name="data_inicio_edit" id="data_inicio_edit" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="data_fim_edit" class="form-label mt-2">Data Fim</label>
                    <input type="datetime-local" min="0" class="rounded-3 form-control" name="data_fim_edit" id="data_fim_edit" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="img_edit" class="form-label mt-2">Imagem</label>
                    <input type="file" accept="image/*" id="img_edit" name="img_edit"  class="rounded-3 form-control">
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="editarPacote()" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>

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
                @endif
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
                @if (Auth::user()->id_tipo_usuario == 1)
                <div class="row">
                    <div class="col-12 mb-3"> 
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="rounded-3 form-control" name="preco" id="preco" placeholder="10">
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
    var pacotesGlobal = "";

    var classPacotes = function () {

        var formatData = function(data){
            var dataFormatada = new Date(data);
            return(dataFormatada.toLocaleString());
        }
        
        var geraPacotesList = function (dados){
            pacotesGlobal = dados;
            var html = "";
            var contador = 1;
            // console.log(dados.length);
            if(dados.length>0){
                dados.forEach(function(pacote){
                    // if(contador%2 !== 0){
                    //     html += '<div class="row mt-3">';
                    // }
                    html += `<div class="row mt-3">
                                <div class="row justify-content-md-center">
                                <div class="col-lg-8 col-lg-10 col-md-10 col-sm-12">
                                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:20px;">
                                        <div class="row ms-4 me-4 mt-4 mb-4">
                                            <div class="col-6">
                                                <img style="width:100%;height:170px;" class="rounded-3" src='{{asset("assets/`+pacote.img+`")}}'>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12" style="font-weight:bold;font-size:1em;">
                                                        `+pacote.nome_pacote+`
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        Qtd. Dias:
                                                    </div>
                                                    <div class="col-8">
                                                        `+pacote.qtd_dias+`
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        Preço:
                                                    </div>
                                                    <div class="col-8">
                                                        R$`+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(pacote.preco_padrao)+`
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        Data Inicial:
                                                    </div>
                                                    <div class="col-8">
                                                        `+(pacote.data_inicio == null ? 'Indeterminado' : formatData(pacote.data_inicio))+`
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        Data Final:
                                                    </div>
                                                    <div class="col-8">
                                                        `+(pacote.data_fim == null ? 'Indeterminado' : formatData(pacote.data_fim))+`
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    @if (Auth::user()->id_tipo_usuario == 1)
                                                    <div class="col-4">
                                                        <button type="button" onclick="modalEditPacote(`+pacote.id+`)" style="color:white;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" style="padding-top: 3px;" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            </svg>
                                                            Editar
                                                        </button>
                                                    </div>
                                                    <div class="col-8">
                                                        <button type="button" onclick="excluirPacote(`+pacote.id+`)" style="display:inline-flex;" class="btn btn-danger rounded-pill">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"  style="padding-top: 3px;" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg>
                                                            Excluir
                                                        </button>
                                                    </div>
                                                    @endif  
                                                    @if (Auth::user()->id_tipo_usuario == 2)
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-8">
                                                        <button type="button" onclick="comprarPacote(`+pacote.id+`)" style="color:white;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="padding-top: 3px;padding-right: 3px;" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                            </svg>
                                                            Comprar
                                                        </button>
                                                    </div>
                                                    @endif  
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
            }
            // console.log(html);
            $("#pacotesList").html(html);
            $("#loading").hide();
            $("#pacotesList").show();
            console.log(dados);
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/pacotes";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                geraPacotesList(dados);
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });        
        classPacotes.init();

        $("#preco_padrao").mask("#.##0,00", {reverse: true});
        
        $("#preco_padrao_edit").mask("#.##0,00", {reverse: true});

    });

    var myModal = document.getElementById('myModal');
    myModal.addEventListener('shown.bs.modal', function () {
    });

    var myModalEdit = document.getElementById('myModalEdit');
    myModalEdit.addEventListener('shown.bs.modal', function () {
    });

    var modalAgendamento = document.getElementById('modalAgendamento');
    modalAgendamento.addEventListener('shown.bs.modal', function () {
    });
    
    
    function modalNovoPacote(){
        $('#myModal').modal('show');
    }

    function modalEditPacote(idPacote){
        const pacote = pacotesGlobal.find(pacote => pacote.id === idPacote);
        console.log(pacote);
        $("#id_pacote_edit").val(pacote.id);
        $("#nome_pacote_edit").val(pacote.nome_pacote);
        $("#preco_padrao_edit").val(pacote.preco_padrao.replace(".",","));
        $("#qtd_dias_edit").val(pacote.qtd_dias);
        $("#desc_pacote_edit").val(pacote.desc_pacote);
        if(pacote.data_inicio !== null){
            $("#data_inicio_edit").val(pacote.data_inicio.replace(" ","T"));
        }
        if(pacote.data_fim !== null){
            $("#data_fim_edit").val(pacote.data_fim.replace(" ","T"));
        }
        $('#myModalEdit').modal('show');
    }


    function editarPacote(){
        console.log("editarPacote");
        var alertConfirm = confirm("Você deseja editar o pacote?");
		if (alertConfirm == true) {
            var idPacote = $("#id_pacote_edit").val();
            var url= SITEURL+"/api/pacotes/"+idPacote;
            // console.log(url);
            var nomePacote = $("#nome_pacote_edit").val();
            var precoPadrao = $("#preco_padrao_edit").val();
            var qtdDias = $("#qtd_dias_edit").val();
            var descPacote = $("#desc_pacote_edit").val();
            var dataInicio = $("#data_inicio_edit").val();
            var dataFim = $("#data_fim_edit").val();
            var imagem = $("#img_edit")[0].files[0];
            var nomeImagem = "";
            var dadosPacote = {};
            
            if(nomePacote == ""){
                alert("Nome do Pacote é um campo abrigatório");
                $("#nome_pacote").focus();
                return("Erro: Nome Pacote Obrigatório");
            }
            if(precoPadrao == ""){
                alert("Preço do Pacote é um campo abrigatório");
                $("#preco_padrao").focus();
                return("Erro: Preço do Pacote Obrigatório");
            }
            if(qtdDias == ""){
                alert("Quantidade de dias do Pacote é um campo abrigatório");
                $("#qtd_dias").focus();
                return("Erro: Quantidade Dias Pacote Obrigatório");
            }
            if(descPacote == ""){
                alert("Descrição do Pacote é um campo abrigatório");
                $("#desc_pacote").focus();
                return("Erro: DEscrição Pacote Obrigatório");
            }
            if(data_inicio == ""){
                data_inicio = 'NULL';
            }
            if(data_fim == ""){
                data_fim = 'NULL';
            }
            if(imagem == undefined) {
                nomeImagem = "pacote_padrao.png";
            }else{
                nomeImagem = nomePacote+".png";
            }
            // console.log(nomePacote);
            // console.log(precoPadrao);
            // console.log(qtdDias);
            // console.log(descPacote);
            // console.log(dataInicio);
            // console.log(dataFim);
            // console.log(imagem);
            dadosPacote =   {
                                "nome_pacote":nomePacote,
                                "preco_padrao":precoPadrao.replaceAll(".","").replace(",","."),
                                "qtd_dias":qtdDias,
                                "desc_pacote":descPacote,
                                "data_inicio":dataInicio,
                                "data_fim":dataFim,
                                "img":nomeImagem
                            };

            $.ajax({headers: {}, data:dadosPacote, method: "PUT", url: url})
            .done(function (dados) {
                console.log(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});

            // inicio salvamento da imagem
            if(imagem !== undefined) {
                console.log("entrando na parte de imagem");
                // console.log(imagem);
                var urlImagem = SITEURL+"/api/imagemPacote";
                var imagemDados = new FormData();
                imagemDados.append('fileimagem', imagem);
                imagemDados.append('nomeImagem', nomeImagem);
                
                $.ajax({headers: {},data:imagemDados, processData: false,contentType: false, method: "POST", url: urlImagem})
                .done(function (dados) {
                    console.log(dados);
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                })
                .always(function() {});
                //fim salvamento da imagem
            }
            
            alert("Edição realizada com sucesso!");
            $('#myModalEdit').modal('hide');
            $("#nome_pacote_edit").val("");
            $("#preco_padrao_edit").val("");
            $("#qtd_dias_edit").val("");
            $("#desc_pacote_edit").val("");
            $("#data_inicio_edit").val("");
            $("#data_fim_edit").val("");
            $('#img_edit').wrap('<form>').closest('form')[0].reset();
            $('#img_edit').unwrap();   
            classPacotes.init();
        }

    }
    
    function salvarPacote(){
        console.log("salvarPacote");
        var url= SITEURL+"/api/pacotes";
        // console.log(url);
        var nomePacote = $("#nome_pacote").val();
        var precoPadrao = $("#preco_padrao").val();
        var qtdDias = $("#qtd_dias").val();
        var descPacote = $("#desc_pacote").val();
        var dataInicio = $("#data_inicio").val();
        var dataFim = $("#data_fim").val();
        var imagem = $("#img")[0].files[0];
        var nomeImagem = "";
        var dadosPacote = {};
     
        if(nomePacote == ""){
            alert("Nome do Pacote é um campo abrigatório");
            $("#nome_pacote").focus();
            return("Erro: Nome Pacote Obrigatório");
        }
        if(precoPadrao == ""){
            alert("Preço do Pacote é um campo abrigatório");
            $("#preco_padrao").focus();
            return("Erro: Preço do Pacote Obrigatório");
        }
        if(qtdDias == ""){
            alert("Quantidade de dias do Pacote é um campo abrigatório");
            $("#qtd_dias").focus();
            return("Erro: Quantidade Dias Pacote Obrigatório");
        }
        if(descPacote == ""){
            alert("Descrição do Pacote é um campo abrigatório");
            $("#desc_pacote").focus();
            return("Erro: DEscrição Pacote Obrigatório");
        }
        if(data_inicio == ""){
            data_inicio = 'NULL';
        }
        if(data_fim == ""){
            data_fim = 'NULL';
        }
        if(imagem == undefined) {
            nomeImagem = "pacote_padrao.png";
        }else{
            nomeImagem = nomePacote+".png";
        }
        // console.log(nomePacote);
        // console.log(precoPadrao);
        // console.log(qtdDias);
        // console.log(descPacote);
        // console.log(dataInicio);
        // console.log(dataFim);
        // console.log(imagem);
        dadosPacote =   {
                            "nome_pacote":nomePacote,
                            "preco_padrao":precoPadrao.replaceAll(".","").replace(",","."),
                            "qtd_dias":qtdDias,
                            "desc_pacote":descPacote,
                            "data_inicio":dataInicio,
                            "data_fim":dataFim,
                            "img":nomeImagem
                        };

        $.ajax({headers: {}, data:dadosPacote, method: "POST", url: url})
        .done(function (dados) {
            console.log(dados);
        })
        .fail(function () {
            //console.log("Requisição com falha. ");
        })
        .always(function() {});

        // inicio salvamento da imagem
        if(imagem !== undefined) {
            console.log("entrando na parte de imagem");
            // console.log(imagem);
            var urlImagem = SITEURL+"/api/imagemPacote";
            var imagemDados = new FormData();
            imagemDados.append('fileimagem', imagem);
            imagemDados.append('nomeImagem', nomeImagem);
            
            $.ajax({headers: {},data:imagemDados, processData: false,contentType: false, method: "POST", url: urlImagem})
            .done(function (dados) {
                console.log(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
            //fim salvamento da imagem
        }
        
        alert("Pacote criado com sucesso!");
        $('#myModal').modal('hide');
        $("#nome_pacote").val("");
        $("#preco_padrao").val("");
        $("#qtd_dias").val("");
        $("#desc_pacote").val("");
        $("#data_inicio").val("");
        $("#data_fim").val("");
        $('#img').wrap('<form>').closest('form')[0].reset();
        $('#img').unwrap();  
        classPacotes.init();
 
    }

    function excluirPacote(idPacote){
        console.log("excluirPacote");
        var alertConfirm = confirm("Você deseja excluir o pacote?");
		if (alertConfirm == true) {
            var url= SITEURL+"/api/pacotes/"+idPacote;
            // console.log(url);
        
            $.ajax({headers: {}, method: "DELETE", url: url})
            .done(function (dados) {
                alert("Pacote excluído com sucesso!");
                classPacotes.init();
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

    }

    function comprarPacote(idPacote){
        console.log("pacote Comrpado"+idPacote);
        const pacote = pacotesGlobal.find(pacote => pacote.id === idPacote);

        if(pacote.data_inicio == null){
            alert("Selecione uma data tela de agendamentos.");
            window.location.href = "http://127.0.0.1:8000/dashboard?idPacote="+idPacote;

        }else{
            window.location.href = "http://127.0.0.1:8000/dashboard?idPacote="+idPacote+"&dataInicial="+pacote.data_inicio+"&dataFinal="+pacote.data_fim;
        }
    }
    

</script>
