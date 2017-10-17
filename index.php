<?php
/**
 * Created by PhpStorm.
 * User: stephocay
 * Date: 14/02/2017
 * Time: 15:04
 */
//require_once ("src/commons/db.php");
require_once ("src/commons/functions.php");

//require_once ("src/commons/orgs.php");

requireFiles("src/classes");
requireFiles("src/contents");
//
//require_once ("src/classes/Content.php");
//require_once ("src/classes/Router.php");
//require_once ("src/contents/pages.php");

//new Router();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoH Uganda - Realtime ARV Stock Status Monitoring Dashboard </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/png" />
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->

    <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script> <!--1.12.4 -->

    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/rass.css">

    <style>
        .arrow-img {
            width: 16px;
            height: 14px;
            position: relative;
            top: -1px;
            left: -3px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            //alert("Hello");
            //$('#btns-sum').attr('hidden', false);
            $( ".arrow-img" ).tooltip();
            /*
            var jtext = $('#jtext').val();

            var obj = JSON.parse(jtext);

            alert (obj.a[0]);
             $("#list option[value='2']").text()
             */
            //alert ($('#ounit option').size());

            $.post(
                "src/commons/periods.php",
                {
                    //level: level
                },
                function(data, status){
                    //alert(data + " " + status);
                    var options = $("#operiod");
                    //put here error handling code!
                    var obj = JSON.parse(data);
                    //alert (obj[0].week);
                    $('.wk').html(obj[0].week);

                    $.each(JSON.parse(data), function() {
                        //alert();
                        options.append($("<option />").val(this.weekno).text(this.week));
                    });
                }
            );

            $('#olevel').change(function() {

                $('#ounit option').each(function() {
                    if ( $(this).val() != '0' ) {
                        $(this).remove();
                    }
                });

                var level = '';
                if ($(this).val() === '1') {
                    level = 'National';
                }
                else if ($(this).val() === '2') {
                    level = 'Regional';
                }
                else if ($(this).val() === '3') {
                    level = 'District';
                } else
                    return;
                $.post(
                    "src/commons/orgs.php",
                    {
                        level: level
                    },
                    function(data, status){
                        //alert(data + " " + status);
                        var options = $("#ounit");
                        //put here error handling code!
                        $.each(JSON.parse(data), function() {
                            //alert();
                            options.append($("<option />").val(this.entity).text(this.entity));
                        });
                    }
                );
            });

            $('#sel').click(function () {

                //location.reload();

                var wk = $('#operiod option:selected').text();
                var wkno = $('#operiod option:selected').val();
                var org = $('#ounit option:selected').text();

                //$('.wk').html(wk);
                //$('.org').html(org);
if ($('#ounit option:selected').val() != 0 || $('#operiod option:selected').val() != 0)
                window.location.href = "?o=" + org + "&w=" + wk + "&wn=" + wkno;

            });

            $('#ounit').change(function () {
                //$('.wk').html($('#operiod option:selected').text());
                //$('.org').html($('#ounit option:selected').text());
            });

            $('#stock').DataTable( {
                columnDefs: [ {
                    targets: [ 1 ],
                    orderData: [ 1, 0 ]
                } ]
            } );

        });
    </script>


    <!-- Theme initialization -->
</head>

<body>
<div class="main-wrapper">
    <div class="app" id="app">
        <header class="header">
            <div class="header-block header-block-collapse hidden-lg-up">
                <button class="collapse-btn" id="sidebar-collapse-btn">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="header-block header-block-search hidden-sm-down">
                <h3>Realtime ARV Stock Status Monitoring Dashboard</h3>
            </div>
        </header>
        <aside class="sidebar">
            <div class="sidebar-container">
                <div class="sidebar-header">
                    <div class="brand">
                        <div class="logo"><img src="assets/images/logo.png" class="img rass_logo"/></div>
                        RASS Dashboard
                    </div>
                </div>
                <nav class="menu">
                    <ul class="nav metismenu" id="sidebar-menu">
                        <li class="active">
                            <a href="index?category=stocks"> <i class="fa fa-th-large"></i> ARV Stocks <i class="fa arrow"></i> </a>
                            <ul>
                                <li><a href="index.php?category=stocks&option=stock_status">
                                        Stock Status
                                    </a></li>
                                <!--
                                <li><a href="index?category=stocks&option=received">
                                        Received Regimens
                                    </a></li>
                                <li><a href="index?category=stocks&option=ordered">
                                        Ordered Regimens
                                    </a></li>
                                 !-->
                            </ul>
                        </li>
                        <!--
                        <li>
                            <a href="index?category=warehouses"> <i class="fa fa-bar-chart"></i> Medical Warehouses <i class="fa arrow"></i> </a>
                            <ul>
                                <li><a href="index?category=warehouses&option=jms">
                                        Joint Medical Stores (JMS)
                                    </a></li>
                                <li><a href="index?category=warehouses&option=maul">
                                        Medical Access Ltd (MAUL)
                                    </a></li>
                                <li><a href="index?category=warehouses&option=nms">
                                        National Medical Stores (NMS)
                                    </a></li>
                            </ul>
                        </li>
                        -->
                        <li>
                            <a href="index?category=reports"> <i class="fa fa-table"></i> Reports <i class="fa arrow"></i> </a>
                            <ul>
                                <li><a href="#"> <!--index.php?category=reports&option=stockout_rates -->
                                        Stockout rates
                                    </a></li>
                                <li><a href="#"> <!--index.php?category=reports&option=art_sites -->
                                        ART Accredited Sites
                                    </a></li>
                                <li><a href="#"><!--index.php?category=reports&option=art_sites-->
                                        Warehouse Distributions
                                    </a></li>
                            </ul>
                        </li>
                        <!--
                        <li>
                            <a href=""> <i class="fa fa-desktop"></i> Help <i class="fa arrow"></i> </a>
                            <ul>
                                <li><a href="buttons.html">
                                        Getting Started
                                    </a></li>
                                <li><a href="cards.html">
                                        FAQs
                                    </a></li>
                                <li><a href="typography.html">
                                        Submit an Issue
                                    </a></li>
                                <li><a href="icons.html">
                                        Contact Us
                                    </a></li>
                            </ul>
                        </li>
                        -->
                    </ul>
                </nav>
            </div>
            <footer class="sidebar-footer">
                <ul class="nav metismenu" id="customize-menu">
                    <li>
                        <ul>
                            <li class="customize">
                                <div class="customize-item">
                                    <div class="row customize-header">
                                        <div class="col-xs-4"></div>
                                        <div class="col-xs-4"><label class="title">fixed</label></div>
                                        <div class="col-xs-4"><label class="title">static</label></div>
                                    </div>
                                    <div class="row hidden-md-down">
                                        <div class="col-xs-4"><label class="title">Sidebar:</label></div>
                                        <div class="col-xs-4"><label>
                                                <input class="radio" type="radio" name="sidebarPosition"
                                                       value="sidebar-fixed">
                                                <span></span>
                                            </label></div>
                                        <div class="col-xs-4"><label>
                                                <input class="radio" type="radio" name="sidebarPosition" value="">
                                                <span></span>
                                            </label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><label class="title">Header:</label></div>
                                        <div class="col-xs-4"><label>
                                                <input class="radio" type="radio" name="headerPosition"
                                                       value="header-fixed">
                                                <span></span>
                                            </label></div>
                                        <div class="col-xs-4"><label>
                                                <input class="radio" type="radio" name="headerPosition" value="">
                                                <span></span>
                                            </label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4"><label class="title">Footer:</label></div>
                                        <div class="col-xs-4"><label>
                                                <input class="radio" type="radio" name="footerPosition"
                                                       value="footer-fixed">
                                                <span></span>
                                            </label></div>
                                        <div class="col-xs-4"><label>
                                                <input class="radio" type="radio" name="footerPosition" value="">
                                                <span></span>
                                            </label></div>
                                    </div>
                                </div>
                                <div class="customize-item">
                                    <ul class="customize-colors">
                                        <li><span class="color-item color-red" data-theme="red"></span></li>
                                        <li><span class="color-item color-orange" data-theme="orange"></span></li>
                                        <li><span class="color-item color-green active" data-theme=""></span></li>
                                        <li><span class="color-item color-seagreen" data-theme="seagreen"></span></li>
                                        <li><span class="color-item color-blue" data-theme="blue"></span></li>
                                        <li><span class="color-item color-purple" data-theme="purple"></span></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <a href=""> <i class="fa fa-info"></i> Version 1.0.0 </a>
                    </li>
                </ul>
            </footer>
        </aside>
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <!--<article class="content dashboard-page">-->
        <?php
            $content = new Content();
            $content->controlPanel();
        ?>
        <!--</article>-->
        <footer class="footer">
            <div class="footer-block author">
                <ul class="pull-right">
                    <li> Developed By <a href="http://mets.or.ug">METS Program (MakSPH)</a></li>
                    <li><a href="http://mets.or.ug/contact/">Contact Us</a></li>
                </ul>
            </div>
        </footer>
        <div class="modal fade" id="modal-media">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Org Unit Level / Period</h4>
                    </div>
                    <div class="modal-body modal-tab-container">
                        <section class="section">
                            <!--<div class="row">-->
                                <!-- <div class="col-md-6"> -->
                                    <div class="card card-block">
                                        <div class="title-block">
                                            <h3 class="title"> Select Level of Analysis </h3>
                                        </div>
                                        <form role="form">
                                            <div class="form-group">
                                                <select class="form-control" id="olevel">
                                                    <option value="0">--Select Org Level--</option>
                                                    <option value="1">National</option>
                                                    <option value="2">Regional</option>
                                                    <option value="3">District</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="ounit">
                                                    <option value="0">--Select Org Unit--</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="operiod">
                                                    <option value="0">--Select Period--</option>
                                                </select>
                                            </div>
                                        </form>
                                   <!-- </div>-->
                               <!-- </div> -->
                                <!--
                                <div class="col-md-6">
                                    <div class="card card-block">
                                        <div class="title-block">
                                            <h3 class="title"> Select Period (Optional)</h3>
                                        </div>
                                        <form role="form">
                                            <div class="form-group">
                                                <div>
                                                    <label>
                                                        <input class="radio" name="radios" type="radio">
                                                        <span>Monthly</span>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label>
                                                        <input class="radio" type="radio" name="radios">
                                                        <span>Quartely</span>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label>
                                                        <input class="radio" type="radio" name="radios">
                                                        <span>Yearly</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                -->
                            </div>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-s" data-dismiss="modal">Cancel</button>
                        <button id = "sel" type="button" class="btn btn-primary rounded-s" data-dismiss="modal">Filter</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="confirm-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to do this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary rounded-s" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary rounded-s" data-dismiss="modal">No</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>

<script src="assets/js/vendor.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>


<!-- Highcharts JS -->
<script src="assets/js/highcharts.js" type="text/javascript"></script>
<script src="assets/js/data.js" type="text/javascript"></script>
<script src="assets/js/drilldown.js" type="text/javascript"></script>
<script src="assets/js/exporting.js" type="text/javascript"></script>
<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js">
<script src="https://code.highcharts.com/modules/exporting.js"></script>
-->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- <script src="assets/js/bootstrap.min.js" type="text/javascript"></script> -->
</body>

</html>
