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
        $(function () {

            var atrends = $('#atrends').val();
            var ptrends = $('#ptrends').val();
            //alert(jtext);
            //var obj = JSON.parse();
            var aobj = JSON.parse(atrends);
            var pobj = JSON.parse(ptrends);

            //alert (aobj[0][0]);

            Highcharts.chart('trends', {
                chart: {
                    zoomType: 'xy',
                },
                title: {
                    text: 'ARV Stockout rates - Last 12 Weeks (' + $('#o').html() + ')'
                },
                subtitle: {
                    text: 'Source: MoH'
                },
                xAxis: [{
                    categories: [aobj[0][0], aobj[1][0], aobj[2][0], aobj[3][0], aobj[4][0], aobj[5][0],
                        aobj[6][0], aobj[7][0], aobj[8][0], aobj[9][0], aobj[10][0], aobj[11][0]],
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
                        text: 'Stockout rates',
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
                    layout: 'vertical',
                    align: 'left',
                    x: 70,
                    verticalAlign: 'top',
                    y: 30,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
                credits: {
                    enabled: true,
                    text: 'Mets.or.ug',
                    href: 'http://www.mets.or.ug'
                },
                series: [{
                    name: 'Affected Clients - Adults',
                    type: 'column',
                    yAxis: 1,
                    data: [aobj[0][2], aobj[1][2], aobj[2][2], aobj[3][2], aobj[4][2], aobj[5][2], aobj[6][2], aobj[7][2], aobj[8][2],
                        aobj[9][2], aobj[10][2], aobj[11][2]],
                    tooltip: {
                        valueSuffix: ''
                    }

                },
                {
                    name: 'Affected Clients - Paediatric',
                    type: 'column',
                    yAxis: 1,
                    data: [pobj[0][2], pobj[1][2], pobj[2][2], pobj[3][2], pobj[4][2], pobj[5][2], pobj[6][2], pobj[7][2], pobj[8][2],
                    pobj[9][2], pobj[10][2], pobj[11][2]],
                    tooltip: {
                        valueSuffix: ''
                    }

                }
                ,{
                    name: 'Paediatric ARVs',
                    type: 'line',
                    data: [pobj[0][1], pobj[1][1], pobj[2][1], pobj[3][1], pobj[4][1], pobj[5][1], pobj[6][1], pobj[7][1], pobj[8][1],
                        pobj[9][1], pobj[10][1], pobj[11][1]],
                    tooltip: {
                        valueSuffix: '%'
                    }
                }, {
                    name: 'Adult ARVs',
                    type: 'line',
                    data: [aobj[0][1], aobj[1][1], aobj[2][1], aobj[3][1], aobj[4][1], aobj[5][1], aobj[6][1], aobj[7][1], aobj[8][1],
                        aobj[9][1], aobj[10][1], aobj[11][1]],
                    tooltip: {
                        valueSuffix: '%'
                    },
                }]
            });

            // Create the chart
            //var jtext = $('#jtext').val();
            var reg = $('#reg').val();
            var dis = $('#dis').val();
            //alert(jtext);
            //var obj = JSON.parse(jtext);
            var obj1 = JSON.parse(reg);
            var obj2 = JSON.parse(dis);

            //alert(obj2["Ntoroko District"][0][0]);

            //alert (reg);
           //alert (obj2['Kabarole District'][0][0]);

            Highcharts.chart('sadults', {


                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Number Of Facilities Stock Out Per ARVs - Adult (' + $('#w').html() + ')'
                },
                subtitle: {
                    text: 'Click the columns to Drill down to ARV Drugs.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Number Of Facilities'
                    }

                },
                legend: {
                    enabled: false
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
                    text: 'Mets.or.ug',
                    href: 'http://www.mets.or.ug'
                },
                series: [{
                    name: 'Regions',
                    colorByPoint: true,
                    data: [{
                     name: 'Rwenzori Region',
                     y: (typeof obj1["Western Region"] === 'undefined') ? 0:obj1["Western Region"],
                     drilldown: 'Rwenzori'
                     }, {
                     name: 'West Nile Region',
                     y: (typeof obj1["Northern Region"] === 'undefined') ? 0:obj1["Northern Region"],
                     drilldown: 'West Nile'
                     }]
                }],
                drilldown: {
                    series: [{
                        name: 'Districts',
                        id: 'Rwenzori',
                        data: [
                            {name:'Kabarole', y:(typeof obj2["Kabarole District"] === 'undefined') ? 0:obj2['Kabarole District'][0][0], drilldown: 'kab'},
                            {name:'Kasese', y:(typeof obj2["Kasese District"] === 'undefined') ? 0:obj2["Kasese District"][0][0], drilldown: 'kas'},
                            {name:'Kamwenge', y:(typeof obj2["Kamwenge District"] === 'undefined') ? 0:obj2['Kamwenge District'][0][0], drilldown: 'kam'},
                            {name:'Kyenjojo', y:(typeof obj2["Kyenjojo District"] === 'undefined') ? 0:obj2["Kyenjojo District"][0][0], drilldown: 'kyen'},
                            {name:'Kyegegwa', y:(typeof obj2["Kyegegwa District"] === 'undefined') ? 0:obj2['Kyegegwa District'][0][0], drilldown: 'kyeg'},
                            {name:'Bundibugyo', y:(typeof obj2["Bundibugyo District"] === 'undefined') ? 0:obj2["Bundibugyo District"][0][0], drilldown: 'bun'},
                            {name:'Ntoroko', y:(typeof obj2["Ntoroko District"] === 'undefined') ? 0:obj2["Ntoroko District"][0][0], drilldown: 'nto'}
                        ]
                    },
                        {
                            id: 'kab',
                            name: 'Kabarole',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Kabarole District"] === 'undefined') ? 0:obj2['Kabarole District'][i][0],
                                        (typeof obj2["Kabarole District"] === 'undefined') ? 0:obj2['Kabarole District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kas',
                            name: 'Kasese',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Kasese District"] === 'undefined') ? 0:obj2['Kasese District'][i][0],
                                        (typeof obj2["Kasese District"] === 'undefined') ? 0:obj2['Kasese District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kam',
                            name: 'Kamwenge',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Kamwenge District"] === 'undefined') ? 0:obj2['Kamwenge District'][i][0],
                                        (typeof obj2["Kamwenge District"] === 'undefined') ? 0:obj2['Kamwenge District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kyen',
                            name: 'Kyenjojo',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Kyenjojo District"] === 'undefined') ? 0:obj2['Kyenjojo District'][i][0],
                                        (typeof obj2["Kyenjojo District"] === 'undefined') ? 0:obj2['Kyenjojo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kyeg',
                            name: 'Kyegegwa',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Kyegegwa District"] === 'undefined') ? 0:obj2['Kyegegwa District'][i][0],
                                        (typeof obj2["Kyegegwa District"] === 'undefined') ? 0:obj2['Kyegegwa District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'bun',
                            name: 'Bundibugyo',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Bundibugyo District"] === 'undefined') ? 0:obj2['Bundibugyo District'][i][0],
                                        (typeof obj2["Bundibugyo District"] === 'undefined') ? 0:obj2['Bundibugyo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },

                        {
                            id: 'nto',
                            name: 'Ntoroko',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Ntoroko District"] === 'undefined') ? 0:obj2['Ntoroko District'][i][0],
                                        (typeof obj2["Ntoroko District"] === 'undefined') ? 0:obj2['Ntoroko District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },

                        {
                        name: 'Districts',
                        id: 'West Nile',
                        data: [
                            {name:'Adjumani', y:(typeof obj2["Adjumani District"] === 'undefined') ? 0:obj2['Adjumani District'][0][0], drilldown: 'adj'},
                            {name:'Arua', y:(typeof obj2["Arua District"] === 'undefined') ? 0:obj2['Arua District'][0][0], drilldown: 'aru'},
                            {name:'Koboko', y:(typeof obj2["Koboko District"] === 'undefined') ? 0:obj2['Koboko District'][0][0], drilldown: 'kob'},
                            {name:'Maracha', y:(typeof obj2["Maracha District"] === 'undefined') ? 0:obj2['Maracha District'][0][0], drilldown: 'mar'},
                            {name:'Moyo', y:(typeof obj2["Moyo District"] === 'undefined') ? 0:obj2['Moyo District'][0][0], drilldown: 'moy'},
                            {name:'Nebbi', y:(typeof obj2["Nebbi District"] === 'undefined') ? 0:obj2['Nebbi District'][0][0], drilldown: 'neb'},
                            {name:'Pakwach', y:(typeof obj2["Pakwach District"] === 'undefined') ? 0:obj2['Pakwach District'][0][0], drilldown: 'pak'},
                            {name:'Yumbe', y:(typeof obj2["Yumbe District"] === 'undefined') ? 0:obj2['Yumbe District'][0][0], drilldown: 'yum'},
                            {name:'Zombo', y:(typeof obj2["Zombo District"] === 'undefined') ? 0:obj2['Zombo District'][0][0], drilldown: 'zom'}
                        ]
                        },
                        {
                            id: 'adj',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Adjumani District"] === 'undefined') ? 0:obj2['Adjumani District'][i][0],
                                        (typeof obj2["Adjumani District"] === 'undefined') ? 0:obj2['Adjumani District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'aru',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Arua District"] === 'undefined') ? 0:obj2['Arua District'][i][0],
                                        (typeof obj2["Arua District"] === 'undefined') ? 0:obj2['Arua District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kob',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Koboko District"] === 'undefined') ? 0:obj2['Koboko District'][i][0],
                                        (typeof obj2["Koboko District"] === 'undefined') ? 0:obj2['Koboko District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'mar',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Maracha District"] === 'undefined') ? 0:obj2['Maracha District'][i][0],
                                        (typeof obj2["Maracha District"] === 'undefined') ? 0:obj2['Maracha District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'moy',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Moyo District"] === 'undefined') ? 0:obj2['Moyo District'][i][0],
                                        (typeof obj2["Moyo District"] === 'undefined') ? 0:obj2['Moyo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'neb',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Nebbi District"] === 'undefined') ? 0:obj2['Nebbi District'][i][0],
                                        (typeof obj2["Nebbi District"] === 'undefined') ? 0:obj2['Nebbi District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'pak',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Pakwach District"] === 'undefined') ? 0:obj2['Pakwach District'][i][0],
                                        (typeof obj2["Pakwach District"] === 'undefined') ? 0:obj2['Pakwach District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'yum',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Yumbe District"] === 'undefined') ? 0:obj2['Yumbe District'][i][0],
                                        (typeof obj2["Yumbe District"] === 'undefined') ? 0:obj2['Yumbe District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'zom',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 18; i += 1) {
                                    data.push([
                                        (typeof obj2["Zombo District"] === 'undefined') ? 0:obj2['Zombo District'][i][0],
                                        (typeof obj2["Zombo District"] === 'undefined') ? 0:obj2['Zombo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        }
                    ]
                }
            });

            var creg = $('#creg').val();
            var cdis = $('#cdis').val();
            //alert(jtext);
            //var obj = JSON.parse(jtext);
            var cobj1 = JSON.parse(creg);
            var cobj2 = JSON.parse(cdis);

            //alert (obj2['Adjumani District'][0][0]);

            //var $json_1 = ;

            Highcharts.chart('spaeds', {


                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Number Of Facilities Stock Out Per ARVs - Paediatric (' + $('#w').html() +')'
                },
                subtitle: {
                    text: 'Click the columns to Drill down to ARV Drugs.'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Number Of Facilities'
                    }

                },
                legend: {
                    enabled: false
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
                    text: 'Mets.or.ug',
                    href: 'http://www.mets.or.ug'
                },
                series: [{
                    name: 'Regions',
                    colorByPoint: true,
                    data: [{
                        name: 'Rwenzori Region',
                        y: (typeof cobj1["Western Region"] === 'undefined') ? 0:cobj1["Western Region"],
                        drilldown: 'Rwenzori'
                    }, {
                        name: 'West Nile Region',
                        y: (typeof cobj1["Northern Region"] === 'undefined') ? 0:cobj1["Northern Region"],
                        drilldown: 'West Nile'
                    }]
                }],
                drilldown: {
                    series: [{
                        name: 'Districts',
                        id: 'Rwenzori',
                        data: [
                            {name:'Kabarole', y: (typeof cobj2["Kabarole District"] === 'undefined') ? 0:cobj2['Kabarole District'][0][0], drilldown: 'kab'},
                            {name:'Kasese', y:(typeof cobj2["Kasese District"] === 'undefined') ? 0:cobj2['Kasese District'][0][0], drilldown: 'kas'},
                            {name:'Kamwenge', y:(typeof cobj2["Kamwenge District"] === 'undefined') ? 0:cobj2['Kamwenge District'][0][0], drilldown: 'kam'},
                            {name:'Kyenjojo', y:(typeof cobj2["Kyenjojo District"] === 'undefined') ? 0:cobj2['Kyenjojo District'][0][0], drilldown: 'kyen'},
                            {name:'Kyegegwa', y:(typeof cobj2["Kyegegwa District"] === 'undefined') ? 0:cobj2['Kyegegwa District'][0][0], drilldown: 'kyeg'},
                            {name:'Bundibugyo', y:(typeof cobj2["Bundibugyo District"] === 'undefined') ? 0:cobj2['Bundibugyo District'][0][0], drilldown: 'bun'},
                            {name:'Ntoroko', y:(typeof cobj2["Ntoroko District"] === 'undefined') ? 0:cobj2['Ntoroko District'][0][0], drilldown: 'nto'}
                        ]
                        /*
                        (function () {
                            // generate an array of random data
                            var data = [], i;

                            for (i = 1; i <= 1; i += 1) {
                                data.push([
                                    //obj2['Kabarole District'][i][0],
                                    //obj2['Kabarole District'][i][1]
                                    {name:'Kabarole', y: i, drilldown: 'kab'}
                                ]);
                            }
                            return data;
                        }())
                        */
                    },
                        {
                            id: 'kab',
                            name: 'Kabarole',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Kabarole District"] === 'undefined') ? 0:cobj2['Kabarole District'][i][0],
                                        (typeof cobj2["Kabarole District"] === 'undefined') ? 0:cobj2['Kabarole District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kas',
                            name: 'Kasese',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Kasese District"] === 'undefined') ? 0:cobj2['Kasese District'][i][0],
                                        (typeof cobj2["Kasese District"] === 'undefined') ? 0:cobj2['Kasese District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kam',
                            name: 'Kamwenge',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Kamwenge District"] === 'undefined') ? 0:cobj2['Kamwenge District'][i][0],
                                        (typeof cobj2["Kamwenge District"] === 'undefined') ? 0:cobj2['Kamwenge District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kyen',
                            name: 'Kyenjojo',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Kyenjojo District"] === 'undefined') ? 0:cobj2['Kyenjojo District'][i][0],
                                        (typeof cobj2["Kyenjojo District"] === 'undefined') ? 0:cobj2['Kyenjojo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kyeg',
                            name: 'Kyegegwa',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Kyegegwa District"] === 'undefined') ? 0:cobj2['Kyegegwa District'][i][0],
                                        (typeof cobj2["Kyegegwa District"] === 'undefined') ? 0:cobj2['Kyegegwa District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'bun',
                            name: 'Bundibugyo',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Bundibugyo District"] === 'undefined') ? 0:cobj2['Bundibugyo District'][i][0],
                                        (typeof cobj2["Bundibugyo District"] === 'undefined') ? 0:cobj2['Bundibugyo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'nto',
                            name: 'Ntoroko',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Ntoroko District"] === 'undefined') ? 0:cobj2['Ntoroko District'][i][0],
                                        (typeof cobj2["Ntoroko District"] === 'undefined') ? 0:cobj2['Ntoroko District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            name: 'Districts',
                            id: 'West Nile',
                            data: [
                                {name:'Adjumani', y: (typeof cobj2["Adjumani District"] === 'undefined') ? 0:cobj2['Adjumani District'][0][0], drilldown: 'adj'},
                                {name:'Arua', y:(typeof cobj2["Arua District"] === 'undefined') ? 0:cobj2['Arua District'][0][0], drilldown: 'aru'},
                                {name:'Koboko', y:(typeof cobj2["Koboko District"] === 'undefined') ? 0:cobj2['Koboko District'][0][0], drilldown: 'kob'},
                                {name:'Maracha', y:(typeof cobj2["Maracha District"] === 'undefined') ? 0:cobj2['Maracha District'][0][0], drilldown: 'mar'},
                                {name:'Moyo', y:(typeof cobj2["Moyo District"] === 'undefined') ? 0:cobj2['Moyo District'][0][0], drilldown: 'moy'},
                                {name:'Nebbi', y:(typeof cobj2["Nebbi District"] === 'undefined') ? 0:cobj2['Nebbi District'][0][0], drilldown: 'neb'},
                                {name:'Pakwach', y:(typeof cobj2["Pakwach District"] === 'undefined') ? 0:cobj2['Pakwach District'][0][0], drilldown: 'pak'},
                                {name:'Yumbe', y:(typeof cobj2["Yumbe District"] === 'undefined') ? 0:cobj2['Yumbe District'][0][0], drilldown: 'yum'},
                                {name:'Zombo', y:(typeof cobj2["Zombo District"] === 'undefined') ? 0:cobj2['Zombo District'][0][0], drilldown: 'zom'}
                            ]
                        },
                        {
                            id: 'adj',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Adjumani District"] === 'undefined') ? 0:cobj2['Adjumani District'][i][0],
                                        (typeof cobj2["Adjumani District"] === 'undefined') ? 0:cobj2['Adjumani District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'aru',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Arua District"] === 'undefined') ? 0:cobj2['Arua District'][i][0],
                                        (typeof cobj2["Arua District"] === 'undefined') ? 0:cobj2['Arua District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'kob',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Koboko District"] === 'undefined') ? 0:cobj2['Koboko District'][i][0],
                                        (typeof cobj2["Koboko District"] === 'undefined') ? 0:cobj2['Koboko District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'mar',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Maracha District"] === 'undefined') ? 0:cobj2['Maracha District'][i][0],
                                        (typeof cobj2["Maracha District"] === 'undefined') ? 0:cobj2['Maracha District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'moy',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Moyo District"] === 'undefined') ? 0:cobj2['Moyo District'][i][0],
                                        (typeof cobj2["Moyo District"] === 'undefined') ? 0:cobj2['Moyo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'neb',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Nebbi District"] === 'undefined') ? 0:cobj2['Nebbi District'][i][0],
                                        (typeof cobj2["Nebbi District"] === 'undefined') ? 0:cobj2['Nebbi District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'pak',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Pakwach District"] === 'undefined') ? 0:cobj2['Pakwach District'][i][0],
                                        (typeof cobj2["Pakwach District"] === 'undefined') ? 0:cobj2['Pakwach District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'yum',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Yumbe District"] === 'undefined') ? 0:cobj2['Yumbe District'][i][0],
                                        (typeof cobj2["Yumbe District"] === 'undefined') ? 0:cobj2['Yumbe District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        },
                        {
                            id: 'zom',
                            name: 'Regimens',
                            data: (function () {
                                // generate an array of random data
                                var data = [], i;

                                for (i = 1; i <= 16; i += 1) {
                                    data.push([
                                        (typeof cobj2["Zombo District"] === 'undefined') ? 0:cobj2['Zombo District'][i][0],
                                        (typeof cobj2["Zombo District"] === 'undefined') ? 0:cobj2['Zombo District'][i][1]
                                    ]);
                                }
                                return data;
                            }())
                        }
                    ]
                }
            });

        });
    </script>

    <?php

        require_once ("src/commons/db.php");

        $org = '';
        $per = '';
        $yr = 2017;
        $wk = 1;

        if(isset($_GET['w']) && isset($_GET['o'])){

            $org = pg_escape_string($_GET['o']);
            $per = pg_escape_string($_GET['w']);
            $wk = pg_escape_string($_GET['wn']);

        }else{

            $cur = "SELECT EXTRACT(YEAR FROM NOW()) AS yr, (EXTRACT(WEEK FROM NOW()) - 1) AS weekno;";
            $onerow = pg_fetch_array(pg_query($db, $cur));

            $org = 'Uganda';
            $per = $onerow['yr'] . 'W' . $onerow['weekno'];
            $yr = $onerow['yr'];
            $wk = $onerow['weekno'];

        }

        //STKA KPIs

        //National Level
        $sql = "SELECT * FROM staging.rass_kpi_stka_w WHERE entity = '$org' AND week = '$per';";
        //Regional Level
        $sql1 = "SELECT * FROM staging.rass_kpi_stka_w WHERE level = 'Regional' AND week = '$per' ORDER BY entity;";
        //District Level
        $sql2 = "SELECT * FROM staging.rass_kpi_stka_w WHERE level = 'District' AND  week = '$per' ORDER BY entity;";

        //STKC KPIs

        //National Level
        $csql = "SELECT * FROM staging.rass_kpi_stkc_w WHERE entity = '$org' AND week = '$per';";
        //Regional Level
        $csql1 = "SELECT * FROM staging.rass_kpi_stkc_w WHERE level = 'Regional' AND week = '$per' ORDER BY entity;";
        //District Level
        $csql2 = "SELECT * FROM staging.rass_kpi_stkc_w WHERE level = 'District' AND  week = '$per' ORDER BY entity;";

        //Trends Data
        //Adults
        $asql = "SELECT * FROM staging.last_12_wks (". $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stka_w w
                ON w.week = lw.week  AND entity = '$org' OR entity IS NULL ORDER BY lw.id;";
        //Paeds
        $psql = "SELECT * FROM staging.last_12_wks (" . $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stkc_w w
                ON w.week = lw.week  AND entity = '$org' OR entity IS NULL ORDER BY lw.id;";

        $res = pg_query($db, $sql);
        $res1 = pg_query($db, $sql1);
        $res2 = pg_query($db, $sql2);

        $cres = pg_query($db, $csql);
        $cres1 = pg_query($db, $csql1);
        $cres2 = pg_query($db, $csql2);

        $ares = pg_query($db, $asql);
        $pres = pg_query($db, $psql);

        if(!$res) {
            echo pg_last_error($db);
            exit;
        }
        //$numrows = pg_numrows($res);

        $wdata = array();
        //$regimens = array();
        $reg = array();
        $dis = array();

        $creg = array();
        $cdis = array();

        $reports = array();

        //STKA data
        while($row = pg_fetch_array($res)) {

            $reports[] = $row['receivedreports'];
            $reports[] = $row['expectedreports'];
            $reports[] = $row['rso'];
            $wdata[] = array("NVP", "Adult", $row['a'], $row['aamc'], $row['au'], $row['an'], $row['am'], $row['ao'], abs($row['aa']));
            $wdata[] = array("EFV", "Adult", $row['b'], $row['bamc'], $row['bu'], $row['bn'], $row['bm'], $row['bo'], abs($row['ba']));
            $wdata[] = array("ABC", "Adult", $row['c'], $row['camc'], $row['cu'], $row['cn'], $row['cm'], $row['co'], abs($row['ca']));
            $wdata[] = array("ETV", "Adult", $row['d'], $row['damc'], $row['du'], $row['dn'], $row['dm'], $row['do'], abs($row['da']));
            $wdata[] = array("3TC", "Adult", $row['e'], $row['eamc'], $row['eu'], $row['en'], $row['em'], $row['eo'], abs($row['ea']));
            $wdata[] = array("AZT", "Adult", $row['f'], $row['famc'], $row['fu'], $row['fn'], $row['fm'], $row['fo'], abs($row['fa']));
            $wdata[] = array("RAL", "Adult", $row['g'], $row['gamc'], $row['gu'], $row['gn'], $row['gm'], $row['go'], abs($row['ga']));
            $wdata[] = array("ATV", "Adult", $row['h'], $row['hamc'], $row['hu'], $row['hn'], $row['hm'], $row['ho'], abs($row['ha']));
            $wdata[] = array("RTV", "Adult", $row['i'], $row['iamc'], $row['iu'], $row['in'], $row['im'], $row['io'], abs($row['ia']));
            $wdata[] = array("Darunavir", "Adult", $row['j'], $row['jamc'], $row['ju'], $row['jn'], $row['jm'], $row['jo'], abs($row['ja']));
            $wdata[] = array("ABC/3TC", "Adult", $row['k'], $row['kamc'], $row['ku'], $row['kn'], $row['km'], $row['ko'], abs($row['ka']));
            $wdata[] = array("AZT/3TC", "Adult", $row['l'], $row['lamc'], $row['lu'], $row['ln'], $row['lm'], $row['lo'], abs($row['la']));
            $wdata[] = array("TDF/3TC", "Adult", $row['m'], $row['mamc'], $row['mu'], $row['mn'], $row['mm'], $row['mo'], abs($row['ma']));
            $wdata[] = array("LPV/r", "Adult", $row['n'], $row['namc'], $row['nu'], $row['nn'], $row['nm'], $row['no'], abs($row['na']));
            $wdata[] = array("ATV/r", "Adult", $row['o'], $row['oamc'], $row['ou'], $row['on'], $row['om'], $row['oo'], abs($row['oa']));
            $wdata[] = array("AZT/3TC/NVP", "Adult", $row['p'], $row['pamc'], $row['pu'], $row['pn'], $row['pm'], $row['po'], abs($row['pa']));
            $wdata[] = array("TDF/3TC/EFV", "Adult", $row['q'], $row['qamc'], $row['qu'], $row['qn'], $row['qm'], $row['qo'], abs($row['qa']));
            $wdata[] = array("TDF/3TC + NVP", "Adult", $row['r'], $row['ramc'], $row['ru'], $row['rn'], $row['rm'], $row['ro'], abs($row['ra']));

        }

        //STKC data
        while($crow = pg_fetch_array($cres)) {
            $wdata[] = array("NVP 50mg", "Paediatric", $crow['a'], $crow['aamc'], $crow['au'], $crow['an'], $crow['am'], $crow['ao'], abs($crow['aa']));
            $wdata[] = array("NVP 10mg/ml (240ml)", "Paediatric", $crow['b'], $crow['bamc'], $crow['bu'], $crow['bn'], $crow['bm'], $crow['bo'], abs($crow['ba']));
            $wdata[] = array("NVP 10mg/ml (100ml)", "Paediatric", $crow['c'], $crow['camc'], $crow['cu'], $crow['cn'], $crow['cm'], $crow['co'], abs($crow['ca']));
            $wdata[] = array("EFV 200mg", "Paediatric", $crow['d'], $crow['damc'], $crow['du'], $crow['dn'], $crow['dm'], $crow['do'], abs($crow['da']));
            $wdata[] = array("EFV 50mg", "Paediatric", $crow['e'], $crow['eamc'], $crow['eu'], $crow['en'], $crow['em'], $crow['eo'], abs($crow['ea']));
            $wdata[] = array("ABC 60mg", "Paediatric", $crow['f'], $crow['famc'], $crow['fu'], $crow['fn'], $crow['fm'], $crow['fo'], abs($crow['fa']));
            $wdata[] = array("ABC 20mg/ml", "Paediatric", $crow['g'], $crow['gamc'], $crow['gu'], $crow['gn'], $crow['gm'], $crow['go'], abs($crow['ga']));
            $wdata[] = array("AZT 100mg", "Paediatric", $crow['h'], $crow['hamc'], $crow['hu'], $crow['hn'], $crow['hm'], $crow['ho'], abs($crow['ha']));
            $wdata[] = array("AZT 60mg", "Paediatric", $crow['i'], $crow['iamc'], $crow['iu'], $crow['in'], $crow['im'], $crow['io'], abs($crow['ia']));
            $wdata[] = array("ABC/3TC 120/60mg", "Paediatric", $crow['j'], $crow['jamc'], $crow['ju'], $crow['jn'], $crow['jm'], $crow['jo'], abs($crow['ja']));
            $wdata[] = array("ABC/3TC 60/30mg", "Paediatric", $crow['k'], $crow['kamc'], $crow['ku'], $crow['kn'], $crow['km'], $crow['ko'], abs($crow['ka']));
            $wdata[] = array("AZT/3TC 60/30mg", "Paediatric", $crow['l'], $crow['lamc'], $crow['lu'], $crow['ln'], $crow['lm'], $crow['lo'], abs($crow['la']));
            $wdata[] = array("LPV/r 100/25mg", "Paediatric", $crow['m'], $crow['mamc'], $crow['mu'], $crow['mn'], $crow['mm'], $crow['mo'], abs($crow['ma']));
            $wdata[] = array("LPV/r 80/20mg (300ml)", "Paediatric", $crow['n'], $crow['namc'], $crow['nu'], $crow['nn'], $crow['nm'], $crow['no'], abs($crow['na']));
            $wdata[] = array("LPV/r 40/10mg (Oral Pellets)", "Paediatric", $crow['o'], $crow['oamc'], $crow['ou'], $crow['on'], $crow['om'], $crow['oo'], abs($crow['oa']));
            $wdata[] = array("AZT/3TC/NVP", "Paediatric", $crow['p'], $crow['pamc'], $crow['pu'], $crow['pn'], $crow['pm'], $crow['po'], abs($crow['pa']));

        }

        $tr = "";
        foreach ($wdata as $item){
            $tr .= "<tr>";
            $tr .= "<td>" . $item[0] ."</td>";
            $tr .= "<td>" . $item[1] ."</td>";
            $tr .= "<td>" . $item[4] ."</td>";
            $tr .= "<td>" . $item[5] ."</td>";
            $tr .= "<td>" . $item[6] ."</td>";
            $tr .= "<td>" . $item[7] ."</td>";
            $tr .= "<td>" . $item[3] ."</td>";
            $tr .= "<td>" . $item[8] ."</td>";
            $tr .= "</tr>";
        }

        //$row1 = pg_fetch_array($res1);
        //$row2 = pg_fetch_array($res2);

        ///print_r($wdata);

        //STKA Data --bar graph

        while($row1 = pg_fetch_array($res1)){

            $stkouts = $row1['rso'];
            $reg["$row1[entity]"] = (int)$stkouts;
            //$reg[] = array($row1['entity'], (int)$stkouts);
        }

        while($row2 = pg_fetch_array($res2)){

            $stkouts = $row2['rso'];
            $dis["$row2[entity]"] = array(
                    array((int)$stkouts),
                    array("NVP", (int)$row2['ao']),
                    array("EFV", (int)$row2['bo']),
                    array("ABC", (int)$row2['co']),
                    array("ETV", (int)$row2['do']),
                    array("3TC", (int)$row2['eo']),
                    array("AZT", (int)$row2['fo']),
                    array("RAL", (int)$row2['go']),
                    array("ATV", (int)$row2['ho']),
                    array("RTV", (int)$row2['io']),
                    array("Darunavir", (int)$row2['jo']),
                    array("ABC/3TC", (int)$row2['ko']),
                    array("AZT/3TC", (int)$row2['lo']),
                    array("TDF/3TC", (int)$row2['mo']),
                    array("LPV/r", (int)$row2['no']),
                    array("ATV/r", (int)$row2['oo']),
                    array("AZT/3TC/NVP", (int)$row2['po']),
                    array("TDF/3TC/EFV", (int)$row2['qo']),
                    array("TDF/3TC + NVP", (int)$row2['ro']),
            );
        }

        //STKC Data

        while($crow1 = pg_fetch_array($cres1)){

            $stkouts = $crow1['rso'];
            $creg["$crow1[entity]"] = (int)$stkouts;
        }

        while($crow2 = pg_fetch_array($cres2)){

            $stkouts = $crow2['rso'];
            $cdis["$crow2[entity]"] = array(
                array((int)$stkouts),
                array("NVP 50mg", (int)$crow2['ao']),
                array("NVP 10mg/ml (240ml)", (int)$crow2['bo']),
                array("NVP 10mg/ml (100ml)", (int)$crow2['co']),
                array("EFV 200mg", (int)$crow2['do']),
                array("EFV 50mg", (int)$crow2['eo']),
                array("ABC 60mg", (int)$crow2['fo']),
                array("ABC 20mg/ml", (int)$crow2['go']),
                array("AZT 100mg", (int)$crow2['ho']),
                array("AZT 60mg", (int)$crow2['io']),
                array("ABC/3TC 120/60mg", (int)$crow2['jo']),
                array("ABC/3TC 60/30mg", (int)$crow2['ko']),
                array("AZT/3TC 60/30mg", (int)$crow2['lo']),
                array("LPV/r 100/25mg", (int)$crow2['mo']),
                array("LPV/r 80/20mg (300ml)", (int)$crow2['no']),
                array("LPV/r 40/10mg (Oral Pellets)", (int)$crow2['oo']),
                array("AZT/3TC/NVP", (int)$crow2['po'])
            );
        }

        //Data For the Trends Graph
        //$ares = pg_query($db, $asql);
        //$pres = pg_query($db, $psql);
        $atrends = array();
        $ptrends = array();
        //Adult Trends
        while($arow = pg_fetch_array($ares)){
            //stock outs per week
            if ($arow['receivedreports'] > 0)
                $stkouts = round(($arow['rso'] / $arow['receivedreports']) * 100, 1);
            else
                $stkouts = 0;
            //affected clients per week
            $clients = $arow['aa'] + $arow['ba'] + $arow['ca'] + $arow['da'] + $arow['ea'] +
                $arow['fa'] + $arow['ga'] + $arow['ha'] + $arow['ia'] + $arow['ja'] + $arow['ka'] +
                $arow['la'] + $arow['ma'] + $arow['na'] + $arow['oa'] + $arow['pa'] + $arow['qa'] +
                $arow['ra'];

            $atrends[] = array($arow['week'], (float)$stkouts, abs((int)$clients), (int)$arow['receivedreports'],
                        (int)$arow['expectedreports']);

        }

        $psrate = $atrends[10][1];
        $csrate = round(($reports[2] / $reports[0]) * 100, 1);

        $prrate = round(($atrends[10][3] / $atrends[10][4]) * 100);
        $crrate = round(($reports[0] / $reports[1]) * 100);

        $simg = "";
        if ($atrends[11][1] > $atrends[10][1])
            $simg = '<img class = "arrow-img" title = "' . round(($csrate - $psrate), 1) . '%" src="assets/images/up_arrow_red.png" />';
        else
            $simg = '<img class = "arrow-img" title = "' . roudn(($csrate - $psrate)) . '%" src="assets/images/down_arrow_green.png" />';

        $rimg = "";
        if ($atrends[11][3] > $atrends[10][3])
            $rimg = '<img class = "arrow-img" title="' . ($crrate - $prrate) . '%" src="assets/images/up_green.png" />';
        else
            $rimg = '<img class = "arrow-img" title="' . ($crrate - $prrate) . '%" src="assets/images/down_red.png" />';

        //Paediatric Trends
        while($prow = pg_fetch_array($pres)){
            //stock outs per week
            if ($prow['receivedreports'] > 0)
                $stkouts = round(($prow['rso'] / $prow['receivedreports']) * 100, 1);
            else
                $stkouts = 0;
            //affected clients per week
            $clients = $prow['aa'] + $prow['ba'] + $prow['ca'] + $prow['da'] + $prow['ea'] +
                $prow['fa'] + $prow['ga'] + $prow['ha'] + $prow['ia'] + $prow['ja'] + $prow['ka'] +
                $prow['la'] + $prow['ma'] + $prow['na'] + $prow['oa'] + $prow['pa'];

            $ptrends[] = array($prow['week'], (float)$stkouts, abs((int)$clients));

        }

        pg_close($db);
    ?>

    <article class="content charts-flot-page">
        <div class="title-block">
            <h3 class="title">Stock Status</h3>
            <p class="title-description">Sites with Stock out of ARVS</p>
            <button type="button" class="pull-right btn btn-info btn-sm rounded-s" data-toggle="modal" data-target="#modal-media">
                Level/Period - Filter
            </button>
        </div>
        <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-block">

                                <div class="card-title-block">
                                    <h3 class="title"><span>Stock Out Rate: </span><span id = "w"><?php echo isset($_GET['w']) ? $_GET['w']:$per ; ?></span> (<span id = "o"><?php echo isset($_GET['o']) ? $_GET['o']:$org ; ?></span>)</h3>
                                </div>

                                <section class="">
                                    <div class="">
                                        <h1 class="title"><span><?php echo $csrate; ?></span>% <?php echo $simg; ?></h1>
                                        <p class="title-description"><span><a href="#"><?php echo $reports[2]; ?></a></span> of <span><a href="#"><?php echo $reports[0]; ?></a></span> Health Facilities Stocked Out - <a href="#">View</a></p>
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-block">

                                <div class="card-title-block">
                                    <h3 class="title"><span>Reporting Rate: <?php echo $w; ?></span><span class = ""><?php echo isset($_GET['w']) ? $_GET['w']:$per ; ?></span> (<span><?php echo isset($_GET['o']) ? $_GET['o']:$org ; ?></span>)</h3>
                                </div>

                                <section class="">
                                    <div class="">
                                        <h1 class="title"><span><?php echo $crrate; ?></span>% <?php echo $rimg; ?></h1>
                                        <p class="title-description"><span><a href="#"><?php echo $reports[0]; ?></a></span> of <span><a href="#"><?php echo $reports[1]; ?></a></span> Health Facilities Reported - <a href="#">View</a></p>
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
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <section class="">
                                <div class="">
                                    <div id="spaeds"></div>
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
                                <h3 class="title">Most Stocked Out ARV Regimens - <a href="#">View All</a></h3>
                            </div>
                            <section class="">
                                <div class="">
                                    <div class="table-responsive">
                                        <!--class="table table-striped table-bordered table-hover"-->
                                        <table id = "stock" class="display" cellspacing="0" >
                                            <thead>
                                            <tr>
                                                <th>ARV</th>
                                                <th>Category</th>
                                                <th>#Under</th>
                                                <th>#Adequate</th>
                                                <th>#Over</th>
                                                <th>#StockOuts</th>
                                                <th>#Clients</th>
                                                <th>#Affected Clients</th>
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
                                        <input type="hidden" value='<?php echo json_encode($atrends); ?>' id="atrends" name="atrends" />
                                        <input type="hidden" value='<?php echo json_encode($ptrends); ?>' id="ptrends" name="ptrends" />
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
    </article>

<?php
}
?>
