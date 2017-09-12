<div id="wrapper">
    <div id="content">
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form action="#" method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Accessory Module</legend>
                    <div class="feildwrap">
                        <div class="btn-block-wrap">
                            <input type="button" class="btn" value="Add Accessory" onclick="popupbox('detail')">
                        </div>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%" >S No.</th>
                                    <th width="40%">Accessories</th>
                                    <th width="10%">Price</th>
                                    <th width="30%">Detail</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="7"><div id="paging">
                                            <ul>
                                                <li><a href=""><span>Previous</span></a></li>
                                                <li><a href="" class="active"><span>1</span></a></li>
                                                <li><a href=""><span>2</span></a></li>
                                                <li><a href=""><span>3</span></a></li>
                                                <li><a href=""><span>4</span></a></li>
                                                <li><a href=""><span>5</span></a></li>
                                                <li><a href=""><span>Next</span></a></li>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($CarAccessories as $Accessories) {
                                    $CarAccessoriesId = $Accessories['Id'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $Accessories['Id'] ?></td>
                                        <td class="tbl-name"><?= $Accessories['AccessoryName'] ?></td>
                                        <td><?= $Accessories['Price'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/accessories/update/<?= $CarAccessoriesId ?>">Edit</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


<!-- Add Accessory Form Popup -->
<div class="feildwrap  popup popup-detail">

    <form name="myform" onSubmit="return validationform()" method="post" action="<?= base_url() ?>index.php/accessories/add" class="form validate-form animated fadeIn">
        <fieldset style="border: 1px solid #A4A4A4;border-radius: 10px;height: auto;display: table;min-width: 250px;
                  margin: 15px auto;width: 90%;padding: 15px;">
            <legend>Add Accessory</legend>
            <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
            <div>
                <label>Accessory Name</label>
                <input type="text" name="accessoryname" data-validation="required">
            </div>
            <br>
            <div>
                <label>Price</label>
                <input type="text" name="price" data-validation="number">
            </div>
            <div class="btn-block-wrap">
                <label>&nbsp;</label>
                <input type="submit" class="btn" value="Save">
            </div>
        </fieldset>
    </form>
</div>
