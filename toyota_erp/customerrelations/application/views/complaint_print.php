<style type="text/css">
    .label-cont {
    float: left;
    width: 100%;
}
</style>
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint' || $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_complaintleftmenu.php';
        } else {
            redirect(base_url() . "index.php/login/logout");
        }
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Faqs/addfaqs" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Customer Complaint Form</legend>
                          <div style="width: 50%;float: left;">
                                <div class="label-cont">
                                    <label>Responsible Dealership:</label>
                                       
                                </div>
                                <div class="label-cont">
                                    <label>Category:</label>
                                        
                                </div>
                                <div class="label-cont">
                                    <label>Complaint Against:</label>
                                       
                                </div>
                                <div class="label-cont">
                                    <label>Related to:</label>
                                       
                                </div>
                               <div class="label-cont">
                                    <label>Contact Details:</label>
                                     
                                </div>
                                <div class="label-cont">
                                    <label>Component / Process:</label>
                                      
                                </div>
                                <div class="label-cont">
                                    <label>Phenomenon / Subprocess:</label>
                                       
                                </div>
                                <div class="label-cont">
                                    <label>Date:</label>
                                       
                                </div>
                                <div class="label-cont">
                                    <label>Time:</label>
                                     
                                </div>
                           </div>
                            <div style="width: 50%;float: left;">
                                <div class="label-cont">
                                    <label>Complaint Form #:</label>
                                       
                                </div>
                                <div class="label-cont">
                                    <label>Ticket #:</label>
                                        
                                </div>
                                <div class="label-cont">
                                    <label>Multiple:</label>
                                       
                                </div>
                           </div>
                           <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer & vehicle information</th>
                                        <th>
                                            <table>
                                                <thead>
                                                    <th>
                                                    <tr><td style="color: #fff;">Customer Type</td>
                                                    </tr>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="color: #fff;">Corporate</td>
                                                        <td><input type="checkbox"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #fff;background: none;">Individual</td>
                                                        <td style="background: none;"><input type="checkbox"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #fff;">Got</td>
                                                        <td><input type="checkbox"/></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </th>
                                        <th>Complaint Recieved Through</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Customer Name</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Soft Phone  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Customer's Contact #:</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Hard Phone  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Customer's Email</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Email:  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Vehichle Make/Model;</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Letter:  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Color:</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Fax:  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Frame #:</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Tele Survey  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">Engine #:</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">FFS Survey  <input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td style="width:30%">PBO #:</td>
                                            <td style="width:40%"></td>
                                            <td style="width:30%">Walk IN  <input type="checkbox"/></td>
                                        </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Repair History</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                        <tr id="allcomplaints">
                                            <td style="height: 100px;background: #fff;"></td>
                                        </tr>
                                </tbody>
                            </table>
                            <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer Complaint</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                        <tr id="allcomplaints">
                                            <td style="height: 100px;background: #fff;"></td>
                                        </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Serious Complaint</th>
                                        <th>Mark If Any</th>
                                        <th>Safety Complaint</th>
                                        <th>General Complaint/Category Of Complaint</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                        <tr id="allcomplaints">
                                            <td>Fire Hazard</td>
                                            <td><input type="checkbox"/></td>
                                            <td>1</td>
                                            <td>PQ</td>
                                        </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Necessary Steps for Swift,Sure and Sincere Handling</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                        <tr id="allcomplaints">
                                            <td>FR / EDR #:</td>
                                            <td><input type="checkbox"/></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td>Refrence RO# / CBJ #:</td>
                                            <td><input type="checkbox"/></td>
                                        </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Action Taken:</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                        <tr id="allcomplaints">
                                            <td style="height: 100px;background: #fff;"></td>
                                        </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align: left">Customer Comments</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                        <tr id="allcomplaints">
                                            <td>Satisfied:</td>
                                            <td><input type="checkbox"/></td>
                                            <td style="width: 70%"></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td>Partially Satisfied:</td>
                                            <td><input type="checkbox"/></td>
                                            <td></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td>Dissatisfied:</td>
                                            <td><input type="checkbox"/></td>
                                            <td></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td>Under Observation:</td>
                                            <td><input type="checkbox"/></td>
                                            <td></td>
                                        </tr>
                                        <tr id="allcomplaints">
                                            <td>Other Suggestions:</td>
                                            <td><input type="checkbox"/></td>
                                        </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </fieldset>
                </div><br>
                 <div id="searchform" class="feildwrap"> 
                    <div>
                            <label>Customer Signature:</label>
                            <input type="text" name="question" id="searchnow"
                                  / >    
                        </div>   
                        <div>
                            <label>CR Manager</label>
                            <input type="text" name="question" id="searchnow"
                                  / >    
                        </div>   
                        <div>
                            <label>Service / Sales /<br> Parts Manager</label>
                            <input type="text" name="question" id="searchnow"
                                  / >    
                        </div>        
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/warehouse/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Warehouse ID</label>
            <input type="text" name="WarehouseId" id="WarehouseId" data-validation="required">
        </div>
        <div>
            <label>Mode Name</label>
            <input type="text" name="Name" id="Name" data-validation="required">
        </div>

    </form>
</div>
<script>
//    $('#searchform').hide();
    $('#searchnow').ready(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Faqs/servicegetquestionsanswers",
            type: "POST",
            data: {question: searchnow},
            dataType: "Json",
            success: function(data) {
                counter = 1;
                if (data !== "null")
                {
                    if (data.length > 0) {
                        try {

                            var items = [];
                            $.each(data, function(i, val) {
//                                items += "<tr><td><div class='feildwrap'><div style='font-size: larger'>Q# " + counter + 1 + ":" val.Question + " < /div><br><div style='font-size: larger'>Ans: " + val.Answer + "</div > < /div></td > < /tr>";
                                items += "<tr><td><br><div class'feildwrap'><div style='font-size: small'>Q#" + counter++ + ": " + val.Question + "</div><div style='font-size: small'>Ans: " + val.Answer + "</div><div style='font-size: small'>Date: " + val.Date + "</div><div style='font-size: small'>Time: " + val.Time + "</div></div></td></tr>";
                            });
                            $('#havefaqs').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#havefaqs").html("<tr><td><div class='feildwrap'><div style='font-size: larger'>No Data Found</div></td></tr>");
                    }
                }
            }, error: function() {
                console.log('error');
            }
        });
    });

    function validationform() {

    }
</script>