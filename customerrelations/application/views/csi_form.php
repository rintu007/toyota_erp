<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint' || $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_leftmenu.php';
        } else {
            redirect(base_url() . "index.php/login/logout");
        }
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Faqs/addfaqs" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">
                    
                    <div style="margin: 10px 0 0 0;">
                            <label>RO #</label>
                            <input type="text" name="question" id="searchnow"
                                  / >    
                        </div>
                    <fieldset>
                        <legend>Customer Information</legend>
                        <div>
                            <label>Customer Name</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Customer Address</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Mobile #</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                            <p style="margin: 20px 0;font-weight: bold;font-family: arial;font-size: 14px;">Prefered Contact Method for Service Reminder:</p>
                       <div>
                            <label>Mobile</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>SMS</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Landline</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="text" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Direct Mail</label>
                            <input type="text" name="question" id="searchnow"
                                  / >    
                        </div>
                        <div style="width:100%;">
                            <p style="float:left;width:100%;margin: 20px 0;font-weight: bold;font-family: arial;font-size: 14px;">Prefered Time for Service Reminder:</p>
                       </div>
                       <div>
                            <label>09:00AM</label>
                            <input type="checkbox" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>10:00AM to 01PM</label>
                            <input type="checkbox" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>1:00PM to 5:00PM</label>
                            <input type="checkbox" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>After 5:00PM</label>
                            <input type="checkbox" name="question" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Any time</label>
                            <input type="checkbox" name="question" id="searchnow"
                                   />    
                        </div>
                    </fieldset>
                </div><br>
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Vehichle Information</legend>
                        <div>
                            <label>Reg #</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>City</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Type</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Varient</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Year</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Mileage</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Selling Dealer</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Purchase Date</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                    </fieldset> 
                     <fieldset>
                        <legend>CSI</legend>
                        <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Very Bad</th>
                                        <th>Bad</th>
                                        <th>Avg</th>
                                        <th>Good</th>
                                        <th>Excellent</th>
                                    </tr>
                                    <tr>
                                        <th>A</th>
                                        <th>Evaluation on SERVICE INITIAION</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                        <tr id="allcomplaints">
                                            <td name="complaintsno">1</td>
                                            <td name="complaints" class="tbl-name">where you greated at the entrance and directed to a sale person</td>
                                            <td name="complaints" class="tbl-name">yes</td>
                                            <td name="complaints" class="tbl-name">no</td>
                                            <td name="complaints" class="tbl-name"></td>
                                            <td name="complaints" class="tbl-name"></td>
                                            <td name="complaints" class="tbl-name"></td>
                                        </tr>
                                       
                                </tbody>
                            </table>
                        </div>         
                    </fieldset> 
                    <div>
                            <label>Customer Signature</label>
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