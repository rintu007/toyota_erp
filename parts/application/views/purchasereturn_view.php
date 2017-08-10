<div id="wrapper">
    <div id="content">
        <?php

        include 'include/purchase_leftmenu.php';
   //include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Purchase Return</legend>
                    <div class="feildwrap">

                        <h4><?= $message ?></h4>
                    </div>
                    <div>
                        <div id="LocalPurchase" >
                           
                            <div class="btn-block-wrap dg">
                                <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                    <thead>
                                        <tr>
                                            <th width="5%">S No.</th>
                                            <th width="8%">Part Number</th>
                                            <th width="18%">PartName</th>
                                            <th width="10%">Return Quantity</th>
                                            <th width="10%">Purchase Quantity</th>
                                            <th width="9%">Purchase Type</th>
                                            <th width="6%">Invoice #</th>
                                            <th width="10%">Created Date</th>
                                           
                                       
                                        </tr>
                                    </thead>
                                    <tbody id="finalResultLOC">
                                        <?php
                                        $count = 1;
                                        foreach ($PurchaseReturn as $row) { ?>
                                            <tr id="carUsers">
                                                <td class="resId" name="resId"><?= $count++ ?></td>
                                                <td class="resId" name="resId"><?= $row['PartNumber'] ?></td>
                                                <td class="tbl-name"><?= $row['PartName'] ?></td>
                                                <td class="tbl-name"><?= $row['ReturnQuantity'] ?></td>
                                                <td class="tbl-name"><?= $row['Quantity'] ?></td>
                                                <td class="tbl-name"><?= $row['type'] ?></td>
                                                <td class="tbl-name"><?= $row['InvoiceNumber'] ?></td>
                                                <td class="tbl-name"><?= $row['CreatedDate'] ?></td>

                                               
                                            </tr>
                                            <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9">
                                                <div id="paging">
                                                    <ul></ul>
                                                </div>
                                        </tr>
                                    </tfoot>
                                    
                                </table>
                            </div>
                        </div>
                      
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
