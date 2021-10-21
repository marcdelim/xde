<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> Dashboard </h2>
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
                <a class="btn btn-danger" href="<?php echo base_url() ?>pod">
					
					<span>Back</span>
				</a>
                <div class="panel panel-default" style="margin-top: 20px;">
                    
                <div class="page-content page-container" id="page-content">
                    
                    <div class="padding">
                        <div class="row">
                            <div class="container-fluid d-flex justify-content-center">
                                <div class="col-sm-8 col-md-6">
                                    <label for="area_id">Area:</label>
                                    <select class="form-control selectpicker" data-container="body" data-live-search="true" id="area_id" name="area_id">
                                        <option value="All" selected>All</option>
                                        <option value="GMA">GMA</option>
                                        <option value="N-Luzon">N-Luzon</option>
                                        <option value="S-Luzon">S-Luzon</option>
                                        <option value="Visayas">Visayas</option>
                                        <option value="Mindanao">Mindanao</option>
                                    </select>
                                </div>
                                <div class="col-sm-8 col-md-6">
                                    <label for="area2_id">Area 2:</label>
                                    <select class="form-control selectpicker" data-container="body" data-live-search="true" id="area2_id" name="area2_id">
                                        <option value="All" selected>All</option>
                                        <option value="GMA">GMA</option>
                                        <option value="Luzon-1">Luzon 1</option>
                                        <option value="Luzon-2">Luzon 2</option>
                                        <option value="Luzon-3">Luzon 3</option>
                                        <option value="Visayas-1">Visayas 1</option>
                                        <option value="Visayas-2">Visayas 2</option>
                                        <option value="Visayas-3">Visayas 3</option>
                                        <option value="Mindanao-1">Mindanao 1</option>
                                        <option value="Mindanao-2">Mindanao 2</option>
                                    </select>
                                </div>
                                <div class="col-sm-8 col-md-6"style="margin-top:10px">
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
                                <div class="col-sm-8 col-md-6" style="margin-top:10px">
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
                                <div class="col-sm-8 col-md-6" style="margin-top:10px">
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
                            </div>
                        </div>
                    </div>
                       
                </div>
            </div>
		</div>
    </div>
</div>

