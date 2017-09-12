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
                  action="<?= base_url() ?>index.php/head/edit" class="form validate-form animated fadeIn">
                <input style="display:none" type="text" name="idheading"  value="<?= $visit_plan['id'] ?>" readonly> 
                <div id="searchform" class="feildwrap">
					<?php
					//print_r($_POST);
					?>
                    <fieldset>
                        <legend>Add heading</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entery_no" id="entery_no" value="<?= $visit_plan['entery_no'] ?>" readonly="readonly">    
                        </div>

                        <div>
                            <label>heading</label>
                            <input type="text" name="heading" class="" value="<?= $visit_plan['heading'] ?>">    
                        </div>
                    </fieldset> 
                    <fieldset>

                        <button style="display:none;" type="button" class="btn" id="addVisitPlan">Add Heading</button>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="visitplan_table" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
										
                              
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
     
        var visit_plan_detail = <?= json_encode($visit_plan_detail) ?>;
        var count = 0;
console.log(visit_plan_detail);

        $.each(visit_plan_detail, function (k, value) {
            console.log(visit_plan_detail);
			html += "<tr>";
			html += "<td><input type = 'text' style = 'display:none' name = 'idInput[]' class='idInput' id = 'idInput" + count + "' value = '" + value['id'] + "'/> ";
			html += "<input type = 'text'  name = 'idsaleman[]' class='textoq' id = 'saleperson" + count + "' value = '" + value['name'] + "'/> </td>";
			html += "<td><a href='' class = 'remCF textoq'>Remove</a></td>"
            html += "</tr>";

            $('#date' + count).val(value['visit_date']);
            $('#day' + count).val(value['day_of_visit']);
            $('#visitplan_tbody').html(html);
            count = count + 1;
        });
    });



$("#addVisitPlan").on('click',function(){
   
   var html;
   


   html += "<tr>";
 
  html += "<td><input type = 'text' name = 'sale_person[]' class='textoq' /> </td>";
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