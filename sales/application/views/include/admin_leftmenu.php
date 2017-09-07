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
        <!--<a href="<?php echo str_replace('sales','',base_url())  ?>index.php/login/menu">Home Page</a>-->
        <a href="<?= base_url() ?>index.php/visitplan/index">Add Visit Plan</a>
        <a href="<?= base_url() ?>index.php/visitplan/viewVisitPlan">View Visit Plan</a>
        <a href="<?= base_url() ?>index.php/Visitplanpost/addPostVisit">Add Post Visit Plan</a>
        <a href="<?= base_url() ?>index.php/Visitplanpost/viewPostVisit">View Post Visit Plan</a>
        <a href="<?= base_url() ?>index.php/resourcebook/index">Resource Book</a>
        <a href="<?= base_url() ?>index.php/pbo/index">Resource Book List</a>
        <a href="<?= base_url() ?>index.php/openpbo/index">Create PBO</a>
        <a href="<?= base_url() ?>index.php/pbo_list/index">PBO List</a>
        <a href="<?= base_url() ?>index.php/pbo_list/PartialAmount">Partial Amount</a>
        <a href="<?= base_url() ?>index.php/dispatch/index">Dispatch</a>
        <a href="<?= base_url() ?>index.php/dispatch/lists">Dispatch List</a>
        <a href="<?= base_url() ?>index.php/dispatch/dispatchReceive_list">Receive List</a>
        <a href="<?= base_url() ?>index.php/salenote/index">Sale Note</a>
        <a href="<?= base_url() ?>index.php/salenote/getAllSaleNote">Sale Note List</a>
        <a href="<?= base_url() ?>index.php/stockreport/index">Stock List</a>
        <a href="<?= base_url() ?>index.php/stockreport/pdi_list">PDI List</a>
        <a href="<?= base_url() ?>index.php/invoice/index">Invoice</a>
        <a href="<?= base_url() ?>index.php/invoice/lists">Invoice List</a>
        <a href="<?= base_url() ?>index.php/invoice/pds_requestlist">PDS Request List</a>
        <a href="<?= base_url() ?>index.php/invoice/pds_list">PDS List</a>
        <a href="<?= base_url() ?>index.php/deliveryorder/index">Delivery Order List</a>
<!--        <a href="--><?//= base_url() ?><!--index.php/gatepass/index">Gate Pass Number</a>-->
        <a href="<?= base_url() ?>index.php/gatepass/gatepass_list">Gate Pass List</a>
        <a href="<?= base_url() ?>index.php/ffs/index">FFS</a>
<!--        <a href="--><?//= base_url() ?><!--index.php/requestfordocument/view">Request For Document</a>-->
        <a href="<?= base_url() ?>index.php/Vehicle_registeration">Vehicle Registration</a>
        <a href="<?= base_url() ?>index.php/documentreceive/index/">Document Receive From IMC</a>
        <a href="<?= base_url() ?>index.php/documentreceive/from_sales/">Document Requests</a>
        <a href="<?= base_url() ?>index.php/documentreceive/from_sales_reponse/Sales">Document Requests from Sales</a>
<!--        <a href="--><?//= base_url() ?><!--index.php/documentrecievefromexcise/view">Document Recieving From Excise</a>-->
          <a href="<?= base_url() ?>index.php/documentdelivery/index">Document Delivery Form</a>

          <a href="<?= base_url() ?>index.php/testdrive/add">Add Test Drive</a>
        <a href="<?= base_url() ?>index.php/testdrive/view">View Test Drive</a>
        <a href="<?= base_url() ?>index.php/lostsale/index">Lost Sale</a>
        <a href="<?= base_url() ?>index.php/followup/index">Follow Up</a>    
        <a href="<?= base_url() ?>index.php/salereport/index">Sale Report</a>
   <!--      <a href="<?= base_url() ?>index.php/finance/index">Payment</a> -->
        <a href="<?php echo str_replace('sales','',base_url())  ?>customerrelations/index.php/Inquiryreplyaction/sale">Inquiry from CR</a>
      </div>
      <a style="float: left;width:12.7%;" href="#"><h1 id="mastertoggle" style="background: #000;cursor: pointer;color: #fff;padding: 3px 15px;
 font-weight: bold;margin: 10px 0 10px 10px;float: left;text-align:center"> <img style="margin: 10px 10px 0 0;"
                                src="<?= base_url(); ?>assets/images/master-form.png" alt=""><br>Master Files</h1></a>       
      <div style="display:none;" id="mstsection">  
        <a href="<?= base_url() ?>index.php/accessories/index">Accessory Module</a>
        <a href="<?= base_url() ?>index.php/location/index">Add Location</a>
		 <a href="<?= base_url() ?>index.php/source/index">Add Source</a>
		 <a href="<?= base_url() ?>index.php/parking/index">Add Parking</a>
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
		<a href="<?= base_url() ?>index.php/gatepasstype/index">Add Gate Pass Type</a>
		<a href="<?= base_url() ?>index.php/head">Add Pds Headings</a>
		<a href="<?= base_url() ?>index.php/head/pds">View Pds Headings</a>
        <!--<a href="<?= base_url() ?>index.php/login/logout">Logout</a>-->
      </div> 
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