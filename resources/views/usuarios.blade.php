
<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:13%;padding-bottom:17%;">
        <div style="color:white;">
            <h3>Usuários</h3>
            @if (Auth::user()->id_tipo_usuario == 1)
                <h5>Veja todos os usuarios do sistema.</h5>
            @endif
        </div>
    </div>
    <div class="ms-5 me-5" style="margin-top:-10%;margin-bottom:5%;">
        <div>
            @if (Auth::user()->id_tipo_usuario == 1)
            <div class="row">
                <div class="col-12">
                    <button type="button" onclick="modalNovoUsuario()" style="color:#339FA3;display:inline-flex;" class="btn btn-light rounded-pill mb-3 pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Novo usuário
                    </button>
                </div>
            </div>
            @endif  
            <div id="loading">
               Carregando ...
            </div>
            <div id="usuariosList">
                <div class="row mt-3">
                    <div class="row justify-content-md-center">
                        <div class="col-12">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="border-radius:10px;">
                                <div class="container row mt-4 mb-4">
                                    <div id="tableUsuarios" class="col-12">
                                     
                                    </div>
                                </div>                       
                            </div>
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
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Usuários</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                <div class="form-group">
                    <label for="nome" class="form-label">Nome*</label>
                    <input type="text" id="nome" name="nome" class="rounded-3 form-control">
                </div>
                <div class="form-group">
                    <label for="tipoUsuario" class="form-label mt-2">Tipo Usuário*</label>
                    <select id="tipoUsuario" class="rounded-3 form-control" name="tipoUsuario">
                        <option value="1">
                            Administrador
                        </option>
                        <option value="2" selected>
                            Simples
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefone" class="form-label mt-2">Telefone*</label>
                    <input type="text" id="telefone" name="telefone" class="rounded-3 form-control" />
                </div>
                <div class="form-group">
                    <label for="email" class="form-label mt-2">E-mail*</label>
                    <input type="text" id="email" name="email" class="rounded-3 form-control">
                </div>
                <div class="form-group">
                    <label for="senha" class="form-label mt-2">Senha*</label>
                    <input type="text" id="senha" name="senha"  class="rounded-3 form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="salvarUsuario()" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                <div class="form-group hidden">
                    <label for="idEdit" class="form-label">Id*</label>
                    <input type="text" id="idEdit" name="idEdit" class="rounded-3 form-control">
                </div>
                <div class="form-group">
                    <label for="nomeEdit" class="form-label">Nome*</label>
                    <input type="text" id="nomeEdit" name="nomeEdit" class="rounded-3 form-control">
                </div>
                <div class="form-group">
                    <label for="tipoUsuarioEdit" class="form-label mt-2">Tipo Usuário*</label>
                    <select id="tipoUsuarioEdit" class="rounded-3 form-control" name="tipoUsuarioEdit">
                        <option value="1">
                            Administrador
                        </option>
                        <option value="2" selected>
                            Simples
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefoneEdit" class="form-label mt-2">Telefone*</label>
                    <input type="text" id="telefoneEdit" name="telefoneEdit" class="rounded-3 form-control" />
                </div>
                <div class="form-group">
                    <label for="emailEdit" class="form-label mt-2">E-mail*</label>
                    <input type="text" id="emailEdit" name="emailEdit" class="rounded-3 form-control">
                </div>
                <div class="form-group">
                    <label for="senhaEdit" class="form-label mt-2">Senha*</label>
                    <input type="text" id="senhaEdit" name="senhaEdit"  class="rounded-3 form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" onclick="editarUsuario()" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";
    var usuariosGlobal = "";

    var classUsuarios = function () {

        var formatPhoneNumber = function(phoneNumberString){
            var cleaned = ('' + phoneNumberString).replace(/\D/g, '')
            var match = cleaned.match(/^(\d{2})(\d{5})(\d{4})$/)
            if (match) {
                return '(' + match[1] + ') ' + match[2] + '-' + match[3]
            }else{
                match = cleaned.match(/^(\d{2})(\d{4})(\d{4})$/)
                if (match) {
                    return '(' + match[1] + ') ' + match[2] + '-' + match[3]
                }
            }
            return null
        }

        var formatData = function(data){
            var dataFormatada = new Date(data);
            return(dataFormatada.toLocaleString());
        }
        
        var geraUsuariosList = function (dados){
            usuariosGlobal = dados;
            var nivel = "";
            var html = `   <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Tipo</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th style="text-align:right;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>`;
            // console.log(dados.length);
            if(dados.length>0){
                dados.forEach(function(usuario){
                    if(usuario.valido == 1){
                        if(usuario.id_tipo_usuario == 1){
                            nivel = "Administrador";
                        }else if(usuario.id_tipo_usuario == 2){
                            nivel = "Cliente"
                        }

                        html += `<tr>
                                    <th><p class="mt-3">`+usuario.name+`</p></th>
                                    <td><p class="mt-3">`+nivel+`</p></td>
                                    <td><p class="mt-3">`+usuario.email+`</p></td>
                                    <td><p class="mt-3">`+formatPhoneNumber(usuario.telefone)+`</p></td>
                                    <td style="text-align:right;">
                                        <button style="color:#71bf94;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill me-3 mt-3" viewBox="0 0 16 16">
                                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                            </svg>
                                        </button>
                                       
                                        <button onclick="modalEditUsuario(`+usuario.id+`)" style="color:#71bf94;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-3 mt-3" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        <button onclick="excluirUsuario(`+usuario.id+`)" style="color:#71bf94;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill me-3 mt-3" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>`;
                    }
                });
            }

            html +=     `</tbody>
                    </table>`;
            // console.log(html);
            $("#tableUsuarios").html(html);
            $("#loading").hide();
            $("#usuariosList").show();
            console.log(dados);
        }

        var gerarDados = function(){
            var url = SITEURL+"/api/users";
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                geraUsuariosList(dados);
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
        classUsuarios.init();

        $("#telefone").mask("(00) 00000-0000", {reverse: false});
        $("#telefoneEdit").mask("(00) 00000-0000", {reverse: false});
    });


    var myModalEdit = document.getElementById('myModalEdit');
        myModalEdit.addEventListener('shown.bs.modal', function () {
    });

    var myModal = document.getElementById('myModal');
        myModal.addEventListener('shown.bs.modal', function () {
    });
    

    function modalNovoUsuario(){
        $('#myModal').modal('show');
    }

  
    function modalEditUsuario(idUsuario){
        const usuario = usuariosGlobal.find(usuario => usuario.id === idUsuario);
        console.log(usuario);
        $("#idEdit").val(usuario.id);
        $("#nomeEdit").val(usuario.name);
        $("#tipoUsuarioEdit").val(usuario.id_tipo_usuario);
        $("#telefoneEdit").val(usuario.telefone);
        $("#emailEdit").val(usuario.email);   
        $('#myModalEdit').modal('show');
    }


    function salvarUsuario(){
      
        var url= SITEURL+"/api/users";
        // console.log(url);
        var nome = $("#nome").val();
        var tipoUsuario = $("#tipoUsuario").val();
        var telefone = $("#telefone").val();
        var email = $("#email").val();
        var senha = $("#senha").val();
        telefone = telefone.replace("(","").replace(")","").replace("-","").replace(" ","");
        var dadosUsuario = {};
        
        if(nome == ""){
            alert("Nome do Usuário é um campo abrigatório");
            $("#nome").focus();
            return("Erro: Nome Usuário Obrigatório");
        }
        if(tipoUsuario == ""){
            alert("Tipo do Usuário é um campo abrigatório");
            $("#tipoUsuario").focus();
            return("Erro: Tipo Usuário Obrigatório");
        }
        if(telefone == ""){
            alert("Telefone do Usuário é um campo abrigatório");
            $("#telefone").focus();
            return("Erro: Telefone Usuário Obrigatório");
        }
        if(email == ""){
            alert("Email do Usuário é um campo abrigatório");
            $("#email").focus();
            return("Erro: Email Usuário Obrigatório");
        }
        if(senha == ""){
            alert("Senha do Usuário é um campo abrigatório");
            $("#senha").focus();
            return("Erro: Senha Usuário Obrigatório");
        }
     
        dadosUsuario =   {
                            "name":nome,
                            "id_tipo_usuario":tipoUsuario,
                            "valido":1,
                            "telefone":telefone,
                            "email":email,
                            "password":senha,    
                        };

        $.ajax({headers: {}, data:dadosUsuario, method: "POST", url: url})
        .done(function (dados) {
            console.log(dados);
        })
        .fail(function () {
            alert("Usuário não salvo, verifique o email!");
            //console.log("Requisição com falha. ");
        })
        .always(function() {});

        $('#myModal').modal('hide');
        $('#nome').val("");
        $("#tipoUsuario").val(2);
        $("#telefone").val("");
        $("#email").val("");
        $("#senha").val("");
        $("#usuariosList").hide();
        $("#loading").show();
        
        classUsuarios.init();
        
    }
    

    function editarUsuario(){
      
      var id = $("#idEdit").val();
      var nome = $("#nomeEdit").val();
      var tipoUsuario = $("#tipoUsuarioEdit").val();
      var telefone = $("#telefoneEdit").val();
      var email = $("#emailEdit").val();
      var senha = $("#senhaEdit").val();
      telefone = telefone.replace("(","").replace(")","").replace("-","").replace(" ","");
      var dadosUsuario = {};

      var url= SITEURL+"/api/users/"+id;
      // console.log(url);
      
      if(nome == ""){
          alert("Nome do Usuário é um campo abrigatório");
          $("#nome").focus();
          return("Erro: Nome Usuário Obrigatório");
      }
      if(tipoUsuario == ""){
          alert("Tipo do Usuário é um campo abrigatório");
          $("#tipoUsuario").focus();
          return("Erro: Tipo Usuário Obrigatório");
      }
      if(telefone == ""){
          alert("Telefone do Usuário é um campo abrigatório");
          $("#telefone").focus();
          return("Erro: Telefone Usuário Obrigatório");
      }
      if(email == ""){
          alert("Email do Usuário é um campo abrigatório");
          $("#email").focus();
          return("Erro: Email Usuário Obrigatório");
      }
      if(senha == ""){
          alert("Senha do Usuário é um campo abrigatório");
          $("#senha").focus();
          return("Erro: Senha Usuário Obrigatório");
      }
   
      dadosUsuario =   {
                          "name":nome,
                          "id_tipo_usuario":tipoUsuario,
                          "valido":1,
                          "telefone":telefone,
                          "email":email,
                          "password":senha,    
                      };

      $.ajax({headers: {}, data:dadosUsuario, method: "PUT", url: url})
      .done(function (dados) {
          console.log(dados);
      })
      .fail(function () {
          alert("Usuário não salvo, verifique o email!");
          //console.log("Requisição com falha. ");
      })
      .always(function() {});

      $('#myModalEdit').modal('hide');
      $('#nomeEdit').val("");
      $("#tipoUsuarioEdit").val(2);
      $("#telefoneEdit").val("");
      $("#emailEdit").val("");
      $("#senhaEdit").val("");
      $("#usuariosList").hide();
      $("#loading").show();
      
      classUsuarios.init();
      
  }
   
    function excluirUsuario(idUsuario){
        console.log("excluirPacote");
        var alertConfirm = confirm("Você deseja excluir o usuário?");
		if (alertConfirm == true) {
            var url= SITEURL+"/api/users/"+idUsuario;
            // console.log(url);
            var dadosUsuario = {
                                "valido": 0,
                            };
            $.ajax({headers: {}, data:dadosUsuario, method: "PUT", url: url})
            .done(function (dados) {
                alert("Pacote excluído com sucesso!");
                classUsuarios.init();
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

    }

    

</script>
