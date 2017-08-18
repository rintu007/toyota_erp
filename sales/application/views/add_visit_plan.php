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
                  action="<?= base_url() ?>index.php/visitplan/save" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Add Visit Plan</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entery_no" id="entery_no" value="<?=$entery_no?>" readonly>    
                        </div>
                        <div>
                            <label>Entry Date</label>
                           <input type="text" name="entery_date" class="date" value="">    
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

function validationform() {

}

$("#addVisitPlan").on('click',function(){
   
   var html;
   var saleperson = <?= json_encode($saleperson)?>;
   var saleperson_option;

   var location =  <?= json_encode($location) ?>;
   var location_option;

   $.each(saleperson , function(i,val){

    saleperson_option +=  "<option value = '"+val['Id']+"'>"+val['FullName']+"</option>";

   });

    $.each(location , function(i,val){

    location_option +=  "<option value = '"+val['idLocation']+"'>"+val['Location']+"</option>";

   });

   html += "<tr>";
   html += "<td><select name = 'sale_person[]'>"+saleperson_option+"</select></td>";
   html += "<td><select name = 'location[]'>"+location_option+"</select></td>";
   html += "<td><input type = 'date' onchange='getday(this)' name = 'visit_date[]' class='textoq' /> </td>";
   html += "<td><input type = 'text' name = 'day_of_visit[]' class='textoq' /> </td>";
   html += "<td style='text-align:center !important;'><a href='#' class = 'remCF textoq'>Remove</a></td>"
   html += "</tr>";

   $('#visitplan_tbody').append(html);
});


$("#addVisitPlan").on('click','.remCF',function(){
        $('#submit').hide();
        $(this).parent().parent().remove();
        
    });
var day;
var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function getday(a)
{

    var d = new Date(a.value);
    day = days[d.getDay()]
    $($($(a).parent().next()).find('input')[0]).val(day)

}
</script>