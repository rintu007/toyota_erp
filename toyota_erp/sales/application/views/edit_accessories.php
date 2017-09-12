<?php
if ($this->session->userdata('userid') == "") {
   // redirect(base_url());
}
?>
<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['username'] == "admin") {
//            include 'include/admin_leftmenu.php';
//        } else if ($cookieData['Role'] == "Sales Admin") {
//            include 'include/sales_leftmenu.php';
//        } else if ($cookieData['Role'] == "Director") {
//            include 'include/director_menu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel" class="form validate-form animated fadeIn">
            <?php $AccessoryId = $accessory['Id']; ?>
            <form action="<?= base_url() ?>index.php/accessories/update/<?= $AccessoryId ?>" method="post" class="form">
                <fieldset>
                    <legend>Edit Accessory</legend>
                    <div class="feildwrap">
                        <div>
                            <input type="text" name="accessoryId" value="<?= $accessory['Id'] ?>" hidden>
                        </div>
                        <div>
                            <label>Accessory Name</label>
                            <input name="accessoryname" type="text" value="<?= $accessory['AccessoryName'] ?>">
                        </div>
                        <br>

                        <div>
                            <label>Price</label>
                            <input name="price" type="text" value="<?= $accessory['Price'] ?>">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Update">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>