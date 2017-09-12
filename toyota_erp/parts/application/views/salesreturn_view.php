<div id="wrapper">
    <div id="content">
        <?php

        include 'include/sale_leftmenu.php';

        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Sales Return</legend>
                    <div class="feildwrap">
<!--                        <div>
                            <label>Search Sale</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Part Number / Name">
                            <input type="button" id="submitSearch" class="btn" value="Search">
                        </div>
                        <br/>
                        <br/>
                        <div>
                            <label> Search By Date</label>
                        </div>
                        <br/>
                        <div>
                            <label for="fromDate">From</label>
                            <input type="text" class="date"  name="fromDate" id="fromDate">
                        </div>
                        <div>
                            <label for="toDate">To</label>
                            <input type="text" class="date" name="toDate"  id="toDate">
                            <input type="button" id="submintFilter" class="btn" value="Filter By Date">
                        </div>-->
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="16%">Part</th>
                                    <th width="16%">Return Quantity</th>
                                    <th width="16%">Sale Quantity</th>
                                    <th width="16%">Sale Price</th>
                                    <th width="16%">Invoice #</th>
                                    <th width="16%">Customer Name</th>     
                                    
                                    
                                </tr>
                            </thead>.
                              <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($SalesReturn as $row) {
                                    $InventoryId = $row['idSale'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $row['PartNumber'] . ' (' . $row['PartName'] . ')' ?></td>
                                        <td class="tbl-name"><?= $row['ReturnQuantity'] ?></td>
                                        <td class="tbl-name"><?= $row['SaleQuantity'] ?></td>
                                        <td class="tbl-name"><?= $row['SalePrice'] ?></td>
                                        <td class="tbl-name"><?= $row['InvoiceNumber'] ?></td>
                                        <td class="tbl-name"><?= $row['CustomerName'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            
                            
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul></ul>
                                        </div>
                                </tr>
                            </tfoot>
                          
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


