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
                    borderWidth: 1,
                    borderColor: 'grey'
                },
                title: {
                    text: 'ARV Stockout rates - Last 12 Weeks (' + $('#o').html() + ')'
                },
                subtitle: {
                    text: 'Health Facilities Reporting ARV Stockstatus during the reporting periods'
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
                        text: '% of Health Facilities with ARV Stockouts',
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
                    }
                }]
            });

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

            var cat = 'Adults';

            drawBarChart(obj1, obj2, 18);

            function drawBarChart(obj1, obj2, count) {
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
                        text: 'Click the columns to Drill down to ARV Drugs.'
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
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b>'
                    },
                    credits: {
                        enabled: true,
                        text: 'rass.mets.or.ug',
                        href: 'http://rass.mets.or.ug'
                    },
                    series: [
                        {
                            name: 'Stockouts',
                            data: [{
                                name: 'Rwenzori',
                                y: (typeof obj1["Western Region"] === 'undefined') ? 0 : obj1["Western Region"][0],
                                drilldown: 'Rwenzori'
                            }, {
                                name: 'West Nile',
                                y: (typeof obj1["Northern Region"] === 'undefined') ? 0 : obj1["Northern Region"][0],
                                drilldown: 'West Nile'
                            }]
                        },

                        {
                            name: 'Affected Clients (x100)',
                            data: [{
                                name: 'Rwenzori',
                                y: (typeof obj1["Western Region"] === 'undefined') ? 0 : obj1["Western Region"][1],
                                drilldown: 'aaRwenzori'
                            }, {
                                name: 'West Nile',
                                y: (typeof obj1["Northern Region"] === 'undefined') ? 0 : obj1["Northern Region"][1],
                                drilldown: 'aaWest Nile'
                            },
                            {
                                name: 'Soroti',
                                y: (typeof obj1["Eastern Region"] === 'undefined') ? 0 : obj1["Eastern Region"][1],
                                drilldown: 'aaSoroti'
                            }]
                        }

                    ],

                    drilldown: {
                        series: [{
                            name: 'Districts',
                            id: 'Rwenzori',
                            data: [
                                {
                                    name: 'Kabarole',
                                    y: (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][0][0],
                                    drilldown: 'kab'
                                },
                                {
                                    name: 'Kasese',
                                    y: (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2["Kasese District"][0][0],
                                    drilldown: 'kas'
                                },
                                {
                                    name: 'Kamwenge',
                                    y: (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][0][0],
                                    drilldown: 'kam'
                                },
                                {
                                    name: 'Kyenjojo',
                                    y: (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2["Kyenjojo District"][0][0],
                                    drilldown: 'kyen'
                                },
                                {
                                    name: 'Kyegegwa',
                                    y: (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][0][0],
                                    drilldown: 'kyeg'
                                },
                                {
                                    name: 'Bundibugyo',
                                    y: (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2["Bundibugyo District"][0][0],
                                    drilldown: 'bun'
                                },
                                {
                                    name: 'Ntoroko',
                                    y: (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2["Ntoroko District"][0][0],
                                    drilldown: 'nto'
                                }
                            ]
                        },
                            {
                                id: 'kab',
                                name: 'Kabarole',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][i][0],
                                            (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'kas',
                                name: 'Kasese',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2['Kasese District'][i][0],
                                            (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2['Kasese District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'kam',
                                name: 'Kamwenge',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][i][0],
                                            (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'kyen',
                                name: 'Kyenjojo',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2['Kyenjojo District'][i][0],
                                            (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2['Kyenjojo District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'kyeg',
                                name: 'Kyegegwa',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][i][0],
                                            (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'bun',
                                name: 'Bundibugyo',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2['Bundibugyo District'][i][0],
                                            (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2['Bundibugyo District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'nto',
                                name: 'Ntoroko',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2['Ntoroko District'][i][0],
                                            (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2['Ntoroko District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },

                            {
                                name: 'Districts',
                                id: 'West Nile',
                                data: [
                                    {
                                        name: 'Adjumani',
                                        y: (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][0][0],
                                        drilldown: 'adj'
                                    },
                                    {
                                        name: 'Arua',
                                        y: (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][0][0],
                                        drilldown: 'aru'
                                    },
                                    {
                                        name: 'Koboko',
                                        y: (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][0][0],
                                        drilldown: 'kob'
                                    },
                                    {
                                        name: 'Maracha',
                                        y: (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][0][0],
                                        drilldown: 'mar'
                                    },
                                    {
                                        name: 'Moyo',
                                        y: (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][0][0],
                                        drilldown: 'moy'
                                    },
                                    {
                                        name: 'Nebbi',
                                        y: (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][0][0],
                                        drilldown: 'neb'
                                    },
                                    {
                                        name: 'Pakwach',
                                        y: (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][0][0],
                                        drilldown: 'pak'
                                    },
                                    {
                                        name: 'Yumbe',
                                        y: (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][0][0],
                                        drilldown: 'yum'
                                    },
                                    {
                                        name: 'Zombo',
                                        y: (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][0][0],
                                        drilldown: 'zom'
                                    }
                                ]
                            },
                            {
                                id: 'adj',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][i][0],
                                            (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aru',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][i][0],
                                            (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'kob',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][i][0],
                                            (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'mar',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][i][0],
                                            (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'moy',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][i][0],
                                            (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'neb',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][i][0],
                                            (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'pak',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][i][0],
                                            (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'yum',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][i][0],
                                            (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'zom',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][i][0],
                                            (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },


                            //Soroti Region Districts

                            {
                                name: 'Districts',
                                id: 'Soroti',
                                data: [
                                    {
                                        name: 'Soroti',
                                        y: (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][0][0],
                                        drilldown: 'sor'
                                    },
                                    {
                                        name: 'Katakwi',
                                        y: (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][0][0],
                                        drilldown: 'kat'
                                    }
                                ]
                            },
                            {
                                id: 'sor',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][i][0],
                                            (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'kat',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][i][0],
                                            (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][i][1]
                                        ]);
                                    }
                                    return data;
                                }())
                            },

                            //Affected Clients

                            {
                                name: 'Districts',
                                id: 'aaRwenzori',
                                data: [
                                    {
                                        name: 'Kabarole',
                                        y: (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][0][1],
                                        drilldown: 'aakab'
                                    },
                                    {
                                        name: 'Kasese',
                                        y: (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2["Kasese District"][0][1],
                                        drilldown: 'aakas'
                                    },
                                    {
                                        name: 'Kamwenge',
                                        y: (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][0][1],
                                        drilldown: 'aakam'
                                    },
                                    {
                                        name: 'Kyenjojo',
                                        y: (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2["Kyenjojo District"][0][1],
                                        drilldown: 'aakyen'
                                    },
                                    {
                                        name: 'Kyegegwa',
                                        y: (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][0][1],
                                        drilldown: 'aakyeg'
                                    },
                                    {
                                        name: 'Bundibugyo',
                                        y: (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2["Bundibugyo District"][0][1],
                                        drilldown: 'aabun'
                                    },
                                    {
                                        name: 'Ntoroko',
                                        y: (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2["Ntoroko District"][0][1],
                                        drilldown: 'aanto'
                                    }
                                ]
                            },
                            {
                                id: 'aakab',
                                name: 'Kabarole',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][i][0],
                                            (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakas',
                                name: 'Kasese',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2['Kasese District'][i][0],
                                            (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2['Kasese District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakam',
                                name: 'Kamwenge',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][i][0],
                                            (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakyen',
                                name: 'Kyenjojo',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2['Kyenjojo District'][i][0],
                                            (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2['Kyenjojo District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakyeg',
                                name: 'Kyegegwa',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][i][0],
                                            (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aabun',
                                name: 'Bundibugyo',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2['Bundibugyo District'][i][0],
                                            (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2['Bundibugyo District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },

                            {
                                id: 'aanto',
                                name: 'Ntoroko',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2['Ntoroko District'][i][0],
                                            (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2['Ntoroko District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },

                            {
                                name: 'Districts',
                                id: 'aaWest Nile',
                                data: [
                                    {
                                        name: 'Adjumani',
                                        y: (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][0][1],
                                        drilldown: 'aaadj'
                                    },
                                    {
                                        name: 'Arua',
                                        y: (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][0][1],
                                        drilldown: 'aaaru'
                                    },
                                    {
                                        name: 'Koboko',
                                        y: (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][0][1],
                                        drilldown: 'aakob'
                                    },
                                    {
                                        name: 'Maracha',
                                        y: (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][0][1],
                                        drilldown: 'aamar'
                                    },
                                    {
                                        name: 'Moyo',
                                        y: (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][0][1],
                                        drilldown: 'aamoy'
                                    },
                                    {
                                        name: 'Nebbi',
                                        y: (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][0][1],
                                        drilldown: 'aaneb'
                                    },
                                    {
                                        name: 'Pakwach',
                                        y: (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][0][1],
                                        drilldown: 'aapak'
                                    },
                                    {
                                        name: 'Yumbe',
                                        y: (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][0][1],
                                        drilldown: 'aayum'
                                    },
                                    {
                                        name: 'Zombo',
                                        y: (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][0][1],
                                        drilldown: 'aazom'
                                    }
                                ]
                            },
                            {
                                id: 'aaadj',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][i][0],
                                            (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aaaru',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][i][0],
                                            (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakob',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][i][0],
                                            (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aamar',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][i][0],
                                            (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aamoy',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][i][0],
                                            (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aaneb',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][i][0],
                                            (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aapak',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][i][0],
                                            (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aayum',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][i][0],
                                            (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aazom',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][i][0],
                                            (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },

                            //Soroti Region Affected patients

                            {
                                name: 'Districts',
                                id: 'aaSoroti',
                                data: [
                                    {
                                        name: 'Soroti',
                                        y: (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][0][1],
                                        drilldown: 'aasor'
                                    },
                                    {
                                        name: 'Katakwi',
                                        y: (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][0][1],
                                        drilldown: 'aakat'
                                    },
                                    {
                                        name: 'Amuria',
                                        y: (typeof obj2["Amuria District"] === 'undefined') ? 0 : obj2['Amuria District'][0][1],
                                        drilldown: 'aaamu'
                                    },
                                    {
                                        name: 'Kumi',
                                        y: (typeof obj2["Kumi District"] === 'undefined') ? 0 : obj2['Kumi District'][0][1],
                                        drilldown: 'aakum'
                                    }
                                ]
                            },
                            {
                                id: 'aasor',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][i][0],
                                            (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakat',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][i][0],
                                            (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aaamu',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Amuria District"] === 'undefined') ? 0 : obj2['Amuria District'][i][0],
                                            (typeof obj2["Amuria District"] === 'undefined') ? 0 : obj2['Amuria District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            },
                            {
                                id: 'aakum',
                                name: 'Regimens',
                                data: (function () {
                                    var data = [], i;
                                    for (i = 1; i <= count; i += 1) {
                                        data.push([
                                            (typeof obj2["Kumi District"] === 'undefined') ? 0 : obj2['Kumi District'][i][0],
                                            (typeof obj2["Kumi District"] === 'undefined') ? 0 : obj2['Kumi District'][i][2]
                                        ]);
                                    }
                                    return data;
                                }())
                            }
                        ]
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
                        renderTo: 'pop',
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
                            text: 'Stockout Distribution Rates (%) <br />' + cat + ' (' + $('#w').html() + ')'
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
            var data = [
                ['Adjumani District', (typeof obj2["Adjumani District"] === 'undefined') ? 0 : obj2['Adjumani District'][0][2]],
                ['Arua District', (typeof obj2["Arua District"] === 'undefined') ? 0 : obj2['Arua District'][0][2]],
                ['Koboko District', (typeof obj2["Koboko District"] === 'undefined') ? 0 : obj2['Koboko District'][0][2]],
                ['Maracha District', (typeof obj2["Maracha District"] === 'undefined') ? 0 : obj2['Maracha District'][0][2]],
                ['Moyo District', (typeof obj2["Moyo District"] === 'undefined') ? 0 : obj2['Moyo District'][0][2]],
                ['Nebbi District', (typeof obj2["Nebbi District"] === 'undefined') ? 0 : obj2['Nebbi District'][0][2]],
                ['Pakwach District', (typeof obj2["Pakwach District"] === 'undefined') ? 0 : obj2['Pakwach District'][0][2]],
                ['Kasese District', (typeof obj2["Kasese District"] === 'undefined') ? 0 : obj2['Kasese District'][0][2]],
                ['Yumbe District', (typeof obj2["Yumbe District"] === 'undefined') ? 0 : obj2['Yumbe District'][0][2]],
                ['Zombo District', (typeof obj2["Zombo District"] === 'undefined') ? 0 : obj2['Zombo District'][0][2]],
                ['Kyenjojo District', (typeof obj2["Kyenjojo District"] === 'undefined') ? 0 : obj2['Kyenjojo District'][0][2]],
                ['Kamwenge District', (typeof obj2["Kamwenge District"] === 'undefined') ? 0 : obj2['Kamwenge District'][0][2]],
                ['Kyegegwa District', (typeof obj2["Kyegegwa District"] === 'undefined') ? 0 : obj2['Kyegegwa District'][0][2]],
                ['Bundibugyo District', (typeof obj2["Bundibugyo District"] === 'undefined') ? 0 : obj2['Bundibugyo District'][0][2]],
                ['Ntoroko District', (typeof obj2["Ntoroko District"] === 'undefined') ? 0 : obj2['Ntoroko District'][0][2]],
                ['Kabarole District', (typeof obj2["Kabarole District"] === 'undefined') ? 0 : obj2['Kabarole District'][0][2]],
                ['Soroti District', (typeof obj2["Soroti District"] === 'undefined') ? 0 : obj2['Soroti District'][0][2]],
                ['Katakwi District', (typeof obj2["Katakwi District"] === 'undefined') ? 0 : obj2['Katakwi District'][0][2]],
                ['Amuria District', (typeof obj2["Amuria District"] === 'undefined') ? 0 : obj2['Amuria District'][0][2]],
                ['Kumi District', (typeof obj2["Kumi District"] === 'undefined') ? 0 : obj2['Kumi District'][0][2]]
            ];

            var cdata = [
                ['Adjumani District', (typeof cobj2["Adjumani District"] === 'undefined') ? 0 : cobj2['Adjumani District'][0][2]],
                ['Arua District', (typeof cobj2["Arua District"] === 'undefined') ? 0 : cobj2['Arua District'][0][2]],
                ['Koboko District', (typeof cobj2["Koboko District"] === 'undefined') ? 0 : cobj2['Koboko District'][0][2]],
                ['Maracha District', (typeof cobj2["Maracha District"] === 'undefined') ? 0 : cobj2['Maracha District'][0][2]],
                ['Moyo District', (typeof cobj2["Moyo District"] === 'undefined') ? 0 : cobj2['Moyo District'][0][2]],
                ['Nebbi District', (typeof cobj2["Nebbi District"] === 'undefined') ? 0 : cobj2['Nebbi District'][0][2]],
                ['Pakwach District', (typeof cobj2["Pakwach District"] === 'undefined') ? 0 : cobj2['Pakwach District'][0][2]],
                ['Kasese District', (typeof cobj2["Kasese District"] === 'undefined') ? 0 : cobj2['Kasese District'][0][2]],
                ['Yumbe District', (typeof cobj2["Yumbe District"] === 'undefined') ? 0 : cobj2['Yumbe District'][0][2]],
                ['Zombo District', (typeof cobj2["Zombo District"] === 'undefined') ? 0 : cobj2['Zombo District'][0][2]],
                ['Kyenjojo District', (typeof cobj2["Kyenjojo District"] === 'undefined') ? 0 : cobj2['Kyenjojo District'][0][2]],
                ['Kamwenge District', (typeof cobj2["Kamwenge District"] === 'undefined') ? 0 : cobj2['Kamwenge District'][0][2]],
                ['Kyegegwa District', (typeof cobj2["Kyegegwa District"] === 'undefined') ? 0 : cobj2['Kyegegwa District'][0][2]],
                ['Bundibugyo District', (typeof cobj2["Bundibugyo District"] === 'undefined') ? 0 : cobj2['Bundibugyo District'][0][2]],
                ['Ntoroko District', (typeof cobj2["Ntoroko District"] === 'undefined') ? 0 : cobj2['Ntoroko District'][0][2]],
                ['Kabarole District', (typeof cobj2["Kabarole District"] === 'undefined') ? 0 : cobj2['Kabarole District'][0][2]],
                ['Soroti District', (typeof cobj2["Soroti District"] === 'undefined') ? 0 : cobj2['Soroti District'][0][2]],
                ['Katakwi District', (typeof cobj2["Katakwi District"] === 'undefined') ? 0 : cobj2['Katakwi District'][0][2]],
                ['Amuria District', (typeof cobj2["Amuria District"] === 'undefined') ? 0 : cobj2['Amuria District'][0][2]],
                ['Kumi District', (typeof cobj2["Kumi District"] === 'undefined') ? 0 : cobj2['Kumi District'][0][2]]
            ];

            drawMap(data);

            $('.select li').first().click(function(){
                //alert('First');

                cat = 'Adults';

                $('#sn a').attr('data-cat', 'akpi');
                $('#sd a').attr('data-cat', 'akpi');
                $('#rn a').attr('data-cat', 'akpi');
                $('#rd a').attr('data-cat', 'akpi');

                $('#sr').html(robj[0][0]); $('#sn a').html(robj[0][1]); $('#sd a').html(robj[0][2]); $('#si').html(robj[0][3]);
                $('#rr').html(robj[0][4]); $('#rn a').html(robj[0][5]); $('#rd a').html(robj[0][6]); $('#ri').html(robj[0][7]);

                $('.arrow-img').tooltip();

                drawBarChart(obj1, obj2, 18);
                drawMap(data);
            });

            $('.select li').last().click(function(){
                //alert('Last');

                cat = 'Paediatrics';

                $('#sn a').attr('data-cat', 'pkpi');
                $('#sd a').attr('data-cat', 'pkpi');
                $('#rn a').attr('data-cat', 'pkpi');
                $('#rd a').attr('data-cat', 'pkpi');

                $('#sr').html(robj[1][0]); $('#sn a').html(robj[1][1]); $('#sd a').html(robj[1][2]); $('#si').html(robj[1][3]);
                $('#rr').html(robj[1][4]); $('#rn a').html(robj[1][5]); $('#rd a').html(robj[1][6]); $('#ri').html(robj[1][7]);

                $('.arrow-img').tooltip();

                drawBarChart(cobj1, cobj2, 16);
                drawMap(cdata);
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
            $yr = date('Y');

        }else{

            $cur = "SELECT DISTINCT weekno, week, yr FROM staging.rass_kpi_stka_w WHERE level = 'National' ORDER BY yr DESC, weekno DESC LIMIT 1;";
            //$cur = "SELECT EXTRACT(YEAR FROM NOW()) AS yr, (EXTRACT(WEEK FROM NOW()) - 1) AS weekno;";
            $onerow = pg_fetch_array(pg_query($db, $cur));

            $org = 'akV6429SUqu'; $orgname = 'Uganda';
            $per = '2018W15'; //$onerow['yr'] . 'W' . $onerow['weekno'];
            $yr = 2018; //$onerow['yr'];
            $wk = 15; //$onerow['weekno'];

        }

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

        //Trends Data
        //Adults
        $asql = "SELECT * FROM staging.last_12_wks (". $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stka_w w
                ON w.week = lw.week  AND uid = '$org' OR entity IS NULL ORDER BY lw.id;";
        //Paeds
        $psql = "SELECT * FROM staging.last_12_wks (" . $yr . ", " . $wk . ") lw LEFT JOIN staging.rass_kpi_stkc_w w
                ON w.week = lw.week  AND uid = '$org' OR entity IS NULL ORDER BY lw.id;";

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

        $reports = array(); //Adult report indicators
        $preports = array(); //Paediatric report indicators

        //STKA data
        while($row = pg_fetch_array($res)) {

            $reports[] = $row['receivedreports'];
            $reports[] = $row['expectedreports'];
            $reports[] = $row['rso'];

            $wdata[] = array("NVP", "Adult", $row['a'], $row['aamc'], $row['au'], $row['an'], $row['am'], $row['ao'], abs($row['aa']), 'a');
            $wdata[] = array("EFV", "Adult", $row['b'], $row['bamc'], $row['bu'], $row['bn'], $row['bm'], $row['bo'], abs($row['ba']), 'b');
            $wdata[] = array("ABC", "Adult", $row['c'], $row['camc'], $row['cu'], $row['cn'], $row['cm'], $row['co'], abs($row['ca']), 'c');
            $wdata[] = array("ETV", "Adult", $row['d'], $row['damc'], $row['du'], $row['dn'], $row['dm'], $row['do'], abs($row['da']), 'd');
            $wdata[] = array("3TC", "Adult", $row['e'], $row['eamc'], $row['eu'], $row['en'], $row['em'], $row['eo'], abs($row['ea']), 'e');
            $wdata[] = array("AZT", "Adult", $row['f'], $row['famc'], $row['fu'], $row['fn'], $row['fm'], $row['fo'], abs($row['fa']), 'f');
            $wdata[] = array("RAL", "Adult", $row['g'], $row['gamc'], $row['gu'], $row['gn'], $row['gm'], $row['go'], abs($row['ga']), 'g');
            $wdata[] = array("ATV", "Adult", $row['h'], $row['hamc'], $row['hu'], $row['hn'], $row['hm'], $row['ho'], abs($row['ha']), 'h');
            $wdata[] = array("RTV", "Adult", $row['i'], $row['iamc'], $row['iu'], $row['in'], $row['im'], $row['io'], abs($row['ia']), 'i');
            $wdata[] = array("Darunavir", "Adult", $row['j'], $row['jamc'], $row['ju'], $row['jn'], $row['jm'], $row['jo'], abs($row['ja']), 'j');
            $wdata[] = array("ABC/3TC", "Adult", $row['k'], $row['kamc'], $row['ku'], $row['kn'], $row['km'], $row['ko'], abs($row['ka']), 'k');
            $wdata[] = array("AZT/3TC", "Adult", $row['l'], $row['lamc'], $row['lu'], $row['ln'], $row['lm'], $row['lo'], abs($row['la']), 'l');
            $wdata[] = array("TDF/3TC", "Adult", $row['m'], $row['mamc'], $row['mu'], $row['mn'], $row['mm'], $row['mo'], abs($row['ma']), 'm');
            $wdata[] = array("LPV/r", "Adult", $row['n'], $row['namc'], $row['nu'], $row['nn'], $row['nm'], $row['no'], abs($row['na']), 'n');
            $wdata[] = array("ATV/r", "Adult", $row['o'], $row['oamc'], $row['ou'], $row['on'], $row['om'], $row['oo'], abs($row['oa']), 'o');
            $wdata[] = array("AZT/3TC/NVP", "Adult", $row['p'], $row['pamc'], $row['pu'], $row['pn'], $row['pm'], $row['po'], abs($row['pa']), 'p');
            $wdata[] = array("TDF/3TC/EFV", "Adult", $row['q'], $row['qamc'], $row['qu'], $row['qn'], $row['qm'], $row['qo'], abs($row['qa']), 'q');
            $wdata[] = array("TDF/3TC + NVP", "Adult", $row['r'], $row['ramc'], $row['ru'], $row['rn'], $row['rm'], $row['ro'], abs($row['ra']), 'r');

        }

        //STKC data
        while($crow = pg_fetch_array($cres)) {

            $preports[] = $crow['receivedreports'];
            $preports[] = $crow['expectedreports'];
            $preports[] = $crow['rso'];

            $wdata[] = array("NVP 50mg", "Paediatric", $crow['a'], $crow['aamc'], $crow['au'], $crow['an'], $crow['am'], $crow['ao'], abs($crow['aa']), 'a');
            $wdata[] = array("NVP 10mg/ml (240ml)", "Paediatric", $crow['b'], $crow['bamc'], $crow['bu'], $crow['bn'], $crow['bm'], $crow['bo'], abs($crow['ba']), 'b');
            $wdata[] = array("NVP 10mg/ml (100ml)", "Paediatric", $crow['c'], $crow['camc'], $crow['cu'], $crow['cn'], $crow['cm'], $crow['co'], abs($crow['ca']), 'c');
            $wdata[] = array("EFV 200mg", "Paediatric", $crow['d'], $crow['damc'], $crow['du'], $crow['dn'], $crow['dm'], $crow['do'], abs($crow['da']), 'd');
            $wdata[] = array("EFV 50mg", "Paediatric", $crow['e'], $crow['eamc'], $crow['eu'], $crow['en'], $crow['em'], $crow['eo'], abs($crow['ea']), 'e');
            $wdata[] = array("ABC 60mg", "Paediatric", $crow['f'], $crow['famc'], $crow['fu'], $crow['fn'], $crow['fm'], $crow['fo'], abs($crow['fa']), 'f');
            $wdata[] = array("ABC 20mg/ml", "Paediatric", $crow['g'], $crow['gamc'], $crow['gu'], $crow['gn'], $crow['gm'], $crow['go'], abs($crow['ga']), 'g');
            $wdata[] = array("AZT 100mg", "Paediatric", $crow['h'], $crow['hamc'], $crow['hu'], $crow['hn'], $crow['hm'], $crow['ho'], abs($crow['ha']), 'h');
            $wdata[] = array("AZT 60mg", "Paediatric", $crow['i'], $crow['iamc'], $crow['iu'], $crow['in'], $crow['im'], $crow['io'], abs($crow['ia']), 'i');
            $wdata[] = array("ABC/3TC 120/60mg", "Paediatric", $crow['j'], $crow['jamc'], $crow['ju'], $crow['jn'], $crow['jm'], $crow['jo'], abs($crow['ja']), 'j');
            $wdata[] = array("ABC/3TC 60/30mg", "Paediatric", $crow['k'], $crow['kamc'], $crow['ku'], $crow['kn'], $crow['km'], $crow['ko'], abs($crow['ka']), 'k');
            $wdata[] = array("AZT/3TC 60/30mg", "Paediatric", $crow['l'], $crow['lamc'], $crow['lu'], $crow['ln'], $crow['lm'], $crow['lo'], abs($crow['la']), 'l');
            $wdata[] = array("LPV/r 100/25mg", "Paediatric", $crow['m'], $crow['mamc'], $crow['mu'], $crow['mn'], $crow['mm'], $crow['mo'], abs($crow['ma']), 'm');
            $wdata[] = array("LPV/r 80/20mg (300ml)", "Paediatric", $crow['n'], $crow['namc'], $crow['nu'], $crow['nn'], $crow['nm'], $crow['no'], abs($crow['na']), 'n');
            $wdata[] = array("LPV/r 40/10mg (Oral Pellets)", "Paediatric", $crow['o'], $crow['oamc'], $crow['ou'], $crow['on'], $crow['om'], $crow['oo'], abs($crow['oa']), 'o');
            $wdata[] = array("AZT/3TC/NVP", "Paediatric", $crow['p'], $crow['pamc'], $crow['pu'], $crow['pn'], $crow['pm'], $crow['po'], abs($crow['pa']), 'p');

        }

        //$para = "?o=" . $_GET['o'] . "&w=" . $_GET['w'] . "&wn=". $_GET['wn'] . "&on=" . $_GET['on'];

        $tr = "";
        foreach ($wdata as $item){

            $arv = $item[9];
            $cat = $item[1];

            $tr .= "<tr>";
            $tr .= "<td>" . $item[0] ."</td>";
            $tr .= "<td>" . $item[1] ."</td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $arv ."u' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[4] ."</a></td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $arv ."n' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[5] ."</a></td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $arv ."m' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[6] ."</a></td>";
            $tr .= "<td><a href='#' class='show-hfs' data-cat = '". $cat ."' data-col = '". $arv ."o' data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'>" . $item[7] ."</a></td>";
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
            $affc = $row1['aa'] + $row1['ba'] + $row1['ca'] + $row1['da'] + $row1['ea'] + $row1['fa'] + $row1['ga'] + $row1['ha']+
                $row1['ia'] + $row1['ja'] + $row1['ka'] + $row1['la'] + $row1['ma'] + $row1['na'] + $row1['oa'] + $row1['pa'] +
                $row1['qa'] + $row1['ra'];

            $reg["$row1[entity]"] = array((int)$stkouts, (float)$affc / 100);
            //$reg[] = array($row1['entity'], (int)$stkouts);
        }

        while($row2 = pg_fetch_array($res2)){

            $stkouts = $row2['rso'];
            $affc = $row2['aa'] + $row2['ba'] + $row2['ca'] + $row2['da'] + $row2['ea'] + $row2['fa'] + $row2['ga'] + $row2['ha']+
                $row2['ia'] + $row2['ja'] + $row2['ka'] + $row2['la'] + $row2['ma'] + $row2['na'] + $row2['oa'] + $row2['pa'] +
                $row2['qa'] + $row2['ra'];

            $dis["$row2[entity]"] = array(
                    array((int)$stkouts, (int)$affc, round(($stkouts * 100) / $row2['receivedreports'])),
                    array("NVP", (int)$row2['ao'], (int)$row2['aa']),
                    array("EFV", (int)$row2['bo'], (int)$row2['ba']),
                    array("ABC", (int)$row2['co'], (int)$row2['ca']),
                    array("ETV", (int)$row2['do'], (int)$row2['da']),
                    array("3TC", (int)$row2['eo'], (int)$row2['ea']),
                    array("AZT", (int)$row2['fo'], (int)$row2['fa']),
                    array("RAL", (int)$row2['go'], (int)$row2['ga']),
                    array("ATV", (int)$row2['ho'], (int)$row2['ha']),
                    array("RTV", (int)$row2['io'], (int)$row2['ia']),
                    array("Darunavir", (int)$row2['jo'], (int)$row2['ja']),
                    array("ABC/3TC", (int)$row2['ko'], (int)$row2['ka']),
                    array("AZT/3TC", (int)$row2['lo'], (int)$row2['la']),
                    array("TDF/3TC", (int)$row2['mo'], (int)$row2['ma']),
                    array("LPV/r", (int)$row2['no'], (int)$row2['na']),
                    array("ATV/r", (int)$row2['oo'], (int)$row2['oa']),
                    array("AZT/3TC/NVP", (int)$row2['po'], (int)$row2['pa']),
                    array("TDF/3TC/EFV", (int)$row2['qo'], (int)$row2['qa']),
                    array("TDF/3TC + NVP", (int)$row2['ro'], (int)$row2['ra'])
            );
        }

        //STKC Data

        while($crow1 = pg_fetch_array($cres1)){

            $stkouts = $crow1['rso'];
            $affc = $crow1['aa'] + $crow1['ba'] + $crow1['ca'] + $crow1['da'] + $crow1['ea'] + $crow1['fa'] + $crow1['ga'] + $crow1['ha']+
                    $crow1['ia'] + $crow1['ja'] + $crow1['ka'] + $crow1['la'] + $crow1['ma'] + $crow1['na'] + $crow1['oa'] + $crow1['pa'];

            $creg["$crow1[entity]"] = array((int)$stkouts, (float)$affc / 100);
        }

        while($crow2 = pg_fetch_array($cres2)){

            $stkouts = $crow2['rso'];
            $affc = $crow2['aa'] + $crow2['ba'] + $crow2['ca'] + $crow2['da'] + $crow2['ea'] + $crow2['fa'] + $crow2['ga'] + $crow2['ha']+
                    $crow2['ia'] + $crow2['ja'] + $crow2['ka'] + $crow2['la'] + $crow2['ma'] + $crow2['na'] + $crow2['oa'] + $crow2['pa'];

            $cdis["$crow2[entity]"] = array(
                array((int)$stkouts, (int)$affc, round(($stkouts * 100) / $crow2['receivedreports'])),
                array("NVP 50mg", (int)$crow2['ao'], (int)$crow2['aa']),
                array("NVP 10mg/ml (240ml)", (int)$crow2['bo'], (int)$crow2['ba']),
                array("NVP 10mg/ml (100ml)", (int)$crow2['co'], (int)$crow2['ca']),
                array("EFV 200mg", (int)$crow2['do'], (int)$crow2['da']),
                array("EFV 50mg", (int)$crow2['eo'], (int)$crow2['ea']),
                array("ABC 60mg", (int)$crow2['fo'], (int)$crow2['fa']),
                array("ABC 20mg/ml", (int)$crow2['go'], (int)$crow2['ga']),
                array("AZT 100mg", (int)$crow2['ho'], (int)$crow2['ha']),
                array("AZT 60mg", (int)$crow2['io'], (int)$crow2['ia']),
                array("ABC/3TC 120/60mg", (int)$crow2['jo'], (int)$crow2['ja']),
                array("ABC/3TC 60/30mg", (int)$crow2['ko'], (int)$crow2['ka']),
                array("AZT/3TC 60/30mg", (int)$crow2['lo'], (int)$crow2['la']),
                array("LPV/r 100/25mg", (int)$crow2['mo'], (int)$crow2['ma']),
                array("LPV/r 80/20mg (300ml)", (int)$crow2['no'], (int)$crow2['na']),
                array("LPV/r 40/10mg (Oral Pellets)", (int)$crow2['oo'], (int)$crow2['oa']),
                array("AZT/3TC/NVP", (int)$crow2['po'], (int)$crow2['pa'])
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

            $atrends[] = array($arow['week'], (float)$stkouts, (int)$clients, (int)$arow['receivedreports'],
                        (int)$arow['expectedreports']);

        }

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

            $ptrends[] = array($prow['week'], (float)$stkouts, (int)$clients, (int)$prow['receivedreports'],
                (int)$prow['expectedreports']);

        }

        //Stockout/Reporting Rates -STKA
        $snum = $reports[2]; $sden = $reports[0];
        $psrate = $atrends[10][1];
        $csrate = round(($snum / $sden) * 100, 1);

        $rnum = $reports[0]; $rden = $reports[1];
        $prrate = round(($atrends[10][3] / $atrends[10][4]) * 100);
        $crrate = round(($rnum / $rden) * 100);

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
        $pcsrate = round(($psnum / $psden) * 100, 1);

        $prnum = $preports[0]; $prden = $preports[1];
        $pprrate = round(($ptrends[10][3] / $ptrends[10][4]) * 100);
        $pcrrate = round(($prnum / $prden) * 100);

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

        $report_smry = array(
                array($csrate, $snum, $sden, $simg, $crrate, $rnum, $rden, $rimg),
                array($pcsrate, $psnum, $psden, $psimg, $pcrrate, $prnum, $prden, $primg)
        );

        pg_close($db);
    ?>

    <article class="content charts-flot-page">
        <div class="title-block" style="margin-top:-4px">
            <h3 class="title">Stock Status</h3>
            <p class="title-description">Sites with Stock out of ARVS</p>
            <div class="pull-right" style="margin-top: -47px">
                <div class="pull-left">
                    <ul class="select">
                        <li>Adults</li>
                        <li>Paediatrics</li>
                    </ul>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-info btn-sm rounded-s" data-toggle="modal" data-target="#modal-media" data-backdrop="static" data-keyboard="false" style="margin-top:-1px">
                        Level/Period - Filter
                    </button>
                </div>
            </div>
        </div>
        <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" style="padding-right: 0px">
                        <div class="card">
                            <div class="card-block">
                                <input type="hidden" value='<?php echo json_encode($report_smry); ?>'  id="rsmry" name="rsmry" data-wn="<?php echo isset($_GET['wn']) ? $_GET['wn']:$wk ; ?>" data-o="<?php echo isset($_GET['o']) ? $_GET['o']:$org ; ?>" data-on="<?php echo isset($_GET['o']) ? $_GET['on']:$orgname ; ?>" data-yr="<?php echo $yr; ?>"/>
                                <div class="card-title-block">
                                    <h3 class="title"><span>Stock Out Rate: </span><span id = "w"><?php echo isset($_GET['w']) ? $_GET['w']:$per ; ?></span> (<span id = "o"><?php echo isset($_GET['o']) ? $_GET['on']:$orgname ; ?></span>)</h3>
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
                                    <h3 class="title"><span>Reporting Rate: <?php if (isset($w))echo $w; ?></span><span class = ""><?php echo isset($_GET['w']) ? $_GET['w']:$per ; ?></span> (<span><?php echo isset($_GET['o']) ? $_GET['on']:$orgname ; ?></span>)</h3>
                                </div>

                                <section class="">
                                    <div class="">
                                        <h1 class="title"><span id="rr"><?php echo $crrate; ?></span>% <span id="ri"><?php echo $rimg; ?></span></h1>
                                        <p class="title-description"><span id="rn"><a href='#' class="show-hfs" data-cat ="akpi" data-col="areports" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'><?php echo $reports[0]; ?></a></span> of <span id="rd"><a href='#' class="show-hfs" data-cat ="akpi" data-col="atotal" data-toggle='modal' data-target='#modal-hfs' data-backdrop='static' data-keyboard='false'><?php echo $reports[1]; ?></a></span> Health Facilities Reported [<a href="#">List Not Reporting</a>]</p>
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
                                <h3 class="title">Most Stocked Out ARV Regimens - Number Of Facilities</h3>
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
