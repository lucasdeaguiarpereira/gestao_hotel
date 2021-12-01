
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
        <div class="max-w-7xl">
            @if (Auth::user()->id_tipo_usuario == 1)
            <div class="row">
                <div class="col-12">
                    <button type="button" onclick="modalNovoPacote()" style="color:#339FA3;display:inline-flex;" class="btn btn-light rounded-pill mb-3 pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Novo Pacote
                    </button>
                </div>
            </div>
            @endif
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";

    var classPacotes = function () {
        var formatData = function(data){
            var dataFormatada = new Date(data);
            return(dataFormatada.toLocaleString());
        }
        
        var geraPacotesList = function (dados){
            var html = "";
            var contador = 1;
            // console.log(dados.length);
            if(dados.length>0){
                dados.forEach(function(pacote){
                    if(contador%2 !== 0){
                        html += '<div class="row mt-3">';
                    }
                    html += `<div class="col-6">
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:20px;">
                                    <div class="container row mt-4 mb-4">
                                        <div class="col-6">
                                            <img style="width:250px;height:150px;" class="rounded-3" src='{{asset("assets/`+pacote.img+`")}}'>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12" style="font-weight:bold;font-size:1em;">
                                                    Fim de Semana Especial
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Qtd. Dias:
                                                </div>
                                                <div class="col-6">
                                                    `+pacote.qtd_dias+`
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Preço:
                                                </div>
                                                <div class="col-6">
                                                    R$`+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(pacote.preco_padrao)+`
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Data Inicial:
                                                </div>
                                                <div class="col-6">
                                                    `+(pacote.data_inicio == null ? 'Indeterminado' : formatData(pacote.data_inicio))+`
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    Data Final:
                                                </div>
                                                <div class="col-6">
                                                    `+(pacote.data_fim == null ? 'Indeterminado' : formatData(pacote.data_fim))+`
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-6">
                                                    <button type="button" onclick="modalNovoPacote()" style="color:white;background-color:#71BF94;display:inline-flex;" class="btn rounded-pill">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" style="padding-top: 3px;" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                        </svg>
                                                        Editar
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" onclick="modalNovoPacote()" style="display:inline-flex;" class="btn btn-danger rounded-pill">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"  style="padding-top: 3px;" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                        Excluir
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>`;
                    if(contador%2 == 0){
                        html += '</div>';
                    }
                    contador++;
                });
            }
            // console.log(html);
            $("#pacotesList").html(html);
            console.log(dados);
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/pacotes";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
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

    });

    var myModal = document.getElementById('myModal');
        myModal.addEventListener('shown.bs.modal', function () {
    });
    
    function modalNovoPacote(){
        $('#myModal').modal('show');
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
        

        $('#myModal').modal('hide');
        $("#nome_pacote").val("");
        $("#preco_padrao").val("");
        $("#qtd_dias").val("");
        $("#desc_pacote").val("");
        $("#data_inicio").val("");
        $("#data_fim").val("");
        $('#img').wrap('<form>').closest('form')[0].reset();
        $('#img').unwrap();   
    }

</script>
