<div class="left-menu" id="sidebar">
    <?php
    $cookieData = unserialize($_COOKIE['logindata']);
    if ($cookieData['Role'] == 'Admin') {
        ?>
        <a href="<?php echo str_replace('parts','',base_url())  ?>index.php/login/menu
">Home Page</a>
        <a href="<?= base_url() ?>index.php/dashboard/index">Dashboard</a>
        <a href="<?= base_url() ?>index.php/parts/index">Parts</a>
        <!--<a href="<?= base_url() ?>index.php/viewparts/index">View Parts</a>-->
        <a href="<?= base_url() ?>index.php/inventory/index">Inventory</a>
        <a href="<?= base_url() ?>index.php/invoices/index">Orders</a>
        <!--<a href="<?= base_url() ?>index.php/invoices/view">View Orders</a>-->
        <a href="<?= base_url() ?>index.php/reports/index">Reports</a>
        <a href="<?= base_url() ?>index.php/service/dispatch">Service Parts Dispatch</a>
        <a href="<?= base_url() ?>index.php/purchase/index">Purchases</a>
        <!--<a href="<?= base_url() ?>index.php/purchase/index">Purchase New Items</a>-->
        <!--<a href="<?= base_url() ?>index.php/purchase/type">Purchase Type</a>-->
        <!--<a href="<?= base_url() ?>index.php/purchase/view">View Purchase Items</a>-->
        <a href="<?= base_url() ?>index.php/sales/index">Sales</a>
    <!--        <a href="<?= base_url() ?>index.php/sales/index">Sale Items</a>
        <a href="<?= base_url() ?>index.php/sales/type">Sale type</a>
        <a href="<?= base_url() ?>index.php/sales/view">View Sale Items</a>-->
        <a href="<?= base_url() ?>index.php/party/index">Add Party</a>
        <a href="<?= base_url() ?>index.php/ordermode/index">Add Order Mode</a>
        <a href="<?= base_url() ?>index.php/dispatchmode/index">Add Dispatch Modes</a>
        <a href="<?= base_url() ?>index.php/warehouse/index">Add Warehouse</a>
        <a href="<?= base_url() ?>index.php/zone/index">Add Zone</a>
        <a href="<?= base_url() ?>index.php/row/index">Add Zone Row</a>
        <a href="<?= base_url() ?>index.php/rack/index">Add Rack</a>
        <a href="<?= base_url() ?>index.php/accessories/index">Accessory Module</a>
        <a href="<?= base_url() ?>index.php/category/index">Add Category</a>
        <a href="<?= base_url() ?>index.php/manufacturer/index">Add Manufacturer</a>
        <a href="<?= base_url() ?>index.php/superceed/index">Add Superceed</a>    
        <a href="<?php echo str_replace('parts','',base_url())  ?>customerrelations/index.php/Inquiryreplyaction/parts">Inquiry to CR</a>
		<a href="<?= base_url() ?>index.php/parts/gatepass">Gate Pass</a> 
		<a href="<?= base_url() ?>index.php/parts/inquiry">Parts Inquiry</a> 
		<a href="<?= base_url() ?>index.php/parts/getquot">Quotation</a>
		<a href="<?= base_url() ?>index.php/parts/getsmr">SMR</a>
		
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a> 
        <?php
    } else {
        ?>
        <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/dashboard/index">Dashboard</a>
        <a href="<?= base_url() ?>index.php/viewparts/index">Parts</a>
        <a href="<?= base_url() ?>index.php/inventory/index">Inventory</a>
        <a href="<?= base_url() ?>index.php/invoices/view">Orders</a>
        <a href="<?= base_url() ?>index.php/purchase/index">Purchases</a>
        <a href="<?= base_url() ?>index.php/sales/index">Sales</a>
         <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/parts">Inquiry</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a> 
        <?php
    }
    ?>
</div>