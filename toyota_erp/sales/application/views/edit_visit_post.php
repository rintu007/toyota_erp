<style type="text/css">
    .feildwrap input[type="text"] {
        width: auto !important;
    }
</style>
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/visitplanpost/edit" class="form validate-form animated fadeIn">
             <!--   <input style="" type="text" name="idvisitplanpost"  value="<?= $visit_post['idvisitplanpost'] ?>" readonly>  -->
                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Add Visit Plan</legend>
                        <div>
                            <label>Entry No</label>
                            <input type = 'text' name = 'enterNumber[]' value='<?= $enter_no; ?>' /> 
                        </div>

                    </fieldset> 
                    <fieldset>

                        <button type="button" class="btn" id="addVisitPlanPost">Add Visit Plan</button>
                        <div class="btn-block-wrap datagrid" style="overflow-x: scroll;" id="shwcompat">
                            <table id="visitplan_table" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Mobile #</th>
                                        <th>Telephone #</th>
                                        <th>Email ID</th>
                                        <th>Business Name</th>
                                        <th>Business Address</th>
                                        <th>action</th>
                                    </tr>
                                    </tr>
                                </thead>

                                <tbody id="visitplanpost_tbody">


                                </tbody>
                            </table>
                            <button type="submit" class="btn" id="submit">Save</button>    
                        </div>         
                    </fieldset>       
                </div>
            </form>

        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        var html = '';
        ////////////////////////////////////////////////////////

        var postplandetail1 = <?= json_encode($postplandetail) ?>;
        //////////////////////
        var customername = <?= json_encode($customername) ?>;
        var customername_option;
        $.each(customername, function (i, val) {
            customername_option += "<option value = '" + val['IdCustomer'] + "'>" + val['CustomerName'] + "</option>";
        }
       
        );
        var count = 0;
        $.each(postplandetail1, function (index, value) {
            html += "<tr>";
            //	html += "<td><input style='display:none' type = 'text' name = 'enterNumber[]' value='"+value.entery_no+"' /> </td>";
            ////////////////////////////////////////////////////
            //html += "<td><select style='width:150px' name = 'customername[]'value='"+value.Customername+"'></select></td>";
            html += "<td><select name = 'customername[]'>" + customername_option + "</select></td>";
            html += "<td><input type = 'text' name = 'address[]' value='" + value.Address + "' /> </td>";
            html += "<td><input type = 'text' name = 'mobile[]'  value='" + value.Mobile + "'/> </td>";
            html += "<td><input type = 'text' name = 'telephone[]' value='" + value.Telephone + "' /> </td>";
            html += "<td><input type = 'text' name = 'email[]' value='" + value.Email + "' /> </td>";
            html += "<td><input type = 'text' name = 'businessname[]'  value='" + value.Businessname + "'/> </td>";
            html += "<td><input type = 'text' name = 'businessaddress[]' value='" + value.Businessaddress + "' /> </td>";
            html += "<td style='text-align:center !important;'><a href='#' class = 'remCF textoq'>Remove</a></td>"
            html += "</tr>";

        });
        $('#visitplanpost_tbody').append(html);
    });



///////////////////////////////
    $("#addVisitPlanPost").on('click', function (e) {
        e.preventDefault();
        var html;
        var customername = <?= json_encode($customername) ?>;
        var customername_option;
        $.each(customername, function (i, val) {
            customername_option += "<option value = '" + val['IdCustomer'] + "'>" + val['CustomerName'] + "</option>";
        }
        ////////////////////////////////////////


        );

        html += "<tr>";

        html += "<td><select name = 'customername[]'>" + customername_option + "</select></td>";
        html += "<td><input type = 'text' name = 'address[]'  /> </td>";
        html += "<td><input type = 'text' name = 'mobile[]'  /> </td>";
        html += "<td><input type = 'text' name = 'telephone[]'  /> </td>";
        html += "<td><input type = 'text' name = 'email[]'  /> </td>";
        html += "<td><input type = 'text' name = 'businessname[]'  /> </td>";
        html += "<td><input type = 'text' name = 'businessaddress[]'  /> </td>";
        html += "<td style='text-align:center !important;'><a href='#' class = 'remCF textoq'>Remove</a></td>"
        html += "</tr>";

        $('#visitplanpost_tbody').append(html);
    });

//////////////
    $(document).on('click', '.remCF', function () {
        // $('#submit').hide();
        $(this).parent().parent().remove();

    });

</script>