<div id="wrapper">
    <div id="content">
        <?php
//        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/order_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Orders List</legend>                    
                    <div class="feildwrap">
                        <div>
                            <label>Brand Name</label>
                            <select id="brandName" class="">
                                <option>Select Brand</option>
                                <?php
                                foreach ($BrandNameCombo as $brand) {
                                    ?>
                                    <option value="<?= $brand['IdParent'] ?>" ><?= $brand['ParentName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div><br>
                    <div id="OrderTypeDiv" class="feildwrap" style="display: none">
                        <div>
                            <label>Order Type</label>
                            <select class="invoiceType" >
                                <option>Select Order Type</option>
                                <?php
                                foreach ($Type as $invoiceType) {
                                    $idType = $invoiceType['idType'];
                                    ?>
                                    <option value="<?= $invoiceType['idType'] ?>" ><?= $invoiceType['TypeName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div><br>
                    <div id="DateWiseDiv" class="feildwrap" style="display: none">
                        <label>Filter</label>
                        <span id="from">From Date</span>
                        <input id="fromDate" name="fromDate" class="date" style="" placeholder="From Date"  data-validation=""><span id="to" style="margin-left: 25px;">to Date</span>
                        <input id="toDate" name="toDate" class="date" style="margin-left:15px;"  placeholder="To Date" style="">
                        <input id="filterDate" type="button" name="filterbybutton" class="btn" value="OK" style="width:25px;margin-left: 25px;">
                    </div><br>
                    <div id="OrderNumDiv" class="feildwrap" style="display: none">
                        <label>Search by Order Number</label>
                        <input type="text" name="OrderNo" style="width: 273px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                    </div><br><br>
                    <!-- Daily Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="DailyOrderInvoices">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                     <th width="10%">Print</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
//                                $count = 1;
                                foreach ($AllDailyOrders as $DailyOrders) {
                                    ?>
                                    <tr id="DailyOrders">
                                        <!--<td class="tbl-count" name="resId"><?= $count++ ?></td>-->
                                        <td class="tbl-date"><?= $DailyOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $DailyOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $DailyOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $DailyOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $DailyOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $DailyOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $DailyOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $DailyOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $DailyOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $DailyOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= 'None' ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintDailyOrder/<?= $DailyOrders['OrderNumber'] ?>">Print</a> </td>
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Plan Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="PlanOrderInvoices">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
//                                $count = 1;
                                foreach ($AllPlanOrders as $PlanOrders) {
                                    ?>
                                    <tr id="PlanOrders">
                                        <td class="tbl-date"><?= $PlanOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $PlanOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $PlanOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $PlanOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $PlanOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $PlanOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $PlanOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $PlanOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $PlanOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $PlanOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $PlanOrders['Variant'] ?></td>
										<td><a href="<?= base_url() ?>index.php/invoices/PrintPlanPackage/<?= $PlanOrders['OrderNumber'] ?>">Print</a> </td>

                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Accessories Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="AccessoriesOrderInvoices">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllAccessoriesOrders as $AccessoriesOrders) {
                                    ?>
                                    <tr id="AccessoriesOrders">

                                        <td class="tbl-date"><?= $AccessoriesOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $AccessoriesOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $AccessoriesOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $AccessoriesOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $AccessoriesOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $AccessoriesOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $AccessoriesOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $AccessoriesOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $AccessoriesOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $AccessoriesOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $AccessoriesOrders['Variant'] ?></td>
										<td><a href="<?= base_url() ?>index.php/invoices/PrintAccessoriesPackage/<?= $AccessoriesOrders['OrderNumber'] ?>">Print</a> </td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- D Package Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="DPackageOrderInvoices">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllDPackageOrders as $DPackageOrders) {
                                    ?>
                                    <tr id="DPackageOrders">

                                        <td class="tbl-date"><?= $DPackageOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $DPackageOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $DPackageOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $DPackageOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $DPackageOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $DPackageOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $DPackageOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $DPackageOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $DPackageOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $DPackageOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $DPackageOrders['Variant'] ?></td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- M Package Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="MPackageOrderInvoices">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllMPackageOrders as $MPackageOrders) {
                                    ?>
                                    <tr id="MPackageOrders">

                                        <td class="tbl-date"><?= $MPackageOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $MPackageOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $MPackageOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $MPackageOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $MPackageOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $MPackageOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $MPackageOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $MPackageOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $MPackageOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $MPackageOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $MPackageOrders['Variant'] ?></td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Urgent Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="UrgentOrderInvoices" >
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllUrgentOrders as $UrgentOrders) {
                                    ?>
                                    <tr id="UrgentOrders">

                                        <td class="tbl-date"><?= $UrgentOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $UrgentOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $UrgentOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $UrgentOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $UrgentOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $UrgentOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $UrgentOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $UrgentOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $UrgentOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $UrgentOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $UrgentOrders['Variant'] ?></td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Dhamaka Package Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="DhamakaPackage" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllDhamakaPackage as $DhamakaPackage) {
                                    ?>
                                    <tr id="DhamakaPackage">

                                        <td class="tbl-date"><?= $DhamakaPackage['Date'] ?></td>
                                        <td class="tbl-order"><?= $DhamakaPackage['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $DhamakaPackage['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $DhamakaPackage['Title'] ?></td>
                                        <td class = "tbl-part"><?= $DhamakaPackage['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $DhamakaPackage['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $DhamakaPackage['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $DhamakaPackage['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $DhamakaPackage['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $DhamakaPackage['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $DhamakaPackage['Variant'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintDhamakaPackage/<?= $DhamakaPackage['OrderNumber'] ?>">Print</a> </td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Maintenance Package List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="MaintenancePackage" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllMaintenancePackage as $MaintenancePackage) {
                                    ?>
                                    <tr id="MaintenancePackage">

                                        <td class="tbl-date"><?= $MaintenancePackage['Date'] ?></td>
                                        <td class="tbl-order"><?= $MaintenancePackage['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $MaintenancePackage['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $MaintenancePackage['Title'] ?></td>
                                        <td class = "tbl-part"><?= $MaintenancePackage['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $MaintenancePackage['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $MaintenancePackage['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $MaintenancePackage['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $MaintenancePackage['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $MaintenancePackage['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $MaintenancePackage['Variant'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintMaintenancePackage/<?= $MaintenancePackage['OrderNumber'] ?>">Print</a> </td>
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Warranty Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="WarrantyOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
                                    <!--<th width="10%">Price</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllWarrantyOrders as $WarrantyOrders) {
                                    ?>
                                    <tr id="WarrantyOrders">

                                        <td class="tbl-date"><?= $WarrantyOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $WarrantyOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $WarrantyOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $WarrantyOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $WarrantyOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $WarrantyOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $WarrantyOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $WarrantyOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $WarrantyOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $WarrantyOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $WarrantyOrders['Variant'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintWarrentyPackage/<?= $WarrantyOrders['OrderNumber'] ?>">Print</a> </td>
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
					
					 <!-- Special Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="SpecialOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
									
									
					
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllSpecialOffers as $SpecialOrders) {
							
                                    ?>
                                    <tr id="SpecialOrders">

                                        <td class="tbl-date"><?= $SpecialOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $SpecialOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $SpecialOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $SpecialOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $SpecialOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $SpecialOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $SpecialOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $SpecialOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $SpecialOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $SpecialOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $SpecialOrders['VariantCode'] ?></td>
										<td><a href="<?= base_url() ?>index.php/invoices/PrintSpecialPackage/<?= $SpecialOrders['OrderNumber'] ?>">Print</a> </td>

                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
					
						 <!-- TGMO Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="TGMOOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
                                    <!--<th width="10%">Price</th>-->
									
									
					
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllTgmo as $TGMOOrders) {
							
                                    ?>
                                    <tr id="TGMOOrders">

                                        <td class="tbl-date"><?= $TGMOOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $TGMOOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $TGMOOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $TGMOOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $TGMOOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $TGMOOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $TGMOOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $TGMOOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $TGMOOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $TGMOOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $TGMOOrders['VariantCode'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintTgmoPackage/<?= $TGMOOrders['OrderNumber'] ?>">Print</a> </td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
					
							 <!-- LocalPurchase Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="localpurchaseOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
									
									
					
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllLocalPurchase as $LPOrders) {
							
                                    ?>
                                    <tr id="LPOrders">

                                        <td class="tbl-date"><?= $LPOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $LPOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $LPOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $LPOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $LPOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $LPOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $LPOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $LPOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $LPOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $LPOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $LPOrders['VariantCode'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintLocalPackage/<?= $LPOrders['OrderNumber'] ?>">Print</a> </td>
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
					
							 <!-- VOR Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="vorOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
									
									
					
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllVOR as $vorOrders) {
							
                                    ?>
                                    <tr id="LPOrders">

                                        <td class="tbl-date"><?= $vorOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $vorOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $vorOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $vorOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $vorOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $vorOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $vorOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $vorOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $vorOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $vorOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $vorOrders['VariantCode'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/invoices/PrintVORPackage/<?= $vorOrders['OrderNumber'] ?>">Print</a> </td>
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
					
						
							 <!-- Byseaorder Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="byseaorderOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
									
									
					
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllBySeaOrders as $seaOrders) {
							
                                    ?>
                                    <tr id="LPOrders">

                                        <td class="tbl-date"><?= $seaOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $seaOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $seaOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $seaOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $seaOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $seaOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $seaOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $seaOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $seaOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $seaOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $seaOrders['VariantCode'] ?></td>
									    <td><a href="<?= base_url() ?>index.php/invoices/PrintSeaPackage/<?= $seaOrders['OrderNumber'] ?>">Print</a> </td>

                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
					
					
												 <!-- Chemical Orders List -->
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="chemicalOrder" style="display: none">
                            <thead>
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="10%">Order Number</th>
                                    <th width="10%">Brand</th>
                                    <th width="10%">Order Type</th>
                                    <th width="10%">Part Number</th>
                                    <th width="15%">Description</th>
                                    <th width="05%">Qty</th>
                                    <th width="05%">WholeSale Price</th>
                                    <th width="05%">Total Price</th>
                                    <th width="10%">IMC Remarks</th>
                                    <th width="10%">Variant</th>
                                    <th width="10%">Print</th>
									
									
					
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                foreach ($AllChemicalOrder as $chemicalOrders) {
							
                                    ?>
                                    <tr id="LPOrders">

                                        <td class="tbl-date"><?= $chemicalOrders['Date'] ?></td>
                                        <td class="tbl-order"><?= $chemicalOrders['OrderNumber'] ?></td>
                                        <td class="tbl-part"><?= $chemicalOrders['ParentName'] ?></td>
                                        <td class="tbl-part"><?= $chemicalOrders['Title'] ?></td>
                                        <td class = "tbl-part"><?= $chemicalOrders['PartNumber'] ?></td>
                                        <td class="tbl-desc"><?= $chemicalOrders['PartName'] ?></td>
                                        <td class="tbl-qty"><?= $chemicalOrders['Quantity'] ?></td>
                                        <td class="tbl-dispatch"><?= $chemicalOrders['CostPrice'] ?></td>
                                        <td class="tbl-dealer"><?= $chemicalOrders['RetailPrice'] ?></td>
                                        <td class="tbl-imc"><?= $chemicalOrders['IMCRemarks'] ?></td>
                                        <td class="tbl-imc"><?= $chemicalOrders['VariantCode'] ?></td>
										 <td><a href="<?= base_url() ?>index.php/invoices/PrintChemicalPackage/<?= $chemicalOrders['OrderNumber'] ?>">Print</a> </td>
                                        <!--<td><a href="<?= base_url() ?>index.php/invoices/dailyorder/<?= $DailyOrders['idOIDetails'] ?>">Get Invoice</a> </td>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
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
<script>

    // On Brand Name Combo Change
    $("#brandName").change(function() {
        if ($("#brandName").val() !== "Select Brand")
        {
            $('#OrderTypeDiv').show();
        } else {
            $('#OrderTypeDiv').hide();
            $('#OrderNumDiv').hide();
        }
    });
    // On Order Type Combo Change
    $(".invoiceType").change(function() {
        if ($(".invoiceType").val() !== 'Select Order Type') {
            $('#OrderNumDiv').show();
            $('#DateWiseDiv').show();
        }
        if ($(".invoiceType").val() === 'Daily Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".DailyOrderInvoices").show();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'Plan Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".PlanOrderInvoices").show();
            $(".DailyOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'Accessories Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".AccessoriesOrderInvoices").show();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'D Package Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".DPackageOrderInvoices").show();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'M Package Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".MPackageOrderInvoices").show();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'Urgent Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".UrgentOrderInvoices").show();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'Dhamaka Package') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".DhamakaPackage").show();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'Maintenance Package') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".MaintenancePackage").show();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".WarrantyOrder").hide();
			 $(".SpecialOrder").hide();
        } else if ($(".invoiceType").val() === 'Warranty Order') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".WarrantyOrder").show();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
			 $(".SpecialOrder").hide();
        }  else if ($(".invoiceType").val() === 'Special Offer') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		$(".TGMOOrder").hide();
            $(".SpecialOrder").show();
			 $(".WarrantyOrder").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
        } else if ($(".invoiceType").val() === 'Toyota Genuine Motor Oil') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
            $(".TGMOOrder").show();
            $(".SpecialOrder").hide();
			 $(".WarrantyOrder").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
        }else if ($(".invoiceType").val() === 'Local Package') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
            $(".localpurchaseOrder").show();
            $(".TGMOOrder").hide();
            $(".SpecialOrder").hide();
			 $(".WarrantyOrder").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
        } else if ($(".invoiceType").val() === 'VOR') {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
            $(".vorOrder").show();
            $(".localpurchaseOrder").hide();
            $(".TGMOOrder").hide();
            $(".SpecialOrder").hide();
			 $(".WarrantyOrder").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
        } else if ($(".invoiceType").val() === 'By Sea Order') {
		 $(".chemicalOrder").hide();
            $(".byseaorderOrder").show();
            $(".vorOrder").hide();
            $(".localpurchaseOrder").hide();
            $(".TGMOOrder").hide();
            $(".SpecialOrder").hide();
			 $(".WarrantyOrder").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
        } else if ($(".invoiceType").val() === 'Chemical Order') {
            $(".chemicalOrder").show();
            $(".byseaorderOrder").hide();
            $(".vorOrder").hide();
            $(".localpurchaseOrder").hide();
            $(".TGMOOrder").hide();
            $(".SpecialOrder").hide();
			 $(".WarrantyOrder").hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
        } else {
		 $(".chemicalOrder").hide();
		$(".byseaorderOrder").hide();
		$(".vorOrder").hide();
		$(".localpurchaseOrder").hide();
		 $(".TGMOOrder").hide();
		  $(".SpecialOrder").hide();
            $('#OrderNumDiv').hide();
            $('#OrderNumDiv').hide();
            $(".UrgentOrderInvoices").hide();
            $(".DailyOrderInvoices").hide();
            $(".PlanOrderInvoices").hide();
            $(".AccessoriesOrderInvoices").hide();
            $(".DPackageOrderInvoices").hide();
            $(".MPackageOrderInvoices").hide();
            $(".DhamakaPackage").hide();
            $(".MaintenancePackage").hide();
            $(".WarrantyOrder").hide();
        }
    });

    $("input[name=OrderNo]").keyup(function(e) {
        var OrderNumber = $("input[name=OrderNo]").val();
        var OrderType = $(".invoiceType option:selected").val();
        var BrandName = $("#brandName option:selected").text();
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/invoices/getSpecificOrder/",
            type: "POST",
            data: {OrderNumber: OrderNumber, BrandName: BrandName, OrderType: OrderType},
            success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        try {
                            var items = [];
                            $.each(parsedData, function(i, val) {
                                items += "<tr>" +
                                        "<td class='tbl-name'>" + val.Date + "</td>" +
                                        "<td class='tbl-name'>" + val.OrderNumber + "</td>" +
                                        "<td class='tbl-name'>" + val.ParentName + "</td>" +
                                        "<td class='tbl-name'>" + val.Title + "</td>" +
                                        "<td class='tbl-name'>" + val.PartNumber + "</td>" +
                                        "<td class='tbl-name'>" + val.PartName + "</td>" +
                                        "<td class='tbl-name'>" + val.Quantity + "</td>" +
                                        "<td class='tbl-name'>" + val.CostPrice + "</td>" +
                                        "<td class='tbl-name'>" + val.RetailPrice + "</td>" +
                                        "<td class='tbl-name'>" + val.IMCRemarks + "</td>" +
                                        "<td class='tbl-name'>" + val.Variant + "</td>" +
                                        "</tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#finalResult").html("<tr><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td></tr>");
                    }
                }
            },
            error: function(data) {
            }
        });
    });

    function filterDateWise() {
        var fromDate = $("#fromDate").val();
        var toDate = $("#toDate").val();
        var orderType = $(".invoiceType option:selected").val();
        var brandName = $("#brandName option:selected").text();
        
        if (fromDate != "" || toDate != "") {
            if (orderType !== 'Select Order Type') {
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/invoices/getDateWiseOrder/",
                    type: "POST",
                    data: {FromDate: fromDate, ToDate: toDate, OrderType: orderType,BrandName: brandName},
                    success: function(data) {
                        if (data !== "null")
                        {
                            var parsedData = JSON.parse(data);
                            if (parsedData.length > 0) {
                                try {
                                    var items = [];
                                    $.each(parsedData, function(i, val) {
                                        items += "<tr>" +
                                                "<td class='tbl-name'>" + val.Date + "</td>" +
                                                "<td class='tbl-name'>" + val.OrderNumber + "</td>" +
                                                "<td class='tbl-name'>" + val.ParentName + "</td>" +
                                                "<td class='tbl-name'>" + val.Title + "</td>" +
                                                "<td class='tbl-name'>" + val.PartNumber + "</td>" +
                                                "<td class='tbl-name'>" + val.PartName + "</td>" +
                                                "<td class='tbl-name'>" + val.Quantity + "</td>" +
                                                "<td class='tbl-name'>" + val.CostPrice + "</td>" +
                                                "<td class='tbl-name'>" + val.RetailPrice + "</td>" +
                                                "<td class='tbl-name'>" + val.IMCRemarks + "</td>" +
                                                "<td class='tbl-name'>" + val.Variant + "</td>" +
                                                "</tr>";
                                    });
                                    $('#finalResult').html(items);
                                } catch (e) {
                                    console.log(e);
                                }
                            }
                            else {
                                $("#finalResult").html("<tr><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td><td></td></tr>");
                            }
                        }
                    },
                    error: function(data) {
                    }
                });
            } else {

            }
        } else {
            alert("Please Select Date First");
        }

    }
	
	$(document).ready(function(){


    $("#filterDate").click(function(){


        var dateFrom = $("#fromDate").val();
        var dateTo = $("#toDate").val();



        $("#finalResult > tr").hide();
        for(i=0;i<$("#finalResult > tr").length;i++){

            var dateCheck = $("#finalResult > tr").eq(i).find('td').eq(0).text();

            var d1 = dateFrom.split("-");
            var d2 = dateTo.split("-");
            var c = dateCheck.split("-");

            var from = new Date(d1[0], d1[1]-1, d1[2]);  // -1 because months are from 0 to 11
            var to   = new Date(d2[0], d2[1]-1, d2[2]);
            var check = new Date(c[0], c[1]-1, c[2]);

            if(check >= from && check <= to){
                $("#finalResult > tr").eq(i).show();
            }

        }


    });



        $("#filterDate").click(function(){


            var dateFrom = $("#fromDate").val();
            var dateTo = $("#toDate").val();



            $("#finalResult > tr").hide();
            for(i=0;i<$("#finalResult > tr").length;i++){

                var dateCheck = $("#finalResult > tr").eq(i).find('td').eq(0).text();

                var d1 = dateFrom.split("-");
                var d2 = dateTo.split("-");
                var c = dateCheck.split("-");

                var from = new Date(d1[0], d1[1]-1, d1[2]);  // -1 because months are from 0 to 11
                var to   = new Date(d2[0], d2[1]-1, d2[2]);
                var check = new Date(c[0], c[1]-1, c[2]);

                if(check >= from && check <= to){
                    $("#finalResult > tr").eq(i).show();
                }

            }


        });


});
</script>