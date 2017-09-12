<div class="left-menu" id="sidebar">
    <?php
    $cookieData = unserialize($_COOKIE['logindata']);
    if ($cookieData['Role'] == 'Admin') {
        ?>
        <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/dashboard/index">Dashboard</a>
        <a href="<?= base_url() ?>index.php/purchase/index">Purchase New Items</a>
        <a href="<?= base_url() ?>index.php/purchase/type">Purchase Type</a>
        <a href="<?= base_url() ?>index.php/purchase/view">View Purchase Items</a>
		<a href="<?= base_url() ?>index.php/purchase/viewPurchaseReturn">View Purchase Return</a>
        <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/parts">Inquiry</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a>
        <?php
    } else {
        ?>
        <a href="http://127.0.0.1/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/dashboard/index">Dashboard</a>
        <a href="<?= base_url() ?>index.php/purchase/index">Purchase New Items</a>
        <a href="<?= base_url() ?>index.php/purchase/view">View Purchase Items</a>
        <a href="http://127.0.0.1/customerrelations/index.php/Inquiryreplyaction/parts">Inquiry</a>
		<a href="<?= base_url() ?>index.php/purchase/viewPurchaseReturn">View Purchase Return</a>
        <a href="<?= base_url() ?>index.php/login/logout">Logout</a>
        <?php
    }
    ?>
</div>

