<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> Daily Summary </h2>
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
                <div class="panel panel-default" style="margin-top: 20px;">
                    
                <div class="page-content page-container" id="page-content">
                    
                    <div class="padding">
                        <div class="row">
                            <div class="container-fluid d-flex justify-content-center">
                                
                                <div class="row">
                                    <div class="col-sm-8 col-md-6">
                                        <label for="area_id">Area:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="area_id" name="area_id">
                                            <option value="All" selected>All</option>
                                            <?php foreach ($areas as $area): ?>
                                                <option value="<?php echo $area->area ?>"><?php echo $area->area ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-8 col-md-6">
                                        <label for="area2_id">Area 2:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="area2_id" name="area2_id">
                                            <option value="All" selected>All</option>
                                            <?php foreach ($area2s as $area2): ?>
                                                <option value="<?php echo $area2->area2 ?>"><?php echo $area2->area2 ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
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
                                    <div class="col-sm-8 col-md-6" style="margin-top:10px">
                                        <label for="payment_id">Payment Method:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="payment_id" name="payment_id">
                                            <option value="All" selected>All</option>
                                            <?php foreach ($payments as $payment): ?>
                                                <option value="<?php echo $payment->payment ?>"><?php echo $payment->payment ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Delivery Percentage</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" sty    le="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-del-percentage" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Delivery OTP Percentage</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-del-otp-percentage" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">1st Attempt Success</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-first-attempt" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Pickup - IB Leadtime</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-pickup-ib" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">LM Dispatch Leadtime</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-dispatch-leadtime" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Delivery Leadtime</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-del-leadtime" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Failed Delivery Percentage</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-failed-percentage" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Open Items</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-open-items" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Linehaul Leadtime</div>
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> 
                                                <canvas id="chart-linehaul-leadtime" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-12" style="margin-top:10px">
                                        <div class="card">
                                            <div class="card-header">Lazada LM Delivery Performance</div>
                                            <div class="card-body"  style="overflow-x: auto; overflow-y:auto; height: 400px">
                                                <table id="delivery-performance" class="table color">
                                        
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

