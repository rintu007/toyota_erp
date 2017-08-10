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
                  action="<?= base_url() ?>index.php/visitplan/edit" class="form validate-form animated fadeIn">
                <input style="display:none" type="text" name="idvisitplan"  value="<?= $visit_plan['idvisitplan'] ?>" readonly> 
                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Add Visit Plan</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entery_no" id="entery_no" value="<?= $visit_plan['entery_no'] ?>" readonly="readonly">    
                        </div>

                        <div>
                            <label>Date</label>
                            <input type="text" name="entery_date" class="date" value="<?= $visit_plan['entery_date'] ?>">    
                        </div>
                    </fieldset> 
                    <fieldset>

                        <button type="button" class="btn" id="addVisitPlan">Add Visit Plan</button>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="visitplan_table" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sale Person</th>
                                        <th>Location</th>
                                        <th>Visit Date</th>
                                        <th>Day Of Visit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="visitplan_tbody">


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
        var html;
        var saleperson = <?= json_encode($saleperson) ?>;
//        var saleperson_option;
        var location = <?= json_encode($location) ?>;
        var location_option;
        var visit_plan_detail = <?= json_encode($visit_plan_detail) ?>;
        var count = 0;


        var salepersonObj = {
            idsalePerson: '',
            nameSalePerson: ''
        }
        var arrSalePerson = [];
        $.each(saleperson, function (index, name) {
            salepersonObj = {
                idsalePerson: name['Id'],
                nameSalePerson: name['FullName']
            };
            arrSalePerson.push(salepersonObj);
        });


        var salelocation = {
            idLocation: '',
            nameLocation: ''
        }
        var arrSaleLocation = [];
        $.each(location, function (index, name) {
            salelocation = {
                idLocation: name['idLocation'],
                nameLocation: name['Location']
            };
            arrSaleLocation.push(salelocation);
        });
//        console.log(visit_plan_detail);

        $.each(visit_plan_detail, function (k, value) {
            html += "<tr>";


            html += "<td><select name = 'sale_person[]' id = 'saleperson" + count + "'>";
            for (i = 0; i < arrSalePerson.length; i++) {
                var selection2 = value['idsaleman'] == arrSalePerson[i].idsalePerson ? 'selected' : '';
                html += '<option value="' + arrSalePerson[i].idsalePerson + '"' + selection2 + '>' + arrSalePerson[i].nameSalePerson + '</option>';
            }
            html += "</select></td>";


            html += "<td><select name = 'location[]' id= 'location" + count + "''>";
            for (i = 0; i < arrSaleLocation.length; i++) {
                var selection = value['idlocation'] == arrSaleLocation[i].idLocation ? 'selected' : '';
                html += '<option value="' + arrSaleLocation[i].idLocation + '"' + selection + '>' + arrSaleLocation[i].nameLocation + '</option>';
            }
            html += "</select>";
            html += "</td>";


            html += "<td><input type = 'text'  name = 'visit_date[]' class='textoq' id = 'date" + count + "' value = '" + value['visit_date'] + "'/> </td>";
            html += "<td><input type = 'text' name = 'day_of_visit[]' class='textoq' id = 'day" + count + "' value = '" + value['day_of_visit'] + "'/> </td>";
            html += "<td><a href='' class = 'remCF textoq'>Remove</a></td>"
            html += "</tr>";

            $('#date' + count).val(value['visit_date']);
            $('#day' + count).val(value['day_of_visit']);
            $('#visitplan_tbody').html(html);
            count = count + 1;
        });
    });



    $("#addVisitPlan").on('click', function () {

        var html;
        var saleperson = <?= json_encode($saleperson) ?>;
        var saleperson_option;

        var location = <?= json_encode($location) ?>;
        var location_option;

        $.each(saleperson, function (i, val) {
            saleperson_option += "<option value = '" + val['Id'] + "'>" + val['FullName'] + "</option>";
        });

        $.each(location, function (i, val) {
            location_option += "<option value = '" + val['idLocation'] + "'>" + val['Location'] + "</option>";
        });

        html += "<tr>";
        html += "<td><select name = 'sale_person[]'>" + saleperson_option + "</select></td>";
        html += "<td><select name = 'location[]'>" + location_option + "</select></td>";
        html += "<td><input type='date' name = 'visit_date[]' class='date' /> </td>";
        html += "<td><input type = 'text' name = 'day_of_visit[]' class='textoq' /> </td>";
        html += "<td style='text-align:center !important;'><a href='#' class = 'remCF textoq'>Remove</a></td>"
        html += "</tr>";
        $('#visitplan_tbody').append(html);
    });

    $(document).on('click', '.remCF', function (e) {
        e.preventDefault();
//        alert();
//        $('#submit').hide();
        $(this).parent().parent().remove();

    });
</script>