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
                  action="<?= base_url() ?>index.php/Ssi/add" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">
                     <fieldset>
                        <legend>SSi</legend>
                        <button class="btn">Add SSI</button>
                        <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SSI NO</th>
                                        <th>Date</th>
                                        <th>Customer No</th>
                                        <th>PBO Number</th>
                                        <th>Registeration No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                        <tr id="allcomplaints">
                                            <td name="complaints" class="tbl-name">001</td>
                                            <td name="complaintsno">01-01-2017</td>
                                            <td name="complaints" class="tbl-name">Saqib Ali</td>
                                            <td name="complaints" class="tbl-name">10233</td>
                                            <td name="complaints" class="tbl-name">10233</td>
                                            <td name="complaints" class="tbl-name"><button class="btn">Print</button></td>
                                        </tr>
                                       
                                </tbody>
                            </table>
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
