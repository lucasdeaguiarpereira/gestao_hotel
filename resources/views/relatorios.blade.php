<x-app-layout>
    <div class="tituloSuperior text-center" style="padding-top:13%;padding-bottom:17%;">
        <div style="color:white;">
            <h3>Relatórios</h3>
            <h5>Veja e analise seus resultados</h5>
        </div>
    </div>
    <div class="ms-5 me-5" style="margin-top:-10%;margin-bottom:5%;">
        <div>
            <div class="row">
                <div class="col-9">
                </div>
                <div class="col-md-3 col-sm-12">
                    <label style="color:white;">Filtrar por data</label>
                    <input type="text" name="dates" class="form-control pull-right">
                </div>
            </div>
            <div id="loading">
               Carregando ...
            </div>
            <div id="dadosGerais" style="display:none;">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4" style="height:255px;border-radius:10px;">
                            <div id="faturamentoTotal" class="mt-5">
                                <h5 class="ps-5" style="font-weight:bold;">Faturamento total no período</h5>
                                <p class="ps-5" style="color:#a6a6c4;">Valor faturado no período selecionado</p>
                                <h4 id="valorFaturamentoTotal" class="ps-5" style="font-weight:900;color:#71BF94;">
                                    R$ 0,00
                                </h4>
                                <div id="graficoFaturamentoTotal"></div>
                                <div style="height:35px;background-color:#c9f7f5;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12" style="height:100%;">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4" style="height:255px;border-radius:10px;">
                            <div id="faturamentoTotalAnual" class="mt-5 mb-4 me-5 ms-5">
                                <div class="row">
                                    <div class="col-md-2 col-sm-12" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:18px;padding-bottom:18px;">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" style="color:#71BF94;" width="32" height="32" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
                                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zM2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                        </svg>    
                                        
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <h5 style="font-weight:bold;">Faturamento total anual</h5>
                                        <p style="color:#a6a6c4;">Este ano considerando de Janeiro à Dezembro</p>
                                    </div>
                                </div>
                                <h4 id="valorFaturamentoTotalAnual" class="mt-3" style="font-weight:900;color:#71BF94;">
                                    R$ 0,00
                                </h4>
                                <p class="pt-3" style="font-weight:bold;">Linha do tempo - <span class="ano"></span></p>
                                <div id="linhaTempo" class="progress" style="height:5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;background-color:#71BF94;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12" style="color:#a6a6c4;">
                                        Janeiro
                                    </div>
                                    <div class="col-md-6 col-sm-12" style="text-align:right;color:#a6a6c4;">
                                        Dezembro
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 col-sm-12">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4" style="border-radius:10px;">
                            <div id="pacotesMaisVendidos" class="container row mt-5 mb-5">
                                <h5 class="ps-5" style="font-weight:bold;">Pacotes mais vendidos</h5>
                                <p class="ps-5" style="color:#a6a6c4;">Comparativo entre os pacotes</p>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 pt-5">
                                        <div id="graficoPacotesMaisVendidos"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ">
                                        <div class="row mt-4">
                                            <div class="col-3" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:15px;padding-bottom:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFC107" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                                </svg>
                                            </div>
                                            <div class="col-9">
                                                <p id="pacoteTop1" style="white-space:nowrap;font-weight:bold;" class="mt-0 mb-0">-</p>
                                                <p id="qtdPacoteTop1" style="white-space:nowrap;color:#a6a6c4;" class="mt-0 mb-0">-</p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-3" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:15px;padding-bottom:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#80808F" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                                </svg>
                                            </div>
                                            <div class="col-9">
                                                <p id="pacoteTop2" style="white-space:nowrap;font-weight:bold;" class="mt-0 mb-0">-</p>
                                                <p id="qtdPacoteTop2" style="white-space:nowrap;color:#a6a6c4;" class="mt-0 mb-0">-</p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-3" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:15px;padding-bottom:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#CD7F32" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                                </svg>
                                            </div>
                                            <div class="col-9">
                                                <p id="pacoteTop3" style="white-space:nowrap;font-weight:bold;" class="mt-0 mb-0">-</p>
                                                <p id="qtdPacoteTop3" style="white-space:nowrap;color:#a6a6c4;" class="mt-0 mb-0">-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4" style="border-radius:10px;">
                            <div id="melhoresCliente" class="container row mt-5 mb-5">
                                <h5 class="ps-5" style="font-weight:bold;">Ranking de melhores clientes</h5>
                                <p class="ps-5" style="color:#a6a6c4;">Lista dos clientes que mais compram</p>
                                <div class="row ps-5">
                                    <div class="col-6">
                                        <div class="row mt-4">
                                            <div class="col-3" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:15px;padding-bottom:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFC107" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                                </svg>
                                            </div>
                                            <div class="col-9">
                                                <p id="clienteTop1" style="white-space:nowrap;font-weight:bold;" class="mt-0 mb-0">José da Silva</p>
                                                <p style="white-space:nowrap;color:#a6a6c4;" class="mt-0 mb-0">Cliente número 1</p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-3" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:15px;padding-bottom:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#80808F" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                                </svg>
                                            </div>
                                            <div class="col-9">
                                                <p id="clienteTop2" style="white-space:nowrap;font-weight:bold;" class="mt-0 mb-0">Olivia Peixoto</p>
                                                <p style="white-space:nowrap;color:#a6a6c4;" class="mt-0 mb-0">Espírito de aventura</p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-3" style="background-color:#F2F2F2;border-radius:10px;text-align:-webkit-center;padding-top:15px;padding-bottom:15px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#CD7F32" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z"/>
                                                </svg>
                                            </div>
                                            <div class="col-9">
                                                <p id="clienteTop3" style="white-space:nowrap;font-weight:bold;" class="mt-0 mb-0">José da Silva</p>
                                                <p style="white-space:nowrap;color:#a6a6c4;" class="mt-0 mb-0">Fã de carteirinha</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row mt-4">
                                            <div class="col-12" style="text-align:-webkit-center;padding-top:15px;padding-bottom:15px;text-align:right;">
                                                <p id="faturamentoClienteTop1" style="font-weight:bold;white-space:nowrap;color:#80808F;" class="mt-0 mb-0">R$ 2850,00</p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12" style="text-align:-webkit-center;padding-top:15px;padding-bottom:15px;text-align:right;">
                                                <p id="faturamentoClienteTop2" style="font-weight:bold;white-space:nowrap;color:#80808F;" class="mt-0 mb-0">R$ 2850,00</p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12" style="text-align:-webkit-center;padding-top:15px;padding-bottom:15px;text-align:right;">
                                                <p id="faturamentoClienteTop3" style="font-weight:bold;white-space:nowrap;color:#80808F;" class="mt-0 mb-0">R$ 2850,00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4" style="border-radius:10px;">
                            <div id="variacaoPrecos" class="row ms-5 me-5 mt-5 mb-5">
                                <h5 class="ps-5" style="font-weight:bold;">Variação de faturamento dos pacotes em <span class="ano"></h5>
                                <p class="ps-5" style="color:#a6a6c4;">Variação do faturamento em reservas utilizando pacotes ao longo do ano de <span class="ano"></span>.</p>
                                <div id="graficoVariacaoPrecos"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    "use strict";
    var SITEURL = "{{ url('/') }}";
    var pacotesGlobal = "";
    var usuariosGlobal = "";
    var dataFinalGlobal = moment().format("DD/MM/YYYY");
    var dataInicialGlobal = moment().subtract(1, 'months').format("DD/MM/YYYY");

    var faturamentoTotalGrafico = null;
    var faturamentoTotalOptions = {
        series: [
                    {
                        name:"Net Profit",data:[40,40,30,30,35,35,50]
                    }
                ],
        chart:	{
                    type:"area",
                    height: 85,
                    toolbar:{show:!1},
                    zoom:{enabled:!1},
                    sparkline:{enabled:!0}
                },
        
        plotOptions:{},
        
        legend: {
                    show:!1
                },

        dataLabels: {
                        enabled:!1
                    },
        fill: {
                type:"solid",
                opacity:1
                },
        stroke:{
                    curve:"smooth",
                    show:!0,
                    width:3,
                    colors: ['#1bc5bd']					
                },
        xaxis:{
                categories:["Feb","Mar","Apr","May","Jun","Jul","Aug"],
                axisBorder: {
                                show:!1
                            },
                axisTicks:  {
                                show:!1
                            },
                labels:{
                            show:!1,
                            style:{
                                    colors: ['#c9f7f5'],
                                    fontSize:"12px"
                                        
                                    }
                        },

        crosshairs:
                {
                    show:!1,
                    position:"front",
                    stroke:{
                                colors: ['#c9f7f5'],
                                width:1,
                                dashArray:3
                            }
                },

        tooltip:
            {
                enabled:!1,
                offsetY:0,
                style:
                    {
                        fontSize:"12px"
                        
                    }
            }
        },
        
        yaxis:[{
                min:0,
                max:55,
                labels:
                    {
                        show:!1,
                        style:
                            {
                                colors: ['#c9f7f5'],
                                fontSize:"12px"			
                            }
                    }
                }],

        states:{
                    normal:
                    {
                        filter:
                            {
                                type:"none",
                                value:0
                            }
                    },

                    hover:{filter:{type:"none",value:0}},
                    active:{allowMultipleDataPointsSelection:!1,filter:{type:"none",value:0}}
                },
        
        tooltip:{
                    style:{fontSize:"12px"},
                    y: {
                        formatter: function (val) {
                            return "R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(val)                        
                        }
                    },
                },

        colors: ['#c9f7f5'],

        markers:{
                    colors: ['#c9f7f5'],
                    // 1bc5bd
                    strokeColor:['#1bc5bd'],
                    strokeWidth:3
                }
    };

    var variacaoPrecosGrafico = null;
    var variacaoPrecosOptions = {
        series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }],
        chart: {
        type: 'bar',
        height: 350
        },
        plotOptions: {
        bar: {
            horizontal: false,
            borderRadius: 10,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
        },
        xaxis: {
        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        },
        yaxis: {
        title: {
            text: 'Faturamento R$'
        }
        },
        fill: {
        opacity: 1,
        colors:['#71BF94']
        },
        tooltip: {
        y: {
            formatter: function (val) {
            return "R$ " + new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(val)
            }
        }
        }
    };
    
    var pacotesMaisVendidosGrafico = null;
    var pacotesMaisVendidosOptions = {
        series: [44, 55, 13],
        legend:{
            show:false
        },
        chart: {
            width: 200,
            type: 'pie',
        },
        labels: ['Team A', 'Team B', 'Team C'],
        responsive: [{
            breakpoint: 480,
        }]
    };

    var classRelatorios = function () {
        
        var formatData = function(data){
            var dataFormatada = new Date(data);
            return(dataFormatada.toLocaleString());
        }

        var formatDataBanco = function(data){
            var dia = "";
            var mes = "";
            var ano = "";
            data = data.split("/");
            dia = data[0];
            mes = data[1];
            ano = data[2];

            return ano+"-"+mes+"-"+dia;
        }

        var gerarCardPacotes = function(rankingPacotes){
            var categoriasGrafico = [];
            $("#pacoteTop1").html("-");
            $("#pacoteTop2").html("-");
            $("#pacoteTop3").html("-");
            $("#qtdPacoteTop1").html("-");
            $("#qtdPacoteTop2").html("-");
            $("#qtdPacoteTop3").html("-");
            pacotesMaisVendidosOptions.series=[];

            if(rankingPacotes.length<=3)
            {
                for(var i=0; i<rankingPacotes.length;i++){
                    $("#pacoteTop"+(i+1)).html(rankingPacotes[i].nome);
                    $("#qtdPacoteTop"+(i+1)).html(rankingPacotes[i].qtd+" vendidos");
                    pacotesMaisVendidosOptions.series.push(rankingPacotes[i].qtd);
                    categoriasGrafico.push(rankingPacotes[i].nome);
                }
            }else{
                for(var i=0; i<3;i++){
                    $("#pacoteTop"+(i+1)).html(rankingPacotes[i].nome);
                    $("#qtdPacoteTop"+(i+1)).html(rankingPacotes[i].qtd+" vendidos");
                    pacotesMaisVendidosOptions.series.push(rankingPacotes[i].qtd);
                    categoriasGrafico.push(rankingPacotes[i].nome);
                }
            }

            pacotesMaisVendidosOptions.labels = categoriasGrafico;

            if(pacotesMaisVendidosGrafico !== null){
                pacotesMaisVendidosGrafico.destroy();
            }
                            
            pacotesMaisVendidosGrafico = new ApexCharts(document.querySelector("#graficoPacotesMaisVendidos"), pacotesMaisVendidosOptions);
            pacotesMaisVendidosGrafico.render();
        }

        var gerarCardUsuarios = function(rankingUsuarios){
            $("#clienteTop1").html("-");
            $("#clienteTop2").html("-");
            $("#clienteTop3").html("-");
            $("#faturamentoClienteTop1").html("-");
            $("#faturamentoClienteTop2").html("-");
            $("#faturamentoClienteTop3").html("-");

            if(rankingUsuarios.length<=3)
            {
                for(var i=0; i<rankingUsuarios.length;i++){
                    $("#clienteTop"+(i+1)).html(rankingUsuarios[i].nome);
                    $("#faturamentoClienteTop"+(i+1)).html("R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(rankingUsuarios[i].faturamento));
                }
            }else{
                for(var i=0; i<3;i++){
                    $("#clienteTop"+(i+1)).html(rankingUsuarios[i].nome);
                    $("#faturamentoClienteTop"+(i+1)).html("R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(rankingUsuarios[i].faturamento));
                }
            }

        }

        var gerarGraficoFaturamento = function(dados){

            console.log(dados);
            var series = Object();
            var categoriasGrafico = [];
            var pacotesRankingID = [];
            var pacotesRankingNOME = [];
            var pacotesRankingQTD = [];
            var pacotesRanking = [];
            var usuariosRankingID = [];
            var usuariosRankingNOME = [];
            var usuariosRankingQTD = [];
            var usuariosRanking = [];
            var pacoteAux = "";
            var usuarioAux = "";
            var faturamentoTotal = 0;
            var maxValor = 0;
            var indexAux = 0;
            series.name = "Faturamento Total";
            series.data = Array();


            dados.forEach(function(agendamento){

                if(categoriasGrafico.includes(formatData(agendamento.data_inicio).split(" ")[0])){
                    indexAux = categoriasGrafico.indexOf(formatData(agendamento.data_inicio).split(" ")[0]);
                    series.data[indexAux] += parseFloat(agendamento.valor);
                }else{
                    categoriasGrafico.push(formatData(agendamento.data_inicio).split(" ")[0]);
                    series.data.push(parseFloat(agendamento.valor));
                }

                if(agendamento.id_pacote !== null){
                    pacoteAux = pacotesGlobal.find(pacotes => pacotes.id === agendamento.id_pacote);
                    if(pacotesRankingID.includes(pacoteAux.id)){
                        indexAux = pacotesRankingID.indexOf(pacoteAux.id);
                        pacotesRankingQTD[indexAux] += 1;
                    }else{
                        pacotesRankingID.push(pacoteAux.id);
                        pacotesRankingNOME.push(pacoteAux.nome_pacote);
                        pacotesRankingQTD.push(1);
                    }        
                }  

                if(agendamento.id_visitante !== null){
                    usuarioAux = usuariosGlobal.find(usuarios => usuarios.id === agendamento.id_visitante);
                    if(usuariosRankingID.includes(usuarioAux.id)){
                        indexAux = usuariosRankingID.indexOf(usuarioAux.id);
                        usuariosRankingQTD[indexAux] += parseFloat(agendamento.valor);
                    }else{
                        usuariosRankingID.push(usuarioAux.id);
                        usuariosRankingNOME.push(usuarioAux.name);
                        usuariosRankingQTD.push(parseFloat(agendamento.valor));
                    }        
                }  

                faturamentoTotal += parseFloat(agendamento.valor);
            });

            for(var i=0;i<pacotesRankingID.length;i++){
                pacotesRanking.push({id:pacotesRankingID[i],nome:pacotesRankingNOME[i],qtd:pacotesRankingQTD[i]});
            }

            for(var i=0;i<usuariosRankingID.length;i++){
                usuariosRanking.push({id:usuariosRankingID[i],nome:usuariosRankingNOME[i],faturamento:usuariosRankingQTD[i]});
            }

            pacotesRanking.sort((a,b) => (a.qtd < b.qtd) ? 1 : ((b.qtd < a.qtd) ? -1 : 0));
            usuariosRanking.sort((a,b) => (a.faturamento < b.faturamento) ? 1 : ((b.faturamento < a.faturamento) ? -1 : 0));

            console.log("pacotes ranking");
            console.log(pacotesRanking);
            console.log("usuarios ranking")
            console.log(usuariosRanking);

            gerarCardPacotes(pacotesRanking);
            gerarCardUsuarios(usuariosRanking);

            series.data.forEach(function(valores){
                if(parseFloat(valores) > maxValor){
                    maxValor = parseFloat(valores);
                }
            });

            // console.log(faturamentoTotal);
            // console.log("SERIES:");
            // console.log(series);
            // console.log("CATEGORIAS GRAFICO:");
            // console.log(categoriasGrafico);
            // console.log(maxValor);
            faturamentoTotalOptions.series.pop();
            faturamentoTotalOptions.series.push(series);
            faturamentoTotalOptions.xaxis.categories = categoriasGrafico;
            faturamentoTotalOptions.yaxis[0].max = maxValor+(maxValor/4);

            if(faturamentoTotalGrafico !== null){
                faturamentoTotalGrafico.destroy();
            }

            faturamentoTotalGrafico = new ApexCharts(document.querySelector("#graficoFaturamentoTotal"), faturamentoTotalOptions);
            $("#loading").hide();
            $("#dadosGerais").show();
            faturamentoTotalGrafico.render();
            $("#valorFaturamentoTotal").html("R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(faturamentoTotal));
                  
        }


        var gerarDadosAnual = function(dados){
            
            var series = Object();
            var faturamentoTotalAnual = 0;
            var maxValor = 0;
            var indexAux = 0;
            series.name = "Faturamento Anual";
            series.data = [0,0,0,0,0,0,0,0,0,0,0,0];

            dados.forEach(function(agendamento){
                faturamentoTotalAnual += parseFloat(agendamento.valor);
                if(agendamento.id_pacote !== null){
                    series.data[parseInt(moment(agendamento.data_inicio).format("MM"))-1] += parseFloat(agendamento.valor);
                }
            });

          
            variacaoPrecosOptions.series.pop();
            variacaoPrecosOptions.series.push(series);
            
            if(variacaoPrecosGrafico !== null){
                variacaoPrecosGrafico.destroy();
            }

            variacaoPrecosGrafico = new ApexCharts(document.querySelector("#graficoVariacaoPrecos"), variacaoPrecosOptions);
            variacaoPrecosGrafico.render();
            $("#valorFaturamentoTotalAnual").html("R$ "+new Intl.NumberFormat('de-DE',{ maximumFractionDigits: 2, minimumFractionDigits:2 }).format(faturamentoTotalAnual));
                
        }

        var gerarDadosFaturamento = function(dataInicial,dataFinal){

            var dataInicialFormat = formatDataBanco(dataInicial);
            var dataFinalFormat = formatDataBanco(dataFinal);
            console.log("data inicial:"+dataInicialFormat+" ---- data final:"+dataFinalFormat);
            var url = SITEURL+"/api/faturamentoTotal/"+dataInicialFormat+"/"+dataFinalFormat;
            
            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
                $("#loading").show();
                gerarGraficoFaturamento(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
        }

        var gerarMeses = function(meses){
            var pedaco = 100/12;
            var percentual = pedaco*meses;
            var html = `<div class="progress-bar" role="progressbar" style="width: `+percentual+`%;background-color:#71BF94;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="120"></div>`;
            $("#linhaTempo").html(html);
        }

        var gerarDadosFaturamentoAnual = function(dataInicial,dataFinal){
            var ano = dataInicial.split("/")[2];
            var anoAtual = moment().format("YYYY");
            var meses = 0;
            if(anoAtual!==ano){
                if(parseInt(anoAtual)>parseInt(ano)){
                    meses = 12;
                }else{
                    meses = 0;
                }
            }else{
                meses = moment().format("MM");
            }
            gerarMeses(meses);
            $(".ano").html(ano);
            var dataInicialFormat = ano+"-01-01";
            var dataFinalFormat = ano+"-12-31";
            console.log("data inicial:"+dataInicialFormat+" ---- data final:"+dataFinalFormat);
            var url = SITEURL+"/api/faturamentoTotal/"+dataInicialFormat+"/"+dataFinalFormat;

            // console.log(url);
            $.ajax({headers: {},method: "GET", url: url})
            .done(function (dados) {
               console.log(dados);
               gerarDadosAnual(dados);
            })
            .fail(function () {
                //console.log("Requisição com falha. ");
            })
            .always(function() {});
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

        return {
            //main function to initiate the module
            init: function (dataInicial,dataFinal) {
                gerarUsuarios();
                gerarPacotes();
                setTimeout(() => {
                    gerarDadosFaturamento(dataInicial,dataFinal);
                    gerarDadosFaturamentoAnual(dataInicial,dataFinal);
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
        classRelatorios.init(dataInicialGlobal,dataFinalGlobal);

        $('input[name="dates"]').daterangepicker({
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Filtrar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "até",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            },
            "startDate": dataInicialGlobal,
            "endDate": dataFinalGlobal
        }, function(start, end, label) {
            classRelatorios.init(start.format('DD/MM/YYYY'),end.format('DD/MM/YYYY'));
        });

    });

 
    

</script>
