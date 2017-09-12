<div class="left-menu" id="sidebar">
    <?php
    $cookieData = unserialize($_COOKIE['logindata']);
    if ($cookieData['Role'] == 'Admin') {
        ?>
        <a href="hthttp://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/dashboard/index">Dashboard</a>
		<a href="<?= base_url() ?>index.php/sales/addcustomer">Add Party</a>
        <a href="<?= base_url() ?>index.php/sales/index">Sale Items</a>
        <a href="<?= base_url() ?>index.php/sales/type">Sale type</a>
        <a href="<?= base_url() ?>index.php/sales/view">View Sale Items</a>
	    <a href="<?= base_url() ?>index.php/sales/viewSalesReturn">View Sale Return</a>
        <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/parts">Inquiry</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a> 
        <?php
    } else if ($cookieData['Role'] == 'FinanceAdmin') {
        ?>
        <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/sales/index">Sale Items</a>
        <a href="<?= base_url() ?>index.php/sales/view">View Sale Items</a>
		        <a href="<?= base_url() ?>index.php/sales/viewSalesReturn">View Sale Return</a>

       <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/parts">Inquiry</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a> 
        <?php
    } else {
        ?>
        <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/dashboard/index">Dashboard</a>
        <a href="<?= base_url() ?>index.php/sales/index">Sale Items</a>
        <a href="<?= base_url() ?>index.php/sales/view">View Sale Items</a>
		        <a href="<?= base_url() ?>index.php/sales/viewSalesReturn">View Sale Return</a>

        <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/parts">Inquiry</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a> 
        <?php
    }
    ?>
</div>

