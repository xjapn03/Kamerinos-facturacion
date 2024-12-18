/**
Template Name: Highdmin - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Email: coderthemes@gmail.com
File: Chartjs
*/


!function($) {
    "use strict";

    var ChartJs = function() {};

    ChartJs.prototype.respChart = function(selector,type,data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize( generateChart );

        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
            switch(type){
                
                case 'Bar':
                    new Chart(ctx, {type: 'bar', data: data, options: options});
                    break;
                
            }
            // Initiate new chart or Redraw

        };
        // run function - render chart at first load
        generateChart();
    },

    //init
    ChartJs.prototype.init = function() {
        //creating lineChart
        var lineChart = {
            labels: ["Proyecto 1", "Proyecto 2", "Proyecto 3", "Proyecto 4", "Proyecto 5", "Proyecto 6", "Proyecto 7", "Proyecto 8", "Proyecto 9", "Proyecto 10"],
            
            datasets: [
                {
                    label:  "ENCUESTA TOTAL DE ENERO",  
                    backgroundColor: "#088A4B",
                    borderColor: "#01DF74",
                    borderWidth: 2,
                    hoverBackgroundColor: "#04B45F",
                    hoverBorderColor: "#01DF74",
                    data: [80, 59, 80, 81, 56, 95, 40, 100, 16, 63]
                    
                    
                }
                
            ]
        };
        this.respChart($("#bar"),'Bar',barChart);

        var lineOpts = {
            responsive: true,
            // title:{
            //     display:true,
            //     text:'Chart.js Line Chart'
            // },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    // scaleLabel: {
                    //     display: true,
                    //     labelString: 'Month'
                    // },
                    gridLines: {
                        color: "rgba(0,0,0,0.1)"
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(255,255,255,0.05)",
                        fontColor: '#fff'
                    },
                    ticks: {
                        max: 100,
                        min: -100,
                        stepSize: 20
                    }
                }]
            }
        };

        this.respChart($("#lineChart"),'Line',lineChart, lineOpts);

        //donut chart
        var donutChart = {
            labels: [
                "Bitcoin",
                "Ethereum",
                "Litecoin",
                "Bitcoin Cash",
                "Cardano"
            ],
            datasets: [
                {
                    data: [80, 50, 100,121,77],
                    backgroundColor: [
                        "#02c0ce",
                        "#4eb7eb",
                        "#e3eaef",
                        "#2d7bf4",
                        "#98a6ad"
                    ],
                    hoverBackgroundColor: [
                        "#02c0ce",
                        "#4eb7eb",
                        "#e3eaef",
                        "#2d7bf4",
                        "#98a6ad"
                    ],
                    hoverBorderColor: "#fff"
                }]
        };
        this.respChart($("#doughnut"),'Doughnut',donutChart);


        //Pie chart
        var pieChart = {
            labels: [
                "Desktops",
                "Tablets",
                "Mobiles",
                "Mobiles",
                "Tablets"
            ],
            datasets: [
                {
                    data: [80, 50, 100,121,77],
                    backgroundColor: [
                        "#02c0ce",
                        "#4eb7eb",
                        "#e3eaef",
                        "#2d7bf4",
                        "#98a6ad"
                    ],
                    hoverBackgroundColor: [
                        "#02c0ce",
                        "#4eb7eb",
                        "#e3eaef",
                        "#2d7bf4",
                        "#98a6ad"
                    ],
                    hoverBorderColor: "#fff"
                }]
        };
        this.respChart($("#pie"),'Pie',pieChart);


        //barchart Prueba
        var barChart = {
            labels: <?php echo $puestos ?>,
            
            datasets: [
                {
                    label:  "ENCUESTA TOTAL DE ENERO",  
                    backgroundColor: "#088A4B",
                    borderColor: "#01DF74",
                    borderWidth: 3,
                    hoverBackgroundColor: "#04B45F",
                    hoverBorderColor: "#01DF74",
                    data: [45, 59, 70, 81, 56, 90, 40, 99, 16, 63]
                    
                    
                }
                
            ]
        };
        this.respChart($("#bar"),'Bar',barChart);


        //radar chart
        var radarChart = {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [
                {
                    label: "Desktops",
                    backgroundColor: "rgba(179,181,198,0.2)",
                    borderColor: "rgba(179,181,198,1)",
                    pointBackgroundColor: "rgba(179,181,198,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(179,181,198,1)",
                    data: [65, 59, 90, 81, 56, 55, 40]
                },
                {
                    label: "Tablets",
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    pointBackgroundColor: "rgba(255,99,132,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,99,132,1)",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }
            ]
        };
        this.respChart($("#radar"),'Radar',radarChart);

        //Polar area chart
        var polarChart = {
            datasets: [{
                data: [
                    11,
                    16,
                    7,
                    18
                ],
                backgroundColor: [
                    "#297ef6",
                    "#45bbe0",
                    "#ebeff2",
                    "#1ea69a"
                ],
                label: 'My dataset', // for legend
                hoverBorderColor: "#fff"
            }],
            labels: [
                "Series 1",
                "Series 2",
                "Series 3",
                "Series 4"
            ]
        };
        this.respChart($("#polarArea"),'PolarArea',polarChart);
    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);

