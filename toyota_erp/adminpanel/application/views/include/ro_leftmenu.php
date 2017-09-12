<div class="left-menu" id="sidebar">
    <?php
    $cookieData = unserialize($_COOKIE['logindata']);
    if ($cookieData['Role'] == 'Admin') {
        ?>
     <a href="http://175.107.202.44:81/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/jpcb/index">Dashboard</a>
        <a href="<?= base_url() ?>index.php/jpcb/plan">JPCB</a>
        <a href="<?= base_url() ?>index.php/jpcb/asb">ASB</a>
        <a href="<?= base_url() ?>index.php/jpcb/index">Schedule Appointment</a>
        <a href = "<?= base_url() ?>index.php/bay/index">Manage Master Data</a>
        <a href = "<?= base_url() ?>index.php/repairorder/index">Create RO</a>
        <a href = "<?= base_url() ?>index.php/rofinance/index">Receive Payment</a>
        <a href = "<?= base_url() ?>index.php/rogatepass/index">Generate Gate Pass</a>       
        <a href = "<?= base_url() ?>index.php/openedro/index">All Opened RO</a>
        <a href = "<?= base_url() ?>index.php/rolist/index">All Closed RO</a>
        <a href = "http://175.107.202.44:81/index.php/login/logout">Logout</a>
    <?php } else if ($cookieData['Role'] == 'FinanceAdmin') {
        ?>
         <a href="http://175.107.202.44:81/index.php/login/menu">Home Page</a>
        <a href = "<?= base_url() ?>index.php/rofinance/index">Receive Payment</a> 
       <a href = "http://175.107.202.44:81/index.php/login/logout">Logout</a>
        <?php
    } else {
        ?>
       <a href="http://175.107.202.44:81/index.php/login/menu">Home Page</a>
        <a href="<?= base_url() ?>index.php/jpcb/index">Dashboard</a>
    <!--     <a href="<?= base_url() ?>index.php/sales/index">Sale Items</a>
         <a href="<?= base_url() ?>index.php/sales/view">View Sale Items</a> -->
        <a href = "http://175.107.202.44:81/index.php/login/logout">Logout</a>
        
        <?php
    }
    ?>
</div>


