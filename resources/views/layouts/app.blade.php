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
            
            /*celular*/
            @media only screen and (max-width: 600px) {
                .menuLateralReduzido{background-color:#F0EAD2;float:left;width:60px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
                .menuLateral{background-color:#F0EAD2;float:left;width:250px ;height: 100%; min-height: 100%;position: fixed;z-index:100;}
                .menuSuperior{width:100%;height:60px;background-image: linear-gradient(to right, #005f2f, #00b057);text-align: right;position:fixed;z-index:2;}
                .tituloSuperior{width:100%;height:60%;background-image: linear-gradient(to right, #005f2f, #00b057);padding-top:25%;padding-bottom:20%;}
                .container-fluid{background-color:#F2F2F2;width:100%;padding-left:60px;padding-right:0px;margin-right:inherit;margin-left:inherit;float:right;}
                .row{--bs-gutter-x:0.5em !important;}
                .alinhaFim{text-align:center;}
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
            .linkSuperior{color:white;font-size:14px;text-decoration: none;padding-right:3%;}
            .linkSuperior:hover{color:#847264;}}
        </style>
    </head>
    <body class="font-sans antialiased">
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
            function splitMenu(){
                console.log($(".menuLateral").css('display'));
                if($(".menuLateral").css('display') == 'block'){
                    $(".menuLateral").hide("slide", {direction: "left" }, 300);
                    $(".menuLateralReduzido").css("display", "block");  
                }else if($(".menuLateral").css('display') == 'none'){
                    $(".menuLateralReduzido").css("display", "none");
                    $(".menuLateral").show("slide", {direction: "left" }, 300);
                }
            }
        </script>
    </body>
</html>
