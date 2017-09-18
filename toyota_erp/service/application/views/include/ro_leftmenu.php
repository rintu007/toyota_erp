<div class="left-menu" id="sidebar">
   <a href="<?php echo str_replace('service','',base_url())  ?>index.php/login/menu">Home Page</a>
    <?php
    $cookieData = unserialize($_COOKIE['logindata']);
    if ($cookieData['Role'] == 'Admin') {
        ?>
        <!--<a href="http://110.93.203.204:8282/twm/index.php/login/menu">Home Page</a>-->		 
		<a href="<?= base_url() ?>index.php/jpcb/index">Dashboard</a>   
        <a href = "<?= base_url() ?>index.php/bay/index">Manage Master Data</a>		
        <a href="<?= base_url() ?>index.php/jpcb/plan">JPCB</a>
        <a href="<?= base_url() ?>index.php/jpcb/asb">ASB</a>
		<a href="<?= base_url() ?>index.php/repairorder/mrs">MRS</a>
        <a href="<?= base_url() ?>index.php/jpcb/index">Appointment Input</a>
        <a href="<?= base_url() ?>index.php/token/index">Token</a>
        <a href="<?= base_url() ?>index.php/token/form">Token Form</a>
		<a href="<?= base_url() ?>index.php/repairorder/index">Open RO</a>
        <a href="<?= base_url() ?>index.php/jobprogresssheet/index">Job Progress Sheet</a>
        <a href="<?= base_url() ?>index.php/rodetail/index">RO-Detail</a>
        <a href = "<?= base_url() ?>index.php/rofinance/index">Receive Payment</a>
        <a href = "<?= base_url() ?>index.php/rogatepass/index">Generate Gate Pass</a>       
        <a href = "<?= base_url() ?>index.php/openedro/index">All Opened RO</a>
        <a href = "<?= base_url() ?>index.php/rolist/index">All Closed RO</a>
        <a href="<?= str_replace('service', '', base_url())  ?>customerrelations/index.php/Inquiryreplyaction/service">Inquiry from CR</a>
		 		 <a href="http://127.0.0.1/service/index.php/call_res">Follow up Car</a>


    <?php } else if ($cookieData['Role'] == 'FinanceAdmin') {
        ?>
        <a href="<?php echo str_replace('service','',base_url())  ?>index.php/login/menu">Home Page</a>
        <a href = "<?= base_url() ?>index.php/rofinance/index">Receive Payment</a> 
		 <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/service">Inquiry from CR</a>
        <?php
    } else {
        ?>

        <a href="<?= base_url() ?>index.php/jpcb/index">Dashboard</a>
    <!--     <a href="<?= base_url() ?>index.php/sales/index">Sale Items</a>
         <a href="<?= base_url() ?>index.php/sales/view">View Sale Items</a> -->

        <?php
    }
    ?>
	 
    <a href = "http://110.93.203.204:8282/twm/index.php/login/logout">Logout</a>
</div>


