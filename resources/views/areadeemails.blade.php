
<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:20%;padding-bottom:17%;">
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
                            <label for="usuariosList" class="form-label">Para quem o email será enviado?</label>
                            <select type="email" class="form-select" id="usuariosList">
                            </select>

                        </div>   
                        <div class="form-check col-3">
                            <input class="form-check-input" type="checkbox" id="todosUsuarios" name="todosUsuarios">
                            <label class="form-check-label" style="font-size:12px;" for="todosUsuarios">Enviar para todos os contatos</label><br>
                        </div>   
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <label for="assuntoEmail" class="form-label">Assunto da Mensagem</label>
                            <input type="email" class="form-control" id="assuntoEmail" placeholder="Assunto">
                        </div>   
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <label for="textoEmail" class="form-label">Corpo do Email</label>
                            <textarea class="form-control" id="textoEmail" rows="7"></textarea>
                        </div>   
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <button type="button" onclick="enviarEmail()" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
    var usuariosGlobal = "";

    var modalEnvio = document.getElementById('modalEnvio');
    
    modalEnvio.addEventListener('shown.bs.modal', function () {
    
    });

    function enviarEmail(){

        if( $("#todosUsuarios").is(":checked") == true ){
            console.log("mandar para todos");
            var assunto = $("#assuntoEmail").val();
            var texto = $("#textoEmail").val();
            if(assunto == ""){
                alert("Assunto é um campo abrigatório");
                $("#assuntoEmail").focus();
                return("Erro: Assunto Obrigatório");
            }

            if(texto == ""){
                alert("texto é um campo abrigatório");
                $("#textoEmail").focus();
                return("Erro: texto Obrigatório");
            }
            usuariosGlobal.forEach(function(usuario){
                var urlEmail= SITEURL+"/api/enviarEmail";
                // console.log(url);
                var destinatario = usuario.email;
                var destinatarioName = "os usuários";
               
                $("#nomeUsuario").html(destinatarioName);
                $('#modalEnvio').modal('show');
                
                var dadosEmail =  {
                                    "destinatario":destinatario,
                                    "assunto":assunto,
                                    "texto":texto
                                };
            

                $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
                .done(function () {
                    $("#assuntoEmail").val("");
                    $("#textoEmail").val("");
                    $('#modalEnvio').modal('hide');
                })
                .fail(function () {
                    //console.log("Requisição com falha. ");
                    alert("Problema no envio do email!");
                    $("#assuntoEmail").val("");
                    $("#textoEmail").val("");
                })
                .always(function() {});
            });
        }else{
            var urlEmail= SITEURL+"/api/enviarEmail";
            // console.log(url);
            var destinatario = $("#usuariosList").val();
            destinatario = destinatario.split("-");
            var assunto = $("#assuntoEmail").val();
            var texto = $("#textoEmail").val();
            $("#nomeUsuario").html(destinatario[1]);
            $('#modalEnvio').modal('show');
            
            if(assunto == ""){
                alert("Assunto é um campo abrigatório");
                $("#assuntoEmail").focus();
                return("Erro: Assunto Obrigatório");
            }

            if(texto == ""){
                alert("texto é um campo abrigatório");
                $("#textoEmail").focus();
                return("Erro: texto Obrigatório");
            }
            
        
            var dadosEmail =  {
                                "destinatario":destinatario[0],
                                "assunto":assunto,
                                "texto":texto
                            };
        

            $.ajax({headers: {}, data:dadosEmail, method: "POST", url: urlEmail})
            .done(function () {
                alert("Email enviado com sucesso!");
                $("#assuntoEmail").val("");
                $("#textoEmail").val("");
                $('#modalEnvio').modal('hide');
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
                alert("Problema no envio do email!");
                $("#assuntoEmail").val("");
                $("#textoEmail").val("");
            })
            .always(function() {});
        }
 
    }

    var classEmails = function () {

        var gerarOptionsUsuarios = function(dados){
            var htmlUsuario = '';
        
            dados.forEach(function(usuario){
                if(usuario.id_tipo_usuario == 2){
                    htmlUsuario += '<option value="'+usuario.email+'-'+usuario.name+'">'+usuario.email+'-'+usuario.name+'</option>';
                } 
               
            });
            
            $("#usuariosList").html(htmlUsuario);
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

        return {
            //main function to initiate the module
            init: function () {
                gerarUsuarios();
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
