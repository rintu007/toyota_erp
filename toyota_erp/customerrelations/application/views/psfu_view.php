<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint' || $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_leftmenu.php';
        } else {
            redirect(base_url() . "index.php/login/logout");
        }
        ?>
        <div class="right-pnel">
            
            <form name="myform" method="post"
                  action="<?= base_url() ?>index.php/Csi/add" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">
                    
                     <fieldset>
                        <legend>PSFU</legend>
                         <div class="feildwrap" style="">
                                    <div>                              
                                        <div style="margin-left: -150px;">
                                            <label>Date</label>
                                            <input style="width: 130px;margin-left: 31px;" id="AppointmentDate" type="text" name="AppointmentDate" class="date hasDatepicker" placeholder="Appointment Date" required=""><img class="ui-datepicker-trigger" src="http://127.0.0.1/toyota_erp/service/assets/images/date.png" alt="..." title="...">
                                        </div>
                                        <button class="btn">Submit</button>
                                    </div>
                                </div>
                        <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>RO</th>
                                        <th>Book in Date</th>
                                        <th>Delivery Date</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th>Variant</th>
                                        <th>Reg Number</th>
                                        <th>Mileage</th>
                                        <th>Total Amount</th>
                                        <th>Staff</th>
                                        <th>Foreman</th>
                                        <th>Detail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                        <tr id="allcomplaints">
                                            <td name="complaints" class="tbl-name">001</td>
                                            <td name="complaintsno">01-01-2017</td>
                                            <td name="complaints" class="tbl-name">Saqib Ali</td>
                                            <td name="complaints" class="tbl-name">001</td>
                                            <td name="complaintsno">01-01-2017</td>
                                            <td name="complaints" class="tbl-name">Saqib Ali</td>
                                            <td name="complaints" class="tbl-name">10233</td>
                                            <td name="complaints" class="tbl-name">10233</td>
                                            <td name="complaints" class="tbl-name">001</td>
                                            <td name="complaintsno">01-01-2017</td>
                                            <td name="complaints" class="tbl-name">Saqib Ali</td>
                                            <td name="complaints" class="tbl-name">10233</td>
                                            <td name="complaints" class="tbl-name">10233</td>
                                            <td name="complaints" class="tbl-name"><button style="margin: 3px 0;padding: 5px;" class="btn">Generate Complain</button><button class="btn">Ask Question</button></td>
                                        </tr>
                                       
                                </tbody>
                            </table>
                        </div>         
                    </fieldset>        
                </div>
            
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
