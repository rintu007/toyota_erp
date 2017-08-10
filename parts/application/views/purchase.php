<div id="wrapper">
    <div id="content">
        <script>

        </script>
        <?php
//        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/purchase_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <?= $message ?>
            <!--<form name="myform" onSubmit="return validationform()" method="post"-->
                  <!--action="<?= base_url() ?>index.php/purchase/add" class="form validate-form animated fadeIn">-->
            <form name="myform" action="<?= base_url() ?>index.php/purchase/add" method="post" class="form validate-form animated fadeIn" onsubmit="return validationform();">
                <fieldset style="width: 96%;">
                    <legend>Add Purchase Item</legend>
                    <div class="feildwrap">
                        <div style=" margin-left: 196px; ">
                            <label>Purchase Type</label>
                            <select style="/*margin-left: 200px;*/" name="type" id="selectType">
                                <option>Select</option>
                                <?php
                                foreach ($PurchaseType as $AllPurchaseTypes) {
                                    ?>
                                    <option value="<?= $AllPurchaseTypes['idPurchaseType'] ?>"><?= $AllPurchaseTypes['PurchaseType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <br><br>
                    </div>
                    <!-- Order from IMC -->
                    <div id="tblOrder">
                        <div style=" margin-left: 35px; ">
                            <label>Order No.</label>
                            <br>
                            <input type="text" name="OrderNo" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Vender / Party</label>
                            <br>
                            <select name="PartyName" id="PartyName" style="width: 272px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                <option>Select Party</option>
                                <?php
                                foreach ($Party as $AllParties) {
                                    ?>
                                    <option value="<?= $AllParties['idParty'] ?>"><?= $AllParties['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-partyname cb-error help-block" style="margin-left: 300px;margin-top: -30px">Select Option!</span>
                        </div>
                        <div style=" margin-top: 20px; margin-left: 35px; ">
                            <label>Purchase Date</label>
                            <br>
                            <input type="text" class="date" name="PurchaseDate" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Invoice Number</label>
                            <br>
                            <input type="text" name="InvoiceNumber" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div style=" margin-top: 20px; margin-left: 35px; ">
                            <label>Invoice Date</label>
                            <br>
                            <input type="text" class="date" name="InvoiceDate" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Sales Tax</label>
                            <br>
                            <input type="text" name="SalesTax" class="salestax" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div class="btn-block-wrap dg" id="tbl-Order">
                            <table id='IMCTable' name='IMCTable' width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="10%">No.</th>
                                        <th width="20%">Part Number</th>
                                        <th width="10%">PartName</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Rec. Qty</th>
                                        <th width="10%">Cost Price</th>
                                        <th width="10%">Discount</th>
                                        <th width="10%">Actual Cost</th>
                                        <th width="10%">Land Value</th>
                                        <th width="10%">Total Cost</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <div id="paging">
                                                <ul>
                                                </ul>
                                            </div>
                                    </tr>
                                </tfoot>
                                <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRow">+</span>-->
                                <tbody id="finalResult">
<!--                                    <tr class="tblPurchase">
                                        <td class="tbl-count">1</td>
                                        <td class="tbl-part">
                                            <select class="chosen-select" name="parts[]" id="PartNumber" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                                <option>Select Part Number</option>
                                    <?php
//                                    foreach ($Part as $PartNumber) {
                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <option value="<?= $PartNumber['idPart'] ?>"><?= $PartNumber['PartNumber'] ?></option>
                                    <?php
//                                    }
                                    ?>
                                            </select>
                                        </td>
                                        <td class="tbl-description"><input type="text" name="description[]" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Description" placeholder="Description"></td>
                                        <td class="tbl-quantity"><input type="text" name="quantity[]" style="width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Quantity" placeholder="Quantity"></td>
                                        <td class="tbl-price"><input type="text" name="price[]" style="width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Price" placeholder="Price"></td>
                                        <td class="tbl-discount"><input type="text" name="discount[]" style="width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Discount" placeholder="Discount"></td>
                                        <td class="tbl-actualcost"><input type="text" name="actualcost[]" style="width: 93px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="ActualCost" placeholder="ActualCost"></td>
                                        <td class="tbl-landvalue"><input type="text" name="landvalue[]" style="width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="LandValue" placeholder="Land Value"></td>
                                    </tr>-->
                                </tbody>
                                <tfoot>
                                    <tr>                                       
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button id="OKButton" type="button" class="btn btn-block-wrap" style="width: 100px;margin-left:0px;" onclick="okButton('#IMCTable')">OK</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Order Local -->
                    <div id="tblLocal">
                        <div style=" margin-left: 35px; ">
                            <label>GRN No.</label>
                            <br><!--value="<?php //$GRNumber['GrnNo'] ?>" -->
                            <input type="text" name="GrnNoLocal" value="TWM/GRN/<?=  sprintf("%04d",$GRN) ?>" readonly placeholder="enter value"  style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Vender / Party</label>
                            <br>
                            <select name="PartyNameLocal" id="PartyNameLocal" style="width: 272px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                <option>Select Party</option>
                                <?php
                                foreach ($Party as $AllParties) {
                                    ?>
                                    <option value="<?= $AllParties['idParty'] ?>"><?= $AllParties['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-partynamelocal cb-error help-block" style="margin-left: 300px;margin-top: -30px">Select Option!</span>
                        </div>
                        <div style=" margin-top: 20px; margin-left: 35px; ">
                            <label>Purchase Date</label>
                            <br>
                            <input type="text" class="date" name="PurchaseDateLocal" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Invoice Number</label>
                            <br>
                            <input type="text" name="InvoiceNumberLocal" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div style=" margin-top: 20px; margin-left: 35px; ">
                            <label>Invoice Date</label>
                            <br>
                            <input type="text" class="date" name="InvoiceDateLocal" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Sales Tax</label>
                            <br>
                            <input type="text" name="SalesTaxLocal" id="SalesTaxLocal" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div class="btn-block-wrap dg" id="tbl-Local">
                            <table id='LocalTable' name='LocalTable' width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="7%">No.</th>
                                        <th width="17%">Part Number</th>
                                        <th width="10%">PartName</th>
                                        <th width="8%">Qty</th>
                                        <th width="12%">Price</th>
                                        <th width="10%">Discount</th>
                                        <th width="10%">Actual Cost</th>
                                        <th width="10%">Land Value</th>
                                    </tr>
                                </thead>                      
                                <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>
                                <tbody id="localPurchase">
<!--                                    <tr class="tblPurchase">
                                        <td class="tbl-count">1</td>
                                        <td class="tbl-part">
                                            <select class="chosen-select" name="parts[]" id="PartNumber" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                                <option>Select Part Number</option>
                                    <?php
//                                    foreach ($Part as $PartNumber) {
                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <option value="<?= $PartNumber['idPart'] ?>"><?= $PartNumber['PartNumber'] ?></option>
                                    <?php
//                                    }
                                    ?>
                                            </select>
                                        </td>
                                        <td class="tbl-description"><input type="text" name="description[]" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Description" placeholder="Description"></td>
                                        <td class="tbl-quantity"><input type="text" name="quantity[]" style="width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Quantity" placeholder="Quantity"></td>
                                        <td class="tbl-price"><input type="text" name="price[]" style="width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Price" placeholder="Price"></td>
                                        <td class="tbl-discount"><input type="text" name="discount[]" style="width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Discount" placeholder="Discount"></td>
                                        <td class="tbl-actualcost"><input type="text" name="actualcost[]" style="width: 93px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="ActualCost" placeholder="ActualCost"></td>
                                        <td class="tbl-landvalue"><input type="text" name="landvalue[]" style="width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="LandValue" placeholder="Land Value"></td>
                                    </tr>-->
                                </tbody><br><br>
                                <tfoot>
                                    <tr>                                       
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> 
                                        <td><button id="OKButton" type="button" class="btn btn-block-wrap" style="width: 100px;margin-left:0px;" onclick="okButton('#LocalTable')">OK</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Order Force -->
                    <div id="tblForce">
                        <div style=" margin-left: 35px; ">
                            <label>GRN No.</label>
                            <br>
                            <input type="text" name="GrnNoForce" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Vender / Party</label>
                            <br>
                            <select name="PartyNameForce" id="PartyNameForce" style="width: 272px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                <option>Select Party</option>
                                <?php
                                foreach ($Party as $AllParties) {
                                    ?>
                                    <option value="<?= $AllParties['idParty'] ?>"><?= $AllParties['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div style=" margin-top: 20px; margin-left: 35px; ">
                            <label>Purchase Date</label>
                            <br>
                            <input type="text" class="date" name="PurchaseDateForce" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Invoice Number</label>
                            <br>
                            <input type="text" name="InvoiceNumberForce" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div style=" margin-top: 20px; margin-left: 35px; ">
                            <label>Invoice Date</label>
                            <br>
                            <input type="text" class="date" name="InvoiceDateForce" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div style=" margin-top: -80px; margin-left: 500px; ">
                            <label>Sales Tax</label>
                            <br>
                            <input type="text" name="SalesTaxForce" id="SalesTaxForce" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <br>
                        <div class="btn-block-wrap dg" id="tbl-Force">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="7%">No.</th>
                                        <th width="17%">Part Number</th>
                                        <!--<th width="10%">Order Detail</th>-->
                                        <th width="10%">PartName</th>
                                        <th width="8%">Qty</th>
                                        <!--<th width="8%">Rec. Qty</th>-->
                                        <th width="12%">Price</th>
                                        <th width="10%">Discount</th>
                                        <th width="10%">Actual Cost</th>
                                        <th width="10%">Land Value</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <div id="paging">
                                                <ul>
                                                </ul>
                                            </div>
                                    </tr>
                                </tfoot>
                                <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowForce">+</span>
                                <tbody id="forcePurchase">
<!--                                    <tr class="tblPurchase">
                                        <td class="tbl-count">1</td>
                                        <td class="tbl-part">
                                            <select class="chosen-select" name="parts[]" id="PartNumber" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                                <option>Select Part Number</option>
                                    <?php
//                                    foreach ($Part as $PartNumber) {
                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <option value="<?= $PartNumber['idPart'] ?>"><?= $PartNumber['PartNumber'] ?></option>
                                    <?php
//                                    }
                                    ?>
                                            </select>
                                        </td>
                                        <td class="tbl-description"><input type="text" name="description[]" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Description" placeholder="Description"></td>
                                        <td class="tbl-quantity"><input type="text" name="quantity[]" style="width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Quantity" placeholder="Quantity"></td>
                                        <td class="tbl-price"><input type="text" name="price[]" style="width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Price" placeholder="Price"></td>
                                        <td class="tbl-discount"><input type="text" name="discount[]" style="width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Discount" placeholder="Discount"></td>
                                        <td class="tbl-actualcost"><input type="text" name="actualcost[]" style="width: 93px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="ActualCost" placeholder="ActualCost"></td>
                                        <td class="tbl-landvalue"><input type="text" name="landvalue[]" style="width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="LandValue" placeholder="Land Value"></td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div><br>
                    <div id="NetTotalDiv" class="feildwrap" style="display: none">
                        <label>Net Total</label>
                        <input id="NetTotal" name="NetTotal" type="text" value="" style="width: 150px;" readonly>
                        <input type="submit" class="btn" value="Done" style="margin-left: 25px;width: 150px;">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>

    var purchaseType = "";
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/parts/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + val.Id + "</td>\n\
                            <td class='tbl - name'>" + val.FullName + "</td><td>" + val.Username + "</td>\n\
            <td>" + val.Department + "</td><td>" + val.RoleName + "</td><td>" + val.Name + "</td>\n\
<td><a style='cursor: pointer;' onClick=userPopup('detail','" + val.Id + "','" + val.FullName + "','" + val.Username + "','" + val.Password + "','" + val.Email + "','" + val.ContactNumber + "','" + val.IdDepartment + "','" + val.RoleId + "','" + val.DateOfBirth + "','" + val.DealerShip + "')> Edit </a> / <a> Delete </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td>");
                }
            }
        });
    });

    $("#selectType").change(function () {
        if ($("#selectType :selected").text() === "IMC") {
            purchaseType = "IMC";
            $("#tblOrder").show();
            $("#tblLocal").hide();
            $("#tblForce").hide();
        } else if ($("#selectType :selected").text() === "LOC") {
            purchaseType = "LOC";
            $("#tblLocal").show();
            $("#tblOrder").hide();
            $("#tblForce").hide();
        } else if ($("#selectType :selected").text() === "Force") {
            purchaseType = "Force";
            $("#tblForce").show();
            $("#tblLocal").hide();
            $("#tblOrder").hide();
        } else {
            $("#tblOrder").hide();
            $("#tblLocal").hide();
            $("#tblForce").hide();
        }
    });

    $("input[name=PboSerial]").keyup(function () {
        var SerialNumber = $("input[name=PboSerial]").val();
        console.log(SerialNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/generatepbo/CheckPboSerial",
            type: "POST",
            data: {PboSerial: SerialNumber},
            success: function (data) {
                console.log(data);
                if ($("input[name=PboSerial]").val() != "") {
                    $("#SerialAvailability").show();
                    if (data == 'Available') {
                        $('#SerialAvailability').html("<h4 style='background-color: green;color: white;'>Available!</h4>");
                    } else {
                        $('#SerialAvailability').html("<h4 style='background-color: maroon;color: white;'>Already Exists in Database!</h4>");
                    }
                } else {
                    $("#SerialAvailability").hide();
                }
            }
        });
    });

    $(".type").click(function () {
        var Type = $('input[name=type]:checked').val();
        if (Type === "Order") {
            $('#tblLocal').hide();
            $('#tblOrder').show();
            console.log(Type);
//            $.ajax({
//                url: "<?= base_url() ?>index.php/resourcebook/getCustomers",
//                type: "POST",
//                success: function(data) {
//                    var a = JSON.parse(data);
//                    console.log(a);
//                    if (a.length > 0) {
//                        try {
//                            var items = "<option>Select Customer</option>";
//                            $.each(a, function(i, val) {
//                                items += "<option value='" + val.IdCustomer + "'>" + val.CustomerName + "</option>";
//                            });
//                            $('#cusId').html(items);
//                        }
//                        catch (e) {
//                            console.log(e);
//                        }
//                    } else {
//                        var items = "<option>Select Customer</option>";
//                        $('#cusId').html(items);
//                    }
//                }
//            });
        } else if (Type == "Local") {
            $('#tblLocal').show();
        } else {

        }
    });

    $("#newRowLocal").click(function (e) {
	var length = $('tr.tblPurchaseLocal').length+1;
	
        var items = "";
        items += "<tr class='tblPurchaseLocal'><td class='tbl-count'>"+length+"</td><td class='tbl-part'><select onchange=getPart(this) class='chosen-select' name='Localparts[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Number</option><?php
                                    foreach ($Part as $AllPart) {
                                        ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?> </option><?php } ?></select></td><td class='tbl-description'><input type='text' name='Localdescription[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='PartName' readonly></td>" +
                "<td class='tbl-quantity'><input type='text' name='Localquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Qty'></td>" +
                "<td class='tbl-price'><input type='text' name='Localprice[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='Price'></td>" +
                "<td class='tbl-discount'><input type='text' onkeyup=discountLocal(this) name='Localdiscount[]' value=0 style='width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Discount' placeholder='Discount' ></td>" +
                "<td class='tbl-actualcost'><input type='text' name='Localactualcost[]' style='width: 98px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ActualCost' placeholder='ActualCost' readonly></td>" +
                "<td class='tbl-landvalue'><input type='text' name='Locallandvalue[]' style='width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LandValue' placeholder='Land Value' readonly></td>" +
                "</tr>";
        $('#localPurchase').append(items);
        $("select[name='Localparts[]']").chosen({no_results_text: "Oops, nothing found!"});
    });

    $("#newRow").click(function (e) {
//        if (e.keyCode === 13) {
        var items = "";
        items += "<tr class='tblPurchaseImc'><td class='tbl-count'>1</td><td class='tbl-part'><select onchange=getPart(this) class='chosen-select' name='parts[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Number</option><?php
                                    foreach ($Part as $AllPart) {
                                        ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?> </option><?php } ?></select></td><td class='tbl-description'><input type='text' name='Forcedescription[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='PartName'></td>" +
                "<td class='tbl-quantity'><input type='text' name='Forcequantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity' ></td>" +
                "<td class='tbl-price'><input type='text' name='Forceprice[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='Price'></td>" +
                "<td class='tbl-discount'><input type='text' onkeyup=discountForce(this) name='Forcediscount[]' style='width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Discount' placeholder='Discount' ></td>" +
                "<td class='tbl-actualcost'><input type='text' name='Forceactualcost[]' style='width: 98px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ActualCost' placeholder='ActualCost'></td>" +
                "<td class='tbl-landvalue'><input type='text' name='Forcelandvalue[]' style='width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LandValue' placeholder='Land Value'></td>" +
                "</tr>";
        $('#finalResult').append(items);
        $("select[name='parts[]']").chosen({no_results_text: "Oops, nothing found!"});
//            $("select").trigger("chosen:updated");
//        }
    });

    $("input[name=OrderNo]").keyup(function (e) {
        $('#finalResult').html('');
        var OrderNumber = $("input[name=OrderNo]").val();
        $('.chosen-select option[selected=selected]').removeAttr('selected');
        $(".chosen-select").trigger("chosen:updated");
        $('#finalResult tr input').val('');
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/purchase/getOrder/",
            type: "POST",
            data: {OrderNumber: OrderNumber},
            success: function (data) {
                var GetOrder = JSON.parse(data);
                var count = 1;
                for (var a = 0; a < GetOrder.length; a++) {
                    console.log("Lenght", GetOrder.length);
                    if ($('#finalResult tr').length > GetOrder.length) {
                        $('#finalResult tr:eq(' + a + ')').remove();
                    } else {
                        $('#finalResult').append("<tr><td class='tbl-count'>" + count++ + "</td>" +
//                                "<td class='tbl-part'><select class='chosen-select' name='parts[]' id='PartNumber' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option>Select Part Number</option><?php foreach ($Parts as $PartNumber) { ?><option value='<?= $PartNumber['idPart'] ?>'><?= $PartNumber['PartNumber'] ?></option><?php } ?></select></td>" +
                                "<td class='tbl-part' style='display:none'><input type='text' name='parts[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'/></td>" +
                                "<td class='tbl-part'><input type='text' id='PartNumber'  style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'/></td>" +
                                "<td class='tbl-od' style='display:none'><input type='text' name='orderdetails[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='PartName' readonly/></td>" +
                                "<td class='tbl-description'><input type='text' id='Description' name='description[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='PartName' readonly/></td>" +
                                "<td class='tbl-quantity'><input type='text' name='quantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity' readonly/></td>" +
                                "<td class='tbl-recievedquantity'><input type='text' name='receivedquantity[]' value=0 style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder=''/></td>" +
                                "<td class='tbl-price'><input type='text' name='price[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='Price'/></td>" +
                                "<td class='tbl-discount'><input type='text' name='discount[]' onkeyup=discount(this) value=0 style='width: 50%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Discount' placeholder='Discount'/></td>" +
                                "<td class='tbl-actualprice'><input type='text' name='actualcost[]' style='width: 93px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ActualCost' placeholder='ActualCost' readonly/></td>" +
                                "<td class='tbl-landvalue'><input type='text' name='landvalue[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LandValue' placeholder='Land Value' readonly/></td>" +
                                "<td class='tbl-totalcost'><input type='text' name='totalcost[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='TotalCost' placeholder='Total Cost' readonly/></td></tr>");

                    }
//                    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
                }
                for (var each in GetOrder) {
                    console.log(GetOrder[each]);
//                    $('#finalResult tr:eq(' + each + ') td:eq(' + 1 + ') select').find('option:contains(' + GetOrder[each]['PartNumber'] + ')').attr('selected', true);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 1 + ') input').val(GetOrder[each]['idPart']);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 2 + ') input').val(GetOrder[each]['PartNumber']);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 3 + ') input').val(GetOrder[each]['idOIDetails']);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 4 + ') input').val(GetOrder[each]['PartName']);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 5 + ') input').val(GetOrder[each]['Quantity']);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 6 + ') input').val();
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 7 + ') input').val(GetOrder[each]['CostPrice']);
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 8 + ') input').val(); //Discount
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 9 + ') input').val(); //ActualCost
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 10 + ') input').val(); //LandValue
                    $('#finalResult tr:eq(' + each + ') td:eq(' + 11 + ') input').val(); //TotalCost
                    $(".chosen-select").trigger("chosen:updated");
                }
            },
            error: function (data) {
            }
        });
    });

    function discount(Source) {
        Discount = $(Source).val();
        if (Discount !== 0) {
			
            Price = $(Source).closest('td').prev('td').find('input').val();
            DiscountedPrice = Discount;
//            console.log(DiscountedPrice);
            ActualPrice = (Price - DiscountedPrice);
//            console.log(ActualPrice);
            SalesTax = $('input[name=SalesTax]').val();
            LandValue = ActualPrice + ((ActualPrice * SalesTax) / 100);
//            console.log(LandValue);
            $(Source).closest('td').next('td').find('input').val(ActualPrice);
//            console.log("AP", $(Source).closest('td').next('td').find('input'));
            Qty = $(Source).closest('td').prev('td').prev('td').find('input').val();
            TotalCost = (Qty * LandValue);
            console.log("QTY", Qty);
            console.log("LV", LandValue);
            console.log("TC", TotalCost);
            $(Source).closest('td').next('td').next('td').find('input').val(LandValue);
//            console.log("LV", $(Source).closest('td').next('td').next('td').find('input'));
            $(Source).closest('td').next('td').next('td').next('td').find('input').val(TotalCost);
//            console.log("TP ", $(Source).closest('td').next('td').next('td').next('td').find('input'));
        } else {
        }
    }

    function discountLocal(Source) {
        Discount = $(Source).val();
        if (Discount !== 0) {
			Qty = $(Source).closest('td').prev('td').prev('td').find('input').val();
			//console.log("QTY", Qty);
            Price = $(Source).closest('td').prev('td').find('input').val();
            DiscountedPrice = Discount;
            console.log(DiscountedPrice);
            ActualPrice = (Price - DiscountedPrice);
            SalesTax = $('#SalesTaxLocal').val();
            LandValue = ActualPrice + ((ActualPrice * SalesTax) / 100);
            $(Source).closest('td').next('td').find('input').val(ActualPrice);
            $(Source).closest('td').next('td').next('td').find('input').val(LandValue*Qty);
        } else {

        }
    }

    function discountForce(Source) {
        Discount = $(Source).val();
        Price = $(Source).closest('td').prev('td').find('input').val();
        DiscountedPrice = (Price * Discount) / 100;
        console.log(DiscountedPrice);
        ActualPrice = (Price - DiscountedPrice);
        SalesTax = $('#SalesTaxForce').val();
        LandValue = ActualPrice + ((ActualPrice * SalesTax) / 100);
        $(Source).closest('td').next('td').find('input').val(ActualPrice);
        $(Source).closest('td').next('td').next('td').find('input').val(LandValue);
    }

    function getPart(Source) {
        console.log($(Source).val());
        idPart = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/getpartdetails",
            type: "POST",
            data: {idPart: idPart},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').find('input').val(val.PartName);
                            $(Source).closest('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val(val.CostPrice);
                            $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                        });
                    }
                }
                else {
                }
            }
        });
    }

    function okButton(obj) {
        $('#NetTotalDiv').show();
        if (obj === '#IMCTable') {
            var tds = $(obj + ' tr td:last-child input');
            var sum = 0;
            for (var i = 0; i < tds.length; i++) {
                sum = sum + parseInt(tds[i].value);
                console.log(tds);
            }
        } else {
            var tds = $(obj + ' tr td:last-child input');
            var sum = 0;
            for (var i = 0; i < tds.length; i++) {
				console.log(tds[i]);
                sum = sum + parseInt(tds[i].value);
            }
        }
        $('#NetTotal').val(sum);
    }

    function validationform() {
        if (purchaseType === 'IMC') {
            var partyNameIMC = $('#PartyName').val();
            if (partyNameIMC === "Select Party") {
                $(".error-partyname").show();
                return false;
            } else {
                $(".error-partyname").show();
                return true;
            }
        } else {
            if (purchaseType === 'LOC') {
                var partyNameLOC = $('#PartyNameLocal').val();
                if (partyNameLOC === "Select Party") {
                    $(".error-partynamelocal").show();
                    return false;
                } else {
                    $(".error-partynamelocal").show();
                    return true;
                }
            }
        }
    }

//    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
//        console.log('chenges');
//        $(this).parents('tr.tblPurchase').children('td.tbl-description').children("input[name='description[]']").val("umar");
//    });
</script>