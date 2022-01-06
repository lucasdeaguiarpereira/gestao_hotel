
<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:13%;padding-bottom:17%;">
        <div style="color:white;">
            <h3>Área de E-mails</h3>
            <h5>Envie e-mails para clientes</h5>
        </div>
    </div>
    <div class="ms-5 me-5" style="margin-top:-10%;margin-bottom:5%;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:10px;">
                <div class="mt-5 mb-5 ms-5 me-5">
                    <div class="row">
                        <div class="col-9">
                            <label for="exampleFormControlInput1" class="form-label">Para quem o email será enviado?</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>   
                        <div class="form-check col-3">
                            <input class="form-check-input" type="checkbox" id="todosUsuarios" name="todosUsuarios" value="1">
                            <label class="form-check-label" style="font-size:12px;" for="todosUsuarios">Enviar para todos os contatos</label><br>
                        </div>   
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label">Assunto da Mensagem</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>   
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Corpo do Email</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";
    var usuariosGlobal = "";

    var classEmails = function () {

        var geraDadosEmails = function (dados){
           
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/users";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                geraDadosEmails(dados);
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
        classEmails.init();

       
    });


</script>
