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
        <div class="right-pnel">
            <form action="#" method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Accessory Module</legend>
                    <div class="feildwrap">
                        <div class="btn-block-wrap">
                            <input type="button" class="btn" value="Add Accessory" onclick="popupbox('detail')">
                        </div>
                        <!--<div>-->
<!--                            <label>CNIC # <span class="required">*</span></label>-->
<!--                            <select style="width: 140px;" id="searchOption">
        <option value="1">Search By Name</option>
        <option value="2">Search By CNIC</option>
    </select>
    <input type="text" data-validation="required" class="searchName" name="search" id="search" placeholder="Search By Name" style="display: none;">
    <input type="text" data-validation="number" class="searchCNIC" name="search" id="search" placeholder="Search By CNIC" style="display: none;">-->
                        <!--</div>-->
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%" >S No.</th>
                                    <th width="40%">Accessories</th>
                                    <th width="10%">Price</th>
                                    <th width="20%">Detail</th>
									<th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    
                                    <td colspan="9">
                                        <div id="paging">
                                            <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                                Total : <?php echo $counts ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links ?>
                                            </ul>
                                        </div>
                                    </td>
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
									<td>
									
                                    <a href="<?=	base_url()."index.php/accessories/delete/"  ?><?= $CarAccessoriesId ?>">Delete</a>

                                </td>                                   
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
