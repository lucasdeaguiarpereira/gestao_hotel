
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="row">
                <div class="col-6">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:20px;">
                        <div class="container mt-5 mb-5" style="max-width: 700px">
                        
                        </div>  
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:20px;">
                        <div class="container mt-5 mb-5" style="max-width: 700px">
                        
                        </div>  
                    </div>
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
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Pacotes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                <div class="form-group">
                    <label for="nome_pacote" class="form-label">Nome</label>
                    <input type="text" id="nome_pacote" name="nome_pacote" class="rounded-3 form-control" placeholder="Pacote Natalino">
                </div>
                <div class="form-group">
                    <label for="preco_padrao" class="form-label">Preço</label>
                    <input type="text" id="preco_padrao" name="preco_padrao" class="rounded-3 form-control" />
                </div>
                <div class="form-group">
                    <label for="qtd_dias" class="form-label">Quantidade de Dias</label>
                    <input type="number" min="0" class="rounded-3 form-control" name="qtd_dias" id="qtd_dias" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="desc_pacote" class="form-label">Descrição</label>
                    <input type="text" id="desc_pacote" name="desc_pacote"  class="rounded-3 form-control"  placeholder="Pacote natalino com aquele preço especial!!!">
                </div>
                <div class="form-group">
                    <label for="data_inicio" class="form-label">Data Inicio</label>
                    <input type="datetime-local" min="0" class="rounded-3 form-control" name="data_inicio" id="data_inicio" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="data_fim" class="form-label">Data Fim</label>
                    <input type="datetime-local" min="0" class="rounded-3 form-control" name="data_fim" id="data_fim" placeholder="3">
                </div>
                <div class="form-group">
                    <label for="img" class="form-label">Imagem</label>
                    <input type="text" id="img" name="img"  class="rounded-3 form-control">
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
    var classPacotes = function () {
        var SITEURL = "{{ url('/') }}";
        
        var teste = function (dados){
          console.log(dados);
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/pacotes";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                teste(dados);
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
       
        $('#myModal').modal('hide');

    }

</script>
