<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serrá do Bené</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style type="text/css">
        .fc-highlight{
            background-color: green !important;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }

        .fab{
            z-index:100;
            position: fixed;
            bottom:20px;
            right:20px;
        }

        .fab a{
            cursor: pointer;
            width: 50px;
            height: 50px;
            border-radius: 30px;
            background-color: #2FB842;
            border: none;
            box-shadow: 0 1px 5px rgba(0,0,0,.4);
            font-size: 24px;
            color: white;
                
            -webkit-transition: .2s ease-out;
            -moz-transition: .2s ease-out;
            transition: .2s ease-out;
        }

        .fab a:focus{
            outline: none;
        }

        .fab a.main{
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 30px;
            background-color: #2FB842;
            right: 0;
            bottom: 0;
            z-index: 20;
        }


        .fab a.main:active,
        .fab a.main:focus{
            outline: none;
            background-color: #2FB842;
            box-shadow: 0 3px 8px rgba(0,0,0,.5);
        }  

        .fab a.main:active + ul,
        .fab a.main:focus + ul{
            bottom: 70px;
        }

        .fab a.main:active + ul li,
        .fab a.main:focus + ul li{
            margin-bottom: 10px;
            opacity: 1;
        }

        .fab a.main:active + ul li:hover label,
        .fab a.main:focus + ul li:hover label{
            opacity: 1;
        }

        /*celular*/
        @media only screen and (max-width: 900px) {
            .logoCentral > img { 
                width:150px !important;
                height:100px !important;
            } 
        }

        /*aqui corno*/
        @media only screen and (max-width: 600px) {
            .menuLateralReduzido{display:none;}
            .menuLateral{background-color:#F0EAD2;float:left;width:250px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
            .menuSuperior{width:100%;height:60px;background-image: linear-gradient(to right, #005f2f, #00b057);text-align: right;position:fixed;z-index:2;}
            .tituloSuperior{width:100%;height:60%;background-image: linear-gradient(to right, #005f2f, #00b057);padding-top:25%;padding-bottom:20%;}
            .container-fluid{background-color:#F2F2F2;width:100%;padding-left:0px;padding-right:0px;margin-right:inherit;margin-left:inherit;float:right;}
            .row{--bs-gutter-x:0.5em !important;}
            .menuLateralIcone{display: inline !important;};
        }
        
     
        @media only screen and (min-width: 600px) {
            .menuLateralReduzido{background-color:#F0EAD2;float:left;width:60px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
            .menuLateral{background-color:#F0EAD2;float:left;width:300px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
            .menuSuperior{width:100%;height:60px;background-image: linear-gradient(to right, #005f2f, #00b057);text-align: right;position:fixed;z-index:2;}
            .tituloSuperior{width:100%;height:60%;background-image: linear-gradient(to right, #005f2f, #00b057);padding-top:13%;padding-bottom:17%;}
            .container-fluid{background-color:#F2F2F2;width:100%;padding-left:60px;padding-right:0px;margin-right:inherit;margin-left:inherit;float:right;}
        }
        
        @media only screen and (max-width: 1010px) {
            .calendario{border-radius: 0px !important;}
        }

        @media only screen and (min-width: 1000px) {
            .menuLateralReduzido{background-color:#F0EAD2;float:left;width:60px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
            .menuLateral{background-color:#F0EAD2;float:left;width:300px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
            .menuSuperior{width:100%;height:60px;background-image: linear-gradient(to right, #005f2f, #00b057);text-align: right;position:fixed;z-index:2;}
            .tituloSuperior{width:100%;height:60%;background-image: linear-gradient(to right, #005f2f, #00b057);padding-top:13%;padding-bottom:17%;}
            .container-fluid{background-color:#F2F2F2;width:100%;padding-left:60px;padding-right:0px;margin-right:inherit;margin-left:inherit;float:right;}
            .calendario{max-width: 950px !important;}
        }

       
        body, html{height: 100%;font-size:14px;}
        .principal{height: 100%;}
        .colorTextLateral{color: #746154;font-weight:400;}
        .nav-item:hover{background-color:#D6CDB7;}
        .button-menu{background-color:#F0EAD2;border:0;}
        .button-menu-mobile{background-color:transparent;border:0;color:white;}
        .linkSuperior{color:white;font-size:14px;text-decoration: none;padding-right:3%;}
        .linkSuperior:hover{color:white;}
    </style>
</head>

<!--begin::Body-->
<body>
    <div class="fab">
        <a href="https://api.whatsapp.com/send?phone=553196524030&text=Desejo marcar um visita na serra do bené..." target="_blank" class="main">
            <svg xmlns="http://www.w3.org/2000/svg" style="padding-top:6px;padding-left:12px;" width="39" height="39" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
            </svg>
        </a>
    </div>
    <div class="menuLateralReduzido">
        <div class="d-flex flex-column flex-shrink-0" style="height:100%;">
            <button onclick="splitMenu(0)" class="button-menu p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            
          
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item text-center">
                    <a href="/" class="colorTextLateral nav-link link-dark fs-5" aria-current="page">                            
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"/>
                            <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/>
                        </svg>
                    </a>
                </li>
                <!-- <li class="nav-item mt-3 text-center">
                    <a href="#" class="colorTextLateral nav-link link-dark fs-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                        </svg>
                    </a>
                </li> -->
                
            </ul>
        </div>
    </div>
    <div class="menuLateral" style="display:none;">
        <div class="d-flex flex-column flex-shrink-0" style="height:100%;">
            <button style="align-self: end;" onclick="splitMenu()" id="botaoMenuLateral" class="button-menu p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            <div style="align-self:center !important;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img style="width:120px;border-radius: 15px !important;" src='{{asset("assets\logo.png")}}'>
                </a>
            </div>
            
          
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mt-3">
                    <a href="/" class="colorTextLateral nav-link link-dark" aria-current="page">                            
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar-date-fill me-3 ms-3" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"/>
                            <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/>
                        </svg>
                        Calendário
                    </a>
                </li>
                <!-- <li class="nav-item mt-3">
                    <a href="#" class="colorTextLateral nav-link link-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-seam me-3 ms-3" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                        </svg>
                        Pacotes
                    </a>
                </li> -->
                
            </ul>
        </div>
    </div>
    <div class="row menuSuperior">
        <div class="col-2" style="text-align: left;padding-top: 10px;">
            <button onclick="splitMenu(1)" style="display:none;" class="menuLateralIcone button-menu-mobile">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
        <div class="col-10">
            <div style="color:white;padding-top:20px;">
                <a href="https://www.serradobene.com.br" class="linkSuperior">Voltar ao site</a>
                <!-- <a href="https://api.whatsapp.com/send?phone=0553196524030&text=Desejo marcar um visita na serra do bené..." target="_blank" class="linkSuperior">WhatsApp</a> -->
                <a href="/register" class="linkSuperior">Cadastre-se</a>
                <a href="/login" class="linkSuperior">Login</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="tituloSuperior text-center" style="padding-top:75px;padding-bottom:150px;">
            <div class="logoCentral" style="text-align:-webkit-center;align-self:center !important;">
                <img style="width:300px;height:200px;border-radius: 15px !important;" src='{{asset("assets\logo.png")}}'>
            </div>
            <div style="color:white;margin-top:30px;">
                <h3>Calendário</h3>
                <h5>Veja o calendário completo</h5>
            </div>
        </div>
        <div class="row" style="--bs-gutter-x: 0 !important;margin-top:-120px;margin-bottom:30px;;justify-content: center!important;">
            <div class="row bg-white overflow-hidden shadow-xl sm:rounded-lg calendario" style="border-radius:20px; justify-content: center!important;">
                <div class="row container mt-5 mb-5 calendario" style="justify-content: center!important;">
                    <div id='loading'>
                        Carregando ...
                    </div>
                    <p>Clique, segure e arraste para selecionar uma data.</p>
                    <div id='full_calendar_events'  class="hidden"></div>
                </div>  
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pré-Agendamento <span id="dataInicio"></span> até <span id="dataFim"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="fs-8 mb-3">Escolha uma opção para prosseguir o pré-agendamento.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=553196524030&text=Desejo marcar um visita na serra do bené..." class="btn btn-success w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                </svg>
                                <br>
                                WhatsApp
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="/register" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                <br>
                                Cadastre-se
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="/login" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                                <br>
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModalErro" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:red;" id="staticBackdropLabel">Data selecionada já foi reservada!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="fs-8 mb-3">Entre em contato para escolher uma nova data.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=553196524030&text=Desejo marcar um visita na serra do bené..." class="btn btn-success w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                </svg>
                                <br>
                                WhatsApp
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="/register" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                <br>
                                Cadastre-se
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="/login" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                                <br>
                                Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">

        var SITEURL = "{{ url('/') }}";
        var agendamentosGlobal = "";
        var precosGlobal = [];

        var classAgendamentos = function () {

            var geraEventsCalendario = function(agendamentos){
                var eventos = [];
                var nomeVisitante = "";
                var nomeResponsavel = "";
                var nomePacote = "";
                var status = "";
                var cor = "";
                var objeto = "";
                
                if(agendamentos.length>0){
                    agendamentos.forEach(function(agendamento){
                        if(agendamento.status == 2){
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
            

            var geraCalendario = function(data){

                $('#full_calendar_events').fullCalendar('destroy');
                var eventos = geraEventsCalendario(data);
                $('#full_calendar_events').fullCalendar({
                    longPressDelay: 10,
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
                            
                            $('#myModal').modal('show');
                        }else{
                            $('#myModalErro').modal('show');
                        }
                    },
                    eventDrop: function (event, delta) {
                        var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    },
                    eventClick: function (event) {
                        
                    }
                });
                $("#loading").hide();
                $('#full_calendar_events').show();

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
                    gerarDados();
                }
            };
        }();


        var myModal = document.getElementById('myModal');
        
        myModal.addEventListener('shown.bs.modal', function () {
        
        });

        var myModalErro = document.getElementById('myModalErro');
        
        myModalErro.addEventListener('shown.bs.modal', function () {
        
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');            
        }


        function splitMenu(tipo){
            if(tipo == 0){
                console.log($(".menuLateral").css('display'));
                $("#botaoMenuLateral").attr("onclick","splitMenu(0)");
                if($(".menuLateral").css('display') == 'block'){
                    $(".menuLateral").hide("slide", {direction: "left" }, 300);           
                    // $(".menuLateralReduzido").css("display", "block");              
                }else if($(".menuLateral").css('display') == 'none'){
                    // $(".menuLateralReduzido").css("display", "none");
                    $(".menuLateral").show("slide", {direction: "left" }, 300);                 
                }
            }else if(tipo ==1){
                console.log($(".menuLateral").css('display'));
                $("#botaoMenuLateral").attr("onclick","splitMenu(1)");
                if($(".menuLateral").css('display') == 'block'){
                    $(".menuLateral").hide("slide", {direction: "left" }, 300);           
                }else if($(".menuLateral").css('display') == 'none'){
                    $(".menuLateral").show("slide", {direction: "left" }, 300);                 
                }
            }
        }

        $(document).ready(function () {

            classAgendamentos.init();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    </script>

   
</body>

</html>