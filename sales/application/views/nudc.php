<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Faqs/addfaqs" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Vehicle Delivery Acceptance Note</legend>
                        <!--<div>
                            <label>PBO</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>-->
                        <div>
                          <p style="font-size:14px;font-family:arial;">Dear Customer,</p>
                          <p style="font-size:14px;font-family:arial;margin:10px 0 10px 0;">Congratulations on your New Vehicle purchase. We are pleased you have chosen a Toyota/Daihatsu brand and we wish you many years of enjoyable ownership. We look forward to satisfy all of your future motoring needs.</p>
                          <p style="font-size:14px;font-family:arial;margin:20px 0 0 0;">Sincerely,</p>
                        </div>
                        <div style="margin:40px 60px 0 60px">
                          <hr><br>
                          <label style="font-family: arial;line-height:0;text-align:center;font-size:14px;">Sales Person's Signature</label>
                        </div>
                        <div style="margin:40px 60px 0 60px">
                          <hr><br>
                          <label style="font-family: arial;line-height:0;text-align:center;font-size:14px;">Sales Manager's Signature</label>
                        </div>
                        <div style="margin:40px 60px 0 60px">
                          <hr><br>
                          <label style="font-family: arial;line-height:0;text-align:center;font-size:14px;">Services Manager's Signature</label>
                        </div>
                        <div style="float:left;width:100%;margin:70px 0 0 0;">
                            <p style="float:left;font-family:arial;font-size:15px;">I, Mr./Ms./Mrs.<strong> <?= $i['CustomerName'] ?></strong>&nbsp;</p>
                            <p style="float:left;font-family:arial;font-size:15px;">Resident of:<strong><?= $i['AddressDetails'] ?> &nbsp;</strong></p>
                            <p style="float:left;font-family:arial;font-size:15px;">Owner of the Vehicle: <strong><?= $i['Variants'] ?> &nbsp;</strong></p>
<!--                            <hr style="margin:40px 0 0 0;width:100%;float:left;">-->
                            <p style="float:left;font-family:arial;font-size:15px;">Model: <strong><?= $i['ModelCode'] ?> &nbsp;</p>
<!--                            <hr style="margin:40px 0 0 0;width:190px;float:left;">-->
                            <p style="float:left;font-family:arial;font-size:15px;">Color: <strong><?= $i['ColorName'] ?> &nbsp;</p>
<!--                            <hr style="margin:40px 0 0 0;width:200px;float:left;">-->
                            <p style=";float:left;font-family:arial;font-size:15px;">bearing  Engine # <strong><?= $i['EngineNo'] ?> &nbsp;</p>
<!--                            <hr style="margin:40px 0 0 0;width:200px;float:left;">-->
                            <p style="float:left;font-family:arial;font-size:15px;">and Chasis  # <strong><?= $i['ChasisNo'] ?> &nbsp;</p>
<!--                            <hr style="margin:40px 0 0 0;width:250px;float:left;">-->
                            <p style="float:left;font-family:arial;font-size:15px;">registered as (number plate) have seen approved and then taken the delivery of my above-said vehicle on <strong><?= date('l jS \of F Y h:i:s A'); ?></strong>
                                in good condition and in working order with all Standard tools and equipments
                                provided by the manufacturer and agrees as follows:</p>

                            <p style="float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> Sales Person has demonstrated operation of features & accessories of
                                my vehicle.</p>
                            <p style="float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> I've visited the Dealership's Services Department and an aware of
                                Business Hours, Service.</p>
                            <p style="margin: 10px 10px 0 0px;float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> Appointment procedure & service contact Person(s) for future support
                                services. I've also been introduced with the Customer Relation Manager & Parts Manager.
                            </p>
                            <p style="margin: 10px 10px 0 0px;float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> Warranty & Owner's Manual have been explained to me & I understand
                                all the benefits which came along with my New Vehicle.</p>
                            <p style="margin: 10px 10px 0 0px;float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> I've learned and understand the required maintenance schedule of my
                                New Vehicle.</p>
                            <p style="margin: 10px 10px 0 0px;float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> Effedtive today, the dealership NOR Indus Motor Company will be
                                responsible for any loss or damage on any account.</p>
                            <p style="margin: 10px 10px 0 0px;float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> I've received all the documents of my New Vehicle duly completed in
                                all respect.</p>
                            <p style="margin: 50px 10px 0 0px;float:left;font-family:arial;font-size:14px;">
                                <strong>-</strong> Remarks/comments on any discrepancy or suggestions for KAIZEN
                                (Continuous Improvement):</p>
                            <hr style="margin:40px 0 0 0;width:100%;float:left;">
                           <hr style="margin:40px 0 0 0;width:100%;float:left;">
                           <div style="margin:40px 0px 0 60px;float:right;">
                              <hr><br>
                              <label style="font-family: arial;line-height:0;text-align:center;font-size:14px;">Customer's Signature</label>

                           </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/warehouse/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Warehouse ID</label>
            <input type="text" name="WarehouseId" id="WarehouseId" data-validation="required">
        </div>
        <div>
            <label>Mode Name</label>
            <input type="text" name="Name" id="Name" data-validation="required">
        </div>

    </form>
</div>
