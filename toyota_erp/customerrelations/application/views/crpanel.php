<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data["Role"] == 'Admin') {
            include 'include/cr_leftmenu.php';
        } else {
            if ($data["Role"] == 'Manager') {
                include 'include/cr_leftsubmenu.php';
            }
            if ($data["Role"] == 'Executive Complaint') {
                include 'include/cr_leftcomplaintsubmenu.php';
            }
            if ($data["Role"] == 'Executive Inquiry') {
                include 'include/cr_leftinquirysubmenu.php';
            }
        }
        ?>
        <div class="right-pnel">


            <form id="addcomplaintmodes" name="complaintmessage" onSubmit="" method=""
                  action="" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Dashboard</legend>
                    <div class="feildwrap">
                        <table>
                            <tbody>
                                <tr>
                                    <td><span><b> Complaint(s) Inbox :</b></span></td>
                                    <td><span>[<?php
                                            if ($noofcomplaints > 0) {
                                                echo $noofcomplaints;
                                            } else {
                                                echo "No Complaint(s) to Give FeedBack ";
                                            }
                                            ?>]</span></td>
                                </tr>

                                <tr>
                                    <td><span><b> Inquiries Inbox :</b></span></td>
                                    <td><span>[<?php
                                            if ($noofinquiries > 0) {
                                                echo $noofinquiries;
                                            } else {
                                                echo "No Inquiries to Give FeedBack ";
                                            }
                                            ?>]</span></td>
                                </tr>
                                 <tr>
                                    <td><span><b> Department Complaint Feedback  :</b></span></td>
                                    <td><span>[<?php
                                            if ($noofcomplaintfeedback > 0) {
                                                echo $noofcomplaintfeedback;
                                            } else {
                                                echo "No Department FeedBack ";
                                            }
                                            ?>]</span></td>
                                </tr>
                                  <tr>
                                    <td><span><b> Department Inquiry Feedback  :</b></span></td>
                                    <td><span>[<?php
                                            if ($noofinquiryfeedback > 0) {
                                                echo $noofinquiryfeedback;
                                            } else {
                                                echo "No Department FeedBack ";
                                            }
                                            ?>]</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
<fieldset>
                        <legend>Inquiry </legend>
                        <div style="height: 300px;overflow-y: scroll;" class="btn-block-wrap dg" id="shwinqra">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="05%">SNo</th>
                                        <th width="10%">Comp#</th>
                                        <th width="5%">Reg.Date</th>
                                        <th width="5%">Attender</th>
                                        <th width="5%">Customer</th>
                                        <th width="8%">Contact</th>
                                        <th width="5%">VOC</th>
                                        <th width="8%">RelatedTo</th>
                                        <th width="5%">Type</th>
                                        <th width="10%">Variant</th>
<!--                                        <th width="5%">Detail</th>-->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="14">
                                    </tr>
                                </tfoot>   
                                <tbody id="shwallcomplaints">
                                    <?php
                                    $count = 1;
                                     
                                    $allinquiries = json_decode($allinquiries);
                                  
                                    foreach ($allinquiries as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name="complaintsno"><?= $count++ ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintPadNumber ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRegDate . ', ' . $key->ComplaintRegTime ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->AttenderName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerCellphone ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VoiceOfCustomer ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->FCR ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                          
<!--                                            <td><a href="#divactiontaken" onclick="takevalues(<?php echo $key->ComplaintPadNumber ?>,<?php echo $key->ComplaintID ?>)">Reply Action</a></td>-->
                                            <?php
                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                
 <fieldset>
                        <legend>Complaints </legend>
                        <div style="height: 300px;overflow-y: scroll;" class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">S#</th>
                                        <th width="10%">Comp#</th>
                                        <th width="10%">Reg.Date</th>
                                        <th width="15%">Attend</th>
                                        <th width="30%">Customer</th>
                                        <th width="10%">Contact</th>
                                        <th width="30%">VOC</th>
                                        <th width="10%">Route</th>
                                        <th width="10%">Mode</th>
                                        <th width="10%">RelatedTo</th>
                                        <th width="15%">Variant</th>
                                        <th width="15%">Chassis No.</th>
<!--                                        <th width="15%">Detail</th>-->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="14">
                                            <div id="paging">
                                                <ul>
                                                    <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                    <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                    <!--                                            <li><a href="" class="active"><span>-->
                                                    <!--</span></a></li>-->
                                                    <!--                                            <li>-->
                                                    <?//= $pagination; ?><!--</li>-->
                                                    <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                    <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                    <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                    <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                                </ul>
                                            </div>
                                    </tr>
                                </tfoot>   
                                <tbody id="shwallcomplaints">
                                    <?php
                                    $count = 1;
                                    $allcomplaints = json_decode($allcomplaints);
                                    foreach ($allcomplaints as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name="complaintsno"><?= $count++ ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintPadNumber ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRegDate ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->AttenderName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerCellphone ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VoiceOfCustomer ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRecieveFrom ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintMode ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleChassisNumber ?></td>
<!--                                           <td><a href="#divactiontaken" onclick="takevalues(<?php echo $key->ComplaintPadNumber ?>,<?php echo $key->ComplaintID ?>)">Action Taken</a></td>-->
                                            <?php
                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
            </form>
        </div>
    </div>
</div>
<div style="width: 800px;height: 400px" class="feildwrap  popup popup-detail">
                <form action="<?= base_url() ?>index.php/Message/updatecomplaintfeedback" method="POST" class="form animated fadeIn">
                    <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none">
                        <label>Id</label>
                        <input  readonly type="text" id="idcomplaint" name="compid">
                    </div><br>
                    <!--                    <div class="feildwrap" style="margin-left: 10px;">
                                            <h5>FeedBack</h5>
                                        </div>-->
                    <div class="feildwrap" style="margin-left: 40px;margin-top: 20px">
                        <textarea id="fbcomplaint" name="compfeedback" style="margin: 0px; width: 724px; height: 300px;" placeholder="Write FeedBack to this Complaint" data-validation="required"></textarea>
                    </div><br><br>
                    <div class="feildwrap" style="margin-left: 720px;">
                        <input type="submit" class="btn" value="OK">
                    </div>
                </form>
            </div>



<div style="width: 800px;height: 400px" class="feildwrap  popup popup-detail">
            <form action="<?= base_url() ?>index.php/Inquirymessagebox/updatecomplaintfeedback" method="POST" class="form animated fadeIn">
                <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                <div style="display: none">
                    <label>Id</label>
                    <input  readonly type="text" id="idcomplaint" name="compid">
                </div><br>
                <div class="feildwrap" style="margin-left: 40px;margin-top: 20px">
                    <textarea id="fbcomplaint" name="compfeedback" style="margin: 0px; width: 724px; height: 300px;" placeholder="Write FeedBack to this Inqiry" data-validation="required"></textarea>
                </div><br><br>
                <div class="feildwrap" style="margin-left: 720px;">
                    <input type="submit" class="btn" value="OK">
                </div>
            </form>
        </div>




<script>

   
</script>

<!--redirect(base_url() . "index.php/login/logout");-->


<!--redirect(base_url() . "index.php/login/logout");-->