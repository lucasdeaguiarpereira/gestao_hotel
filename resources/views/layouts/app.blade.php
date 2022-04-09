<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Serra do Bené</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <style type="text/css">
            /* width */
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
            .modal {
                overflow-y:auto;
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

            /*celular*/
            @media only screen and (max-width: 600px) {
                .menuLateralReduzido{display:none;}
                .menuLateral{background-color:#F0EAD2;float:left;width:250px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
                .menuSuperior{width:100%;height:60px;background-image: linear-gradient(to right, #005f2f, #00b057);text-align: right;position:fixed;z-index:2;}
                .tituloSuperior{width:100%;height:60%;background-image: linear-gradient(to right, #005f2f, #00b057);padding-top:25%;padding-bottom:20%;}
                .row{--bs-gutter-x:0.5em !important;}
                .alinhaFim{text-align:center;}
                .container-fluid{background-color:#F2F2F2;width:100%;padding-left:0px;padding-right:0px;margin-right:inherit;margin-left:inherit;float:right;}
                .menuLateralIcone{display: inline !important;};
            }
        
     
            @media only screen and (min-width: 600px) {
                .menuLateralReduzido{background-color:#F0EAD2;float:left;width:60px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
                .menuLateral{background-color:#F0EAD2;float:left;width:300px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
                .menuSuperior{width:100%;height:60px;background-image: linear-gradient(to right, #005f2f, #00b057);text-align: right;position:fixed;z-index:2;}
                .tituloSuperior{width:100%;height:60%;background-image: linear-gradient(to right, #005f2f, #00b057);padding-top:13%;padding-bottom:17%;}
                .container-fluid{background-color:#F2F2F2;width:100%;padding-left:60px;padding-right:0px;margin-right:inherit;margin-left:inherit;float:right;}
                .alinhaFim{text-align:right;}
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
                .alinhaFim{text-align:center;}
            }

            body, html{height: 100%;font-size:14px;}
            .nav-link{display:flex !important;}
            .principal{height: 100%;}
            .colorTextLateral{color: #746154;font-weight:400;}
            .nav-item:hover{background-color:#D6CDB7;}
            .button-menu{background-color:#F0EAD2;border:0;}
            .button-menu-mobile{background-color:transparent;border:0;color:white;}
            .linkSuperior{color:white;width:100px;font-size:14px;text-decoration: none;padding-right:3%;}
            .linkSuperior:hover{color:white;}
        </style>
    </head>
    <body class="font-sans antialiased">
        @if (Auth::user()->id_tipo_usuario == 2)
        <div class="fab">
            <a href="https://api.whatsapp.com/send?phone=553196524030&text=Desejo marcar um visita na serra do bené..." target="_blank" class="main">
                <svg xmlns="http://www.w3.org/2000/svg" style="padding-top:10px;padding-left:12px;" width="39" height="39" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                </svg>
            </a>
        </div>
        @endif
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            <!-- <div class="container-fluid"> -->
                <!-- Page Heading -->
                <!-- @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif -->

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        {{-- Scripts --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script type="text/javascript">
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
        </script>
    </body>
</html>
