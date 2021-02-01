<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 15/02/2017
 * Time: 08:48
 */

function stock_status(){
    ?>
    <script type="text/javascript">
        /*
        $(document).ready(function() {
            var dtable = $('#stock').DataTable({
                "order": [[5, "desc"]]
            });
        });
        */

        $(function () {

            var dtable = $('#stock').DataTable({
                "order": [[5, "desc"]],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
                /*
                ,
                "columnDefs": [
                    {
                        "targets": [6],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [7],
                        "visible": false
                    }
                    ]
                 */
            });

            var orgsmrytable = $('#orgsmry').DataTable({
                //"order": [[5, "desc"]],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            dtable.column(1).data().search("Adult").draw();
            orgsmrytable.column(0).data().search("STKA").draw();


            var atrends = $('#atrends').val();
            var ptrends = $('#ptrends').val();
            var rtrends = $('#rtrends').val();
            var rdtrends = $('#rdtrends').val();
            //alert(jtext);
            //var obj = JSON.parse();
            var aobj = JSON.parse(atrends);
            var pobj = JSON.parse(ptrends);
            var rtksobj = JSON.parse(rtrends);
            var rdtsobj = JSON.parse(rdtrends);

            //alert (aobj[0][0]);

            //Trends data variables
            var at, pt, rt, rdt;

            at = [

            ];

            var tobj = aobj;
            var colname = 'Clients (at risk) - Adults';
            var linename = 'Adult ARVs';

            plotTrends(tobj, colname, linename, "ARV");

            function plotTrends(tobj, colname, linename, type) {

                //alert(tobj[11][0]);

                if (type == "ARV") {
                    var trendData = [{
                        name: colname,
                        type: 'column',
                        yAxis: 1,
                        data: [tobj[0][2], tobj[1][2], tobj[2][2], tobj[3][2], tobj[4][2], tobj[5][2], tobj[6][2], tobj[7][2], tobj[8][2],
                            tobj[9][2], tobj[10][2], tobj[11][2]],
                        tooltip: {
                            valueSuffix: ''
                        }
                    }
                        ,
                        {
                            name: linename + " (Stockout Rates)",
                            type: 'line',
                            data: [tobj[0][1], tobj[1][1], tobj[2][1], tobj[3][1], tobj[4][1], tobj[5][1], tobj[6][1], tobj[7][1], tobj[8][1],
                                tobj[9][1], tobj[10][1], tobj[11][1]],
                            tooltip: {
                                valueSuffix: '%'
                            }
                        },
                        {
                            name: linename + " (Reporting Rates)",
                            type: 'line',
                            data: [tobj[0][5], tobj[1][5], tobj[2][5], tobj[3][5], tobj[4][5], tobj[5][5], tobj[6][5], tobj[7][5], tobj[8][5],
                                tobj[9][5], tobj[10][5], tobj[11][5]],
                            tooltip: {
                                valueSuffix: '%'
                            }
                        }
                        ];
                } else {
                    //alert(tobj[11][5]);
                    var trendData = [{
                            name: linename + " (Stockout Rates)",
                            type: 'line',
                            data: [tobj[0][1], tobj[1][1], tobj[2][1], tobj[3][1], tobj[4][1], tobj[5][1], tobj[6][1], tobj[7][1], tobj[8][1],
                                tobj[9][1], tobj[10][1], tobj[11][1]],
                            tooltip: {
                                valueSuffix: '%'
                            }
                        },
                        {
                            name: linename + " (Reporting Rates)",
                            type: 'line',
                            data: [tobj[0][5], tobj[1][5], tobj[2][5], tobj[3][5], tobj[4][5], tobj[5][5], tobj[6][5], tobj[7][5], tobj[8][5],
                                tobj[9][5], tobj[10][5], tobj[11][5]],
                            tooltip: {
                                valueSuffix: '%'
                            }
                        }
                        ];

                }

                Highcharts.chart('trends', {
                    chart: {
                        zoomType: 'xy',
                        borderWidth: 1,
                        borderColor: 'grey'
                    },
                    title: {
                        text: 'HIV Commodity Stockout rates - Last 12 Weeks (' + $('#o').html() + ')'
                    },
                    subtitle: {
                        text: 'Health Facilities Reporting HIV Commodity Stockstatus during the reporting periods'
                    },
                    xAxis: [{
                        categories: [tobj[0][0], tobj[1][0], tobj[2][0], tobj[3][0], tobj[4][0], tobj[5][0],
                            tobj[6][0], tobj[7][0], tobj[8][0], tobj[9][0], tobj[10][0], tobj[11][0]],
                        crosshair: true,
                        title: {
                            text: 'Weeks',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    }],
                    yAxis: [{ // Primary yAxis
                        labels: {
                            format: '{value} %',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        title: {
                            text: 'Rates (%)',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    }, { // Secondary yAxis
                        title: {
                            text: 'Number of Clients',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: '{value}',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    legend: {
                        /*
                         layout: 'vertical',
                         align: 'left',
                         x: 70,
                         verticalAlign: 'top',
                         y: 52,
                         floating: true,
                         */
                        align: 'center',
                        verticalAlign: 'bottom',
                        x: 0,
                        y: 0,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                    },
                    exporting: {
                        filename: 'RASS_stockout_rates_reporting_rates_' + cat + '_' + $('#w').html(),
                        buttons: {
                            contextButton: {
                                menuItems: [
                                    "printChart",
                                    "separator",
                                    "downloadPNG",
                                    "downloadJPEG",
                                    "downloadPDF",
                                    //"downloadSVG",
                                    "separator",
                                    "downloadXLS",
                                    "downloadCSV"
                                    //"viewData",
                                    //"openInCloud"
                                    ]
                            }
                        }
                    }
                    ,
                    /*
                     plotOptions: {
                     series: {
                     borderWidth: 0,
                     dataLabels: {
                     enabled: true,
                     format: '{point.y:,.0f}' //{point.y:.1f}
                     }
                     }
                     },
                     */
                    credits: {
                        enabled: true,
                        text: 'www.rass.mets.or.ug',
                        href: 'http://rass.mets.or.ug'
                    },
                    series: trendData
                });
            }
            //Data objects - data from hidden input fields
            // Create the chart
            //Adults
            var reg = $('#reg').val();
            var dis = $('#dis').val();

            var obj1 = JSON.parse(reg);
            var obj2 = JSON.parse(dis);

            //Paeds
            var creg = $('#creg').val();
            var cdis = $('#cdis').val();

            var cobj1 = JSON.parse(creg);
            var cobj2 = JSON.parse(cdis);

            //RTKS
            var rreg = $('#rreg').val();
            var rdis = $('#rdis').val();

            var rtkobj1 = JSON.parse(rreg);
            var rtkobj2 = JSON.parse(rdis);

            //RDTS
            var rdreg = $('#rdreg').val();
            var rddis = $('#rddis').val();

            var rdtobj1 = JSON.parse(rdreg);
            var rdtobj2 = JSON.parse(rddis);

            //OrgUnits
            var orgunits = $('#orgunits').val();
            var orgobj = JSON.parse(orgunits);

            var cat = 'Adults';

            var rassReg, rassDis, rassSub;

            var ol = $('#ol').val();
            var orgn = $('#o').html().toString();

            drawBarChart(obj1, obj2, 16);

            //alert(ol);
            //alert(orgn);

            function drawBarChart(obj1, obj2, count) {

                //RASS regions
                rassReg = [];
                rassDis = [];
                rassSub = [];
                //console.log(orgobj);
                $.each(orgobj, function( regName,  dis) {
                    //regions;
                    rassReg.push (regName.split("-")[0]);
                    $.each(dis, function( disName, sub ) {
                        //districts;
                        rassDis.push ([regName.split("-")[0], disName.split("-")[0]]);
                        //subcounties
                        /*
                        $.each(sub, function( subName, hf ) {
                            //districts;
                            rassSub.push ([disName, subName]);
                        });
                        */
                    });

                });

                //alert (obj1);
                //alert (rassDis);
                //console.log (rassReg);

                //Regional bar graphs
                var regData = [];

                if (ol == "National") {

                    regData = [
                        {
                            name: 'Stockouts',
                            data: (function () {
                                var data = [], i;
                                $.each(rassReg, function (key, val) {
                                    data.push(
                                        {
                                            name: val,
                                            y: (typeof obj1[val] === 'undefined') ? 0 : obj1[val][0],
                                            drilldown: val
                                            /*
                                             name: (val === 'West Nile Region') ? "West Nile" : val.split(" ")[0],
                                             y: (typeof obj1[val] === 'undefined') ? 0 : obj1[val][0],
                                             drilldown: (val === 'West Nile Region') ? "West Nile" : val.split(" ")[0]
                                            */
                                        }
                                    );
                                });
                                return data;
                            }())

                        },
                        {
                            name: 'Clients at risk (x100)',
                            data: (function () {
                                var data = [], i;
                                $.each(rassReg, function (key, val) {
                                    data.push(
                                        {
                                            name: val,
                                            y: (typeof obj1[val] === 'undefined') ? 0 : obj1[val][1],
                                            drilldown: "aa" + val
                                            /*
                                             name: (val === 'West Nile Region') ? "West Nile" : val.split(" ")[0],
                                             y: (typeof obj1[val] === 'undefined') ? 0 : obj1[val][1],
                                             drilldown: (val === 'West Nile Region') ? "aaWest Nile" : "aa" + val.split(" ")[0]
                                            */
                                        }
                                    );
                                });
                                return data;
                            }())

                        }
                    ];

                } else if (ol == "Regional"){

                    regData = [
                        {
                            name: 'Stockouts',
                            data: (function () {
                                var data = [], i;
                                $.each(orgobj, function (reg, dis) {
                                    if(reg.split("-")[0] == orgn) {
                                        $.each(dis, function (disn, sub) {
                                            data.push(
                                                {
                                                    name: disn.split("-")[0].split(" ")[0],
                                                    y: (typeof obj2[disn.split("-")[0]] === 'undefined') ? 0 : obj2[disn.split("-")[0]][0][0],
                                                    drilldown: "so" + disn.split("-")[0].split(" ")[0]
                                                }
                                            );
                                        });
                                    }
                                });
                                return data;
                            }())

                        },
                        {
                            name: 'Clients at risk (x100)',
                            data: (function () {
                                var data = [], i;
                                $.each(orgobj, function (reg, dis) {
                                    if (reg.split("-")[0] == orgn) {
                                        $.each(dis, function (disn, sub) {
                                            data.push(
                                                {
                                                    name: disn.split("-")[0].split(" ")[0],
                                                    y: (typeof obj2[disn.split("-")[0]] === 'undefined') ? 0 : obj2[disn.split("-")[0]][0][1],
                                                    drilldown: "ac" + disn.split("-")[0].split(" ")[0]
                                                }
                                            );
                                        });
                                    }
                                });
                                return data;
                            }())

                        }
                    ];

                } else if (ol == "District"){

                } else if (ol == "Subcounty"){

                } else if (ol == "Facility"){

                }
                //District bar graphs
                var sdata = [];

                if(ol == "National"){

                    $.each(orgobj, function( k, v ) {

                        sdata.push (
                            //District bar graphs - Stockouts
                            {
                                name: 'Stockouts',
                                id: k.split("-")[0],
                                //id: (k.split("-")[0] === 'West Nile Region') ? "West Nile" : k.split("-")[0].split(" ")[0],
                                data: (function(){
                                    var data = [], i;
                                    $.each(v, function( key, val ) {
                                        data.push (
                                            {
                                                name: key.split("-")[0].split(" ")[0],
                                                y: (typeof obj2[key.split("-")[0]] === 'undefined') ? 0 : obj2[key.split("-")[0]][0][0],
                                                drilldown: "so" + key.split("-")[0].split(" ")[0]
                                            }
                                        );
                                    });
                                    return data;
                                }())
                            },
                            //District bar graphs -  Clients at risk
                            {
                                name: 'Clients at risk (x100)',
                                id: "aa" + k.split("-")[0],
                                //id: (k.split("-")[0] === 'West Nile Region') ? "aaWest Nile" : "aa" + k.split("-")[0].split(" ")[0],
                                data:
                                    (function(){
                                        var data = [], i;
                                        $.each(v, function( key, val ) {
                                            data.push (
                                                {
                                                    name: key.split("-")[0].split(" ")[0],
                                                    y: (typeof obj2[key.split("-")[0]] === 'undefined') ? 0 : obj2[key.split("-")[0]][0][1],
                                                    drilldown: "ac" + key.split("-")[0].split(" ")[0]
                                                }
                                            );
                                        });
                                        return data;
                                    }())
                            }

                        );
                    });

                } else if (ol == "Regional"){

                } else if (ol == "District"){

                } else if (ol == "Subcounty"){

                } else if (ol == "Facility"){

                }
                //Commodity data bar graphs

                $.each(orgobj, function( key, dis ) {

                    $.each(dis, function( k, v ) {
                       //alert(ol);

                        if (ol == "National") {

                            var sodata = [], acdata = [], i;
                            for (i = 1; i <= count; i += 1) {
                                //Stockouts per commodity
                                sodata.push([
                                    (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][0],
                                    (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][1]
                                ]);
                                //Clients at risk per commodity
                                acdata.push([
                                    (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][0],
                                    (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][2]
                                ]);
                            }
                            sdata.push(
                                {
                                    id: "so" + k.split("-")[0].split(" ")[0],
                                    name: 'Stockouts',
                                    data: sodata
                                },
                                {
                                    id: "ac" + k.split("-")[0].split(" ")[0],
                                    name: 'Clients at risk (x100)',
                                    data: acdata
                                }
                            );

                        } else if (ol == "Regional"){

                            if(key.split("-")[0] == orgn) {
                                var sodata = [], acdata = [], i;
                                for (i = 1; i <= count; i += 1) {
                                    //Stockouts per commodity
                                    sodata.push([
                                        (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][0],
                                        (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][1]
                                    ]);
                                    //Clients at risk per commodity
                                    acdata.push([
                                        (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][0],
                                        (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][2]
                                    ]);
                                }
                                sdata.push(
                                    {
                                        id: "so" + k.split("-")[0].split(" ")[0],
                                        name: 'Stockouts',
                                        data: sodata
                                    },
                                    {
                                        id: "ac" + k.split("-")[0].split(" ")[0],
                                        name: 'Clients at risk (x100)',
                                        data: acdata
                                    }
                                );
                            }

                        } else if (ol == "District"){

                            if(k.split("-")[0] == orgn) {

                                var sodata = [], acdata = [], i;
                                for (i = 1; i <= count; i += 1) {
                                    //Stockouts per commodity
                                    sodata.push({
                                        name: (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][0],
                                        y: (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][1]
                                        //drilldown:
                                    });
                                    //Clients at risk per commodity
                                    acdata.push({
                                        name: (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][0],
                                        y: (typeof obj2[k.split("-")[0]] === 'undefined') ? 0 : obj2[k.split("-")[0]][i][2]
                                        //drilldown:
                                    });
                                }
                                regData.push(
                                    {
                                        name: 'Stockouts',
                                        data: sodata
                                    },
                                    {
                                        name: 'Clients at risk (x100)',
                                        data: acdata
                                    }
                                );
                            }

                        } else if (ol == "Subcounty"){

                        } else if (ol == "Facility"){

                        }



                   });
                });

                Highcharts.setOptions({
                    lang: {
                        drillUpText: '< Back'
                    }
                });

                Highcharts.chart('sadults', {

                    chart: {
                        type: 'column',
                        borderWidth: 1,
                        borderColor: 'grey'
                    },
                    title: {
                        text: 'Number Of Facilities Stocked Out <br />' + cat + ' (' + $('#w').html() + ')'
                    },
                    subtitle: {
                        text: 'Click the columns to Drill down to HIV Commodities.'
                    },
                    xAxis: {

                        type: 'category'

                    },
                    yAxis: {
                        title: {
                            text: 'Number Of Facilities / Clients'
                        }

                    },
                    legend: {
                        enabled: true
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.0f}' //{point.y:.1f}
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b>'
                    },
                    credits: {
                        enabled: true,
                        text: 'rass.mets.or.ug',
                        href: 'http://rass.mets.or.ug'
                    },
                    exporting: {
                        filename: 'RASS_number_of_health_facilities_stockedout_' + cat + '_' + $('#w').html(),
                        buttons: {
                            contextButton: {
                                menuItems: [
                                    "printChart",
                                    "separator",
                                    "downloadPNG",
                                    "downloadJPEG",
                                    "downloadPDF",
                                    //"downloadSVG",
                                    "separator",
                                    "downloadXLS",
                                    "downloadCSV"
                                    //"viewData",
                                    //"openInCloud"
                                ]
                            }
                        }
                    },
                    series: regData,
                    drilldown: {
                        drillUpButton: {
                            relativeTo: 'spacingBox',
                            position: {
                                y: 35,
                                x: 0
                            }
                            /*
                            ,
                            theme: {
                                fill: 'white',
                                'stroke-width': 1,
                                stroke: 'silver',
                                r: 0,
                                states: {
                                    hover: {
                                        fill: '#bada55'
                                    },
                                    select: {
                                        stroke: '#039',
                                        fill: '#bada55'
                                    }
                                }
                            }
                            */
                        },
                        series: sdata
                    }
                });
            }

            //Map Distribution

            /**
             * Event handler for clicking points. Use jQuery UI to pop up
             * a pie chart showing the details for each state.
             */

            function pointClick() {

                $('#pop').dialog({
                    title: this.name + ' [ARV Category]',
                    width: 'auto',
                    height: 'auto'
                });

                window.chart = new Highcharts.Chart({
                    chart: {
                        renderTo: '#pop',
                        type: 'pie',
                        width: 370,
                        height: 240
                    },
                    title: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    },
                    exporting: {
                        enabled: false
                    },
                    series: [{
                        name: 'Categories',
                        data: [{
                            name: 'Adults',
                            color: '#0200D0',
                            y: 70
                        }, {
                            name: 'Paediatrics',
                            color: '#C40401',
                            y: 30
                        }],
                        dataLabels: {
                            format: '<b>{point.name}</b> {point.percentage:.1f}%'
                        }
                    }]
                });

            }

            //Function drawMap
            function drawMap(data) {
                $.getJSON('assets/files/organisationUnits.geojson', function (geojson) {
                    // Instanciate the map
                    Highcharts.mapChart('dmap', {

                        chart: {
                            borderWidth: 1,
                            height: 400,
                            borderColor: 'grey'
                        },

                        title: {
                            text: 'Stockout Distribution Rates (%)' + '<br />' + cat + ' (' + $('#w').html() + ')'
                        }
                        /*
                        ,
                        subtitle: {
                            text: 'Click on District for more details'
                        }
                        */
                        ,

                        legend: {
                            enabled: true
                        },
                        credits: {
                            enabled: false,
                            text: 'Mets.or.ug',
                            href: 'http://www.mets.or.ug'
                        },

                        colorAxis: {

                            dataClasses: [{
                                from: 0,
                                to: 25,
                                color: '#ADFF2F',
                                name: '<=25'
                            }, {
                                from: 26,
                                to: 50,
                                color: '#FFFF00',
                                name: '<=50'
                            },
                                {
                                    from: 51,
                                    to: 75,
                                    color: '#FF0000',
                                    name: '<=75'
                                },
                                {
                                    from: 76,
                                    to: 100,
                                    color: '#bf0000',
                                    name: '<=100'
                                }
                            ]
                        },
                        exporting: {
                            filename: 'RASS_stockout_rate_distribution_per_district_' + cat + '_' + $('#w').html(),
                            buttons: {
                                contextButton: {
                                    menuItems: [
                                        "printChart",
                                        "separator",
                                        "downloadPNG",
                                        "downloadJPEG",
                                        "downloadPDF",
                                        //"downloadSVG",
                                        "separator",
                                        "downloadXLS",
                                        "downloadCSV"
                                        //"viewData",
                                        //"openInCloud"
                                        /*
                                        {
                                            textKey: 'downloadJPEG',
                                            onclick: function () {
                                                alert('Hey');
                                                this.exportChart({
                                                    //type: 'image/jpeg'
                                                    //type: 'application/pdf'
                                                    //this.downloadCSV();
                                                    //this.downloadXLS();
                                                    //this.print();
                                                    //this.exportChart();//defaults to png
                                                });
                                            }
                                        }
                                        */
                                    ]
                                }
                            }
                        },
                        series: [{
                            name: 'Stockouts',
                            mapData: geojson, //Highcharts.maps['countries/ug/ug-all']
                            joinBy: 'name',
                            keys: ['name', 'value'],
                            data: data,
                            color: '#FF0000',
                            dataLabels: {
                                enabled: false,
                                color: '#FFFFFF',
                                formatter: function () {
                                    if (this.point.value) {
                                        return this.point.name;
                                    }
                                }
                            },
                            tooltip: {
                                headerFormat: '',
                                pointFormat: '{point.name}' + '<br />{point.value}%'
                            },

                            states: {
                                hover: {
                                    color: '#DCDCDC',
                                    borderWidth:1,
                                    borderColor:'#000000'
                                }
                            }
                            /*
                            ,
                            point: {
                                events: {
                                    click: pointClick
                                }
                            }
                        */
                        }
                        ]

                    });//end
                });
            }
            //Load Reporting rates

            var rsmry = $('#rsmry').val();
            var robj = JSON.parse(rsmry);

            //Load Map
            //STKA data
            var data = [];
            //STKC data
            var cdata = [];
            //RTK data
            var rdata = [];
            //RDT data
            var rddata = [];

            $.each(orgobj, function( reg, dis ) {

                $.each(dis, function( disn, val ) {
                    //alert(val);
                    if (ol == "National") {

                        if (typeof obj2[disn.split("-")[0]] !== 'undefined')
                            data.push([disn.split("-")[0], (typeof obj2[disn.split("-")[0]] === 'undefined') ? 0 : obj2[disn.split("-")[0]][0][2]]);
                        if (typeof cobj2[disn.split("-")[0]] !== 'undefined')
                            cdata.push([disn.split("-")[0], (typeof cobj2[disn.split("-")[0]] === 'undefined') ? 0 : cobj2[disn.split("-")[0]][0][2]]);
                        if (typeof rtkobj2[disn.split("-")[0]] !== 'undefined')
                            rdata.push([disn.split("-")[0], (typeof rtkobj2[disn.split("-")[0]] === 'undefined') ? 0 : rtkobj2[disn.split("-")[0]][0][2]]);
                        if (typeof rdtobj2[disn.split("-")[0]] !== 'undefined')
                            rddata.push([disn.split("-")[0], (typeof rdtobj2[disn.split("-")[0]] === 'undefined') ? 0 : rdtobj2[disn.split("-")[0]][0][2]]);

                    } else if(ol == "Regional"){

                        if (reg.split("-")[0] == orgn){
                            if (typeof obj2[disn.split("-")[0]] !== 'undefined')
                                data.push([disn.split("-")[0], (typeof obj2[disn.split("-")[0]] === 'undefined') ? 0 : obj2[disn.split("-")[0]][0][2]]);
                            if (typeof cobj2[disn.split("-")[0]] !== 'undefined')
                                cdata.push([disn.split("-")[0], (typeof cobj2[disn.split("-")[0]] === 'undefined') ? 0 : cobj2[disn.split("-")[0]][0][2]]);
                            if (typeof rtkobj2[disn.split("-")[0]] !== 'undefined')
                                rdata.push([disn.split("-")[0], (typeof rtkobj2[disn.split("-")[0]] === 'undefined') ? 0 : rtkobj2[disn.split("-")[0]][0][2]]);
                            if (typeof rdtobj2[disn.split("-")[0]] !== 'undefined')
                                rddata.push([disn.split("-")[0], (typeof rdtobj2[disn.split("-")[0]] === 'undefined') ? 0 : rdtobj2[disn.split("-")[0]][0][2]]);
                        }

                    } else if(ol == "District"){

                        if (disn.split("-")[0] == orgn){
                            if (typeof obj2[disn.split("-")[0]] !== 'undefined')
                                data.push([disn.split("-")[0], (typeof obj2[disn.split("-")[0]] === 'undefined') ? 0 : obj2[disn.split("-")[0]][0][2]]);
                            if (typeof cobj2[disn.split("-")[0]] !== 'undefined')
                                cdata.push([disn.split("-")[0], (typeof cobj2[disn.split("-")[0]] === 'undefined') ? 0 : cobj2[disn.split("-")[0]][0][2]]);
                            if (typeof rtkobj2[disn.split("-")[0]] !== 'undefined')
                                rdata.push([disn.split("-")[0], (typeof rtkobj2[disn.split("-")[0]] === 'undefined') ? 0 : rtkobj2[disn.split("-")[0]][0][2]]);
                            if (typeof rdtobj2[disn.split("-")[0]] !== 'undefined')
                                rddata.push([disn.split("-")[0], (typeof rdtobj2[disn.split("-")[0]] === 'undefined') ? 0 : rdtobj2[disn.split("-")[0]][0][2]]);
                        }

                    } else if(ol == "Subcounty"){

                    } else if(ol == "Facility"){

                    }
                });
            });

            drawMap(data);

            $('.select li').first().click(function(){
                //alert('First');

                cat = 'Adults';

                var atobj = aobj;
                var colname = 'Clients (at risk) - Adults';
                var linename = 'Adult ARVs';

                $('#sn a').attr('data-cat', 'akpi');
                $('#sd a').attr('data-cat', 'akpi');
                $('#rn a').attr('data-cat', 'akpi');
                $('#rd a').attr('data-cat', 'akpi');
                $('#rm a').attr('data-cat', 'akpi');

                $('#sr').html(robj[0][0]); $('#sn a').html(robj[0][1]); $('#sd a').html(robj[0][2]); $('#si').html(robj[0][3]);
                $('#rr').html(robj[0][4]); $('#rn a').html(robj[0][5]); $('#rd a').html(robj[0][6]); $('#ri').html(robj[0][7]);

                $('.arrow-img').tooltip();

                drawBarChart(obj1, obj2, 16);
                drawMap(data);
                plotTrends(atobj, colname, linename, "ARV");
                dtable.column(1).data().search("Adult").draw();
                orgsmrytable.column(0).data().search("STKA").draw();

            });

            $('.select li:nth-child(2)').click(function(){
                //alert('Last');

                cat = 'Paediatrics';

                var ptobj = pobj;
                var colname = 'Clients (at risk) - Paediatrics';
                var linename = 'Paediatric ARVs';

                $('#sn a').attr('data-cat', 'pkpi');
                $('#sd a').attr('data-cat', 'pkpi');
                $('#rn a').attr('data-cat', 'pkpi');
                $('#rd a').attr('data-cat', 'pkpi');
                $('#rm a').attr('data-cat', 'pkpi');

                $('#sr').html(robj[1][0]); $('#sn a').html(robj[1][1]); $('#sd a').html(robj[1][2]); $('#si').html(robj[1][3]);
                $('#rr').html(robj[1][4]); $('#rn a').html(robj[1][5]); $('#rd a').html(robj[1][6]); $('#ri').html(robj[1][7]);

                $('.arrow-img').tooltip();

                drawBarChart(cobj1, cobj2, 11);
                drawMap(cdata);
                plotTrends(ptobj, colname, linename, "ARV");
                dtable.column(1).data().search("Paediatric").draw();
                orgsmrytable.column(0).data().search("STKC").draw();
                //dtable.clear().draw();

            });

            $('.select li:nth-child(3)').click(function(){
                //alert('Last');

                cat = 'RTKS';

                var rtobj = rtksobj;
                //var colname = 'Clients (at risk) - RTKS';
                var linename = 'RTKS';

                $('#sn a').attr('data-cat', 'rkpi');
                $('#sd a').attr('data-cat', 'rkpi');
                $('#rn a').attr('data-cat', 'rkpi');
                $('#rd a').attr('data-cat', 'rkpi');
                $('#rm a').attr('data-cat', 'rkpi');

                $('#sr').html(robj[2][0]); $('#sn a').html(robj[2][1]); $('#sd a').html(robj[2][2]); $('#si').html(robj[2][3]);
                $('#rr').html(robj[2][4]); $('#rn a').html(robj[2][5]); $('#rd a').html(robj[2][6]); $('#ri').html(robj[2][7]);

                $('.arrow-img').tooltip();

                drawBarChart(rtkobj1, rtkobj2, 4);
                drawMap(rdata);
                plotTrends(rtobj, colname, linename, "RTKS");
                dtable.column(1).data().search("RTKS").draw();
                orgsmrytable.column(0).data().search("RTK").draw();

            });

            $('.select li').last().click(function(){
                //alert('Last');
                
                cat = 'RDTS';

                var rdtobj = rdtsobj;
                //var colname = 'Clients (at risk) - RDTS';
                var linename = 'RDTS';

                $('#sn a').attr('data-cat', 'rdkpi');
                $('#sd a').attr('data-cat', 'rdkpi');
                $('#rn a').attr('data-cat', 'rdkpi');
                $('#rd a').attr('data-cat', 'rdkpi');
                $('#rm a').attr('data-cat', 'rdkpi');

                $('#sr').html(robj[3][0]); $('#sn a').html(robj[3][1]); $('#sd a').html(robj[3][2]); $('#si').html(robj[3][3]);
                $('#rr').html(robj[3][4]); $('#rn a').html(robj[3][5]); $('#rd a').html(robj[3][6]); $('#ri').html(robj[3][7]);

                $('.arrow-img').tooltip();

                drawBarChart(rdtobj1, rdtobj2, 12); //12 commodities + 6 Results data
                drawMap(rddata);
                plotTrends(rdtobj, colname, linename, "RDTS");
                dtable.column(1).data().search("RDTS").draw();
                orgsmrytable.column(0).data().search("RDT").draw();
                
            });
        });

    </script>

    <?php

        require_once ("src/commons/db.php");

        $org = '';
        $per = '';
        $yr = 2017;
        $wk = 1;
        $on = '';
        $orgunits = array();

        if(isset($_GET['w']) && isset($_GET['o'])){

            $per = "";
            //Current Week
            $cwk = pg_escape_string($_GET['cw']);

            $wk = pg_escape_string($_GET['wn']);
            $org = pg_escape_string($_GET['o']);
            $per = pg_escape_string($_GET['w']);
            $ol = pg_escape_string($_GET['ol']);
            $yr = date('Y');
            if($per == $cwk){
                $per = $yr . "W". $wk;
            }

        }else{

            $cur = "SELECT DISTINCT weekno, week, yr FROM staging.rass_kpi_stka_w
                    WHERE level = 'National'
                    AND (CASE WHEN yr = EXTRACT(YEAR FROM NOW()) AND weekno > EXTRACT(WEEK FROM NOW()) - 1 THEN 0 ELSE 1 END) = 1
                    ORDER BY yr DESC, weekno DESC LIMIT 1;";
            //$cur = "SELECT EXTRACT(YEAR FROM NOW()) AS yr, (EXTRACT(WEEK FROM NOW()) - 1) AS weekno;";
            $onerow = pg_fetch_array(pg_query($db, $cur));

            $org = 'akV6429SUqu'; $orgname = 'Uganda';

            $per = $onerow['yr'] . 'W' . $onerow['weekno'];
            //For displaying current week (w) but data is for previous week (w-1)
            $cper = $onerow['yr'] . 'W' . ($onerow['weekno'] + 1);

            $yr = $onerow['yr'];
            $wk = $onerow['weekno'];
            $ol = "National";
        }

        //$orgunits = array();
        //All RASS orgunits
        $org_qry  = "SELECT * FROM staging.rass_reporting_orgs_m ORDER BY region, district, subcounty, hf;";
        $res_org = pg_query($db, $org_qry);

        while($orgs = pg_fetch_array($res_org)) {
            $orgunits["$orgs[region]-$orgs[ruid]"]["$orgs[district]-$orgs[duid]"]["$orgs[subcounty]-$orgs[suid]"][] = array($orgs['uid'], str_replace("'", "", $orgs['hf']));
        }
        //$json = json_encode($orgunits);

        //Default orgunit number per region
        $orgunitno_qry = "SELECT count(*) as no FROM staging.rass_reporting_orgs WHERE nuid = '$org' OR ruid = '$org' OR duid = '$org';";
        $res_orgunitno = pg_fetch_array(pg_query($db, $orgunitno_qry));


        //STKA KPIs

        //National Level
        $sql = "SELECT * FROM staging.rass_kpi_stka_w WHERE uid = '$org' AND week = '$per';";
        //Regional Level
        $sql1 = "SELECT * FROM staging.rass_kpi_stka_w WHERE level = 'Regional' AND week = '$per' ORDER BY entity;";
        //District Level
        $sql2 = "SELECT * FROM staging.rass_kpi_stka_w WHERE level = 'District' AND  week = '$per' ORDER BY entity;";

        //STKC KPIs

        //National Level
        $csql = "SELECT * FROM staging.rass_kpi_stkc_w WHERE uid = '$org' AND week = '$per';";
        //Regional Level
        $csql1 = "SELECT * FROM staging.rass_kpi_stkc_w WHERE level = 'Regional' AND week = '$per' ORDER BY entity;";
        //District Level
        $csql2 = "SELECT * FROM staging.rass_kpi_stkc_w WHERE level = 'District' AND  week = '$per' ORDER BY entity;";

        //RTK KPIs

        //National Level
        $rsql = "SELECT * FROM staging.rass_kpi_rtks_w WHERE uid = '$org' AND week = '$per';";
        //Regional Level
        $rsql1 = "SELECT * FROM staging.rass_kpi_rtks_w WHERE level = 'Regional' AND week = '$per' ORDER BY entity;";
        //District Level
        $rsql2 = "SELECT * FROM staging.rass_kpi_rtks_w WHERE level = 'District' AND  week = '$per' ORDER BY entity;";

        //RDT KPIs

        //National Level
        $rdsql = "SELECT * FROM staging.rass_kpi_stk_w WHERE uid = '$org' AND week = '$per';";
        //Regional Level
        $rdsql1 = "SELECT * FROM staging.rass_kpi_stk_w WHERE level = 'Regional' AND week = '$per' ORDER BY entity;";
        //District Level
        $rdsql2 = "SELECT * FROM staging.rass_kpi_stk_w WHERE level = 'District' AND  week = '$per' ORDER BY entity;";

        //Trends Data
        //Adults
        $asql = "SELECT lw.week as wk, * FROM staging.last_12_wks (". $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stka_w w
                ON w.week = lw.week  AND uid = '$org' OR entity IS NULL ORDER BY lw.id;";
        //Paeds
        $psql = "SELECT lw.week as wk, * FROM staging.last_12_wks (" . $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stkc_w w
                ON w.week = lw.week  AND uid = '$org' OR entity IS NULL ORDER BY lw.id;";
        //RTKs
        $rtksql = "SELECT lw.week as wk, * FROM staging.last_12_wks (" . $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_rtks_w w
                    ON w.week = lw.week  AND uid = '$org' OR entity IS NULL ORDER BY lw.id;";
        //RDTs
        $rdtsql = "SELECT lw.week as wk, * FROM staging.last_12_wks (" . $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stk_w w
                    ON w.week = lw.week  AND uid = '$org' OR entity IS NULL ORDER BY lw.id;";

        //Retrieve Org Summaries
        $qry_orgsmry_a = "SELECT
                                level,
                                SUM(count) As num,
                                MAX(
                                CASE WHEN ouid = 'sIbY5kh15sT' THEN count ELSE 0 END
                                ) AS pnfp,
                                MAX(
                                CASE WHEN ouid = '2JWKwteWFo3' THEN count ELSE 0 END
                                ) AS pfp,
                                MAX(
                                CASE WHEN ouid = 'uzg9rPxGZgq' THEN count ELSE 0 END
                                ) AS govt,
                                MAX(
                                CASE WHEN ouid = 'VgJIIy7pbvE' THEN count ELSE 0 END
                                ) AS ngo
                                FROM
                                (
                                SELECT level, ouid, count(*) FROM staging.weekly_data_smry_a 
                                WHERE weekno = $wk and yr = $yr AND (cuid = '$org' OR ruid = '$org' OR duid = '$org') GROUP BY level, ouid ORDER BY level
                                )tbl
                                GROUP BY level";
        $qry_orgsmry_c = "SELECT
                                level,
                                SUM(count) As num,
                                MAX(
                                CASE WHEN ouid = 'sIbY5kh15sT' THEN count ELSE 0 END
                                ) AS pnfp,
                                MAX(
                                CASE WHEN ouid = '2JWKwteWFo3' THEN count ELSE 0 END
                                ) AS pfp,
                                MAX(
                                CASE WHEN ouid = 'uzg9rPxGZgq' THEN count ELSE 0 END
                                ) AS govt,
                                MAX(
                                CASE WHEN ouid = 'VgJIIy7pbvE' THEN count ELSE 0 END
                                ) AS ngo
                                FROM
                                (
                                SELECT level, ouid, count(*) FROM staging.weekly_data_smry_c 
                                WHERE weekno = $wk and yr = $yr AND (cuid = '$org' OR ruid = '$org' OR duid = '$org') GROUP BY level, ouid ORDER BY level
                                )tbl
                                GROUP BY level";
        $qry_orgsmry_r = "SELECT
                                level,
                                SUM(count) As num,
                                MAX(
                                CASE WHEN ouid = 'sIbY5kh15sT' THEN count ELSE 0 END
                                ) AS pnfp,
                                MAX(
                                CASE WHEN ouid = '2JWKwteWFo3' THEN count ELSE 0 END
                                ) AS pfp,
                                MAX(
                                CASE WHEN ouid = 'uzg9rPxGZgq' THEN count ELSE 0 END
                                ) AS govt,
                                MAX(
                                CASE WHEN ouid = 'VgJIIy7pbvE' THEN count ELSE 0 END
                                ) AS ngo
                                FROM
                                (
                                SELECT level, ouid, count(*) FROM staging.weekly_data_smry_rtks 
                                WHERE weekno = $wk and yr = $yr AND (cuid = '$org' OR ruid = '$org' OR duid = '$org') GROUP BY level, ouid ORDER BY level
                                )tbl
                                GROUP BY level";
                $qry_orgsmry_r = "SELECT
                                level,
                                SUM(count) As num,
                                MAX(
                                CASE WHEN ouid = 'sIbY5kh15sT' THEN count ELSE 0 END
                                ) AS pnfp,
                                MAX(
                                CASE WHEN ouid = '2JWKwteWFo3' THEN count ELSE 0 END
                                ) AS pfp,
                                MAX(
                                CASE WHEN ouid = 'uzg9rPxGZgq' THEN count ELSE 0 END
                                ) AS govt,
                                MAX(
                                CASE WHEN ouid = 'VgJIIy7pbvE' THEN count ELSE 0 END
                                ) AS ngo
                                FROM
                                (
                                SELECT level, ouid, count(*) FROM staging.weekly_data_smry_rtks 
                                WHERE weekno = $wk and yr = $yr AND (cuid = '$org' OR ruid = '$org' OR duid = '$org') GROUP BY level, ouid ORDER BY level
                                )tbl
                                GROUP BY level";
                $qry_orgsmry_rd = "SELECT
                                level,
                                SUM(count) As num,
                                MAX(
                                CASE WHEN ouid = 'sIbY5kh15sT' THEN count ELSE 0 END
                                ) AS pnfp,
                                MAX(
                                CASE WHEN ouid = '2JWKwteWFo3' THEN count ELSE 0 END
                                ) AS pfp,
                                MAX(
                                CASE WHEN ouid = 'uzg9rPxGZgq' THEN count ELSE 0 END
                                ) AS govt,
                                MAX(
                                CASE WHEN ouid = 'VgJIIy7pbvE' THEN count ELSE 0 END
                                ) AS ngo
                                FROM
                                (
                                SELECT level, ouid, count(*) FROM staging.stk 
                                WHERE weekno = $wk and yr = $yr AND (cuid = '$org' OR ruid = '$org' OR duid = '$org') GROUP BY level, ouid ORDER BY level
                                )tbl
                                GROUP BY level";

        //Adults national, regional and district data queries
        $res = pg_query($db, $sql);
        $res1 = pg_query($db, $sql1);
        $res2 = pg_query($db, $sql2);
        //Paeds national, regional and district data queries                            
        $cres = pg_query($db, $csql);
        $cres1 = pg_query($db, $csql1);
        $cres2 = pg_query($db, $csql2);
        //RTK national, regional and district data queries
        $rres = pg_query($db, $rsql);
        $rres1 = pg_query($db, $rsql1);
        $rres2 = pg_query($db, $rsql2);
        //RDT national, regional and district data queries
        $rdres = pg_query($db, $rdsql);
        $rdres1 = pg_query($db, $rdsql1);
        $rdres2 = pg_query($db, $rdsql2);
        //Trends data queries, Adults, Paeds, RTKs and RDTs
        $ares = pg_query($db, $asql);
        $pres = pg_query($db, $psql);
        $rtkres = pg_query($db, $rtksql);
        $rdtres = pg_query($db, $rdtsql);

        if(!$res) {
            echo pg_last_error($db);
            exit;
        }
        //$numrows = pg_numrows($res);

        $wdata = array();
        //Level data KPIs; Regional, District
        //STKA
        $reg = array();
        $dis = array();
        //STKC
        $creg = array();
        $cdis = array();
        //RTKS
        $rreg = array();
        $rdis = array();
        //RDTs
        $rdreg = array();
        $rddis = array();

        //(int)$res_orgunitno['no'], array(0, (int)$res_orgunitno['no'], 0)
        $reports = array(); //Adult report indicators
        $preports = array(); //Paediatric report indicators
        $rreports = array(); //RTK report indicators
        $rdreports = array(); //RDT report indicators
        //Initialize the reports arrays with number of expected reports
        if(pg_num_rows($res) <= 0) $reports = array(0, (int)$res_orgunitno['no'], 0);
        if(pg_num_rows($cres) <= 0) $preports = array(0, (int)$res_orgunitno['no'], 0);
        if(pg_num_rows($rres) <= 0) $rreports = array(0, (int)$res_orgunitno['no'], 0);
        if(pg_num_rows($rdres) <= 0) $rdreports = array(0, (int)$res_orgunitno['no'], 0);

        //STKA data
        while($row = pg_fetch_array($res)) {

            //reset arary;

            $reports[] = $row['receivedreports'];
            $reports[] = $row['expectedreports'];
            $reports[] = $row['rso'];

            $wdata[] = array("Nevirapine (NVP)", "Adult", $row['a'], $row['aamc'], $row['au'], $row['an'], $row['am'], $row['ao'], abs($row['aa']), 'a', $row['receivedreports']);
            $wdata[] = array("Efavirenz (EFV)", "Adult", $row['b'], $row['bamc'], $row['bu'], $row['bn'], $row['bm'], $row['bo'], abs($row['ba']), 'b', $row['receivedreports']);
            $wdata[] = array("Abacavir (ABC)", "Adult", $row['c'], $row['camc'], $row['cu'], $row['cn'], $row['cm'], $row['co'], abs($row['ca']), 'c', $row['receivedreports']);
            $wdata[] = array("Etravirine (ETV)", "Adult", $row['d'], $row['damc'], $row['du'], $row['dn'], $row['dm'], $row['do'], abs($row['da']), 'd', $row['receivedreports']);
            $wdata[] = array("Lamivudine (3TC)", "Adult", $row['e'], $row['eamc'], $row['eu'], $row['en'], $row['em'], $row['eo'], abs($row['ea']), 'e', $row['receivedreports']);
            $wdata[] = array("Zidovudine (AZT)", "Adult", $row['f'], $row['famc'], $row['fu'], $row['fn'], $row['fm'], $row['fo'], abs($row['fa']), 'f', $row['receivedreports']);
            $wdata[] = array("Raltegravir (RAL)", "Adult", $row['g'], $row['gamc'], $row['gu'], $row['gn'], $row['gm'], $row['go'], abs($row['ga']), 'g', $row['receivedreports']);
            $wdata[] = array("Atazanavir (ATV)", "Adult", $row['h'], $row['hamc'], $row['hu'], $row['hn'], $row['hm'], $row['ho'], abs($row['ha']), 'h', $row['receivedreports']);
            $wdata[] = array("Ritonavir (RTV)", "Adult", $row['i'], $row['iamc'], $row['iu'], $row['in'], $row['im'], $row['io'], abs($row['ia']), 'i', $row['receivedreports']);
            $wdata[] = array("Darunavir (DRV) 300mg", "Adult", $row['j'], $row['jamc'], $row['ju'], $row['jn'], $row['jm'], $row['jo'], abs($row['ja']), 'j', $row['receivedreports']);
            $wdata[] = array("Abacavir/Lamivudine (ABC/3TC)", "Adult", $row['k'], $row['kamc'], $row['ku'], $row['kn'], $row['km'], $row['ko'], abs($row['ka']), 'k', $row['receivedreports']);
            $wdata[] = array("Zidovudine/Lamivudine (AZT/3TC)", "Adult", $row['l'], $row['lamc'], $row['lu'], $row['ln'], $row['lm'], $row['lo'], abs($row['la']), 'l', $row['receivedreports']);
            $wdata[] = array("Tenovofir/ Lamivudine (TDF/3TC)", "Adult", $row['m'], $row['mamc'], $row['mu'], $row['mn'], $row['mm'], $row['mo'], abs($row['ma']), 'm', $row['receivedreports']);
            $wdata[] = array("Lopinavir/Ritonavir (LPV/r)", "Adult", $row['n'], $row['namc'], $row['nu'], $row['nn'], $row['nm'], $row['no'], abs($row['na']), 'n', $row['receivedreports']);
            $wdata[] = array("Atazanavir/Ritonavir (ATV/r)", "Adult", $row['o'], $row['oamc'], $row['ou'], $row['on'], $row['om'], $row['oo'], abs($row['oa']), 'o', $row['receivedreports']);
            $wdata[] = array("Zidovudine/Lamivudine/Nevirapine (AZT/3TC/NVP)", "Adult", $row['p'], $row['pamc'], $row['pu'], $row['pn'], $row['pm'], $row['po'], abs($row['pa']), 'p', $row['receivedreports']);
            $wdata[] = array("Tenovofir/Lamivudine/Efavirenz (TDF/3TC/EFV)", "Adult", $row['q'], $row['qamc'], $row['qu'], $row['qn'], $row['qm'], $row['qo'], abs($row['qa']), 'q', $row['receivedreports']);
            //$wdata[] = array("TDF/3TC + NVP", "Adult", $row['r'], $row['ramc'], $row['ru'], $row['rn'], $row['rm'], $row['ro'], abs($row['ra']), 'r');
            $wdata[] = array("Dolutegravir (DTG)", "Adult", $row['s'], $row['samc'], $row['su'], $row['sn'], $row['sm'], $row['so'], abs($row['sa']), 's', $row['receivedreports']);
            $wdata[] = array("Tenofovir/Lamivudine/Dolutegravir (TDF/3TC/DTG)", "Adult", $row['t'], $row['tamc'], $row['tu'], $row['tn'], $row['tm'], $row['to'], abs($row['ta']), 't', $row['receivedreports']);
            $wdata[] = array("Darunavir (DRV) 600mg", "Adult", $row['u'], $row['uamc'], $row['uu'], $row['un'], $row['um'], $row['uo'], abs($row['ua']), 'u', $row['receivedreports']);
            $wdata[] = array("Darunavir (DRV) 150mg", "Adult", $row['v'], $row['vamc'], $row['vu'], $row['vn'], $row['vm'], $row['vo'], abs($row['va']), 'v', $row['receivedreports']);

        }
        //print_r($reports)
        //STKC data
        while($crow = pg_fetch_array($cres)) {

            $preports[] = $crow['receivedreports'];
            $preports[] = $crow['expectedreports'];
            $preports[] = $crow['rso'];

            $wdata[] = array("Nevirapine (NVP) 50mg", "Paediatric", $crow['a'], $crow['aamc'], $crow['au'], $crow['an'], $crow['am'], $crow['ao'], abs($crow['aa']), 'a', $crow['receivedreports']);
            $wdata[] = array("Nevirapine (NVP) 10mg/ml (240ml)", "Paediatric", $crow['b'], $crow['bamc'], $crow['bu'], $crow['bn'], $crow['bm'], $crow['bo'], abs($crow['ba']), 'b', $crow['receivedreports']);
            $wdata[] = array("Nevirapine (NVP) 10mg/ml (100ml)", "Paediatric", $crow['c'], $crow['camc'], $crow['cu'], $crow['cn'], $crow['cm'], $crow['co'], abs($crow['ca']), 'c', $crow['receivedreports']);
            $wdata[] = array("Efavirenz (EFV) 200mg", "Paediatric", $crow['d'], $crow['damc'], $crow['du'], $crow['dn'], $crow['dm'], $crow['do'], abs($crow['da']), 'd', $crow['receivedreports']);
            $wdata[] = array("Efavirenz (EFV) 50mg", "Paediatric", $crow['e'], $crow['eamc'], $crow['eu'], $crow['en'], $crow['em'], $crow['eo'], abs($crow['ea']), 'e', $crow['receivedreports']);
            $wdata[] = array("Abacavir (ABC) 60mg", "Paediatric", $crow['f'], $crow['famc'], $crow['fu'], $crow['fn'], $crow['fm'], $crow['fo'], abs($crow['fa']), 'f', $crow['receivedreports']);
            $wdata[] = array("Abacavir (ABC) 20mg/ml", "Paediatric", $crow['g'], $crow['gamc'], $crow['gu'], $crow['gn'], $crow['gm'], $crow['go'], abs($crow['ga']), 'g', $crow['receivedreports']);
            $wdata[] = array("Zidovudine (AZT) 100mg", "Paediatric", $crow['h'], $crow['hamc'], $crow['hu'], $crow['hn'], $crow['hm'], $crow['ho'], abs($crow['ha']), 'h', $crow['receivedreports']);
            $wdata[] = array("Zidovudine (AZT) 60mg", "Paediatric", $crow['i'], $crow['iamc'], $crow['iu'], $crow['in'], $crow['im'], $crow['io'], abs($crow['ia']), 'i', $crow['receivedreports']);
            $wdata[] = array("Abacavir/Lamivudine (ABC/3TC) 120/60mg", "Paediatric", $crow['j'], $crow['jamc'], $crow['ju'], $crow['jn'], $crow['jm'], $crow['jo'], abs($crow['ja']), 'j', $crow['receivedreports']);
            $wdata[] = array("Abacavir/Lamivudine (ABC/3TC) 60/30mg", "Paediatric", $crow['k'], $crow['kamc'], $crow['ku'], $crow['kn'], $crow['km'], $crow['ko'], abs($crow['ka']), 'k', $crow['receivedreports']);
            $wdata[] = array("Zidovudine/Lamivudine (AZT/3TC) 60/30mg", "Paediatric", $crow['l'], $crow['lamc'], $crow['lu'], $crow['ln'], $crow['lm'], $crow['lo'], abs($crow['la']), 'l', $crow['receivedreports']);
            $wdata[] = array("Lopinavir/Ritonavir (LPV/r) 100/25mg", "Paediatric", $crow['m'], $crow['mamc'], $crow['mu'], $crow['mn'], $crow['mm'], $crow['mo'], abs($crow['ma']), 'm', $crow['receivedreports']);
            $wdata[] = array("Lopinavir/Ritonavir (LPV/r) 80/20mg (300ml)", "Paediatric", $crow['n'], $crow['namc'], $crow['nu'], $crow['nn'], $crow['nm'], $crow['no'], abs($crow['na']), 'n', $crow['receivedreports']);
            $wdata[] = array("Lopinavir/Ritonavir (LPV/r) 40/10mg (Oral Pellets)", "Paediatric", $crow['o'], $crow['oamc'], $crow['ou'], $crow['on'], $crow['om'], $crow['oo'], abs($crow['oa']), 'o', $crow['receivedreports']);
            $wdata[] = array("Zidovudine/Lamivudine/Nevirapine (AZT/3TC/NVP)", "Paediatric", $crow['p'], $crow['pamc'], $crow['pu'], $crow['pn'], $crow['pm'], $crow['po'], abs($crow['pa']), 'p', $crow['receivedreports']);
            $wdata[] = array("Darunavir (DRV) 75mg", "Paediatric", $crow['q'], $crow['qamc'], $crow['qu'], $crow['qn'], $crow['qm'], $crow['qo'], abs($crow['qa']), 'q', $crow['receivedreports']);
            $wdata[] = array("Raltegravir (RAL) 100mg", "Paediatric", $crow['r'], $crow['ramc'], $crow['ru'], $crow['rn'], $crow['rm'], $crow['ro'], abs($crow['ra']), 'r', $crow['receivedreports']);
            $wdata[] = array("Etravirine (ETV) 25mg", "Paediatric", $crow['s'], $crow['samc'], $crow['su'], $crow['sn'], $crow['sm'], $crow['so'], abs($crow['sa']), 's', $crow['receivedreports']);

        }

        //RTK data
        while($rrow = pg_fetch_array($rres)) {

            $rreports[] = $rrow['receivedreports'];
            $rreports[] = $rrow['expectedreports'];
            $rreports[] = $rrow['rso'];

            $wdata[] = array("Determine HIV 1/2 Test", "RTKS", $rrow['a'], "N/A", $rrow['au'], $rrow['an'], $rrow['am'], $rrow['ao'], "N/A", 'a', $rrow['receivedreports']);
            $wdata[] = array("Stat-Pak HIV 1+2 Test", "RTKS", $rrow['b'], "N/A", $rrow['bu'], $rrow['bn'], $rrow['bm'], $rrow['bo'], "N/A", 'b', $rrow['receivedreports']);
            $wdata[] = array("Serum cRAG Test kit", "RTKS", $rrow['c'], "N/A", $rrow['cu'], $rrow['cn'], $rrow['cm'], $rrow['co'], "N/A", 'c', $rrow['receivedreports']);
            $wdata[] = array("SD Bioline HIV 1/2 Test", "RTKS", $rrow['d'], "N/A", $rrow['du'], $rrow['dn'], $rrow['dm'], $rrow['do'], "N/A", 'd', $rrow['receivedreports']);

        }

        //RDT and Results data
        while($rrow = pg_fetch_array($rdres)) {

            $rdreports[] = $rrow['receivedreports'];
            $rdreports[] = $rrow['expectedreports'];
            $rdreports[] = 0; //Replace with reported stockout
            //RDT Commodities
            $wdata[] = array("Nasopharyngeal Swab", "RDTS", $rrow['a'], "N/A", 0, 0, 0, 0, "N/A", 'a', $rrow['receivedreports']);
            $wdata[] = array("Oropharyngeal Swab", "RDTS", $rrow['b'], "N/A", 0, 0, 0, 0, "N/A", 'b', $rrow['receivedreports']);
            $wdata[] = array("Standard Q", "RDTS", $rrow['c'], "N/A", 0, 0, 0, 0, "N/A", 'c', $rrow['receivedreports']);
            $wdata[] = array("Abbot Panbio", "RDTS", $rrow['d'], "N/A", 0, 0, 0, 0, "N/A", 'd', $rrow['receivedreports']);
            $wdata[] = array("Abbot Molecular INC. RealTime Sars-CoV-2 Assay", "RDTS", $rrow['e'], "N/A", 0, 0, 0, 0, "N/A", 'e', $rrow['receivedreports']);
            $wdata[] = array("Cobas Sars-CoV-2 Test", $rrow['f'], "N/A", 0, 0, 0, 0, "N/A", 'f', $rrow['receivedreports']);
            $wdata[] = array("Xpert Xpress SARS-CoV-2 Test and AccuPlex", "RDTS", $rrow['g'], "N/A", 0, 0, 0, 0, "N/A", 'g', $rrow['receivedreports']);
            $wdata[] = array("RealStar SARS-CoV-2 RT-PCR Kit 1.0", "RDTS", $rrow['h'], "N/A", 0, 0, 0, 0, "N/A", 'h', $rrow['receivedreports']);
            $wdata[] = array("ABI-7500 Sars COV-2 Test", "RDTS", $rrow['s'], "N/A", 0, 0, 0, 0, "N/A", 's', $rrow['receivedreports']);
            $wdata[] = array("SSIII 1-Step QRT-PCR (500)", "RDTS", $rrow['j'], "N/A", 0, 0, 0, 0, "N/A", 'j', $rrow['receivedreports']);
            $wdata[] = array("QIAamp Qiagen RNA Mini Kit (250)", "RDTS", $rrow['k'], "N/A", 0, 0, 0, 0, "N/A", 'k', $rrow['receivedreports']);
            $wdata[] = array("Hologic  Sars-CoV-2 Test", "RDTS", $rrow['t'], "N/A", 0, 0, 0, 0, "N/A", 't', $rrow['receivedreports']);
            //Results data
            $wdata[] = array("Number of Positives (Antigens)", "RDTS", $rrow['m'], "N/A", 0, 0, 0, 0, "N/A", 'm', $rrow['receivedreports']);
            $wdata[] = array("Number of Negatives (Antigens)", "RDTS", $rrow['n'], "N/A", 0, 0, 0, 0, "N/A", 'n', $rrow['receivedreports']);
            $wdata[] = array("Number of Invalids (Antigens)", "RDTS", $rrow['u'], "N/A", 0, 0, 0, 0, "N/A", 'u', $rrow['receivedreports']);
            $wdata[] = array("Number of Positives (Antibody)", "RDTS", $rrow['p'], "N/A", 0, 0, 0, 0, "N/A", 'p', $rrow['receivedreports']);
            $wdata[] = array("Number of Negatives (Antibody)", "RDTS", $rrow['q'], "N/A", 0, 0, 0, 0, "N/A", 'q', $rrow['receivedreports']);
            $wdata[] = array("Number of Invalids (Antibody)", "RDTS", $rrow['r'], "N/A", 0, 0, 0, 0, "N/A", 'r', $rrow['receivedreports']);

        }

      /*
        if (empty($wdata)){
            //Initilize STKA data;
            $wdata[] = array("NVP", "Adult", 0, 0, 0, 0, 0, 0, 0, 'a'); $wdata[] = array("EFV", "Adult", 0, 0, 0, 0, 0, 0, 0, 'b');
            $wdata[] = array("ABC", "Adult", 0, 0, 0, 0, 0, 0, 0, 'c'); $wdata[] = array("ETV", "Adult", 0, 0, 0, 0, 0, 0, 0, 'd');
            $wdata[] = array("3TC", "Adult", 0, 0, 0, 0, 0, 0, 0, 'e'); $wdata[] = array("AZT", "Adult", 0, 0, 0, 0, 0, 0, 0, 'f');
            $wdata[] = array("RAL", "Adult", 0, 0, 0, 0, 0, 0, 0, 'g'); $wdata[] = array("ATV", "Adult", 0, 0, 0, 0, 0, 0, 0, 'h');
            $wdata[] = array("RTV", "Adult", 0, 0, 0, 0, 0, 0, 0, 'i'); $wdata[] = array("Darunavir", "Adult", 0, 0, 0, 0, 0, 0, 0, 'j');
            $wdata[] = array("ABC/3TC", "Adult", 0, 0, 0, 0, 0, 0, 0, 'k'); $wdata[] = array("AZT/3TC", "Adult", 0, 0, 0, 0, 0, 0, 0, 'l');
            $wdata[] = array("TDF/3TC", "Adult", 0, 0, 0, 0, 0, 0, 0, 'm'); $wdata[] = array("LPV/r", "Adult", 0, 0, 0, 0, 0, 0, 0, 'n');
            $wdata[] = array("ATV/r", "Adult", 0, 0, 0, 0, 0, 0, 0, 'o'); $wdata[] = array("AZT/3TC/NVP", "Adult", 0, 0, 0, 0, 0, 0, 0, 'p');
            $wdata[] = array("TDF/3TC/EFV", "Adult", 0, 0, 0, 0, 0, 0, 0, 'q'); $wdata[] = array("DTG", "Adult", 0, 0, 0, 0, 0, 0, 0, 's');
            $wdata[] = array("TDF/3TC/DTG", "Adult", 0, 0, 0, 0, 0, 0, 0, 't'); $wdata[] = array("DRV 600mg", "Adult", 0, 0, 0, 0, 0, 0, 0, 'u');
            $wdata[] = array("DRV 150mg", "Adult", 0, 0, 0, 0, 0, 0, 0, 'v');
        }
      */

        //Populate Commodity Table on the dashboard.
        $tr = "";
        foreach ($wdata as $item){

            $com = $item[9];
            $cat = $item[1];
            $receivedreports = $item[10];

            $tr .= "<tr>";
            $tr .= "<td>" . $item[0] ."</td>";
            $tr .= "<td>" . $item[1] ."</td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $com ."u' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[4] ."</a> <!--(".round(($item[4]/(empty($receivedreports) ? 1 : $receivedreports))*100,1)."%)--></td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $com ."n' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[5] ."</a> <!--(".round(($item[5]/(empty($receivedreports) ? 1 : $receivedreports))*100,1)."%)--></td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $com ."m' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[6] ."</a> <!--(".round(($item[6]/(empty($receivedreports) ? 1 : $receivedreports))*100,1)."%)--></td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $com ."o' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[7] ."</a> <!--(".round(($item[7]/(empty($receivedreports) ? 1 : $receivedreports))*100,1)."%)--></td>";
            $tr .= "<td>" . $item[3] ."</td>";
            $tr .= "<td>" . $item[8] ."</td>";
            $tr .= "</tr>";
        }

        //$row1 = pg_fetch_array($res1);
        //$row2 = pg_fetch_array($res2);

        ///print_r($wdata);

        //STKA Data --bar graph
        //Regional data KPIs
        while($row1 = pg_fetch_array($res1)){

            $stkouts = $row1['rso'];
            $affc = $row1['aa'] + $row1['ba'] +
                    //$row1['ca'] +
                    $row1['da'] +
                    //$row1['ea'] +
                    $row1['fa'] + $row1['ga'] +
                    //$row1['ha']+ $row1['ia'] + $row1['ja'] +
                    $row1['ka'] + $row1['la'] + $row1['ma'] + $row1['na'] + $row1['oa'] + $row1['pa'] +
                    $row1['qa'] + + $row1['sa'] + $row1['ta'] + $row1['ua'] + $row1['va'];

            $reg["$row1[entity]"] = array((int)$stkouts, (float)$affc / 100, $row1['entity']);
            //$reg[] = array($row1['entity'], (int)$stkouts);
        }
        //District data KPIs
        while($row2 = pg_fetch_array($res2)){

            $stkouts = $row2['rso'];
            $affc = $row2['aa'] + $row2['ba'] +
                    //$row2['ca'] +
                    $row2['da'] +
                    //$row2['ea'] +
                    $row2['fa'] + $row2['ga'] +
                    //$row2['ha']+ $row2['ia'] + $row2['ja'] +
                    $row2['ka'] + $row2['la'] + $row2['ma'] + $row2['na'] + $row2['oa'] + $row2['pa'] +
                    $row2['qa']  + $row2['sa'] + $row2['ta'] + $row2['ua'] + $row2['va'];

            $dis["$row2[entity]"] = array(
                    array((int)$stkouts, (int)$affc, round(($stkouts * 100) / $row2['receivedreports']), $row2['entity'], $row2['uid']),
                    array("NVP", (int)$row2['ao'], (int)$row2['aa']),
                    array("DTG", (int)$row2['so'], (int)$row2['sa']),
                    array("DRV 600mg", (int)$row2['uo'], (int)$row2['ua']),
                    array("DRV 150mg", (int)$row2['vo'], (int)$row2['va']),
                    array("EFV", (int)$row2['bo'], (int)$row2['ba']),
                    //array("ABC", (int)$row2['co'], (int)$row2['ca']),
                    array("ETV", (int)$row2['do'], (int)$row2['da']),
                    //array("3TC", (int)$row2['eo'], (int)$row2['ea']),
                    array("AZT", (int)$row2['fo'], (int)$row2['fa']),
                    array("RAL", (int)$row2['go'], (int)$row2['ga']),
                    //array("ATV", (int)$row2['ho'], (int)$row2['ha']),
                    //array("RTV", (int)$row2['io'], (int)$row2['ia']),
                    //array("Darunavir", (int)$row2['jo'], (int)$row2['ja']),
                    array("ABC/3TC", (int)$row2['ko'], (int)$row2['ka']),
                    array("AZT/3TC", (int)$row2['lo'], (int)$row2['la']),
                    array("TDF/3TC", (int)$row2['mo'], (int)$row2['ma']),
                    array("LPV/r", (int)$row2['no'], (int)$row2['na']),
                    array("ATV/r", (int)$row2['oo'], (int)$row2['oa']),
                    array("AZT/3TC/NVP", (int)$row2['po'], (int)$row2['pa']),
                    array("TDF/3TC/EFV", (int)$row2['qo'], (int)$row2['qa']),
                    array("TDF/3TC/DTG", (int)$row2['to'], (int)$row2['ta'])
            );
        }

        //STKC Data - bar graph
        //Regional data KPIs
        while($crow1 = pg_fetch_array($cres1)){

            $stkouts = $crow1['rso'];
            $affc = $crow1['aa'] + $crow1['ba'] + $crow1['ca'] + $crow1['da'] +
                    //$crow1['ea'] +
                    $crow1['fa'] +
                    //$crow1['ga'] + $crow1['ha']+ $crow1['ia'] +
                    $crow1['ja'] +
                    //$crow1['ka'] +
                    $crow1['la'] + $crow1['ma'] +
                    //$crow1['na'] +
                    $crow1['oa'] + $crow1['pa']+
                    $crow1['qa'] + $crow1['ra'] + $crow1['sa'];

            $creg["$crow1[entity]"] = array((int)$stkouts, (float)$affc / 100);
        }
        //District data KPIs
        while($crow2 = pg_fetch_array($cres2)){

            $stkouts = $crow2['rso'];
            $affc = $crow2['aa'] + $crow2['ba'] + $crow2['ca'] + $crow2['da'] +
                //$crow2['ea'] +
                $crow2['fa'] +
                //$crow2['ga'] + $crow2['ha']+ $crow2['ia'] +
                $crow2['ja'] +
                //$crow2['ka'] +
                $crow2['la'] + $crow2['ma'] +
                //$crow2['na'] +
                $crow2['oa'] + $crow2['pa']+
                $crow2['qa'] + $crow2['ra'] + $crow2['sa'];

            $cdis["$crow2[entity]"] = array(
                array((int)$stkouts, (int)$affc, round(($stkouts * 100) / $crow2['receivedreports'])),
                array("NVP 50mg", (int)$crow2['ao'], (int)$crow2['aa']),
                array("NVP 10mg/ml (240ml)", (int)$crow2['bo'], (int)$crow2['ba']),
                array("NVP 10mg/ml (100ml)", (int)$crow2['co'], (int)$crow2['ca']),
                array("EFV 200mg", (int)$crow2['do'], (int)$crow2['da']),
                //array("EFV 50mg", (int)$crow2['eo'], (int)$crow2['ea']),
                array("ABC 60mg", (int)$crow2['fo'], (int)$crow2['fa']),
                //array("ABC 20mg/ml", (int)$crow2['go'], (int)$crow2['ga']),
                //array("AZT 100mg", (int)$crow2['ho'], (int)$crow2['ha']),
                //array("AZT 60mg", (int)$crow2['io'], (int)$crow2['ia']),
                array("ABC/3TC 120/60mg", (int)$crow2['jo'], (int)$crow2['ja']),
                //array("ABC/3TC 60/30mg", (int)$crow2['ko'], (int)$crow2['ka']),
                array("AZT/3TC 60/30mg", (int)$crow2['lo'], (int)$crow2['la']),
                array("LPV/r 100/25mg", (int)$crow2['mo'], (int)$crow2['ma']),
                //array("LPV/r 80/20mg (300ml)", (int)$crow2['no'], (int)$crow2['na']),
                array("LPV/r 40/10mg (Oral Pellets)", (int)$crow2['oo'], (int)$crow2['oa']),
                array("AZT/3TC/NVP", (int)$crow2['po'], (int)$crow2['pa']),
                array("DRV 75mg", (int)$crow2['qo'], (int)$crow2['qa']),
                array("RAL 100mg", (int)$crow2['ro'], (int)$crow2['ra']),
                array("ETV 25mg", (int)$crow2['so'], (int)$crow2['sa'])
            );
        }

        //RTK Data - bar graph
        //Regional data KPIs
        while($rrow1 = pg_fetch_array($rres1)){

            $stkouts = $rrow1['rso'];
            $affc = 0;

            $rreg["$rrow1[entity]"] = array((int)$stkouts, $affc);
        }
        //District data KPIs
        while($rrow2 = pg_fetch_array($rres2)){

            $stkouts = $rrow2['rso'];
            $affc = 0;

            $rdis["$rrow2[entity]"] = array(
                array((int)$stkouts, (int)$affc, round(($stkouts * 100) / $rrow2['receivedreports'])),
                array("Determine HIV 1/2 Test", (int)$rrow2['ao'], 0),
                array("Stat-Pak HIV 1+2 Test", (int)$rrow2['bo'], 0),
                array("Serum cRAG Test kit", (int)$rrow2['co'], 0),
                array("SD Bioline HIV 1/2 Test", (int)$rrow2['do'], 0)
            );
        }

        //RDT Data - bar graph
        //Regional data KPIs
        while($rrow1 = pg_fetch_array($rdres1)){

            $stkouts = 0; //$rrow1['rso']; //Replace with rso once available
            $affc = 0;

            $rdreg["$rrow1[entity]"] = array((int)$stkouts, $affc);
        }
        //District data KPIs
        while($rrow2 = pg_fetch_array($rdres2)){

            $stkouts = 0; //$rrow2['rso']; //Replace with rso once available
            $affc = 0;

            $rddis["$rrow2[entity]"] = array(
                array((int)$stkouts, (int)$affc, round(($stkouts * 100) / $rrow2['receivedreports'])),
                array("Nasopharyngeal Swab", 0, 0),
                array("Oropharyngeal Swab", 0, 0),
                array("Standard Q", 0, 0),
                array("Abbot Panbio", 0, 0),
                array("Abbot Molecular INC. RealTime Sars-CoV-2 Assay", 0, 0),
                array("Cobas Sars-CoV-2 Test", 0, 0),
                array("Xpert Xpress SARS-CoV-2 Test and AccuPlex", 0, 0),
                array("RealStar SARS-CoV-2 RT-PCR Kit 1.0", 0, 0),
                array("ABI- 7500 Sars COV-2 Test", 0, 0),
                array("SSIII 1-Step QRT-PCR (500)", 0, 0),
                array("QIAamp Qiagen RNA Mini Kit (250)", 0, 0),
                array("Hologic  Sars-CoV-2 Test", 0, 0)
            );
        }

        //Data For the Trends Graph
        //$ares = pg_query($db, $asql);
        //$pres = pg_query($db, $psql);
        $atrends = array();
        $ptrends = array();
        $rtrends = array();
        $rdtrends = array();
        //Adult Trends
        while($arow = pg_fetch_array($ares)){
            //stock outs per week
            if ($arow['receivedreports'] > 0)
                $stkouts = round(($arow['rso'] / $arow['receivedreports']) * 100, 1);
            else
                $stkouts = 0;
            //Reporting rates per week
            if ($arow['expectedreports'] > 0)
                $reportrates = round(($arow['receivedreports'] / $arow['expectedreports']) * 100, 1);
            else
                $reportrates = 0;
            //affected clients per week
            $clients = $arow['aa'] + $arow['ba'] +
                //$arow['ca'] +
                $arow['da'] +
                //$arow['ea'] +
                $arow['fa'] + $arow['ga'] +
                //$arow['ha'] + $arow['ia'] + $arow['ja'] +
                $arow['ka'] +
                $arow['la'] + $arow['ma'] + $arow['na'] + $arow['oa'] + $arow['pa'] + $arow['qa'] +
                $arow['ra'];

            $atrends[] = array($arow['wk'], (float)$stkouts, (int)$clients, (int)$arow['receivedreports'],
                        (int)$arow['expectedreports'], (float)$reportrates);

        }

        //Paediatric Trends
        while($prow = pg_fetch_array($pres)){
            //stock outs per week
            if ($prow['receivedreports'] > 0)
                $stkouts = round(($prow['rso'] / $prow['receivedreports']) * 100, 1);
            else
                $stkouts = 0;
            //Reporting rates per week
            if ($prow['expectedreports'] > 0)
                $reportrates = round(($prow['receivedreports'] / $prow['expectedreports']) * 100, 1);
            else
                $reportrates = 0;
            //affected clients per week
            $clients = $prow['aa'] + $prow['ba'] + $prow['ca'] + $prow['da'] +
                //$prow['ea'] +
                $prow['fa'] +
               // $prow['ga'] + $prow['ha'] + $prow['ia'] +
                $prow['ja'] +
                //$prow['ka'] +
                $prow['la'] + $prow['ma'] +
                //$prow['na'] +
                $prow['oa'] + $prow['pa'];

            $ptrends[] = array($prow['wk'], (float)$stkouts, (int)$clients, (int)$prow['receivedreports'],
                (int)$prow['expectedreports'], (float)$reportrates);

        }

        //RTK Trends
        //$rtrends = array('', 0, 0, 0, 0);
        while($rrow = pg_fetch_array($rtkres)){
            //stock out rates per week
            if ($rrow['receivedreports'] > 0)
                $stkouts = round(($rrow['rso'] / $rrow['receivedreports']) * 100, 1);
            else
                $stkouts = 0;
            //Reporting rates per week
            if ($rrow['expectedreports'] > 0)
                $reportrates = round(($rrow['receivedreports'] / $rrow['expectedreports']) * 100, 1);
            else
                $reportrates = 0;
            //affected clients per week
            $clients = 0;

            $rtrends[] = array($rrow['wk'], (float)$stkouts, (int)$clients, (int)$rrow['receivedreports'],
                (int)$rrow['expectedreports'], (float)$reportrates);

        }
        //print_r($rtrends);

        //RDT Trends
        //$rdtrends = array('', 0, 0, 0, 0);
        while($rrow = pg_fetch_array($rdtres)){
            //stock out rates per week
            if ($rrow['receivedreports'] > 0)
                $stkouts = round((0 / $rrow['receivedreports']) * 100, 1); //Replace with 0 with $rrow['rso']
            else
                $stkouts = 0;
            //Reporting rates per week
            if ($rrow['expectedreports'] > 0)
                $reportrates = round(($rrow['receivedreports'] / $rrow['expectedreports']) * 100, 1);
            else
                $reportrates = 0;
            //affected clients per week
            $clients = 0;

            $rdtrends[] = array($rrow['wk'], (float)$stkouts, (int)$clients, (int)$rrow['receivedreports'],
                (int)$rrow['expectedreports'], (float)$reportrates);

        }

        //Stockout/Reporting Rates -STKA
        $snum = $reports[2]; $sden = $reports[0];
        $psrate = $atrends[10][1];
        if($sden != 0)
            $csrate = round(($snum / $sden) * 100, 1);
        else
            $csrate = 0;

        $rnum = $reports[0]; $rden = $reports[1];
        if($atrends[10][4] != 0)
            $prrate = round(($atrends[10][3] / $atrends[10][4]) * 100);
        else
            $prrate = 0;
        if($rden != 0)
            $crrate = round(($rnum / $rden) * 100);
        else
            $crrate = 0;

        $simg = "";
        if ($atrends[11][1] > $atrends[10][1])
            $simg = '<img class = "arrow-img" title = "' . round(($csrate - $psrate), 1) . '%" src="assets/images/up_arrow_red.png" />';
        else
            $simg = '<img class = "arrow-img" title = "' . round(($csrate - $psrate)) . '%" src="assets/images/down_arrow_green.png" />';

        $rimg = "";
        if ($atrends[11][3] > $atrends[10][3])
            $rimg = '<img class = "arrow-img" title="' . ($crrate - $prrate) . '%" src="assets/images/up_green.png" />';
        else
            $rimg = '<img class = "arrow-img" title="' . ($crrate - $prrate) . '%" src="assets/images/down_red.png" />';

        //Stockout/Reporting Rates -STKC
        $psnum = $preports[2]; $psden = $preports[0];
        $ppsrate = $ptrends[10][1];
        if($psden != 0)
            $pcsrate = round(($psnum / $psden) * 100, 1);
        else
            $pcsrate = 0;

        $prnum = $preports[0]; $prden = $preports[1];
        if($ptrends[10][4] != 0)
            $pprrate = round(($ptrends[10][3] / $ptrends[10][4]) * 100);
        else
            $pprrate = 0;

        if($prden != 0)
            $pcrrate = round(($prnum / $prden) * 100);
        else
            $pcrrate = 0;

        $psimg = "";
        if ($ptrends[11][1] > $ptrends[10][1])
            $psimg = '<img class = "arrow-img" title = "' . round(($pcsrate - $ppsrate), 1) . '%" src="assets/images/up_arrow_red.png" />';
        else
            $psimg = '<img class = "arrow-img" title = "' . round(($pcsrate - $ppsrate)) . '%" src="assets/images/down_arrow_green.png" />';

        $primg = "";
        if ($ptrends[11][3] > $ptrends[10][3])
            $primg = '<img class = "arrow-img" title="' . ($pcrrate - $pprrate) . '%" src="assets/images/up_green.png" />';
        else
            $primg = '<img class = "arrow-img" title="' . ($pcrrate - $pprrate) . '%" src="assets/images/down_red.png" />';

        //Stockout/Reporting Rates - RTKS
        //Stockout out sites - Numerator and Denominator
        $rsnum = $rreports[2]; $rsden = $rreports[0];
        //Previous Stockout (ps) rates
        $rpsrate = $rtrends[10][1];
        //Current stockout (cs) rate
        if($rsden != 0)
            $rcsrate = round(($rsnum / $rsden) * 100, 1);
        else
            $rcsrate = 0;
        //Reported sites - Numerator and denominator
        $rrnum = $rreports[0]; $rrden = $rreports[1];
        //Previuos reporting (pr) rates
        if($rtrends[10][4] != 0)
            $rprrate = round(($rtrends[10][3] / $rtrends[10][4]) * 100);
        else
            $rprrate = 0;
        //Current reporting (cr) rate
        if($rrden != 0)
            $rcrrate = round(($rrnum / $rrden) * 100);
        else
            $rcrrate = 0;

        //Stockout rate icon/image
        $rsimg = "";
        if ($rtrends[11][1] > $rtrends[10][1])
            $rsimg = '<img class = "arrow-img" title = "' . round(($rcsrate - $rpsrate), 1) . '%" src="assets/images/up_arrow_red.png" />';
        else
            $rsimg = '<img class = "arrow-img" title = "' . round(($rcsrate - $rpsrate)) . '%" src="assets/images/down_arrow_green.png" />';
        //Reoprtng rate icon/image - up down arrow
        $rrimg = "";
        if ($rtrends[11][3] > $rtrends[10][3])
            $rrimg = '<img class = "arrow-img" title="' . ($rcrrate - $rprrate) . '%" src="assets/images/up_green.png" />';
        else
            $rrimg = '<img class = "arrow-img" title="' . ($rcrrate - $rprrate) . '%" src="assets/images/down_red.png" />';

        //Stockout/Reporting Rates - RDTS
        //Stockout out sites - Numerator and Denominator
        $rdsnum = $rdreports[2]; $rdsden = $rdreports[0];
        //Previous Stockout (ps) rates
        $rdpsrate = $rdtrends[10][1];
        //Current stockout (cs) rate
        if($rdsden != 0)
            $rdcsrate = round(($rdsnum / $rdsden) * 100, 1);
        else
            $rdcsrate = 0;
        //Reported sites - Numerator and denominator
        $rdrnum = $rdreports[0]; $rdrden = $rdreports[1];
        //Previuos reporting (pr) rates
        if($rdtrends[10][4] != 0)
            $rdprrate = round(($rdtrends[10][3] / $rdtrends[10][4]) * 100);
        else
            $rdprrate = 0;
        //Current reporting (cr) rate
        if($rdrden != 0)
            $rdcrrate = round(($rdrnum / $rdrden) * 100);
        else
            $rdcrrate = 0;

        //Stockout rate icon/image
        $rdsimg = "";
        if ($rdtrends[11][1] > $rdtrends[10][1])
            $rdsimg = '<img class = "arrow-img" title = "' . round(($rdcsrate - $rdpsrate), 1) . '%" src="assets/images/up_arrow_red.png" />';
        else
            $rdsimg = '<img class = "arrow-img" title = "' . round(($rdcsrate - $rdpsrate)) . '%" src="assets/images/down_arrow_green.png" />';
        //Reoprtng rate icon/image - up down arrow
        $rdrimg = "";
        if ($rdtrends[11][3] > $rdtrends[10][3])
            $rdrimg = '<img class = "arrow-img" title="' . ($rdcrrate - $rdprrate) . '%" src="assets/images/up_green.png" />';
        else
            $rdrimg = '<img class = "arrow-img" title="' . ($rdcrrate - $rdprrate) . '%" src="assets/images/down_red.png" />';
        
        //All STKA, STKC, RTK, RDT Reporting and Stockout rates
        $report_smry = array(
                array($csrate, $snum, $sden, $simg, $crrate, $rnum, $rden, $rimg),
                array($pcsrate, $psnum, $psden, $psimg, $pcrrate, $prnum, $prden, $primg),
                array($rcsrate, $rsnum, $rsden, $rsimg, $rcrrate, $rrnum, $rrden, $rrimg),
                array($rdcsrate, $rdsnum, $rdsden, $rdsimg, $rdcrrate, $rdrnum, $rdrden, $rdrimg)
        );
        //print_r ($report_smry[3]);

        //Org Summaries

        $res_orgsmry_a = pg_query($db, $qry_orgsmry_a);
        $res_orgsmry_c = pg_query($db, $qry_orgsmry_c);
        $res_orgsmry_r = pg_query($db, $qry_orgsmry_r);
        $res_orgsmry_rd = pg_query($db, $qry_orgsmry_rd);

        $org_smry_tr_a = "";
        //Load STKAs
        while($row = pg_fetch_array($res_orgsmry_a)){

            //$cat = $row['level'];

            $org_smry_tr_a .= "<tr>".
                "<td>STKA</td>".
                "<td>$row[level]</td>".
                "<td><a href='#' class='show-hfs' data-cat = 'akpi' data-col = 'ownership' data-ownership = 'all' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $row['num'] . "</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'akpi' data-col = 'ownership' data-ownership = 'uzg9rPxGZgq' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['govt']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'akpi' data-col = 'ownership' data-ownership = 'sIbY5kh15sT' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pnfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'akpi' data-col = 'ownership' data-ownership = '2JWKwteWFo3' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'akpi' data-col = 'ownership' data-ownership = 'VgJIIy7pbvE' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['ngo']."</a></td>".
                "</tr>";
        }
        //Load STKcs
        while($row = pg_fetch_array($res_orgsmry_c)){
            $org_smry_tr_a .= "<tr>".
                "<td>STKC</td>".
                "<td>$row[level]</td>".
                "<td><a href='#' class='show-hfs' data-cat = 'pkpi' data-col = 'ownership' data-ownership = 'all' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $row['num'] . "</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'pkpi' data-col = 'ownership' data-ownership = 'uzg9rPxGZgq' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['govt']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'pkpi' data-col = 'ownership' data-ownership = 'sIbY5kh15sT' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pnfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'pkpi' data-col = 'ownership' data-ownership = '2JWKwteWFo3' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'pkpi' data-col = 'ownership' data-ownership = 'VgJIIy7pbvE' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['ngo']."</a></td>".
                "</tr>";
        }
        //Load RTKs
        while($row = pg_fetch_array($res_orgsmry_r)){
            $org_smry_tr_a .= "<tr>".
                "<td>RTK</td>".
                "<td>$row[level]</td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rkpi' data-col = 'ownership' data-ownership = 'all' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $row['num'] . "</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rkpi' data-col = 'ownership' data-ownership = 'uzg9rPxGZgq' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['govt']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rkpi' data-col = 'ownership' data-ownership = 'sIbY5kh15sT' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pnfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rkpi' data-col = 'ownership' data-ownership = '2JWKwteWFo3' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rkpi' data-col = 'ownership' data-ownership = 'VgJIIy7pbvE' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['ngo']."</a></td>".
                "</tr>";
        }
        //Load RDTs
        while($row = pg_fetch_array($res_orgsmry_rd)){
            $org_smry_tr_a .= "<tr>".
                "<td>RDT</td>".
                "<td>$row[level]</td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rdkpi' data-col = 'ownership' data-ownership = 'all' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $row['num'] . "</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rdkpi' data-col = 'ownership' data-ownership = 'uzg9rPxGZgq' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['govt']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rdkpi' data-col = 'ownership' data-ownership = 'sIbY5kh15sT' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pnfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rdkpi' data-col = 'ownership' data-ownership = '2JWKwteWFo3' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['pfp']."</a></td>".
                "<td><a href='#' class='show-hfs' data-cat = 'rdkpi' data-col = 'ownership' data-ownership = 'VgJIIy7pbvE' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>".$row['ngo']."</a></td>".
                "</tr>";
        }

    pg_close($db);
    ?>
    <!--
    <article class="content charts-flot-page">
        <div class="title-block" style="margin-top:-4px">
            <h3 class="title">Stock Status</h3>
            <p class="title-description">Sites with Stock out of ARVS</p>
            <div class="pull-right" style="margin-top: -47px">
                <div class="pull-left">
                    <ul class="select">
                        <li>Adults</li>
                        <li>Paediatrics</li>
                        <li>Rapid Test Kits</li>
                    </ul>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-info btn-sm rounded-s" data-toggle="modal" data-target="#modal-media" data-backdrop="static" data-keyboard="false" style="margin-top:-1px">
                        Level/Period - Filter
                    </button>
                </div>
            </div>
        </div>
        -->
        <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" style="padding-right: 0px">
                        <div class="card">
                            <div class="card-block">
                                <input type="hidden" value='<?php echo json_encode($report_smry); ?>'  id="rsmry" name="rsmry" data-wn="<?php echo isset($_GET['wn']) ? $_GET['wn']:$wk ; ?>" data-o="<?php echo isset($_GET['o']) ? $_GET['o']:$org ; ?>" data-on="<?php echo isset($_GET['o']) ? $_GET['on']:$orgname ; ?>" data-yr="<?php echo $yr; ?>"/>
                                <div class="card-title-block">
                                    <h3 class="title"><span>Stock Out Rate: </span><span id = "w"><?php echo isset($_GET['w']) ? $_GET['w']:$cper ; ?></span> (<span id = "o"><?php echo isset($_GET['o']) ? $_GET['on']:$orgname ; ?></span>)</h3>
                                </div>

                                <section class="">
                                    <div class="">
                                        <h1 class="title"><span id="sr"><?php echo $csrate; ?></span>% <span id="si"><?php echo $simg; ?></span></h1>
                                        <p class="title-description"><span id="sn"><a href='#' class="show-hfs" data-cat ="akpi" data-col="aso" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'><?php echo $reports[2]; ?></a></span> of <span id="sd"><a href='#' class="show-hfs" data-cat ="akpi" data-col="areports" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'><?php echo $reports[0]; ?></a></span> Health Facilities Stocked Out<!-- - <a href="#">View</a>--></p>
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6" style="padding-left: 8px">
                        <div class="card">
                            <div class="card-block">

                                <div class="card-title-block">
                                    <h3 class="title"><span>Reporting Rate: <?php if (isset($w))echo $w; ?></span><span class = ""><?php echo isset($_GET['w']) ? $_GET['w']:$cper ; ?></span> (<span><?php echo isset($_GET['o']) ? $_GET['on']:$orgname ; ?></span>)</h3>
                                </div>

                                <section class="">
                                    <div class="">
                                        <h1 class="title"><span id="rr"><?php echo $crrate; ?></span>% <span id="ri"><?php echo $rimg; ?></span></h1>
                                        <p class="title-description"><span id="rn"><a href='#' class="show-hfs" data-cat ="akpi" data-col="areports" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'><?php echo $reports[0]; ?></a></span> of <span id="rd"><a href='#' class="show-hfs" data-cat ="akpi" data-col="atotal" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'><?php echo $reports[1]; ?></a></span> Health Facilities Reported [<span id="rm"><a href="#" class="show-hfs" data-cat ="akpi" data-col="missing" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>Missing Reports</a></span>]</p>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-md-6" style="padding-right: 0px">
                    <div class="card">
                        <div class="card-block">
                            <section class="">
                                <div class="">
                                    <div id="sadults"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="padding-left: 8px">
                    <div class="card">
                        <div class="card-block" style="height:440px;">
                            <section class="">
                                <div class="">
                                    <div id="dmap"></div>
                                    <div id="pop"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <section class="">
                                <div class="">
                                    <div id="trends"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title-block">
                                <h3 class="title">Stock Status [Commodities] - Number Of Facilities</h3>
                            </div>
                            <section class="">
                                <div class="">
                                    <div class="table-responsive">
                                        <!--class="table table-striped table-bordered table-hover"-->
                                        <table id = "stock" class="display" cellspacing="0" >
                                            <thead>
                                            <tr>
                                                <th>Commodity</th>
                                                <th>Category</th>
                                                <!-- <th>#SOH</th> -->
                                                <th>#Under</th>
                                                <th>#Adequate</th>
                                                <th>#Over</th>
                                                <th>#StockOuts</th>
                                                <th>#Clients</th>
                                                <th>#Clients at risk</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            echo $tr;
                                            ?>
                                            </tbody>
                                        </table>
                                        <input type="hidden" value='<?php echo json_encode($reg); ?>' id="reg" name="reg" />
                                        <input type="hidden" value='<?php echo json_encode($dis); ?>' id="dis" name="dis" />
                                        <input type="hidden" value='<?php echo json_encode($creg); ?>' id="creg" name="creg" />
                                        <input type="hidden" value='<?php echo json_encode($cdis); ?>' id="cdis" name="cdis" />
                                        <input type="hidden" value='<?php echo json_encode($rreg); ?>' id="rreg" name="rreg" />
                                        <input type="hidden" value='<?php echo json_encode($rdis); ?>' id="rdis" name="rdis" />
                                        <input type="hidden" value='<?php echo json_encode($rdreg); ?>' id="rdreg" name="rdreg" />
                                        <input type="hidden" value='<?php echo json_encode($rddis); ?>' id="rddis" name="rddis" />
                                        <input type="hidden" value='<?php echo json_encode($atrends); ?>' id="atrends" name="atrends" />
                                        <input type="hidden" value='<?php echo json_encode($ptrends); ?>' id="ptrends" name="ptrends" />
                                        <input type="hidden" value='<?php echo json_encode($rtrends); ?>' id="rtrends" name="rtrends" />
                                        <input type="hidden" value='<?php echo json_encode($rdtrends); ?>' id="rdtrends" name="rdtrends" />
                                        <input type="hidden" value='<?php echo json_encode($orgunits); ?>' id="orgunits" name="orgunits" />
                                        <input type="hidden" value='<?php echo $ol; ?>' id="ol" name="ol" />
                                        <!-- <img src="assets/images/up-small.png" />
                                        <img src="assets/images/down-small.png" /> <a href="#">35</a>
                                        -->
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title-block">
                                <h3 class="title">Org Unit Summary [Reports]</h3>
                            </div>
                            <section class="">
                                <div class="">
                                    <div class="table-responsive">
                                        <!--class="table table-striped table-bordered table-hover"-->
                                        <table id = "orgsmry" class="display" cellspacing="0" >
                                            <thead>
                                            <tr>
                                                <th>Report</th>
                                                <th>Level of Care</th>
                                                <th>Total</th>
                                                <th>GOVT</th>
                                                <th>PNFP</th>
                                                <th>PFP</th>
                                                <th>NGO</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            echo $org_smry_tr_a;
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </article>

<?php
}
?>
