<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/admin_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel"> 
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Job Progress Sheet</legend><br>
                    <h4><?= $insertMessage ?></h4>
                    <div id="ROModeDiv" class="feildwrap" style="width:500px;">
                    </div><br><br>
                    <form class="form animated fadeIn">
                        <fieldset>
                            <legend onclick="DoToggle('#BasicInfoDiv')">Basic Information</legend>
                            <div id="BasicInfoDiv" class="feildwrap"><br>                        
                                <div>
                                    <label>Repair Order</label>
                                    <input id="RepairOrder" type="text" name="RepairOrder" placeholder="Enter RO Number" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Customer Name</label>
                                    <input id="Customer" type="text" name="Customer" placeholder="Customer Name" style="width: 150px;">
                                </div><div>
                                    <label>Company Name</label>
                                    <input id="CompanyName" type="text" name="CompanyName" placeholder="CompanyName" style="width: 150px;">
                                </div><br>
                                <div>
                                    <label>Est. No</label>
                                    <input id="EstNo" type="text" name="EstNo" placeholder="Estimate Number" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Reg No:</label>
                                    <input id="RegistrationNumber" type="text" name="RegistrationNumber" placeholder="Registration Number"  data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Make</label>
                                    <input id="Make" type="text" name="Make" placeholder="Make"  data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Model</label>
                                    <input id="Model" type="text" name="Model" placeholder="Model"  data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Frame No.</label>
                                    <input id="FrameNumber" type="text" name="FrameNumber" placeholder="Frame Number" data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Model Year</label>
                                    <input id="ModelYear" type="text" name="ModelYear" placeholder="Model Year"  data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Mileage</label>
                                    <input id="Mileage" type="text" name="Mileage" placeholder="Mileage"  data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Reception Date</label>
                                    <input id="ReceptionDate" type="text" name="ReceptionDate" class="date" placeholder="Reception Date" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Reception Time</label>
                                    <input id="ReceptionTime" type="text" name="ReceptionTime" placeholder="Reception Time" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Delivery Date</label>
                                    <input id="DeliveryDate" type="text" name="DeliveryDate" class="date" placeholder="Delivery Date" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Delivery Time</label>
                                    <input id="DeliveryTime" type="text" name="DeliveryTime" placeholder="Delivery Time" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Estimated Cost</label>
                                    <input id="EstimatedCost" type="text" name="EstimatedCost" placeholder="Enter Est. Cost" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Revised Delivery Date</label>
                                    <input id="RevisedDeliveryDate" type="text" name="RevisedDeliveryDate" class="date" placeholder="Enter Revised Date" style="width: 150px;" data-validation = "">
                                </div>
                                <div>
                                    <label>Revised Delivery Time</label>
                                    <input Class="Timepicker" id="RevisedDeliveryTime" type="text" name="RevisedDeliveryTime" data-time-format="H:i:s"  placeholder="Enter Revised Time" style="width: 150px;" data-validation = "">
                                </div>   
                                <div>
                                    <label>Revised Estimated</label>
                                    <input id="RevisedEstimated" type="text" name="RevisedEstimated" placeholder="Enter Revised Est."  data-validation=" " style="width: 150px;">
                                </div>
                                <div>
                                    <label>Estimated Job Time</label>
                                    <input id="EstimatedJobTime" type="text" name="EstimatedJobTime" placeholder="Enter Est. Job Time"  data-validation="" style="width: 150px;" >mins
                                </div>                          
                                <div>
                                    <fieldset style="margin-left: 139px;margin-top: 6px;width: 0px;">
                                        <legend>Category</legend>
                                        <div style="margin-left: 75px">
                                            <div id="CategoryDiv" class="feildwrap"><br>
                                                <?php
                                                $Counter = 0;
                                                foreach ($categoryList as $key) {
                                                    ?>
                                                    <div style="margin-left: 50px"><input id="Category" name="Category" type="checkbox" value="<?= $key['idCategory'] ?>"><?= $key['Name'] ?></div>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </fieldset> 
                    </form>

                    <!--All-RO Div-->
                    <div id="AllRODiv">
                        <form id="jobprogressform" action="<?= base_url() ?>index.php/jobprogresssheet/Add"  method="post" onSubmit="return validationform('mechjobprogress')" class="form animated fadeIn">
                            <fieldset>
                                <legend onclick="DoToggle('#JobDescriptionDiv')">Job Description</legend>
                                <div id="JobDescriptionDiv" class="feildwrap">
                                    <div style="display: none">
                                        <label>id RO</label>
                                        <input id="idRepairOrder" type="text" name="idRepairOrder" placeholder="" style="width: 150px;">
                                    </div>
                                    <div>
                                        <label>Job Description</label>
                                        <textarea id="JobDescription" name="JobDescription" placeholder="Enter Job Description" style="margin: 0px; width: 600px; height: 100px;"></textarea>
                                    </div><br>
                                    <div>
                                        <label>Job Requested</label>
                                        <textarea id="JobRequested" name="JobRequested" placeholder="Enter Job Requested" style="margin: 0px; width: 600px; height: 100px;"></textarea>
                                    </div>
                                    <div id="SSCDiv" style="display: none;">
                                        <label>SSC Campaign</label>
                                        <textarea id="SSC" name="SSC" placeholder="Enter SSC" style="margin: 0px; width: 600px; height: 100px;"></textarea>
                                    </div>
                                </div>
                            </fieldset>                    
                            <fieldset>
                                <legend tag="diago" onclick="DoToggle('#DiagnosisDiv')">Diagnosis: Inspection / Result</legend>
                                <div id="DiagnosisDiv" class="feildwrap">
                                    <div class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                        <table id="DiagnosisTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="02%">S.NO</th>
                                                    <th width="20%">Diagnosis</th>
                                                    <th width="20%">Jobs</th>
                                                    <th width="15%">Diagnose By</th>
                                                    <th width="19%">Clock On</th>
                                                    <th width="18%">Clock Off</th>
                                                    <th width="03%">+</th>
                                                    <th width="03%">X</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="">
                                                <tr>
                                                    <td colspan="8">
                                                        <div id="paging">
                                                        </div>
                                                </tr>
                                            </tfoot>
                                            <input name="newDiagnose" style="width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newDiagnose" value="ADD" readonly>                                 
                                            <tbody id="TblDiagnose">
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend tag="jobs" onclick="DoToggle('#JobDiv')">Jobs</legend>
                                <div id="JobDiv" class="feildwrap">
                                    <div class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                        <table id="JobTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="02%">S.NO</th>
                                                    <th width="30%">Job</th>
                                                    <th width="20%">Staff</th>
                                                    <th width="20%">Clock On</th>
                                                    <th width="20%">Clock off</th>
                                                    <th width="20%">Status</th>
                                                    <th width="07%">X</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="">
                                                <tr>
                                                    <td colspan="7">
                                                        <div id="paging">
                                                        </div>
                                                </tr>
                                            </tfoot>
                                            <input name="newJob" style=" width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer ;" id="newJob" value="ADD" readonly>                                 
        <!--                                    <input style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newJob" value="+" readonly>     //Azeem's                            
                                            <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newJob">+</span>-->
                                            <tbody id="TblJob">
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend tag="jobspackages" onclick="DoToggle('#PackageDescDiv')">Packages</legend>
                                <div id="PackageDescDiv" class="feildwrap">
                                    <div class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                        <table id="PackageTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="02%">S.NO</th>
                                                    <th width="30%">Package</th>
                                                    <th width="20%">Staff</th>
                                                    <th width="20%">Clock On</th>
                                                    <th width="20%">Clock off</th>
                                                    <th width="20%">Status</th>
                                                    <th width="07%">X</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="">
                                                <tr>
                                                    <td colspan="7">
                                                        <div id="paging">
                                                        </div>
                                                </tr>
                                            </tfoot>
                                            <input name="newPackageDesc" style=" width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer ;" id="newPackageDesc" value="ADD" readonly>                                 
        <!--                                    <input style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newJob" value="+" readonly>     //Azeem's                            
                                            <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newJob">+</span>-->
                                            <tbody id="TblPackageDesc">
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend tag="addjobs" onclick="DoToggle('#AddJobDiv')">Additional Job</legend>
                                <div id="AddJobDiv" class="feildwrap">
                                    <div class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                        <table id="AddJobTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="02%">S.NO</th>
                                                    <th width="15%">Additional Job</th>
                                                    <th width="05%">Add. Cost</th>
                                                    <th width="15%">Cust Cntc Date</th>
                                                    <th width="15%">Clock On</th>
                                                    <th width="15%">Clock off</th>
                                                    <th width="10%">Staff Name</th>
                                                    <th width="15%">Status</th>
                                                    <th width="08%">X</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="">
                                                <tr>
                                                    <td colspan="9">
                                                        <div id="paging">
                                                        </div>
                                                </tr>
                                            </tfoot>
                                            <input name="newAddJob" style=" width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newAddJob" value="ADD" readonly>                                 
                                            <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newAddJob">+</span>-->
                                            <tbody id="TblAddJob">
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend tag="jobstop" onclick="DoToggle('#JobStopDiv')">Job Stoppage</legend>
                                <div id="JobStopDiv" class="feildwrap">
                                    <div class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                        <table id="JobStopTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="02%">S.NO</th>
                                                    <th width="15%">Job</th>
                                                    <th width="05">Cost</th>
                                                    <th width="15%">Cust Cntc Date</th>
                                                    <th width="15%">Clock On</th>
                                                    <th width="15%">Clock off</th>
                                                    <th width="10%">Staff Name</th>
                                                    <th width="15%">Status</th>
                                                    <th width="15%">Remarks</th>
                                                    <th width="08%">X</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="">
                                                <tr>
                                                    <td colspan="10">
                                                        <div id="paging">
                                                        </div>
                                                </tr>
                                            </tfoot>
                                            <input name="newJobStop" style=" width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newJobStop" value="ADD" readonly>                                 
                                            <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newAddJob">+</span>-->
                                            <tbody id="TblJobStop">
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend onclick="DoToggle('#QCheckDiv')"> Quality Check</legend>
                                <div id ="QCheckDiv" class="feildwrap">
                                    <br><div style="margin-left: 40px" style="float: left">
                                        <?php
                                        foreach ($qualityList as $key) {
                                            ?>
                                            <input id="QualityCheck" name="QualityCheck" type="radio" value="<?= $key['idQualityCheck'] ?>" style="margin-left: 115px" checked><?= $key['Name'] ?>;
                                        <?php }
                                        ?>
                                    </div><br><br><br>
                                    <div style="margin-left:-45px;float: left">
                                        <label>Q.C Inspector Name</label>
                                        <select id="InspectorName" name="InspectorName" style="width:200px ">
                                            <option>Select Quality Inspector</option>
                                            <?php
                                            foreach ($staffList as $key) {
                                                $idStaff = $staffList['idStaff'];
                                                ?>
                                                <option value="<?= $key['idStaff'] ?>" ><?= $key['Name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="error-qi cb-error help-block" style="margin-left: 245px;">Select Option</span>
                                    </div> 
                                    <div style=" margin-top: -15%; margin-left: 38%; display: block !important; ">
                                        <fieldset style="margin-left: 160px;margin-top: 60px;width: 60%;min-width: 100px;">
                                            <div><br>
                                                <input id="Clean" name="Clean" type="checkbox" value="Cleanliness"><span>Cleanliness</span>
                                            </div><br><br>
                                            <div>
                                                <input id="Courtesy" name="Courtesy" type="checkbox" value="Courtesy"><span>Courtesy Item Removal</span>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>               
                            </fieldset>
                            <fieldset>
                                <legend onclick="DoToggle('#JobExpDiv')">Job Result Explanation</legend>
                                <div id="JobExpDiv" class="feildwrap">
                                    <div>
                                        <fieldset style="
                                                  margin-left: 50px;
                                                  margin-top: 6px;
                                                  width: 0px;
                                                  ">
                                            <div class="feildwrap"><br>
                                                <?php
                                                foreach ($jobResultList as $key) {
                                                    ?>
                                                    <div style="margin-left: 50px;height:auto;"><input id="JobExp" name="JobExp[]" type="checkbox" value="<?= $key['idJobResultExplanaition'] ?>"><?= $key['Name'] ?></div><br>
                                                <?php }
                                                ?>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>                        
                            </fieldset>
                            <fieldset>
                                <legend onclick="DoToggle('#PSFUDiv')">PSFU Plan</legend>
                                <div id="PSFUDiv" class="feildwrap">
                                    <div>
                                        <label style="margin-left: 155px;">Is PSFU will be done according to Standard Time of <?php echo $stdDuration; ?> Day(s) ?</label><br><br><br>
                                        <input id="Yes" name="isCustDuration" value="1" type="radio" checked data-validation = "required" onclick="shwCustDuration(this, '#custDurationDiv')" style="margin-left:300px;">Yes
                                        <input id="No" name="isCustDuration" value="0" type="radio" data-validation = "required" onclick="shwCustDuration(this, '#custDurationDiv')">No
                                    </div><br><br>
                                    <div id="custDurationDiv" style="display: none">
                                        <label>Customize Duration</label>
                                        <input id="custDuration" name="custDuration" min='0' type="number" placeholder="Enter Day(s)" style="width:90px;margin-left: 0px;"> Day(s)
                                    </div><br>
                                    <div>
                                        <label>Date</label>
                                        <input id="PSFUPlanDate" type="text" name="PSFUPlanDate" class="date" value="<?php
                                        $newDate = Date('d-m-Y', strtotime("+4 days"));
                                        echo $newDate;
                                        ?>" placeholder="PSFU Plan Date"  data-validation = "">
                                    </div>
                                    <div>
                                        <label>Time</label>
                                        <input Class="Timepicker" id="PSFUPlanTime" type="text" name="PSFUPlanTime" value="00:00:00" data-time-format="H:i:s" placeholder="PSFU Plan Time" data-validation = "">
                                    </div>
                                </div>                                 
                                <div class="btn-block-wrap">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn" value="Save" style="margin-left: 400px;width: 180px;">
                                </div>
                            </fieldset>
                        </form>
                    </div> 

                    <!--All Body-Paint Div-->
                    <div id="AllBodyPaintDiv" style="display: none;">
                        <form id="jobprogressform" action="<?= base_url() ?>index.php/jobprogresssheet/AddBodyPaint"  method="post" onSubmit="return validationform('bpjobprogress')" class="form animated fadeIn">
                            <fieldset>
                                <legend onclick="DoToggle('#InitialInfoDiv')">Initial Information</legend>
                                <div id="InitialInfoDiv" class="feildwrap">  
                                    <div style="display: none;">
                                        <label>id RO</label>
                                        <input id="idRO" type="text" name="idRO" placeholder="" style="width: 150px;">
                                    </div><br>
                                    <div>
                                        <label>Insurance Company Code</label>
                                        <input id="InsuranceCode" type="text" name="InsuranceCode" placeholder="Insurance Company Code" style="width: 150px;" data-validation = "">
                                    </div>
                                    <div>
                                        <label>Branch Name</label>
                                        <input id="BranchName" type="text" name="BranchName" placeholder="Branch Name" style="width: 150px;"  data-validation = "">
                                    </div><br>  
                                    <div>
                                        <label>Color Code Applied</label>
                                        <input id="ColourCode" type="text" name="ColourCode" placeholder="Colour/Paint Code" style="width: 150px;" data-validation = "">
                                    </div><br>
                                    <div>
                                        <label>Date Of Job Start</label>
                                        <input id="JobStartDate" type="text" name="JobStartDate" class="date" placeholder="Job Start Date" style="width: 150px;" data-validation = "required">
                                    </div>
                                    <div>
                                        <label>Time Of Job Start</label>
                                        <input Class="Timepicker" id="JobStartTime" type="text" name="JobStartTime" data-time-format="H:i:s"  placeholder="Job Start Time" style="width: 150px;" data-validation = "required">
                                    </div>                                     
                                </div>                           
                            </fieldset>
                            <fieldset>
                                <legend tag="panals" onclick="DoToggle('#PanalsDiv')">Dent-Paint Panals</legend>
                                <div id="PanalsDiv" class="feildwrap">
                                    <div class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                        <table id="PanalsTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="02%">S.NO</th>
                                                    <th width="40%">Paint Panals</th>
                                                    <th width="40%">Dent Panals</th>
                                                    <th width="07%">X</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="">
                                                <tr>
                                                    <td colspan="5">
                                                        <div id="paging">
                                                        </div>
                                                </tr>
                                            </tfoot>
                                            <input name="newPanals" style=" width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer ;" id="newPanals" value="ADD" readonly>                                 
        <!--                                    <input style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newJob" value="+" readonly>     //Azeem's                            
                                            <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newJob">+</span>-->
                                            <tbody id="TblPanals">
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Dent-Paint Staff</legend>
                                <div class="feildwrap"> 
                                    <br>
                                    <div>
                                        <label>Denter</label>
                                        <select id="idDenter" name="idDenter[]" class="bpstaff" multiple style="width: 175px;">
                                            <?php
                                            foreach ($denterList as $key) {
                                                ?>
                                                <option value="<?= $key['idStaff'] ?>" ><?= $key['Name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="error-dentername cb-error help-block" style="margin-left: 230px;margin-top:2px;">Option must be selected!</span>
                                    </div>
                                    <div>
                                        <label style="">Painter</label>
                                        <select id="idPainter" name="idPainter[]" class="bpstaff" multiple style="width: 175px;">
                                            <?php
                                            foreach ($painterList as $key) {
                                                ?>
                                                <option value="<?= $key['idStaff'] ?>" ><?= $key['Name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="error-paintername cb-error help-block" style="margin-left: 230px;margin-top:2px;">Option must be selected</span>
                                    </div>                               
                                </div>
                                <div class="btn-block-wrap">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn" value="Save" style="margin-left: 400px;width: 180px;">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </fieldset>
            </form>
            <!--Date Pop-Up-->
            <div id="ClockPop" style="width: 500px;" class="feildwrap  popup popup-detail">
                <form id="ClockPopForm" action="" method="Post" class="form animated fadeIn" onSubmit="">
                    <!--<img src="<?php // echo base_url()                                                                                                                                                                                                                         ?>assets/images/icons/close.png" width="32" height="32" alt="close" >-->
                    <div>
                        <label>Clock Date</label>
                        <input id="ClockDate" name="ClockDate" type="datetime-local" data-validation = "required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input id="DoneButton" type="button" class="btn close" value="Done">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $("#InspectorName").chosen();
        $('#DoneButton').click(function() {
            func();
        });
//        $(".chosen-select").chosen();
    });
    // On Focus Out
    $("#RepairOrder").focusout(function() {
        var search = $("#RepairOrder").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Jobprogresssheet/searchRONumber",
            type: "POST",
            data: {searchRONumber: search},
            success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
					console.log(parsedData);
                    if (parsedData.length > 0) {
                        $('#idRepairOrder').val(parsedData [0]['idRO']);
                        $('#Make').val(parsedData [0]['Vehicle']);
                        $('#Model').val(parsedData [0]['Model']);
                        $('#RegistrationNumber').val(parsedData [0]['RegNumber']);
                        $('#ModelYear').val(parsedData [0]['Year']);
                        $('#FrameNumber').val(parsedData [0]['FrameNumber']);
                        $('#Mileage').val(parsedData [0]['Mileage']);
                        $('#ReceptionDate').val(getFormatedDate(parsedData [0]['BookingDate']));
                        $('#ReceptionTime').val(parsedData [0]['BookingTime']);
                        $('#DeliveryDate').val(getFormatedDate(parsedData [0]['DeliveryDate']));
                        $('#DeliveryTime').val(parsedData [0]['DeliverTime']);
                        $('#JobRequested').val(parsedData [0]['VOC']);
                        $('#Customer').val(parsedData [0]['CustomerName']);
                        $('#EstNo').val(parsedData[0]['EstimateNo']);
                        $('#InsuranceCode').val(parsedData[0]['CompanyCode']);
                        $('#BranchName').val(parsedData[0]['BranchName']);
                        $('#ColourCode').val(parsedData[0]['ColorPaintCode']);
                        $('#CompanyName').val(parsedData[0]['CompanyNamee']);

                        // Populating Job Combo and JobDescription Textarea 
                        var JobDescField = "Jobs: ";
                        if (parsedData[0]['ROMode'] == "Mechanincal") {
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>" + parsedData[0]['ROMode'] + " RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
							
							
		/*					
							
				      JobCount = JobCount + 1;
            var items = "";
            items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                    "<td tag='job' class = 'tbl-description'><select id='Job' name='Job[]' class = 'slctboxes' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option " + (idjob[i]['idJobRef'] == '<?= $key['idJobRef'] ?>' ? "selected" : "") + "  value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                    "<td tag='technician' class = 'tbl-part'><select id='jobStaff_"+i+"' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                    "<td tag='clockOn' value='' class='tbl-price'><input value='"+idjob[i]['ClockOnDate']+'T'+idjob[i]['ClockOnTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='clockOff' value='' class='tbl-price'><input value='"+idjob[i]['ClockOffDate']+'T'+idjob[i]['ClockOffTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='status' class='tbl-price'><select style = 'width:175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option "+ (idjob[i]['isDone'] == 1 ? "selected" : "") + " value='Done'>Done</option><option "+ (idjob[i]['isNotDone'] == 1 ? "selected" : "") + " value='NotDone'>NotDone</option><option "+ (idjob[i]['isRefused'] == 1 ? "selected" : "") + " value='Refused'>Customer Refused</option></select></td>" +
                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
            $('#TblJob').append(items);
			
			var abc = [];
                                                for (ii = 0; ii < idjob[i]['staff'].length; ii++) {

                                                    abc.push(idjob[i]['staff'][ii]['idStaff']);

                                                }
                                                console.log(abc);
                                                $("#jobStaff_"+i).val(abc);
                                                $("#jobStaff_"+i).trigger("chosen:updated");
            setTime('.settime');			
							
							
					*/		
							
				

				if(parsedData[0]['s_diag']){
				    // For Diagnose
    var DiagnoseCount = 1;
   for (i=0;i<parsedData[0]['s_diag'].length;i++) {
        $("#newDiagnose").val('+');
        $("#newDiagnose").css({"font-size": "22px"});
        DiagnoseCount = DiagnoseCount + 1;
        var items = "";
        items += "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (DiagnoseCount - 1) + "</td>" +
                "<td tag='Diagnosis'><input type = 'text' value='"+parsedData[0]['s_diag'][i]['Diagnosis']+"' style = 'width: 275px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 1px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'diagnosis' placeholder = 'Diagnosis' data-validation = 'required'></td>" +
                "<td tag='DiagJobs'><select id='DiagJobs_"+i+"' name='DiagJobs' multiple class = 'chosen-select'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = 'required'><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select></td>" +
                "<td tag='DiagStaff'><select id='DiagStaff_"+i+"' name='DiagStaff' multiple class = 'chosen-select' style = 'width: 150px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); data-validation = 'required'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?></select></td>" +
                "<td tag='ClockOn'><input  value='"+parsedData[0]['s_diag'][i]['ClockOnDate']+'T'+parsedData[0]['s_diag'][i]['ClockOnTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='ClockOff'><input value='"+parsedData[0]['s_diag'][i]['ClockOffDate']+'T'+parsedData[0]['s_diag'][i]['ClockOffTime']+"'  style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOff' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td><input style='width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='ADD' onclick='populateJobs(this)'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 21px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delDiagRow(this)'></td></tr>";
        $('#TblDiagnose').append(items);
        $("select[name='DiagJobs']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='DiagStaff']").chosen({no_results_text: "Oops, nothing found!"});
	
		var abc = [];
                                                for (ii = 0; ii < parsedData[0]['s_diag'][i]['staff'].length; ii++) {

                                                    abc.push(parsedData[0]['s_diag'][i]['staff'][ii]['idStaff']);

                                                }
                                               // console.log(abc);
                                                $("#DiagStaff_"+i).val(abc);
                                                $("#DiagStaff_"+i).trigger("chosen:updated");
												
													var abc2 = [];
                                                for (ii = 0; ii < parsedData[0]['s_diag'][i]['jobs'].length; ii++) {

                                                    abc2.push(parsedData[0]['s_diag'][i]['jobs'][ii]['idJobRef']);

                                                }
                                              //  console.log(abc);
                                                $("#DiagJobs_"+i).val(abc2);
                                                $("#DiagJobs_"+i).trigger("chosen:updated");
	

        setTime('.settime');
    }
				
				}
				
				
				
				
				
	if(parsedData[0]['s_addjob']){			
				  // For Additional Job
    var AddCount = 1;
   for (i=0;i<parsedData[0]['s_addjob'].length;i++) {
        $("#newAddJob").val('+');
        $("#newAddJob").css({"font-size": "22px"});
        AddCount = AddCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (AddCount - 1) + "</td>" +
                "<td tag='AddJob'><select id='addjob' name='addjob' class = 'chosen-select slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='Cost'><input type='text' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Cost' placeholder='0' data-validation = 'required'></td>" +
                "<td tag='AddJobClockOn'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='AddJobClockOff'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfddf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOff' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='AddJobClock'><input id='AddJobClock' placeholder='DateTime'  style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='AddStaff'><select id = 'AddStaff' name='addStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                "<td tag='AddJobStatus'><select style = 'width: 120px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delAddJobRow(this)'></td></tr>";
        $('#TblAddJob').append(items);
        $("select[name='addStaff']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='addjob']").chosen({no_results_text: "Oops, nothing found!"});
        setTime('.settime');
    };
    };
				
				
				



				
							
							
							
							if(parsedData[0]['s_package'].length > 0){
								    var PackageCount = 1;
  for (i=0;i<parsedData[0]['s_package'].length;i++) {
//        $("#newPackageDesc").val('+');
        $("#newPackageDesc").css({"font-size": "22px"});
        PackageCount = PackageCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (PackageCount - 1) + "</td>" +
                "<td tag='package' class ='tbl-description'><select id='package' name='package[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allPackages as $key) {
                                                ?><option " + (parsedData[0]['s_package'][i]['idPeriodicMaintenance'] == '<?= $key['idPeriodicMaintenance'] ?>' ? "selected" : "") + " value=<?php echo $key['idPeriodicMaintenance'] ?>><?php echo $key['PeriodName'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='technician' class = 'tbl-part'><select id = 'packStaff_"+i+"' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td > " +
                "<td tag='clockOn' class='tbl-price'><input value='"+parsedData[0]['s_package'][i]['ClockOnDate']+'T'+parsedData[0]['s_package'][i]['ClockOnTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='clockOff' class='tbl-price'><input value='"+parsedData[0]['s_package'][i]['ClockOffDate']+'T'+parsedData[0]['s_package'][i]['ClockOffTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option "+ (parsedData[0]['s_package'][i]['isDone'] == 1 ? "selected" : "") + " value='Done'>Done</option><option "+ (parsedData[0]['s_package'][i]['isNotDone'] == 1 ? "selected" : "") + " value='NotDone'>NotDone</option><option "+ (parsedData[0]['s_package'][i]['isRefused'] == 1 ? "selected" : "") + " value='Refused'>Customer Refused</option></select></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPackageRow(this)'></td></tr>";
        $('#TblPackageDesc').append(items);
		
			var abc = [];
                                                for (ii = 0; ii < parsedData[0]['s_package'][i]['staff'].length; ii++) {

                                                    abc.push(parsedData[0]['s_package'][i]['staff'][ii]['idStaff']);

                                                }
                                                console.log(abc);
                                                $("#packStaff_"+i).val(abc);
                                                $("#packStaff_"+i).trigger("chosen:updated");
		
		
        setTime('.settime');
		
		
       // $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
    };
								
							}else if(parsedData[0]['ro_package'].length > 0){
								
								 $("#newPackageDesc").css({"font-size": "22px"});
        PackageCount = PackageCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (PackageCount - 1) + "</td>" +
                "<td tag='package' class ='tbl-description'><select id='package' name='package[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allPackages as $key) {
                                                ?><option " + (parsedData[0]['ro_package'][i]['idPeriodicMaintenanceDetail'] == '<?= $key['idPeriodicMaintenance'] ?>' ? "selected" : "") + " value=<?php echo $key['idPeriodicMaintenance'] ?>><?php echo $key['PeriodName'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='technician' class = 'tbl-part'><select id = 'packStaff_"+i+"' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td > " +
                "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option  value='Done'>Done</option><option  value='NotDone'>NotDone</option><option  value='Refused'>Customer Refused</option></select></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPackageRow(this)'></td></tr>";
        $('#TblPackageDesc').append(items);
								
							}
							
							if (parsedData[0]['SubModeName'] !== "PM"){
								console.log('yes');
								  $('#roModeType').val('GR');
								if(parsedData[0]['s_job'].length > 0){
									//console.log('s_job');
									 for (ii=0;ii<parsedData[0]['s_job'].length;ii++) {
									jobsGrid2(ii, parsedData[0]['s_job'], "", "Diag");
									}
								}else if(parsedData[0]['ro_job'].length > 0){
									//console.log('ro_job');
									for (ii=0;ii<parsedData[0]['ro_job'].length;ii++) {
									jobsGrid3(ii, parsedData[0]['ro_job'], "", "Diag");
									}
									
								}else{
								 // console.log('else');
                            var mjob = "";
                            var idmjob = "";
                            idmjob = parsedData[0]['idJobTask'].split(",");
                            mjob = parsedData[0]['JobTask'].split(",");
                            mjob = removeDuplications(mjob);
                            idmjob = removeDuplications(idmjob);
							 $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
							                            for (val in mjob) {
                          //      jobsGrid(val, idmjob, "", "Diag");
//                                According to new Change
//                                valueField += "<option value=" + idmjob[val] + ">" + mjob[val] + "</option>";
                                if ((mjob.length - 1) == val) {
                                    JobDescField += mjob[val];
                                } else {
                                    JobDescField += mjob[val] + ",";
                                }
                            }
								}
							}
                        
                        } else if (parsedData[0]['ROMode'] === "BodyPaint") {
                            $('#idRO').val(parsedData [0]['idRO']);
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>" + parsedData[0]['ROMode'] + " RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').hide();
                            $('#AllBodyPaintDiv').show();
                            $('#roModeType').val('BP');
                            $('.bpstaff').chosen();
                            var idjobp = "";
                            var bpjob = "";
                            idjobp = parsedData [0]['idJobRefBP'].split(",");
                            bpjob = parsedData [0]['JobTaskBP'].split(",");
                            bpjob = removeDuplications(bpjob);
                            idjobp = removeDuplications(idjobp);
                            for (val in bpjob) {
                                jobsGrid(val, idjobp, "", "Diag");
//                                  According to new Change
//                                valueField += "<option value=" + idjobp[val] + ">" + bpjob[val] + "</option>";
                                if ((bpjob.length - 1) == val) {
                                    JobDescField += bpjob[val];
                                } else {
                                    JobDescField += bpjob[val] + ",";
                                }
                            }
                        } else if (parsedData[0]['ROMode'] === "GR-PM") {
							console.log('GR-PM');
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>GR-PM Package RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('GR-PM');
//                            Populating GR-Jobs
                            var mjob = "";
                            var idmjob = "";
                            PackageCount = PackageCount + 1;
                            idmjob = parsedData[0]['idJobTask'].split(",");
                            mjob = parsedData[0]['JobTask'].split(",");
                            mjob = removeDuplications(mjob);
                            idmjob = removeDuplications(idmjob);
                            for (val in mjob) {
                                jobsGrid(val, idmjob, "", "Diag");
//                                According to new Change
//                                valueField += "<option value=" + idmjob[val] + ">" + mjob[val] + "</option>";
                                if ((mjob.length - 1) == val) {
                                    JobDescField += mjob[val];
                                } else {
                                    JobDescField += mjob[val] + ",";
                                }
                            }

//                            Populating Packages
                            var items = "";
                            items += "<tr><td class='tbl-count'>" + (PackageCount - 1) + "</td>" +
                                    "<td tag='package' class ='tbl-description'><select id='package' name='package[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allPackages as $key) {
                                                ?><option " + (parsedData[0]['PMPackage'] == '<?= $key['PeriodName'] ?>' ? "selected" : "") + " value=<?php echo $key['idPeriodicMaintenance'] ?>><?php echo $key['PeriodName'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                                    "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> < /select></td > " +
                                    "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                                    "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                                    "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPackageRow(this)'></td></tr>";
                            $('#TblPackageDesc').append(items);
                            setTime('.settime');
                            $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
                            JobDescField += ' PM-Package, ' + parsedData[0]['PMPackage'];
                        } else if (parsedData[0]['ROMode'] === "Other-PM") {
							console.log('OTHER-PM');
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>Other-PM RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('Other-PM');
                            var mjob = "";
                            var idmjob = "";
                            idmjob = parsedData[0]['idPmdJobs'].split(",");
                            mjob = parsedData[0]['PMJobs'].split(",");
                            mjob = removeDuplications(mjob);
                            idmjob = removeDuplications(idmjob);
                            for (var val in mjob) {
                                jobsGrid(val, idmjob, "", "Diag");
//                                According to new Change
//                                valueField += "<option value=" + idmjob[val] + ">" + mjob[val] + "</option>";
                                if ((mjob.length - 1) == val) {
                                    JobDescField += mjob[val];
                                } else {
                                    JobDescField += mjob[val] + ",";
                                }
                            }
                        } else if (parsedData[0]['ROMode'] === "Other PM-GR") {
							console.log('OTHER GR-PM');
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>Other PM-GR RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('Other PM-GR');
                            //                            Populating GR-Jobs
                            var mjob = "";
                            var idmjob = "";
                            var pmjob = "";
                            var idpmjob = "";
                            PackageCount = PackageCount + 1;
                            idmjob = parsedData[0]['idJobTask'].split(",");
                            mjob = parsedData[0]['JobTask'].split(",");
                            mjob = removeDuplications(mjob);
                            idmjob = removeDuplications(idmjob);
                            for (val in mjob) {
                                jobsGrid(val, idmjob, "", "Diag");
//                                According to new Change
//                                valueField += "<option value=" + idmjob[val] + ">" + mjob[val] + "</option>";
                                if ((mjob.length - 1) == val) {
                                    JobDescField += mjob[val] + " ";
                                } else {
                                    JobDescField += mjob[val] + ",";
                                }
                            }
                            idpmjob = parsedData[0]['idPmdJobs'].split(",");
                            pmjob = parsedData[0]['PMJobs'].split(",");
                            pmjob = removeDuplications(pmjob);
                            idpmjob = removeDuplications(idpmjob);
                            for (val in pmjob) {
                                jobsGrid(val, idpmjob, "", "Diag");
//                                According to new Change
//                                valueField += "<option value=" + idmjob[val] + ">" + mjob[val] + "</option>";
                                if ((pmjob.length - 1) == val) {
                                    JobDescField += pmjob[val];
                                } else {
                                    JobDescField += pmjob[val] + " ,";
                                }
                            }

//                            Populating Packages
                            var items = "";
                            items += "<tr><td class='tbl-count'>" + (PackageCount - 1) + "</td>" +
                                    "<td tag='package' class ='tbl-description'><select id='package' name='package[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allPackages as $key) {
                                                ?><option " + (parsedData[0]['PMPackage'] == '<?= $key['PeriodName'] ?>' ? "selected" : "") + " value=<?php echo $key['idPeriodicMaintenance'] ?>><?php echo $key['PeriodName'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                                    "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td> " +
                                    "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                                    "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                                    "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPackageRow(this)'></td></tr>";
                            $('#TblPackageDesc').append(items);
                            setTime('.settime');
                            $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
                            JobDescField += 'PM-Package, ' + parsedData[0]['PMPackage'];
                        } else if (parsedData[0]['ROMode'] === "SSC-Campaign") {
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>SSC-Campaign RO</label>");
                            $('#SSCDiv').show();
                            $('#SSC').text(parsedData[0]['SSCDescription']);
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('SSC-Campaign');
                            JobDescField += 'SSC-Campaing';
                        } else if (parsedData[0]['ROMode'] === "Warranty") {
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>Warranty RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('Warranty');
                            var mjob = "";
                            var idmjob = "";
                            idmjob = parsedData[0]['idJobTask'].split(",");
                            mjob = parsedData[0]['JobTask'].split(",");
                            mjob = removeDuplications(mjob);
                            idmjob = removeDuplications(idmjob);
                            for (val in mjob) {
                                jobsGrid(val, idmjob, "", "Diag");
//                                According to new Change
//                                valueField += "<option value=" + idmjob[val] + ">" + mjob[val] + "</option>";
                                if ((mjob.length - 1) == val) {
                                    JobDescField += mjob[val];
                                } else {
                                    JobDescField += mjob[val] + ",";
                                }
                            }
                        }else  if (parsedData[0]['SubModeName'] === "PDS") {
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>PDS RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('PDS');
                        } else if (parsedData[0]['SubModeName'] === "PM") {
							console.log('PM');
                            $('#ROModeDiv').html("<label style='font-weight: bolder;font-size:35px;margin-left: 230px;width:400px;'>PM-Package RO</label>");
                            $('#SSCDiv').hide();
                            $('#AllRODiv').show();
                            $('#AllBodyPaintDiv').hide();
                            $('#roModeType').val('PM');
                            PackageCount = PackageCount + 1;
                            var items = "";
                            items += "<tr><td class='tbl-count'>" + (PackageCount - 1) + "</td>" +
                                    "<td tag='package' class ='tbl-description'><select id='package' name='package[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allPackages as $key) {
                                                ?><option " + (parsedData[0]['PMPackage'] == '<?= $key['PeriodName'] ?>' ? "selected" : "") + " value=<?php echo $key['idPeriodicMaintenance'] ?>><?php echo $key['PeriodName'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                                    "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?></option ><?php } ?> </select></td > " +
                                    "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                                    "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                                    "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPackageRow(this)'></td></tr>";
                            $('#TblPackageDesc').append(items);
                            setTime('.settime');
                            $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
                            JobDescField += 'PM-Package, ' + parsedData[0]['PMPackage'];

                        }else{
							console.log('diff');
								if(parsedData[0]['s_job'].length > 0){
									//console.log('s_job');
									 for (ii=0;ii<parsedData[0]['s_job'].length;ii++) {
									jobsGrid2(ii, parsedData[0]['s_job'], "", "Diag");
									}
								}else if(parsedData[0]['ro_job'].length > 0){
									//console.log('ro_job');
									for (ii=0;ii<parsedData[0]['ro_job'].length;ii++) {
									jobsGrid3(ii, parsedData[0]['ro_job'], "", "Diag");
									}
									
								}
						}
//                        According to new Change
//                        valueField = "<select id='Job' name = 'Job[]' style = 'width: 120px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option>Select Option(s)s</option>";
//                        valueField += "</select>";
//                        $('#TblJob').find("td:eq(1)").empty();
//                        $('#TblJob').find("td:eq(1)").append(valueField);

                        $('#JobDescription').val(JobDescField);
//                        According to new Change
//                        $("select[name='Job[]']").chosen({no_results_text: "No Jobs!"});

                    } else {

                        $('#Make').val('');
                        $('#Model').val('');
                        $('#RegistrationNumber').val('');
                        $('#ModelYear').val('');
                        $('#FrameNumber').val('');
                        $('#Mileage').val('');
                        $('#ReceptionDate').val('');
                        $('#ReceptionTime').val('');
                        $('#DeliveryDate').val('');
                        $('#DeliveryTime').val('');
                    }
                }
            }
        });
    });
	
	 function jobsGrid2(i, idjob, jobtask, cause) {
	//	console.log(idjob[i]['staff']);
//        $("#newJob").val('+');
        $("#newJob").css({"font-size": "22px"});
        if (cause === "Diag") {
//            valueField = "<input type = 'text' name = 'Job[]' value='" + idjob[i] + "' style='display:none'><input type = 'text' value='" + jobtask[i] + "' style = 'width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 1px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder = 'Job' data-validation = 'required'>";
            JobCount = JobCount + 1;
            var items = "";
            items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                    "<td tag='job' class = 'tbl-description'><select id='Job' name='Job[]' class = 'slctboxes' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option " + (idjob[i]['idJobRef'] == '<?= $key['idJobRef'] ?>' ? "selected" : "") + "  value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                    "<td tag='technician' class = 'tbl-part'><select id='jobStaff_"+i+"' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                    "<td tag='clockOn' value='' class='tbl-price'><input value='"+idjob[i]['ClockOnDate']+'T'+idjob[i]['ClockOnTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='clockOff' value='' class='tbl-price'><input value='"+idjob[i]['ClockOffDate']+'T'+idjob[i]['ClockOffTime']+"' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='status' class='tbl-price'><select style = 'width:175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option "+ (idjob[i]['isDone'] == 1 ? "selected" : "") + " value='Done'>Done</option><option "+ (idjob[i]['isNotDone'] == 1 ? "selected" : "") + " value='NotDone'>NotDone</option><option "+ (idjob[i]['isRefused'] == 1 ? "selected" : "") + " value='Refused'>Customer Refused</option></select></td>" +
                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
            $('#TblJob').append(items);
			
			var abc = [];
                                                for (ii = 0; ii < idjob[i]['staff'].length; ii++) {

                                                    abc.push(idjob[i]['staff'][ii]['idStaff']);

                                                }
                                                console.log(abc);
                                                $("#jobStaff_"+i).val(abc);
                                                $("#jobStaff_"+i).trigger("chosen:updated");
            setTime('.settime');
        } else {
            if (cause === "Jobs") {
                JobCount = JobCount + 1;
                var items = "";
                items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                        "<td tag='job' class ='tbl-description'><select id='Job' name='Job[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                        "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                        "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                        "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                        "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                        "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
                $('#TblJob').append(items);
                setTime('.settime');
            }
        }
//        $("select[name='Job']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
    }
	
	 function jobsGrid3(i, idjob, jobtask, cause) {
	//	console.log(idjob[i]['staff']);
//        $("#newJob").val('+');
        $("#newJob").css({"font-size": "22px"});
        if (cause === "Diag") {
//            valueField = "<input type = 'text' name = 'Job[]' value='" + idjob[i] + "' style='display:none'><input type = 'text' value='" + jobtask[i] + "' style = 'width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 1px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder = 'Job' data-validation = 'required'>";
            JobCount = JobCount + 1;
            var items = "";
            items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                    "<td tag='job' class = 'tbl-description'><select id='Job' name='Job[]' class = 'slctboxes' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option " + (idjob[i]['idJobRefManual'] == '<?= $key['idJobRef'] ?>' ? "selected" : "") + "  value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                    "<td tag='technician' class = 'tbl-part'><select id='jobStaff_"+i+"' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                    "<td tag='clockOn' value='' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='clockOff' value='' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='status' class='tbl-price'><select style = 'width:175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option  value='Done'>Done</option><option  value='NotDone'>NotDone</option><option  value='Refused'>Customer Refused</option></select></td>" +
                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
            $('#TblJob').append(items);
			
			
                                             
    
        } else {
            if (cause === "Jobs") {
                JobCount = JobCount + 1;
                var items = "";
                items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                        "<td tag='job' class ='tbl-description'><select id='Job' name='Job[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                        "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                        "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                        "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                        "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                        "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
                $('#TblJob').append(items);
                setTime('.settime');
            }
        }
//        $("select[name='Job']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
    }
    // For Diagnose
    var DiagnoseCount = 1;
    $("#newDiagnose").click(function(e) {
        $("#newDiagnose").val('+');
        $("#newDiagnose").css({"font-size": "22px"});
        DiagnoseCount = DiagnoseCount + 1;
        var items = "";
        items += "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (DiagnoseCount - 1) + "</td>" +
                "<td tag='Diagnosis'><input type = 'text' style = 'width: 275px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 1px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'diagnosis' placeholder = 'Diagnosis' data-validation = 'required'></td>" +
                "<td tag='DiagJobs'><select id='DiagJobs' name='DiagJobs' multiple class = 'chosen-select'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = 'required'><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select></td>" +
                "<td tag='DiagStaff'><select id='DiagStaff' name='DiagStaff' multiple class = 'chosen-select' style = 'width: 150px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); data-validation = 'required'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?></select></td>" +
                "<td tag='ClockOn'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='ClockOff'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOff' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td><input style='width:45px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='ADD' onclick='populateJobs(this)'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 21px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delDiagRow(this)'></td></tr>";
        $('#TblDiagnose').append(items);
        $("select[name='DiagJobs']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='DiagStaff']").chosen({no_results_text: "Oops, nothing found!"});
        setTime('.settime');
    });
    // For JOB
    var JobCount = 1;
    $("#newJob").click(function(e) {
        jobsGrid("", "", "", "Jobs");
    });
    // For Additional Job
    var AddCount = 1;
    $("#newAddJob").click(function(e) {
        $("#newAddJob").val('+');
        $("#newAddJob").css({"font-size": "22px"});
        AddCount = AddCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (AddCount - 1) + "</td>" +
                "<td tag='AddJob'><select id='addjob' name='addjob' class = 'chosen-select slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='Cost'><input type='text' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Cost' placeholder='0' data-validation = 'required'></td>" +
                "<td tag='AddJobClockOn'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='AddJobClockOff'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfddf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOff' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='AddJobClock'><input id='AddJobClock' placeholder='DateTime'  style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='AddStaff'><select id = 'AddStaff' name='addStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                "<td tag='AddJobStatus'><select style = 'width: 120px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delAddJobRow(this)'></td></tr>";
        $('#TblAddJob').append(items);
        $("select[name='addStaff']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='addjob']").chosen({no_results_text: "Oops, nothing found!"});
        setTime('.settime');
    });
    // For Job Stop
    var JobStopCount = 1;
    $("#newJobStop").click(function(e) {
        $("#newJobStop").val('+');
        $("#newJobStop").css({"font-size": "22px"});
        JobStopCount = JobStopCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (JobStopCount - 1) + "</td>" +
                "<td tag='StopJob'><select id='stopjob' name='stopjob' class = 'chosen-select slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='StopCost'><input type='text' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Cost' placeholder='0' data-validation = 'required'></td>" +
                "<td tag='JobStopClock'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='JobStopClockOn'><input style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOff' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='JobStopClockOff'><input id='' placeholder='DateTime'  style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='JobStopStaff'><select id = 'stopStaff' name='stopStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                "<td tag='JobStopStatus'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                "<td tag='JobStopRemarks'><input id='JobStoppageRemarks' placeholder='Remarks' style='width: 275px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobStopRow(this)'></td></tr>";
        $('#TblJobStop').append(items);
        $("select[name='stopStaff']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='stopjob']").chosen({no_results_text: "Oops, nothing found!"});
        setTime('.settime');
    });
    // For Package Desc
    var PackageCount = 1;
    $("#newPackageDesc").click(function(e) {
//        $("#newPackageDesc").val('+');
        $("#newPackageDesc").css({"font-size": "22px"});
        PackageCount = PackageCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (PackageCount - 1) + "</td>" +
                "<td tag='package' class ='tbl-description'><select id='package' name='package[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allPackages as $key) {
                                                ?><option value=<?php echo $key['idPeriodicMaintenance'] ?>><?php echo $key['PeriodName'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td > " +
                "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPackageRow(this)'></td></tr>";
        $('#TblPackageDesc').append(items);
        setTime('.settime');
        $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
    });

    // For Panal Desc
    var PanalCount = 1;
    $("#newPanals").click(function(e) {
        $("#newPanals").css({"font-size": "22px"});
        PanalCount = PanalCount + 1;
        var items = "";
        items += "<tr><td class='tbl-count'>" + (PanalCount - 1) + "</td>" +
                "<td tag='dentpanals' class ='tbl-description'><select id='dent' name='dent[]' class = 'chosen-select slctboxesdent'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Dent Panal</option><?php
                                            foreach ($allDentPanals as $key) {
                                                ?><option value=<?php echo $key['idPanalDent'] ?>><?php echo $key['PanalName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td tag='paintpanals' class ='tbl-description'><select id='paint' name='paint[]' class = 'chosen-select slctboxespaint'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Paint Panal</option><?php
                                            foreach ($allPaintPanals as $key) {
                                                ?><option value=<?php echo $key['idPanalPaint'] ?>><?php echo $key['PanalName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delPanalRow(this)'></td></tr>";
        $('#TblPanals').append(items);
        setTime('.settime');
        $(".slctboxesdent").chosen();
        $(".slctboxespaint").chosen();
        $(".slctboxesdent").chosen({no_results_text: "Oops, nothing found!"});
        $(".slctboxespaint").chosen({no_results_text: "Oops, nothing found!"});
    });

    function populateJobs(obj) {
        var objVal = $(obj).val();
        if (objVal === "ADD") {
            var count = $(obj).closest('tr').find('td:eq(2)').find('select :selected').length;
            var text = $(obj).closest('tr').find('td:eq(2)').find('select :selected').text();
            var idvalues = $(obj).closest('tr').find('td:eq(2)').find('select').val();
            var jobtask = text.split(",");
            for (var i = 0; i < count; i++) {
                jobsGrid(i, idvalues, jobtask, "Diag");
            }
        }
        $(obj).val('N.A');
    }

    var valueField = "";
    function jobsGrid(i, idjob, jobtask, cause) {
//        $("#newJob").val('+');
        $("#newJob").css({"font-size": "22px"});
        if (cause === "Diag") {
//            valueField = "<input type = 'text' name = 'Job[]' value='" + idjob[i] + "' style='display:none'><input type = 'text' value='" + jobtask[i] + "' style = 'width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 1px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder = 'Job' data-validation = 'required'>";
            JobCount = JobCount + 1;
            var items = "";
            items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                    "<td tag='job' class = 'tbl-description'><select id='Job' name='Job[]' class = 'slctboxes' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option " + (idjob[i] == '<?= $key['idJobRef'] ?>' ? "selected" : "") + "  value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                    "<td tag='technician' class = 'tbl-part'><select id='jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                    "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                    "<td tag='status' class='tbl-price'><select style = 'width:175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
            $('#TblJob').append(items);
            setTime('.settime');
        } else {
            if (cause === "Jobs") {
                JobCount = JobCount + 1;
                var items = "";
                items += "<tr><td class='tbl-count'>" + (JobCount - 1) + "</td>" +
                        "<td tag='job' class ='tbl-description'><select id='Job' name='Job[]' class = 'slctboxes'  style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Option(s)</option><?php
                                            foreach ($allJobs as $key) {
                                                ?><option value=<?php echo $key['idJobRef'] ?>><?php echo $key['JobTask'] . ',' ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                        "<td tag='technician' class = 'tbl-part'><select id = 'jobStaff' name='jobStaff' multiple class = 'chosen-select' style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><?php
                                            foreach ($staffList as $key) {
                                                ?><option value='<?= $key['idStaff'] ?>'><?= $key['Name'] ?> </option ><?php } ?> </select></td>" +
                        "<td tag='clockOn' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                        "<td tag='clockOff' class='tbl-price'><input value='' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ClockOn' placeholder='Date Time' data-validation = 'required' onClick=UpdatePopup('detail',this)></td>" +
                        "<td tag='status' class='tbl-price'><select style = 'width: 175px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option value='Done'>Done</option><option value='NotDone'>NotDone</option><option value='Refused'>Customer Refused</option></select></td>" +
                        "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='delJobRow(this)'></td></tr>";
                $('#TblJob').append(items);
                setTime('.settime');
            }
        }
//        $("select[name='Job']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='jobStaff']").chosen({no_results_text: "Oops, nothing found!"});
    }

	
	
	
    function DoToggle(id) {
        $(id).toggle();
    }

    function setTime(timeclass) {
        $(timeclass).timepicker();
    }

    function delDiagRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('DiagnosisTable').deleteRow(i);
    }

    function delJobRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('JobTable').deleteRow(i);
    }

    function delAddJobRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('AddJobTable').deleteRow(i);
    }

    function delJobStopRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('JobStopTable').deleteRow(i);
    }

    function delPackageRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('PackageTable').deleteRow(i);
    }

    function delPanalRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('PanalsTable').deleteRow(i);
    }
    var func;
    function UpdatePopup(div_id, obj) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close'
        }, function() {
            func = function() {
                var cDate = $('#ClockPop input[name=ClockDate]').val();
                $(obj).val(cDate);
                $('#ClockPop').hide();
            };
        });
    }

    function setData(target) {
        var data = [];
        var trs = $(target).children().eq(1).find("tbody tr");
        for (var x = 0; x < trs.length; x++) {
            var d = {};
            var tds = $(trs[x]).find("td[tag]");
            for (var y = 0; y < tds.length; y++) {
                var td = tds[y];
                d[$(td).attr("tag")] = $(td).eq(0).children().eq(0).val();
            }
            data.push(d);
        }
        $(target).eq(0).append("<input type='hidden' name='" + $(target).children().eq(0).attr("tag") + "' value='" + JSON.stringify(data) + "'>");
    }

    function removeDups(array) {
        var index = {};
        for (var i = array.length - 1; i >= 0; i--) {
            if (array[i] in index) {
                // remove this item
                array.splice(i, 1);
            } else {
                // add this value index
                index[array[i]] = true;
            }
        }
        return index;
    }

    function removeDuplications(a) {
        var b = [];
        for (var x in a) {
            if (b.indexOf($.trim(a[x])) === -1) {
                b.push($.trim(a[x]));
            }
        }
        return b;
    }

    function shwCustDuration(obj, id) {
        var $noValue = $(obj).val();
        if ($noValue === "0") {
            $(id).show();
        } else {
            if ($noValue === "1") {
                $(id).hide();
            }
        }
    }

    function getFormatedDate(dateVal) {
        var DateIs = new Date(dateVal);
        var Day = DateIs.getDate();
//        var Month = DateIs.get() + 1;
        var Year = DateIs.getFullYear();
//        if (Month < 10) {
//            Month = "0" + Month;
//        }
        if (Day < 10) {
            Day = "0" + Day;
        }
        var d = new Date();
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
        var Month = month[d.getMonth()];
        var formatedDate = Day + "-" + Month + "-" + Year;
        return formatedDate;
    }

    function selectTheCombo(selector, values) {
        selector.filter(function() {
            return ($(this).val() == values);
        }).prop('selected', true);
    }

    function validationform(type) {
        if (type === "mechjobprogress") {
//           Setting Data in Grids
            setData($("fieldset")[4]);
            setData($("fieldset")[5]);
            setData($("fieldset")[6]);
            setData($("fieldset")[7]);
            setData($("fieldset")[8]);

            // Validating Form
            var QISlct = $('#InspectorName').val();
            var isValidate = 1;
            var countJobRows = $("#JobTable > tbody").children().length;
            var countPackageRows = $("#PackageTable > tbody").children().length;
            var countaddJobRows = $("#AddJobTable > tbody").children().length;
            var countJobStopRows = $("#JobStopTable > tbody").children().length;

            if (QISlct === "Select Quality Inspector") {
                $(".error-qi").show();
                isValidate = 0;
            } else {
                $(".error-qi").hide();
            }

            if (countJobRows > 0) {
                $('#newJob').val('+');
                var selects = $("#JobTable").find(".slctboxes");
                for (var count = 0; count < selects.length; count++) {
                    if ($(selects[count]).val() === "Select Option(s)") {
                        isValidate = 0;
                        $(selects[count]).parent().find('span').show();
                    } else {
                        $(selects[count]).parent().find('span').hide();
                    }
                }
            } else {
                $('#newJob').val('ADD');
            }
            if (countPackageRows > 0) {
                $('#newPackageDesc').val('+');
                var selects = $("#PackageTable").find(".slctboxes");
                for (var count = 0; count < selects.length; count++) {
                    if ($(selects[count]).val() === "Select Option(s)") {
                        isValidate = 0;
                        $(selects[count]).parent().find('span').show();
                    } else {
                        $(selects[count]).parent().find('span').hide();
                    }
                }
            } else {
                $('#newPackageDesc').val('ADD');
            }
            if (countaddJobRows > 0) {
                var selects = $("#AddJobTable").find(".slctboxes");
                for (var count = 0; count < selects.length; count++) {
                    if ($(selects[count]).val() === "Select Option(s)") {
                        isValidate = 0;
                        $(selects[count]).parent().find('span').show();
                    } else {
                        $(selects[count]).parent().find('span').hide();
                    }
                }
            } else {

            }
            if (countJobStopRows > 0) {
                var selects = $("#JobStopTable").find(".slctboxes");
                for (var count = 0; count < selects.length; count++) {
                    if ($(selects[count]).val() === "Select Option(s)") {
                        isValidate = 0;
                        $(selects[count]).parent().find('span').show();
                    } else {
                        $(selects[count]).parent().find('span').hide();
                    }
                }
            } else {

            }

            if (isValidate === 0) {
                return false;
            } else {
                return true;
            }
        } else if (type == "bpjobprogress") {

//            Setting Panal Data
            var countBPRows = $("#PanalsTable > tbody").children().length;
            if (countBPRows > 0) {
                $('#newPanals').val('+');
            }
            setData($("fieldset")[15]);

//            Validation Form BP
            var isValidBP = 1;
            var slctDenter = $('#idDenter').val();
            var slctPainter = $('#idPainter').val();

            if ((slctDenter == null) && (slctPainter == null)) {
                $(".error-dentername").show();
                $(".error-paintername").show();
                isValidBP = 0;
            }
            else {
                if ((slctDenter == null) || (slctPainter == null)) {
                    if (slctDenter == null) {
                        $(".error-dentername").show();
                        isValidBP = 0;
                    } else {
                        $(".error-dentername").hide();
                    }

                    if (slctPainter == null) {
                        $(".error-paintername").show();
                        isValidBP = 0;
                    } else {
                        $(".error-paintername").hide();
                    }
                }
            }
            if (isValidBP === 0) {
                return false;
            } else {
                return true;
            }
            /*        
             //            var countBPRows = $("#PanalsTable > tbody").children().length;
             //            if (countBPRows > 0) {
             //                $('#newPanals').val('+');
             //                var selectDent = $("#PanalsTable").find(".slctboxesdent");
             //                var selectPaint = $("#PanalsTable").find(".slctboxespaint");
             //                for (var count = 0; count < selectDent.length; count++) {
             //                    if ($(selectDent[count]).val() === "") {
             //                        isValidate = 0;
             //                        $(selectDent[count]).parent().find('span').show();
             //                    } else {
             //                        $(selectDent[count]).parent().find('span').hide();
             //                    }
             //                }
             //            } else {
             //                $('#newPanals').val('ADD');
             //        }
             */
        }
    }
</script>


