<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 15/02/2017
 * Time: 12:06
 */

function stocks_received(){
    ?>

    <script type="text/javascript">

        $(document).ready(function() {
           //alert() ;
            $('#modal-placeholder').data('backdrop', "static");
            $('#modal-placeholder').data('keyboard', false);
            $('#modal-placeholder').modal('show');


            //data-toggle="modal" data-target="#modal-placeholder" data-backdrop="static" data-keyboard="false"
        });

        $(function () {
            Highcharts.chart('stock-comp', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Stock Received Vs Stock Ordered'
                },
                subtitle: {
                    text: 'Source: MoH'
                },
                xAxis: {
                    categories: [
                        'Adult 1st Line',
                        'Paed 1st Line',
                        'Adult 2nd Line',
                        'Paed 2nd Line'
                    ],
                    crosshair: true,
                    title:{
                        text: 'Line Regimens'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantity Of Stock (Tabs)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} Tabs</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Ordered',
                    data: [22000, 102000, 40000, 250000]

                }, {
                    name: 'Received',
                    data: [22000, 52000, 35000, 60000]

                }]
            });
        });
    </script>
    <!--
    <article class="content dashboard-page" style="padding-top:84px;">
        <div class="title-block">
            <h1 class="title">Stock Received - <small>Number of ARV Regimens received by a Health Facility.</small></h1>
            <!--<a href="#" class="pull-right btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#exampleModal">Level/Period - Filter</a>
            <button type="button" class="pull-right btn btn-info btn-sm rounded-s" data-toggle="modal" data-target="#modal-media">
                Level/Period - Filter
            </button>
        </div>
    -->
        <section class="section">
            <table id = "stock" class="display" cellspacing="0" ></table>
            <div class="row sameheight-container">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-block">
                            <span>Adult 1st Line Regimen</span>
                            <h2>50,567</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-block">
                            <span>Adult 2nd Line Regimen</span>
                            <h2>150,567</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-block">
                            <span>Paed 1st Line Regimen</span>
                            <h2>40,620</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-block">
                            <span>Paed 1st Line Regimen</span>
                            <h2>340,812</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row sameheight-container">
                <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-5 stats-col">
                    <div class="card sameheight-item stats" data-exclude="xs">
                        <div class="card-block">
                            <div class="title-block">
                                <h4 class="title"> Statistics - Uganda (2018W29)</h4>
                                <p class="title-description">Total Received Stock Per Region</p>
                            </div>
                            <div class="row row-sm stats-container">
                                <div class="col-xs-12 col-sm-6 stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 5,407 </div>
                                        <div class="name">Rwenzori Region</div>
                                    </div> <progress class="progress stat-progress" value="75" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 75%;"></span>
                                        </div>
                                    </progress> </div>
                                <div class="col-xs-12 col-sm-6 stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 78,464 </div>
                                        <div class="name">West Nile Region</div>
                                    </div> <progress class="progress stat-progress" value="25" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 25%;"></span>
                                        </div>
                                    </progress> </div>
                                <div class="col-xs-12 col-sm-6  stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 80,560 </div>
                                        <div class="name">Central1 Region</div>
                                    </div> <progress class="progress stat-progress" value="60" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 60%;"></span>
                                        </div>
                                    </progress> </div>
                                <div class="col-xs-12 col-sm-6  stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 359 </div>
                                        <div class="name">Masaka Region</div>
                                    </div> <progress class="progress stat-progress" value="34" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 34%;"></span>
                                        </div>
                                    </progress> </div>
                                <div class="col-xs-12 col-sm-6  stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 59 </div>
                                        <div class="name">Bunyoro Region </div>
                                    </div> <progress class="progress stat-progress" value="49" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 49%;"></span>
                                        </div>
                                    </progress> </div>
                                <div class="col-xs-12 col-sm-6  stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 59 </div>
                                        <div class="name">Kampala Region </div>
                                    </div> <progress class="progress stat-progress" value="49" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 49%;"></span>
                                        </div>
                                    </progress> </div>
                                <div class="col-xs-12 col-sm-6  stat-col">
                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                    <div class="stat">
                                        <div class="value"> 59 </div>
                                        <div class="name">Soroti Region </div>
                                    </div> <progress class="progress stat-progress" value="49" max="100">
                                        <div class="progress">
                                            <span class="progress-bar" style="width: 49%;"></span>
                                        </div>
                                    </progress> </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-7 history-col">
                    <!--
                    <div class="card sameheight-item" data-exclude="xs">
                        <div class="card-header card-header-sm bordered">
                            <div class="header-block">
                                <h3 class="title">Stock Received Vs Stock Ordered</h3>
                            </div>
                            <ul class="nav nav-tabs pull-right" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" href="#stock" role="tab" data-toggle="tab">Stock (Total)</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#adult" role="tab" data-toggle="tab">Adult Regimens</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#paed" role="tab" data-toggle="tab">Paeditric Regimens</a> </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active fade in" id="stock">

                                    <p class="title-description"></p>
                                    <section class="">
                                        <div class="">
                                            <div id="stock-comp"></div>
                                        </div>
                                    </section>

                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="adult">
                                    <p class="title-description"> Comparison Stock Received Vs Stock Ordered (Adult Regimens) </p>
                                    <div id="dashboard-downloads-chart"></div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="paed">
                                    <p class="title-description"> Comparison Stock Received Vs Stock Ordered (Paed Regimens) </p>
                                    <div id="dashboard-downloads-chart"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    -->
                    <div id="stock-comp"></div>
                </div>
            </div>
        </section>

    </article>

    <?php
}
//stocks_received();
?>