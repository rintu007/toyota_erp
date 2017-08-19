<div id="wrapper">
    <div id="content">

        <div class="right-pnel" class="form validate-form animated fadeIn">


            <div class="form validate-form animated fadeIn">
                <form action="<?= base_url() ?>/index.php/ReceiveAmount/updateamount" method="post">
                    <fieldset>
                        <legend>Receive Amount</legend>
                        <div class="feildwrap">

                            <div>
                                <label>Pbo Number</label>
                                <input name="Idpbo" type="hidden" value="<?= $receive[0]['Id'] ?>" readonly="">
                                <input name="PboNumber" type="text" value="<?= $receive[0]['PboNumber'] ?>" readonly="">
                            </div>
                            <div>
                                <label>Resourcebook Id</label>
                                <input name="ResourcebookId" type="text" value="<?= $receive[0]['ResourcebookId'] ?>">
                            </div>
                            <div>
                                <label>Chasis Number</label>
                                <input name="ChasisNumber" type="text" value="<?= $receive[0]['ChasisNumber'] ?>">
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input name="EngineNumber" type="text" value="<?= $receive[0]['EngineNumber'] ?>">
                            </div>

                            <fieldset>
                                <br>
                                <legend>Payment Details</legend>
                                <div class="feildwrap">
                                    <table class="" id="paymentdetail">
                                        <tr>
                                            <th>
                                                Payment Type
                                            </th>
                                            <th>
                                                Instrument Type
                                            </th>
                                            <th>
                                                Number
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Bank
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                <button type="button" class="btn add">+</button>

                                            </th>
                                        </tr>
                                        <?php foreach ($pd as $row)
                                        {?>


                                            <tr>

                                                <td>
                                                    <select  name="paymenttype[]">
                                                        <option <?=($row['paymenttype']=="Pay Order")?'selected':''?> value="Pay Order">Pay Order</option>
                                                        <option <?=($row['paymenttype']=="Demand Draft")?'selected':''?> value="Demand Draft">Demand Draft</option>
                                                        <option <?=($row['paymenttype']=="Cheque")?'selected':''?> value="Cheque">Cheque</option>

                                                    </select>
                                                </td>

                                                <td>
                                                    <select name="instrumenttype[]">
                                                        <option <?=($row['instrumenttype']=="Partial payment with WHT")?'selected':''?>>Partial payment with WHT</option>
                                                        <option <?=($row['instrumenttype']=="Partial payment without WHT")?'selected':''?>>Partial payment without WHT</option>
                                                    </select>
                                                </td>

                                                <td >
                                                    <input type="text" id="efPayOrder" name="number[]" value="<?=$row["number"]?>" placeholder="Number" style="width: 100px;"/>
                                                </td>

                                                <td>
                                                    <input type="text" class="date" name="date[]" value="<?=$row["date"]?>"  placeholder="Date" style="width: 90px;"/>
                                                </td>

                                                <td>
                                                    <input type="text" class="" name="bank[]" value="<?=$row["bank"]?>" placeholder="Bank" style="width: 90px;"/>
                                                </td>

                                                <td>
                                                    <input type="number" class="amount" name="partialamount[]" value="<?=$row["partialamount"]?>"  placeholder="Amount" style="width: 90px;"/>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn remove" onclick="remove(this)">X</button>
                                                </td>
                                            </tr>
                                        <?php } ?>



                                    </table>
                                    <table style="
    background: rgb(250,85,55);
    float: right;
    margin-right: 307px;
    font-size: large;
">
                                        <tr>
                                            <th colspan="4">Total Amount Paid : </th>
                                            <th ><input type="text" readonly name="TotalPartialAmount"  value="<?=$receive[0]['TotalPartialAmount']?>" id="total" ></th>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>


                            <div>
                                <label>Total Amount</label>
                                <input id="totalamount" name="TotalAmount" type="text"
                                       value="<?= intval($receive[0]['TotalAmount']); ?>"><br>
                            </div>

                            <div>
                                <label>Remaining</label>
                                <input id="remaining" name="Remaining" type="text"
                                       value="<?= (intval($receive[0]['TotalAmount']))-$receive[0]['TotalPartialAmount'] ?>">
                            </div>


                            <input type="submit" class="btn" value="Update" style="width: 187px;">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var payment_dropdown =
        "                                            <select name=\"instrumenttype[]\">\n" +
        "                                                <option>Partial payment without WHT</option>\n" +
        "                                                <option>Partial payment without WHT</option>\n" +
        "                                            </select>\n"
    $(document).on('change', '.amount', function(){
        calc()

    });
    function calc()
    {
        total = 0
        $('.amount').each(function(){
            total += (this.value  )*1
        })

        totalAmount = $("#totalamount").val()
        $("#total").val(total)

        $("#remaining").val(totalAmount - total)

    }




    $('.add').click(function()
    {
        html = "    <tr>\n" +
            "\n" +
            "                                        <td>\n" +
            "                                            <select  name=\"paymenttype[]\">\n" +
            "                                                <option value=\"Pay Order\">Pay Order</option>\n" +
            "                                                <option value=\"Demand Draft\">Demand Draft</option>\n" +
            "                                                <option value=\"Cheque\">Cheque</option>\n" +
            "\n" +
            "                                            </select>\n" +
            "                                        </td>\n" +
            "                                        \n" +
            "                                        <td>\n" + payment_dropdown +
            "                                        </td>\n" +
            "\n" +
            "                                        <td >\n" +
            "                                            <input type=\"text\" id=\"efPayOrder\" name=\"number[]\" placeholder=\"Number\" style=\"width: 100px;\"/>\n" +
            "                                        </td>\n" +
            "\n" +
            "                                        <td>\n" +
            "                                            <input type=\"date\"  name=\"date[]\"  placeholder=\"Date\" style=\"width: 90px;\"/>\n" +
            "                                        </td>\n" +
            "\n" +
            "                                        <td>\n" +
            "                                            <input type=\"text\" class=\"\" name=\"bank[]\" placeholder=\"Bank\" style=\"width: 90px;\"/>\n" +
            "                                        </td>\n" +
            "\n" +
            "                                        <td>\n" +
            "                                            <input type=\"number\" class=\"amount\" name=\"partialamount[]\"  placeholder=\"Amount\" style=\"width: 90px;\"/>\n" +
            "                                        </td>\n" +
            "                                        <td>\n" +
            "                                            <button type=\"button\" class=\"btn remove\" onclick=\"remove(this)\">X</button>\n" +
            "                                        </td>\n" +
            "                                    </tr>";
        $('#paymentdetail').append(html)

    })
    var a;
    function remove(elem)
    {
        a=elem
        $(elem).parent().parent().remove()
        calc()
    }
</script>