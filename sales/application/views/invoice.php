
<div id="wrapper">
    <div id="content">

        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post" action="" class="form validate-form animated fadeIn">

                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <legend>Search</legend>
                        <button type="button" class="btn"  onclick="financePopup('detail')">Generate Invoice</button>
                    </fieldset>
                    <p id="Success" style="display:none">Invoice Generated</p>
                    <fieldset id="invoiceDetail">
                        <legend>Invoice</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entry_no" id="entry_no"/>    
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date" name="date"  readonly="readonly"/>
                        </div>
                        <div>
                            <label>Customer No</label>
                            <input type="text" name="CustomerNo" id="CustomerNo" readonly="readonly">    
                        </div>


                        <div>
                            <label>Applicant</label>
                            <input type="text" name="Applicant" id="Applicant" readonly="readonly">    
                        </div>
                        <div>
                            <label>Source</label>
                            <select name="Source" id="Source" >
                                <option>Select Source</option>

                            </select>  
                        </div>
                        <div>
                            <label>Purchase From</label>
                            <input type="text" name="PurchaseFrom" id="PurchaseFrom" readonly="readonly">    
                        </div>

                        <br>
                        <hr>
                        <div>
                            <label>Chasis No</label>
                            <input type="text" name="ChasisNoo" id="ChasisNoo" readonly="readonly">
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="EngineNoo" id="EngineNoo" readonly="readonly">
                        </div>
                        <div>
                            <label>Model</label>
                            <select name="Model" id="Model" readonly="readonly">
                                <option>Select Model</option>                               
                            </select>  
                        </div>
                        <div>
                            <label>Vehicle</label>
                            <select name="Vehicle" id="Vehicle" readonly="readonly">
                                <option>Select Variants</option>

                            </select>  
                        </div>
                        <div>
                            <label>Color</label>
                            <select name="Coloor" id="Coloor" readonly="readonly">
                                <option>Select Color</option>

                            </select>  
                        </div>
                        <div>
                            <label>Order From Color</label>
                            <select name="OrderFromColor" id="OrderFromColor" />
                            <option>Select Order From Color</option>                                
                            </select>  
                        </div>
                        <div>
                            <label>Arrival Color</label>
                            <select name="ArrivalColor" id="ArrivalColor">
                                <option>Select Arrival Color</option>

                            </select>  
                        </div>
                        <div>
                            <label>Parking Row No</label>
                            <input type="text" name="ParkingRowNo" id="ParkingRowNo"> 
                        </div>

                        <div>
                            <label>Reg No</label>
                            <input type="text" name="RegNo" id="RegNo" readonly="readonly">    
                        </div>
                        <div>
                            <label>Doc Rec.Date</label>
                            <input type="text" class="date" name="DocRecDate"  id="DocRecDate"/>
                        </div>
                        <br>
                        <hr>
                        <div>
                            <label>Order Form No</label>
                            <input type="text" name="OrderFormNo" id="OrderFormNo" >
                        </div>

                        <div>
                            <label>Order From Date</label>
                            <input type="text" class="date" name="OrderFromDate" data-validation="required" id="OrderFromDate" />
                        </div>

                        <div>
                            <label>Order Type</label>
                            <input type="text" name="OrderType" id="OrderType">    

                        </div>

                        <div>
                            <label>Booking No</label>
                            <input type="text" name="BookingNo" id="BookingNo" >    
                        </div>



                        <div>
                            <label>Invoice No</label>
                            <input type="text" name="InvoiceNo" id="InvoiceNo" readonly="readonly">    
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input type="text" class="date" name="InvoiceDate"  id="InvoiceDate"/>
                        </div>


                        <div>
                            <label>Invoice Amount</label>
                            <input type="text" name="InvoiceAmount" id="InvoiceAmount" value="0">      
                        </div>
                        <div>
                            <label>Tax</label>
                            <input type="text" name="Tax" id="Tax" value="0">     
                        </div>
                        <div>
                            <label>Commission</label>
                            <input type="text" name="Commission" id="Commission" value="0">       
                        </div>
                        <div>
                            <label>Delivery Charges</label>
                            <input type="text" name="DeliveryCharges" id="DeliveryCharges" value="0">      
                        </div>
                        <div>
                            <label>Donation Charges</label>
                            <input type="text" name="DonationCharges" id="DonationCharges"  value="0">        
                        </div>
                        <div>
                            <label>Total Amount</label>
                            <input type="text" name="TotalAmount" id="TotalAmount" readonly="readonly" value="0">    
                        </div>
                        <br>
                        <hr>
                        <div>
                            <label>Purchase Type</label>
                            <select name="PurchaseType" id="PurchaseType">
                                <option value="0">Purchase Type</option>
                                <option value="test">test</option>

                            </select>  
                        </div>

                        <div>
                            <label>Debit</label>
                            <select name="Debit" id="Debit">
                                <option value="Debit">Select Debit</option>

                            </select> 
                            <input class="btn" value="Show Ledger" style="width: 100px;">
                        </div>
                        <br>
                        <div>
                            <label>Credit</label>
                            <select name="Credit" id="Credit">
                                <option value="Credit">Select Credit</option>

                            </select>  
                        </div>
                        <br>
                        <div>
                            <label>Salesman</label>
                            <select name="Salesman" id="Salesman" readonly="readonly">
                                <option>Select Salesman</option>                               
                            </select>  



                        </div>
                        <div style="display: none">

                            <input type="text"  id="resBookColor" name="resBookColor" value="" >
                            <input type="text"  id="dispatchColor" name="dispatchColor" value="" >  
                            <input type="text" id="dispatchType" name="dispatchType" value="" > 
<!--                            <input type="text" id="customerid" name="customerid" value="" > -->
                            <input type="text" id="dispatchId" name="dispatchId" value="" > 
                        </div>
                        <br>
                        <div>

                            <input type="submit" class="btn" value="Generate Invoice" id="InvoiceBtn" style="width: 130px;">
                        </div>
                    </fieldset> 

                </div>

            </form>
            
            <p id="partialPaymentWarning" style="color:orange;font-size: 15px;text-align: center; display: none;border: 1px solid #A4A4A4;
    border-radius: 10px;
    height: auto;
    background-color: green;
    min-width: 660px;
    margin: 15px auto;
    width: 90%;
    padding: 15px;">Partial Payment is not clear!!</p>
            </fieldset
        </div>

    </div>

</div>


<div style="width: 750px;" class="feildwrap  popup popup-detail">
    <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
        <img src="http://localhost/toyota_erp/assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="margin-left: 25px;width: 0px;">
            <fieldset style="">
                <legend>Invoice</legend>
                <div style="width:100%;" class="feildwrap">
                    <!--<div style="">-->     
                    <div class="btn-block-wrap datagrid" id="shwcompat">
                        <table class="table" width="100%" border="0" cellpadding="1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Chasis Number</th>
                                    <th>Engine Number</th>
                                    <th>Variant</th>
                                    <th>Color</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($Invoicedetail) {
                                    for ($i = 0; $i < count($Invoicedetail); $i++) {
                                        echo '<tr>';
                                        echo '<td><input type="radio" data-value="' . $Invoicedetail[$i]['DispatchType'] . '" data-partial="' . $Invoicedetail[$i]['Is_partial_amount'] . '" id="dispatchRadio" name="dispatchRadio" class="dispatchRadio" value="' . $Invoicedetail[$i]['idDispatch'] . '"></td>';
                                        echo '<td>' . $Invoicedetail[$i]['ChasisNo'] . '</td>';
                                        echo '<td>' . $Invoicedetail[$i]['EngineNo'] . '</td>';
                                        echo '<td>' . $Invoicedetail[$i]['Variants'] . '</td>';
                                        echo '<td>' . $Invoicedetail[$i]['ColorName'] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>

        </div><br>
    </form>
</div>  
<script>

    $(document).ready(function () {
        $('#invoiceDetail').hide();
    });
    function validationform() {
        var chosen = "";
        var pass = $("#pass").val();
        var confirm_pass = $("#cpass").val();
        var Color = $("#ColorList :selected").html();
        var VariantColor = $("input[name=variant_color]").val();
    }


    function financePopup(div_id) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
        });
    }

    $('.dispatchRadio').click(function () {

        $('.close-pop').click();
        $('#invoiceDetail').show();
        var NewEnterNumber = <?= json_encode($NewEnterNumber) ?>;
        var NewInvoiceNumber = <?= json_encode($NewInvoiceNumber) ?>;
        console.log(NewInvoiceNumber);
        var Varients = <?= json_encode($Varients) ?>;
        var VarientsObj = {
            idVarient: '',
            nameVarient: ''
        }
        var arrVarients = [];
        $.each(Varients, function (index, name) {
            VarientsObj = {
                idVarient: name['IdVariants'],
                nameVarient: name['Variants']
            };
            arrVarients.push(VarientsObj);
        });
        var Model = <?= json_encode($Model) ?>;
        var ModelObj = {
            idModel: '',
            namemodel: ''
        }
        var arrModel = [];
        $.each(Model, function (index, name) {
            ModelObj = {
                idModel: name['IdModel'],
                namemodel: name['Model']
            };
            arrModel.push(ModelObj);
        });
        var saleperson = <?= json_encode($ActualSalesMan) ?>;
        var salepersonObj = {
            idsalePerson: '',
            nameSalePerson: ''
        }
        var arrSalePerson = [];
        $.each(saleperson, function (index, name) {
            salepersonObj = {
                idsalePerson: name['FullName'],
                nameSalePerson: name['FullName']
            };
            arrSalePerson.push(salepersonObj);
        });
        var ContactType = <?= json_encode($ContactType) ?>;
        var ContactTypeObj = {
            ContactType: '',
            ContactId: '',
        }
        var arrContactType = [];
        $.each(ContactType, function (index, name) {
            ContactTypeObj = {
                ContactType: name['ContactType'],
                ContactId: name['Id']
            };
            arrContactType.push(ContactTypeObj);
        });
        var selectDispatchId = $(this).val();
        var dispatchType = $(this).data('value');
        var partialAmount = $(this).data('partial');
        $('#dispatchType').val(dispatchType);
        //  alert(selectDispatchId);

        if (dispatchType == 'OPENSTOCK') {
            $.ajax({
                url: "<?= base_url() ?>index.php/invoice/GetInvoices",
                type: "POST",
                data: {
                    selectDispatch: selectDispatchId,
                    dispatchType: dispatchType
                },
                dataType: "Json",
                success: function (data) {
//                    console.log(data);
                    counter = 1;
                    if (data !== "null")
                    {
                        if (data.length > 0) {
                            try {
                                var html = '';
                                for (i = 0; i < arrSalePerson.length; i++) {
                                    var selection2 = data[0].SalePerson == arrSalePerson[i].nameSalePerson ? 'selected' : '';
                                    html += '<option value="' + arrSalePerson[i].nameSalePerson + '"' + selection2 + '>' + arrSalePerson[i].nameSalePerson + '</option>';
                                }
                                $('#Salesman').html(html);
                                var html2 = '';
                                html2 += '<option value="0">Select Source</option>';
                                for (i = 0; i < arrContactType.length; i++) {
                                    var selection2 = '' == arrContactType[i].Id ? 'selected' : '';
                                    html2 += '<option value="' + arrContactType[i].ContactType + '"' + selection2 + '>' + arrContactType[i].ContactType + '</option>';
                                }
                                $('#Source').html(html2);
                                var model = '';
                                for (i = 0; i < arrModel.length; i++) {
                                    var selection2 = 'Personal Inquiry Call - Incoming' == arrModel[i].idModel ? 'selected' : '';
                                    model += '<option value="' + arrModel[i].idModel + '"' + selection2 + '>' + arrModel[i].namemodel + '</option>';
                                }
                                $('#Model').html(model);
                                var Varients = '';
                                for (i = 0; i < arrVarients.length; i++) {
                                    var selection2 = data[0].Variants == arrVarients[i].nameVarient ? 'selected' : '';
                                    Varients += '<option data-value="' + arrVarients[i].idVarient + '" value="' + arrVarients[i].nameVarient + '"' + selection2 + '>' + arrVarients[i].nameVarient + '</option>';
                                }
                                $('#Vehicle').html(Varients);
                                $('#resBookColor').val("");
                                $('#dispatchColor').val("");
                                $("#Vehicle").trigger("change");
                                $('#ChasisNoo').val(data[0].ChasisNo);
                                $('#EngineNoo').val(data[0].EngineNo);
                                $('#Applicant').val(data[0].CustomerName);
                                $('#InvoiceAmount').val(data[0].SellingPrice);
                                $('#CustomerNo').val(data[0].Customer);
                                $('#PurchaseFrom').val(data[0].Location);
                                $('#OrderType').val('Normal');
                                $('#ParkingRowNo').val(data[0].ParkingRow);
                                $('#InvoiceAmount').val(data[0].SellingPrice);
                                $('#Tax').val(0);
                                $('#Commission').val(0);
                                $('#DeliveryCharges').val(0);
                                $('#DonationCharges').val(0);
                                $('#InvoiceNo').val(NewInvoiceNumber);
                                $('#entry_no').val(NewEnterNumber);
//                                $('#customerid').val(data[0].Customer);
                                $('#dispatchId').val(data[0].idDispatch);
                                $('#RegNo').val(data[0].DispatchRegistrationNumber);
//                                 $('#OrderFromDate').val(date('Y-M-D'));
                                SumTotal();
//                            $('#').val(data[0].CustomerName);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {
//                        $("#haveinvoice").html("<tr><td><div class='feildwrap'><div style='font-size: larger'>No Data Found</div></td></tr>");
                        }
                    }
                }, error: function () {
                    console.log('error');
                }
            });
        } else if (dispatchType == 'PBO') {
            if (partialAmount == 0) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/invoice/GetInvoices",
                    type: "POST",
                    data: {
                        selectDispatch: selectDispatchId,
                        dispatchType: dispatchType
                    },
                    dataType: "Json",
                    success: function (data) {
                        console.log(data);
                        counter = 1;
                        if (data !== "null")
                        {
                            if (data.length > 0) {
                                try {
                                    var html = '';
                                    for (i = 0; i < arrSalePerson.length; i++) {
                                        var selection2 = data[0].ActualSalePerson == arrSalePerson[i].nameSalePerson ? 'selected' : '';
                                        html += '<option value="' + arrSalePerson[i].nameSalePerson + '"' + selection2 + '>' + arrSalePerson[i].nameSalePerson + '</option>';
                                    }
                                    $('#Salesman').html(html);
//                                alert(data[0].ContactTypeId);
                                    var html2 = '';
                                    html2 += '<option value="0">Select Source</option>';
                                    for (i = 0; i < arrContactType.length; i++) {
                                        var selection2 = data[0].ContactTypeId == arrContactType[i].ContactId ? 'selected' : '';
                                        html2 += '<option value="' + arrContactType[i].ContactId + '"' + selection2 + '>' + arrContactType[i].ContactType + '</option>';
                                    }
                                    $('#Source').html(html2);
                                    var model = '';
                                    for (i = 0; i < arrModel.length; i++) {
                                        var selection2 = '' == arrModel[i].idModel ? 'selected' : '';
                                        model += '<option value="' + arrModel[i].idModel + '"' + selection2 + '>' + arrModel[i].namemodel + '</option>';
                                    }
                                    $('#Model').html(model);
                                    var Varients = '';
                                    for (i = 0; i < arrVarients.length; i++) {
                                        var selection2 = data[0].Variants == arrVarients[i].nameVarient ? 'selected' : '';
                                        Varients += '<option data-value="' + arrVarients[i].idVarient + '" value="' + arrVarients[i].nameVarient + '"' + selection2 + '>' + arrVarients[i].nameVarient + '</option>';
                                    }
                                    $('#Vehicle').html(Varients);
                                    $('#resBookColor').val(data[0].Color1);
                                    $('#dispatchColor').val(data[0].ColorId);
                                    $("#Vehicle").trigger("change");
                                    $('#ChasisNoo').val(data[0].ChasisNo);
                                    $('#EngineNoo').val(data[0].EngineNo);
                                    $('#Applicant').val(data[0].CustomerName);
                                    $('#InvoiceAmount').val(data[0].SellingPrice);
                                    $('#CustomerNo').val(data[0].CustomerId);
                                    $('#BookingNo').val(data[0].PboNumber);
                                    $('#BookingNo').attr('readonly', true);
                                    $('#OrderFromDate').val(data[0].Date);
                                    $('#OrderFromDate').attr('readonly', true);
                                    $('#OrderFormNo').val(data[0].ResourcebookId);
                                    $('#OrderFormNo').attr('readonly', true);
                                    $('#PurchaseFrom').val(data[0].Location);
                                    $('#OrderType').val('Normal');
                                    $('#ParkingRowNo').val(data[0].ParkingRow);
                                    $('#InvoiceAmount').val(data[0].EFAmount);
                                    $('#Tax').val(data[0].FIAmount);
                                    $('#Commission').val(0);
                                    $('#DeliveryCharges').val(0);
                                    $('#DonationCharges').val(0);
                                    $('#InvoiceNo').val(NewInvoiceNumber);
                                    $('#entry_no').val(NewEnterNumber);
                                    $('#RegNo').val("");
//                                 $('#customerid').val(data[0].CustomerId);
                                    $('#dispatchId').val(data[0].idDispatch);
                                    SumTotal();
                                } catch (e) {
                                    console.log(e);
                                }
                            }
                            else {
//                        $("#haveinvoice").html("<tr><td><div class='feildwrap'><div style='font-size: larger'>No Data Found</div></td></tr>");
                            }
                        }
                    }, error: function () {
                        console.log('error');
                    }
                });
            } else {
                $('#invoiceDetail').hide();
                $('#partialPaymentWarning').show();
            }
        }
    });
    $('#Vehicle').change(function () {
        var Vehicle = $('#Vehicle option:selected').data('value');
        var resBookColor = $('#resBookColor').val();
        var dispatchColor = $('#dispatchColor').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/invoice/GetColor",
            type: "POST",
            data: {
                Vehicle: Vehicle
            },
            success: function (data) {
                var a = JSON.parse(data);
                var items = '';
                var itemss = '';
                if (a !== "null")
                {
                    if (a.length > 0) {
                        try {
                            items += "<option value='0'>Select Color</option>";
                            $.each(a, function (i, val) {
                                var selection2 = resBookColor == val.IdColor ? 'selected' : '';
                                items += '<option value="' + val.IdColor + '"' + selection2 + '>' + val.ColorName + '</option>';
                            });
                            itemss += "<option value='0'>Select Color</option>";
                            $.each(a, function (i, val) {
                                var selection2 = dispatchColor == val.IdColor ? 'selected' : '';
                                itemss += '<option value="' + val.IdColor + '"' + selection2 + '>' + val.ColorName + '</option>';
                            });
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        items += "<option value='0'>Select Varients</option>";
                    }
                    $('#Coloor').html(items);
                    $('#OrderFromColor').html(items);
                    $('#ArrivalColor').html(itemss);
                }
            }, error: function () {
                console.log('error');
            }
        });
    });
    $('#InvoiceAmount,#Tax,#Commission,#DeliveryCharges,#DonationCharges').keyup(function () {
        SumTotal();
    });
    function SumTotal() {
        var InvoiceAmount = $('#InvoiceAmount').val();
        var Tax = $('#Tax').val();
        var Commission = $('#Commission').val();
        var DeliveryCharges = $('#DeliveryCharges').val();
        var DonationCharges = $('#DonationCharges').val();
        var grandtotal = (parseFloat(InvoiceAmount) + parseFloat(Tax) + parseFloat(Commission) + parseFloat(DeliveryCharges) + parseFloat(DonationCharges));
        $('#TotalAmount').val(grandtotal);
    }


    $('#PurchaseType,#Debit,#Credit,#Salesman,#Source,#Coloor,#OrderFromColor,#ArrivalColor,#ParkingRowNo,#OrderFormNo,#OrderFromDate,#OrderType,#BookingNo,#InvoiceDate,#InvoiceAmount,#Tax,#Commission,#DeliveryCharges,#DonationCharges').click(function () {
        $(this).css("border", "solid 1px #dfdfdf");
    });
    $('#InvoiceBtn').click(function (e) {
        e.preventDefault();
        var entry_no = $('#entry_no').val();
        var entry_date = $('#entry_date').val();
        var CustomerNo = $('#CustomerNo').val();
        var Applicant = $('#Applicant').val();
        var Source = $('#Source').val();
        var PurchaseFrom = $('#PurchaseFrom').val();
        var ChasisNoo = $('#ChasisNoo').val();
        var EngineNoo = $('#EngineNoo').val();
        var Model = $('#Model option:selected').val();
        var Vehicle = $('#Vehicle').val();
        var Coloor = $('#Coloor option:selected').val();
        var OrderFromColor = $('#OrderFromColor').val();
        var ArrivalColor = $('#ArrivalColor option:selected').val();
        var ParkingRowNo = $('#ParkingRowNo').val();
        var RegNo = $('#RegNo').val();
        var DocRecDate = $('#DocRecDate').val();
        var OrderFormNo = $('#OrderFormNo').val();
        var OrderFromDate = $('#OrderFromDate').val();
        var OrderType = $('#OrderType').val();
        var BookingNo = $('#BookingNo').val();
        var InvoiceNo = $('#InvoiceNo').val();
        var InvoiceDate = $('#InvoiceDate').val();
        var InvoiceAmount = $('#InvoiceAmount').val();
        var Tax = $('#Tax').val();
        var Commission = $('#Commission').val();
        var DeliveryCharges = $('#DeliveryCharges').val();
        var DonationCharges = $('#DonationCharges').val();
        var TotalAmount = $('#TotalAmount').val();
        var PurchaseType = $('#PurchaseType').val();
        var Debit = $('#Debit').val();
        var Credit = $('#Credit').val();
        var Salesman = $('#Salesman').val();
        var DispatchId = $('#dispatchId').val();



        var error = 0;
        if (Source == 0) {
            $('#Source').css("border", "solid 1px red");
            error++;
        }
        if (Coloor == 0) {
            $('#Coloor').css("border", "solid 1px red");
            error++;
        }
        if (OrderFromColor == 0) {
            $('#OrderFromColor').css("border", "solid 1px red");
            error++;
        }
        if (ArrivalColor == 0) {
            $('#ArrivalColor').css("border", "solid 1px red");
            error++;
        }
        if (ParkingRowNo == '') {
            $('#ParkingRowNo').css("border", "solid 1px red");
            error++;
        }
        if (OrderFormNo == '') {
            error++;
            $('#OrderFormNo').css("border", "solid 1px red");
        }
        if (OrderFromDate == '') {
            $('#OrderFromDate').css("border", "solid 1px red");
            error++;
        }
        if (OrderType == '') {
            $('#OrderType').css("border", "solid 1px red");
            error++;
        }
        if (BookingNo == '') {
            $('#BookingNo').css("border", "solid 1px red");
            error++;
        }
        if (InvoiceDate == '') {
            $('#InvoiceDate').css("border", "solid 1px red");
            error++;
        }
        if (InvoiceAmount == '') {
            $('#InvoiceAmount').css("border", "solid 1px red");
            error++;
        }
        if (Tax == '') {
            $('#Tax').css("border", "solid 1px red");
            error++;
        }
        if (Commission == '') {
            $('#Commission').css("border", "solid 1px red");
            error++;
        }
        if (DeliveryCharges == '') {
            $('#DeliveryCharges').css("border", "solid 1px red");
            error++;
        }
        if (DonationCharges == '') {
            $('#DonationCharges').css("border", "solid 1px red");
            error++;
        }
        if (TotalAmount == '') {
            $('#TotalAmount').css("border", "solid 1px red");
            error++;
        }
        if (PurchaseType == 0) {
            $('#PurchaseType').css("border", "solid 1px red");
            error++;
        }
        if (Debit == 0) {
            $('#Debit').css("border", "solid 1px red");
            error++;
        }
        if (Credit == 0) {
            $('#Credit').css("border", "solid 1px red");
            error++;
        }
        if (Salesman == 0) {
            $('#Salesman').css("border", "solid 1px red");
            error++;
        }
        if (DeliveryCharges == '') {
            $('#DeliveryCharges').css("border", "solid 1px red");
            error++;
        }
        if (DeliveryCharges == '') {
            $('#DeliveryCharges').css("border", "solid 1px red");
            error++;
        }
        if (DeliveryCharges == '') {
            $('#DeliveryCharges').css("border", "solid 1px red");
            error++;
        }


        if (error == 0) {
            $.ajax({
                url: "<?= base_url() ?>index.php/invoice/newInvoice",
                type: "POST",
                data: {
                    DispatchId: DispatchId,
                    entry_no: entry_no,
                    entry_date: entry_date,
                    CustomerNo: CustomerNo,
                    Applicant: Applicant,
                    Source: Source,
                    PurchaseFrom: PurchaseFrom,
                    ChasisNoo: ChasisNoo,
                    EngineNoo: EngineNoo,
                    Model: Model,
                    Vehicle: Vehicle,
                    Coloor: Coloor,
                    OrderFromColor: OrderFromColor,
                    ArrivalColor: ArrivalColor,
                    ParkingRowNo: ParkingRowNo,
                    RegNo: RegNo,
                    DocRecDate: DocRecDate,
                    OrderFormNo: OrderFormNo,
                    OrderFromDate: OrderFromDate,
                    OrderType: OrderType,
                    BookingNo: BookingNo,
                    InvoiceNo: InvoiceNo,
                    InvoiceDate: InvoiceDate,
                    InvoiceAmount: InvoiceAmount,
                    Tax: Tax,
                    Commission: Commission,
                    DeliveryCharges: DeliveryCharges,
                    DonationCharges: DonationCharges,
                    TotalAmount: TotalAmount,
                    PurchaseType: PurchaseType,
                    Debit: Debit,
                    Credit: Credit,
                    Salesman: Salesman
                },
                success: function (data) {
                    if (data == 1) {
                        $('#invoiceDetail').hide();
                        location.reload();
                        // $('#Success').show();
                    } else {
                        console.log('error');
                    }
                }, error: function () {
                    console.log('error');
                }
            });
        } else {
//            alert('error');
        }


    });

</script>