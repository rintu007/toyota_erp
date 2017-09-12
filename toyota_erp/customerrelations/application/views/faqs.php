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
                        <legend>Search Question/Answers</legend>
                        <div>
                            <label>Search</label>
                            <input type="text" name="question" id="searchnow"
                                   placeholder="By Question">    
                        </div>
                    </fieldset>
                </div><br>
                <fieldset>
                    <legend>FAQ'S</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Questions</label>
                            <textarea name="question" style="margin: 0px; width:500px; height: 100px;" placeholder="Quesion" data-validation="required"></textarea>
                        </div><br>
                        <div>
                            <label>Answers</label>
                            <textarea name="answer" style="margin: 0px; width: 500px; height: 100px;" placeholder="Answer" data-validation="required"></textarea>
                        </div>
                          <div>
                            <label>Date</label>
                            <input type="date" id="FDate" name="Fdate" />
                        </div>
                        <div>
                            <label>Time</label>
                            <input type="time" id="FTime" name="FTime" />
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>FAQ'S List</legend>
                    <!--                    <div class="feildwrap">
                                            <div>
                                                <label>Search FAQ'S</label>
                                                <input type="text" name="search" id="searchnow"
                                                       placeholder="Search By Question">
                                            </div>
                                        </div>-->
                    <div class="btn-block-wrap">
                        <table>
                            <tbody id="havefaqs">

                                <?php
                                $count = 1;
                                $faqslist = json_decode($faqslist);
                                foreach ($faqslist as $key) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div id="shwfaqs" class="feildwrap">
                                                <div style="font-size: larger"><?= "Q#" . $count++ . ': ' . $key->Question ?></div><br>
                                                <div style="font-size: larger"><?= "Ans: " . $key->Answer . "." ?></div>
                                            </div><br>
                                        </td> 
                                    </tr>

                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
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