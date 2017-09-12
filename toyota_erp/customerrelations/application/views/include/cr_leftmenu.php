<script>
$(document).ready(function(){
	$("#fadetoggle").click(function(){
        $("#optsection").toggle(500);
		$("#mstsection").slideUp(500);
    });
	$("#mastertoggle").click(function(){
        $("#mstsection").toggle(500);
		$("#optsection").slideUp(500);
    });
});
</script>
<style>
#wrapper {
    margin: 0 !important;
}
</style>
<div class="left-menu" id="sidebar">
    <?php
    $cookieData = unserialize($_COOKIE['logindata']);
    if ($cookieData['Role'] == 'Admin') {
        ?>
        <!--<a href="http://127.0.0.1/index.php/login/menu">Home Page</a>-->
      <a style="float: left;width: 12%;" href="#"><h1 style="background: #000;cursor: pointer;color: #fff;padding: 3px 15px;font-weight: bold;margin: 10px 0 10px 10px;float: left;text-align:center"> <img style="margin: 10px 10px 0 0;" src="<?= base_url(); ?>assets/images/dashboard-ico.png" alt=""><br>Dashboard</h1></a> 
      <a style="float: left;width: 16.5%;" href="#"><h1 id="fadetoggle" style="background: #000;cursor: pointer;color: #fff;padding: 3px 15px;
 font-weight: bold;margin: 10px 0 10px 10px;float: left;text-align:center"><img  style="margin: 10px 10px 0 0;"
                                src="<?= base_url(); ?>assets/images/form-ico.png" alt=""><br> Operational Forms</h1></a>
      <div style="display:none;" id="optsection">
        <a href="<?php echo str_replace('customerrelations','',base_url())  ?>index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/Crpanel/index">Dashboard</a>
        <!--<a href="<?= base_url() ?>index.php/Message/index">Complaint Message Box</a>
        <a href="<?= base_url() ?>index.php/Inquirymessagebox/index">Inquiry Message Box</a> -->
        <a href="<?= base_url() ?>index.php/Mode/index">Mode</a>
        <a href="<?= base_url() ?>index.php/Route/index">Route</a>
        <a href="<?= base_url() ?>index.php/Complaintrelation/index">Related To</a>
        <a href="<?= base_url() ?>index.php/Complaintresponsetime/index">Target</a>
        <a href="<?= base_url() ?>index.php/Skills/index">Skills</a>
        <a href="<?= base_url() ?>index.php/Complaint/index">Register Complaint</a>
        <a href="<?= base_url() ?>index.php/Inquiry/index">Register Inquiry</a>
        <a href="<?= base_url() ?>index.php/Contactdetaildescription/index">VOC Details</a>
        <a href="<?= base_url() ?>index.php/Processdescription/index">VOC Process</a>
        <a href="<?= base_url() ?>index.php/Subprocessdescription/index">VOC SubProcess</a>
        <a href="<?= base_url() ?>index.php/vocclassification/index">VOC Classification</a>
        <a href="<?= base_url() ?>index.php/Faqs/index">FAQ'S</a>
        <a href="<?= base_url() ?>index.php/Csi/index">CSI</a>
        <a href="<?= base_url() ?>index.php/Ssi/index">SSI</a>
        <a href="<?= base_url() ?>index.php/Psfu/index">PSFU</a>
        <a href="<?= base_url() ?>index.php/allreports/index">Reporting</a>
        <a style="position:relative;" href="<?= base_url() ?>index.php/allreports/index">Feedback
            <span style="color: #fff;background: #545454;border-radius: 130px;padding: 0px 6px;position: absolute;top: 0px;
line-height: 25px;right: 120px;font-family: arial;">13</span>
        </a>
      </div>
      <!--<a style="float: left;width:12.7%;border-right: solid 2px #fff;" href="#"><h1 id="mastertoggle" style="background: #000;cursor: pointer;border: 1px solid #fff;border-radius: 4px;color: #fff;padding: 3px 15px;
 font-weight: bold;margin: 10px 0 10px 10px;float: left;"> <img style="margin: 10px 10px 0 0;"
                                src="<?= base_url(); ?>assets/images/form-ico.png" alt="">Master Files</h1></a>       
      <div style="display:none;" id="mstsection">  
        <a href="<?= base_url() ?>index.php/accessories/index">Accessory Module</a>
        <a href="<?= base_url() ?>index.php/location/index">Add Location</a>
        <a href="<?= base_url() ?>index.php/changecolor/index">Change Color</a>
        <a href="<?= base_url() ?>index.php/financer/index">Add Financer</a>
        <a href="<?= base_url() ?>index.php/allocation/index">Add Allocation</a>
        <a href="<?= base_url() ?>index.php/allocationtype/index">Add Allocation Type</a>
        <a href="<?= base_url() ?>index.php/brand/index">Add Brand</a>
        <a href="<?= base_url() ?>index.php/model/index">Add Model</a>
        <a href="<?= base_url() ?>index.php/color/index">Add Color</a>
        <a href="<?= base_url() ?>index.php/engine/index">Add Engine</a>
        <a href="<?= base_url() ?>index.php/displacement/index">Add Displacement</a>
        <a href="<?= base_url() ?>index.php/customertype/index">Add Customer Type</a>
        <a href="<?= base_url() ?>index.php/contacttype/index">Add Contact Type</a>
        <a href="<?= base_url() ?>index.php/paymentmode/index">Add Payment Mode</a>
        <a href="<?= base_url() ?>index.php/variants/index">Add Variant</a>
        <!--<a href="<?= base_url() ?>index.php/login/logout">Logout</a>-->
      <!--</div> -->
      <a style="float: left;width: 10%;" href="<?= base_url() ?>index.php/login/logout"><h1 style="background: #000;cursor: pointer;color: #fff;padding: 3px 15px;
 font-weight: bold;margin: 10px 0 10px 10px;float: left;text-align:center"> <img style="margin: 10px 10px 0 0;"
                                src="<?= base_url(); ?>assets/images/exit-ico.png" alt=""><br>Logout</h1></a>  
        <?php
    } else if ($cookieData['Role'] == 'Director') {
        ?>
       <a href="<?= base_url() ?>index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/pbo/index"> Search RB</a>
        <a href="<?= base_url() ?>index.php/openpbo/index">Create PBO</a>
        <a href="<?= base_url() ?>index.php/stockreport/index">Stock List</a>
        <a href="<?= base_url() ?>index.php/salereport/index">Sale Report</a>
        <a href="<?= base_url() ?>index.php/Lostsale/index">Lost Sale</a>
        <a href="<?= base_url() ?>index.php/Followup/index">Follow Up</a>
        <a href="<?= base_url() ?>index.php/pbo_list/PartialAmount">Partial Amount</a>
        <a href="<?php echo str_replace('sales','',base_url())  ?>customerrelations/index.php/Inquiryreplyaction/sale">Inquiry from CR</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a>
        <?php
    } else if ($cookieData['Role'] == 'Sales Admin') {
        ?>
         <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/resourcebook/index">Resource Book</a>
        <a href="<?= base_url() ?>index.php/pbo/index">Search RB</a>
        <a href="<?= base_url() ?>index.php/openpbo/index">Create PBO</a>
        <a href="<?= base_url() ?>index.php/pbo_list/index">PBO List</a>
        <a href="<?= base_url() ?>index.php/changecolor/index">Change Color</a>
        <a href="<?= base_url() ?>index.php/dispatch/index">Dispatch</a>
        <a href="<?= base_url() ?>index.php/invoice/index">Invoice</a>
        <a href="<?= base_url() ?>index.php/invoice/lists">Invoice List</a>
        <a href="<?= base_url() ?>index.php/allocation/index">Add Allocation</a>
        <a href="<?= base_url() ?>index.php/gatepass/index">Gate Pass Number</a>
        <a href="<?= base_url() ?>index.php/salenote/index">Sale Note</a>
        <a href="<?= base_url() ?>index.php/finance/index">Payment</a>
        <a href="<?= base_url() ?>index.php/stockreport/index">Stock List</a>
        <a href="<?= base_url() ?>index.php/salereport/index">Sale Report</a>
         <a href="<?= base_url() ?>index.php/pbo_list/PartialAmount">Partial Amount</a>
       <a href="<?php echo str_replace('sales','',base_url())  ?>customerrelations/index.php/Inquiryreplyaction/sale">Inquiry from CR</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a>
        <?php
    } else if ($cookieData['Role'] == 'FinanceAdmin') {
        ?>
         <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/finance/index">Payment</a>
         <a href="<?= base_url() ?>index.php/pbo_list/PartialAmount">Partial Amount</a>
        <a href=""<?= base_url() ?>customerrelations/index.php/Inquiryreplyaction/sale">Inquiry from CR</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a>
        <?php
    } else {
        ?>
         <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/resourcebook/index">Resource Book</a>
        <a href="<?= base_url() ?>index.php/salenote/index">Sale Note</a>
        <a href="<?= base_url() ?>index.php/pbo/index"> Search RB</a>
        <a href="<?= base_url() ?>index.php/openpbo/index">Create PBO</a>
        <a href="<?= base_url() ?>index.php/invoice/index">Invoice</a>
        <a href="<?= base_url() ?>index.php/invoice/lists">Invoice List</a>
        <a href="<?= base_url() ?>index.php/Lostsale/index">Lost Sale</a>
        <a href="<?= base_url() ?>index.php/Followup/index">Follow Up</a>
         <a href="<?= base_url() ?>index.php/pbo_list/PartialAmount">Partial Amount</a>
        <a href="<?php echo str_replace('sales','',base_url())  ?>customerrelations/index.php/Inquiryreplyaction/sale">Inquiry from CR</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a>
        <?php
    }
    ?>
</div>