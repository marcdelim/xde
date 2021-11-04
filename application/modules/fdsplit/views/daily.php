<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> FD Split (COD & N-COD) </h2>
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
                <div class="panel panel-default" style="margin-top: 20px;">
                    
                <div class="page-content page-container" id="page-content">
                    
                    <div class="padding">
                        <div class="row">
                            <div class="container-fluid d-flex justify-content-center">
                                <div class="row">
                                    
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <label for="province_id">Province:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="province_id" name="province_id">
                                            <option value="All" selected>All</option>
                                            <?php foreach ($provinces as $province): ?>
                                                <option value="<?php echo $province->province ?>"><?php echo $province->province ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <label for="city_id">City:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="city_id" name="city_id">
                                            <option value="All" selected>All</option>
                                            <?php foreach ($cities as $city): ?>
                                                <option value="<?php echo $city->city ?>"><?php echo $city->city ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-8 col-md-12"style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (COD) </div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" sty    le="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-failed-cod" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12"style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (N-COD) </div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" sty    le="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-failed-non-cod" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (COD) </div>
                                            <div class="card-body" style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="failed-cod" class="table color">
                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (N-COD)</div>
                                            <div class="card-body" style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="failed-non-cod" class="table color">

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (COD) </div>
                                            <div class="card-body" style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="failed-area-cod" class="table">
                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (N-COD) </div>
                                            <div class="card-body" style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="failed-area-non-cod" class="table">
                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (COD) </div>
                                            <div class="card-body" style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="failed-reason-cod" class="table">
                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery (N-COD) </div>
                                            <div class="card-body" style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="failed-reason-non-cod" class="table">
                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                       
                </div>
            </div>
		</div>
    </div>
</div>

