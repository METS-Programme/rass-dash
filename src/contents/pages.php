<?php
/**
 * Created by PhpStorm.
 * User: stephocay
 * Date: 14/02/2017
 * Time: 17:02
 */

//<!-- JMS Warehouse -->

function warehouses_jms(){
    ?>
<article class="content dashboard-page">
    <h1>JMS Warehouse</h1>
</article>
    <?php
}
?>
<!-- MAUL Warehouse -->
<?php
function warehouses_maul(){
    ?>
<article class="content dashboard-page">
    <h1>MAUL Warehouse</h1>
</article>
    <?php
}
?>
<!-- NMS Warehouse -->
<?php
function warehouses_nms(){
    ?>
    <article class="content charts-flot-page">
        <div class="title-block">
            <h3 class="title">NMS Warehouse</h3>
            <p class="title-description"> List of sample charts with custom colors </p>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title-block">
                                <h3 class="title"> Bar Chart Example </h3>
                            </div>
                            <section class="example">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-bar-chart"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title-block">
                                <h3 class="title"> Line Cahrt Example </h3>
                            </div>
                            <section class="example">
                                <div class="flot-chart">
                                    <!--<div class="flot-chart-content" id="flot-line-chart"></div>-->
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
                            <div class="card-title-block">
                                <h3 class="title"> Pie Chart Example </h3>
                            </div>
                            <section class="example">
                                <div class="flot-chart">
                                    <div class="flot-chart-pie-content" id="flot-pie-chart"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="card-title-block">
                                <h3 class="title"> Live Chart Example </h3>
                            </div>
                            <section class="example">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart-moving"></div>
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
                                <h3 class="title"> Multiple Axes Line Chart Example </h3>
                            </div>
                            <section class="example">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart-multi"></div>
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

