<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_inquiryleftmenu.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
    </div>
</div>