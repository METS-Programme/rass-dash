<?php
/**
 * Created by PhpStorm.
 * User: kayemilton
 * Date: 14/02/2017
 * Time: 15:04
 */

require ("src/commons/pvisits.php");

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
    <title>MoH Uganda - Realtime Stock Status Monitoring Dashboard </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/png" />

    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="">
    <!-- <link rel="stylesheet" href="assets/css/jquery-ui.css"> -->
    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->

    <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script> <!--1.12.4 -->
    <!-- Start of mets Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=ae98ab2b-b116-40c6-a092-128038209c3c"> </script>
    <!-- End of mets Zendesk Widget script -->

    <style>

        .rass_logo{
            height: 35px;
            margin-top: -50px;
        }

        .arrow-img {
            width: 16px;
            height: 14px;
            position: relative;
            top: -1px;
            left: -3px;
        }

        #dmap {
            height: 500px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }
        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }

        .select {
            display: inline-block;
            width: auto;
            color: #3B6692;
        }

        ul.select li {
            float: left;
            list-style: none;
            text-align: center;
            margin-right: 5px;
            width: auto;
            /*padding: 5px;*/
            padding-left: 8px;
            padding-right: 8px;
            color: #3B6692;
            background-color: #FFF;
            border: dashed 1px #CEC6C6;
            border-radius: 0.2rem;
        }

        ul.select li:hover {
            background-color: #46c5f2;
            color: white;
            cursor: pointer;
        }

        ul.select li.selected {
            background-color: #94979A;
            color: white;
            border-color: transparent;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            -khtml-border-radius: 5px;
            border-radius: 5px;
            text-align: center;
        }
        img.load{
            height: 129px;
            display: block;
            margin-left: auto;
            margin-right: auto
        }
        .center {
            margin: auto;
            width: 50%;
        }

        .modal-lg {
            max-width: 80% !important;
        }

        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/details_close.png') no-repeat center center;
        }

    </style>

    <script type="text/javascript">
        $(document).ready(function(){
            //console.log('Hello');

            $('.arrow-img').tooltip();

            $('.select li').first().addClass('selected');

            $('.select li').click(function(){
                $(this).addClass('selected');
                $(this).siblings().removeClass("selected");
                //alert('Hello');
            });

            //Hide org unit category select element under filter
            $('#orgcat').hide();
            //$('#ounit').disable();
            //$('#ounit').attr('disabled', 'disabled');
            //$('#ounit').removeAttr('disabled');
            /*
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
                    alert (obj[0].week);
                    $('.wk').html(obj[0].week);

                    $.each(JSON.parse(data), function() {
                        //alert();
                        options.append($("<option />").val(this.weekno).text(this.week));
                    });
                }
            );
            */
            //All orgunits
            var orgs = JSON.parse($('#orgunits').val());
            //Parent Orgunit
            var level = '', parentLevel = '';

            $('#olevel').change(function() {

                //var level = '';

                $('#ounit option').each(function() {
                    if ( $(this).val() != '0' ) {
                        $(this).remove();
                    }
                });

                if ($(this).val() === '1') {
                    level = 'National';
                    $('#ol').val("National");

                    $('#ounit').append($("<option />").val('akV6429SUqu').text('Uganda'));

                    $('#orgcat').hide();
                    $('#ounit').removeAttr('disabled');
                }
                else if ($(this).val() === '2') {
                    level = 'Regional';
                    $('#ol').val("Regional");

                    $.each(orgs, function (key, val) {
                        $('#ounit').append($("<option />").val(key.split("-")[1]).text(key.split("-")[0]));
                    });

                    $('#orgcat').hide();
                    $('#ounit').removeAttr('disabled');
                }
                else if ($(this).val() === '3') {

                    level = 'District';
                    parentLevel = 'Region'

                    $('#ol').val("District");

                    //Remove existing options before populating
                    $('#orgcat option').each(function() {
                        $(this).remove();
                    });

                    $('#orgcat').append($("<option />").val(0).text("--Select Region--"));
                    $.each(orgs, function (key, val) {
                        $('#orgcat').append($("<option />").val(key.split("-")[1]).text(key.split("-")[0]));
                    });

                    $('#orgcat').show();
                    $('#ounit').attr('disabled', 'disabled');

                } else
                    return;

                //alert (parentLevel);

                /*
                $.post(
                    "src/commons/orgs.php",
                    {
                        level: level,
                        parentLevel: parentLevel
                    },
                    function(data, status){
                        //alert(data + " " + status);
                        var options = $("#ounit");
                        //put here error handling code!
                        $.each(JSON.parse(data), function() {
                            //alert();
                            options.append($("<option />").val(this.uid).text(this.entity));
                        });
                    }
                );
                */
                //$('#ounit').removeAttr('disabled');

            });

            $('#orgcat').change(function(){
                //Selected Category
                var selcat = $('#orgcat option:selected').text();

                //Clear Org unit options before populating
                $('#ounit option').each(function() {
                    if ( $(this).val() != '0' ) {
                        $(this).remove();
                    }
                });

                //Populate orgunits at selected level and parentLevel

                $.each(orgs, function (reg, dis) {
                    //alert(reg);
                        $.each(dis, function (disn, sub) {
                            if(reg.split("-")[0] == selcat)
                                $('#ounit').append($("<option />").val(disn.split("-")[1]).text(disn.split("-")[0]));
                        });
                });

                //alert (parentLevel);
                $('#ounit').removeAttr('disabled');
            });

            $('#sel').click(function () {

                //Current Week

                var cwk = new Date().getFullYear() + "W" + new Date().getWeekNumber();

                //alert (cwk);

                //location.reload();

                var wk = $('#operiod option:selected').val();

                if (wk == cwk) {
                    var wkno = ($('#operiod option:selected').val().substring(5) - 1);
                }else {
                    var wkno = $('#operiod option:selected').val().substring(5);
                }

                var org = $('#ounit option:selected').val();
                var on = $('#ounit option:selected').text();
                var ol = $('#ol').val();

                //$('.wk').html(wk);
                //$('.org').html(org);
                if ($('#ounit option:selected').val() != 0 || $('#operiod option:selected').val() != 0)
                    window.location.href = "?o=" + org + "&w=" + wk + "&wn=" + wkno + "&on=" + on + "&ol=" + ol + "&cw=" + cwk;

            });
            /*
           $('#stock').DataTable( {
                "order": [[ 5, "desc" ]]
           } );
            */
            var table;

            $(document).on('click', '.show-hfs', function(){

                var tr = $(this).parents('tr');
                //alert(tr.children('td').eq(0).html());
                var tblid = $(this).parents('table').attr('id');

                var cat = $(this).attr("data-cat");
                var col = $(this).attr("data-col");
                var o = $('#rsmry').attr("data-o");
                var wn = $('#rsmry').attr("data-wn");
                var on = $('#rsmry').attr("data-on");
                var yr = $('#rsmry').attr("data-yr");
                //Ownership category
                var ownership = '';
                var level = '';

                if (tblid == 'orgsmry')  ownership = $(this).attr("data-ownership"); else ownership = ownership;
                if (tblid == 'orgsmry')  level = tr.children('td').eq(1).html(); else level = level;

                //alert (cat + " " + col + " " + on);

                $('#fc').addClass("center");
                $('#fc').html("<img src='assets/images/load.gif' class='img load'/>");
                //$('#fc').html("Loading...");

                $.post(
                    "src/commons/facilities.php",
                    {
                        o: o,
                        wn: wn,
                        cat: cat,
                        col: col,
                        on: on,
                        yr: yr,
                        ownership: ownership,
                        level: level
                    },
                    function(data, status){

                        //alert(data + " " + status);

                        if (status === "success") {
                            $('#fc').removeClass("center");
                            $('#fc').html(data);
                        }

                        table = $('#hf-list').DataTable({
                            //{"ajax": "assets/files/data.txt"}
                            //"autoWidth": true
                            //"order": [[1, 'asc']]
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });

                    }
                );

            });

            /* Formatting function for row details - modify as you need */
            function format ( d ) {
                // `d` is the original data object for the row
                return d.toString();
                /*
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                    '<tr>'+
                    '<td>Full name:</td>'+
                    '<td>'+ d.district +'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Extension number:</td>'+
                    '<td>'+ 'Milton' +'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Extra info:</td>'+
                    '<td>And any further details here (images etc)...</td>'+
                    '</tr>'+
                    '</table>';
                */
            }

            // Add event listener for opening and closing details
            $(document).on('click', '#hf-list tbody td.details-control', function () {

                //alert('Hello');

                var tr = $(this).closest('tr');
                var row = table.row( tr );
                //var row = $('#hf-list').DataTable({"ajax": "assets/files/data.txt"}).row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    //row.child( format(row.data()[1]) ).show();
                    //row.child( format(tr.attr('data-fid')) ).show();

                    var tr = $(this).parents('tr');
                    //alert(tr.children('td').eq(0).html());
                    var tblid = $(this).parents('table').attr('id');

                    var cat = $(this).parents('table').attr("data-ccat");
                    var o = format(tr.attr('data-fid'));
                    var wn = $('#rsmry').attr("data-wn");
                    var yr = $('#rsmry').attr("data-yr");

                    if (cat == 'rdkpi'){

                        $.post(
                        "src/commons/reports.php",
                        {
                            o: o,
                            wn: wn,
                            cat: cat,
                            yr: yr
                        },
                        function(data, status){
                            //alert(data + " " + status);
                            if (status === "success") {
                                //$('#fc').removeClass("center");
                                //$('#fc').html(data);
                                row.child( data ).show();
                            }
                        }
                        );
                    } else {
                        row.child( format(tr.attr('data-fid')) ).show();
                    }            
                    //var content = format(tr.attr('data-fid'))
                    tr.addClass('shown');
                }
            } );

            Date.prototype.getWeekNumber = function(){
                var d = new Date(Date.UTC(this.getFullYear(), this.getMonth(), this.getDate()));
                var dayNum = d.getUTCDay() || 7;
                d.setUTCDate(d.getUTCDate() + 4 - dayNum);
                var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
                return Math.ceil((((d - yearStart) / 86400000) + 1)/7)
            };

            //alert(wk);

            function getDateOfWeek(w, y) {
                var d = (1 + (w - 1) * 7); // 1st of January + 7 days for each week
                return new Date(y, 0, d);
            }

            function GetFormattedDate(d) {
                var date = new Date(d);
                //var orgdate = format(date.getDate());
                //alert(date);
                date.setDate(date.getDate() + 6);
                //alert(date);
                var month = (format(date.getMonth() + 1) <= 9) ? '0' + format(date.getMonth() + 1) : format(date.getMonth() + 1);
                var year = format(date.getFullYear());
                //alert(date.getMonth());
                //alert(date.getDate());
                if (year == 2021){
                    var day = (format(date.getDate()) <= 9) ? '0' + (format(date.getDate()) - 1)  : (format(date.getDate()) - 1);
                }else{
                    var day = (format(date.getDate()) <= 9) ? '0' + format(date.getDate()) : format(date.getDate());
                }

                if (day == 0) {
                    return "31-12-" + (year - 1);
                }else {
                    return day + "-" + month + "-" + year;
                }
            }

            //alert(GetFormattedDate(getDateOfWeek(53, '2018')));

            //Week ending 2018-11-18 (2018W46)

            //var currYear = new Date().getFullYear();

            function generatePeriods(dateObj) {

                var weekNumber, yr = dateObj.getFullYear();
                //alert(yr);
                //Check if current year
                if (yr == new Date().getFullYear())
                    weekNumber = dateObj.getWeekNumber();
                else
                    weekNumber = dateObj.getWeekNumber();

                //alert (weekNumber);

                $('.wk').html(yr + "W" + weekNumber);
                var options = $("#operiod");

                for (var i = weekNumber; i >= 1; i--) {
                    //Week e.g 2018W47
                    var week = yr + "W" + i;
                    //Weeking ending 2018-11-18 (2018W46)
                    var weekEndDate = GetFormattedDate(getDateOfWeek(i, yr));
                    options.append($("<option />").val(week).text("Week ending " + weekEndDate + " (" + week + ")"));
                }

            }

            $('#pyear').click(function () {

                //Clear periods before populating with new periods
                $('#operiod option').each(function() {
                    if ( $(this).val() != '0' ) {
                        $(this).remove();
                    }
                });

                var currYear = new Date().getFullYear();
                clicks = clicks - 1
                var prevYear = currYear + clicks;
                //Period date
                var pDate = prevYear + '-12-29';
                //alert(pDate);
                //End on 2016
                if (prevYear >= 2016) {
                    generatePeriods(new Date(pDate));
                } else {
                    //neutralize the non useful clicks
                    clicks = clicks + 1;
                    generatePeriods(new Date('2016-12-31'));
                }

               // alert(clicks);

            });

            $('#nyear').click(function () {

                //Clear periods before populating with new periods
                $('#operiod option').each(function() {
                    if ( $(this).val() != '0' ) {
                        $(this).remove();
                    }
                });

                var currYear = new Date().getFullYear();
                clicks = clicks + 1
                var nxtYear = currYear + clicks;
                //Period date
                var nDate = nxtYear + '-12-29';
                //alert(nxtYear + '=' + currYear);
                //Make sure next years don't point to future years
                if (nxtYear < currYear) {
                    generatePeriods(new Date(nDate));
                } else {
                    //neutralize the non useful clicks
                    if (nxtYear != currYear)
                        clicks = clicks - 1;
                    generatePeriods(new Date());
                }

                //alert(clicks);

            });

            var clicks = 0;

            $('#filter-btn').click(function () {
                //alert(getDateOfWeek(52, 2018));
                //Reset clicks to zero
                clicks = 0;

                //Clear periods before populating with new periods
                $('#operiod option').each(function() {
                    if ( $(this).val() != '0' ) {
                        $(this).remove();
                    }
                });

                //Default periods - Current year
                //alert(new Date())
                //alert(GetFormattedDate(getDateOfWeek(5, '2021')));
                //alert(getDateOfWeek(53, '2020'));
                //alert(new Date(2020, 0, 366))
                generatePeriods(new Date());

            });


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
                <h3>Realtime Commodity Stock Status Monitoring Dashboard</h3>
            </div>
        </header>
        <aside class="sidebar">
            <div class="sidebar-container">
                <div class="sidebar-header">
                    <div class="brand">
                        <div class="logo"><img src="assets/images/logo.png" class="img rass_logo"/></div>
                        RSS Dashboard
                    </div>
                </div>
                <nav class="menu">
                    <ul class="nav metismenu" id="sidebar-menu">
                        <li class="active">
                            <a href="?category=stocks"> <i class="fa fa-th-large"></i> Commodities <i class="fa arrow"></i> </a>
                            <ul>
                                <li><a href="?category=stocks&option=stock_status">
                                        Stock Status
                                    </a></li>

                                <li><a href="?category=stocks&option=received">
                                        <!-- data-toggle="modal" data-target="#modal-placeholder" data-backdrop="static" data-keyboard="false" -->
                                        Received Stock
                                    </a></li>

                                <!--<li><a href="index?category=stocks&option=ordered">
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
                                        Weekly Summary
                                    </a></li>
                                <!--
                                <li><a href="#"> //index.php?category=reports&option=art_sites
                                        ART Accredited Sites
                                    </a></li>
                                <li><a href="#">//--index.php?category=reports&option=art_sites
                                        Warehouse Distributions
                                    </a></li>
                                -->
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
                        <a href=""> <i class="fa fa-info"></i> Version 1.0.1 </a>
                    </li>
                </ul>
            </footer>
        </aside>
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <!--<article class="content dashboard-page">-->
        <?php
        $content = new Content();
        //$content->pageDetails();
        ?>

        <article class="content charts-flot-page dashboard-page">
            <div class="title-block" style="margin-top:-4px">
                <h3 class="title"><?php echo $content->pageDetails("title"); ?></h3>
                <p class="title-description"><?php echo $content->pageDetails("desc"); ?></p>
                <div class="pull-right" style="margin-top: -47px">
                    <div class="pull-left">
                        <ul class="select">
                            <li>Adults</li>
                            <li>Paediatrics</li>
                            <li>RTKS</li>
                            <li>COVID-19</li>
                        </ul>
                    </div>
                    <div class="pull-right">
                        <button id = "filter-btn" type="button" class="btn btn-info btn-sm rounded-s" data-toggle="modal" data-target="#modal-media" data-backdrop="static" data-keyboard="false" style="margin-top:-1px">
                            Level/Period - Filter
                        </button>
                    </div>
                </div>
            </div>

        <?php
            //$content = new Content();
            $content->controlPanel();
        ?>
        <!--</article>-->
        <footer class="footer">
            <div class="footer-block author">
                <ul class="pull-right">
                    <!--
                    <li> Powered By <a href="http://mets.or.ug">METS Program (MakSPH)</a></li>
                    <li><a href="http://mets.or.ug/contact/">Contact Us</a></li>
                    -->
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
                                                <select class="form-control" id="orgcat">
                                                    <!-- <option value="0">--Select Org Cat--</option> -->
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="ounit">
                                                    <option value="0">--Select Org Unit--</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button id="pyear" type="button" class="btn btn-sm btn-outline-secondary rounded-s">Prev Year</button>
                                                <button id="nyear" type="button" class="btn btn-sm btn-outline-secondary rounded-s">Next Year</button>
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

        <!-- Modal displaying details -->
        <div class="modal fade" id="modal-hfs">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Health Facilities</h4>
                    </div>
                    <div class="modal-body modal-tab-container">
                        <section class="section" style="padding:10px">
                                <div class="table-responsive" id="fc">
                                    <img src="assets/images/load.gif" class="img load"/>
                                </div>
                        </section>
                    </div>
                    <!--
                    <div class="modal-footer">

                    </div>
                    -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!--Modal Loading facilities with missing reports  -->
        <div class="modal fade" id="modal-mhfs">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Health Facilities</h4>
                    </div>
                    <div class="modal-body modal-tab-container">
                        <section class="section" style="padding:10px">
                            <div class="table-responsive" id="mfc">
                                <img src="assets/images/load.gif" class="img load"/>
                            </div>
                        </section>
                    </div>
                    <!--
                    <div class="modal-footer">

                    </div>
                    -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Modal Loading data -->
        <div class="modal fade" id="modal-placeholder">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location='/'">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h5 class="modal-title">Received Stock - Please wait!</h5>
                    </div>
                    <div class="modal-body modal-tab-container">
                        <section class="section" style="padding:10px">
                            <div class="table-responsive" id="">
                                <img src="assets/images/load.gif" class="img load"/>
                            </div>
                        </section>
                    </div>
                    <!--
                    <div class="modal-footer">

                    </div>
                    -->
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
<!--<script src="assets/js/jquery-ui.js" type="text/javascript"></script> -->
<script src="assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="assets/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="assets/js/jszip.min.js" type="text/javascript"></script>
<script src="assets/js/pdfmake.min.js" type="text/javascript"></script>
<script src="assets/js/vfs_fonts.js" type="text/javascript"></script>
<script src="assets/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="assets/js/buttons.print.min.js" type="text/javascript"></script>



<!-- <script src="assets/js/dataTables.fixedHeader.min.js" type="text/javascript"></script> -->

<!-- Highcharts JS -->
<script src="assets/js/highcharts.js" type="text/javascript"></script>
<script src="assets/js/data.js" type="text/javascript"></script>
<script src="assets/js/drilldown.js" type="text/javascript"></script>
<script src="assets/js/exporting.js" type="text/javascript"></script>
<script src="assets/js/map.js" type="text/javascript"></script>
<!--
<script src="https://code.highcharts.com/modules/data.src.js"></script>
<script src="https://code.highcharts.com/modules/exporting.src.js"></script>
-->
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!--Ug Map-->


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
