<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="firquestionsform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/firquestions/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add FIR-Questions</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Question No.</label>
                            <input id="QuestionNo" name="QuestionNo" type="number" min="1" placeholder="Question No" data-validation="required">
                        </div>
                        <div>
                            <label>Question</label>
                            <textarea id="Question" name="Question" style="margin: 0px; width:500px; height: 100px;" placeholder="Question..." data-validation="required"></textarea>
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 425px;width: 100px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>FIR-Question List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Question</label>
                        <input type="text" name="searchfirquestions" id="searchfirquestions"  placeholder="Search by Question">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="firquestionslisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="05%">QNo</th>
                                    <th width="70%">Question</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="firquestionslisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="firquestionslistbody">
                                <?php
                                $Counter = 1;
                                foreach ($firquestionsList as $key) {
                                    ?>
                                    <tr id="firquestionsTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['QuestionNo'] ?></td>
                                        <td class="tbl-name"><?= $key['Question'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdateFirQuestions('detail', '<?= $key['idFirQuestions'] ?>', '<?= $key['QuestionNo'] ?>', '<?= $key['Question'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/firquestions/Delete/<?= $key['idFirQuestions'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 700px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/firquestions/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>ID FIR-Question</label>
                        <input id="idfirquestions" name="idFirQuestions" type="text" data-validation="required">
                    </div>
                    <div>
                        <label>Question No</label>
                        <input id="uQuestionNo" name="QuestionNo" type="text" data-validation="required">
                    </div>
                    <div>
                        <label>Question</label>
                        <textarea id="uQuestion" name="Question" style="margin-left:200px; width:415px; height: 100px;" placeholder="Quesion" data-validation="required"></textarea>
                    </div><br>
                    <div style="float: right;margin-right:60px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchfirquestions").keyup(function() {
        var search = $("#searchfirquestions").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/firquestions/search",
            type: "POST",
            data: {searchfirquestions: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".firquestionslisthf").is(":visible"))) {
                                $(".firquestionslisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.QuestionNo + "</td>\n\
                            <td class='tbl-name'>" + val.Question + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdateFirQuestions('detail','" + val.idFirQuestions + "','" + val.QuestionNo + "','" + val.Question + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/firquestions/Delete/" + val.idFirQuestions + "' >Delete</a></td></tr>";
                            });
                            $('#firquestionslistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".firquestionslisthf").hide();
                        $("#firquestionslistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var typeName = $('#SelectDealer').val();
            if (typeName === "Select Dealer") {
                $(".error-type").show();
                return false;
            } else {
                $(".error-type").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateQuestion = $('#IdDealer').val();
                if (updateQuestion === "Select Dealer") {
                    $(".error-updatetype").show();
                    return false;
                } else {
                    $(".error-updatetype").hide();
                    return true;
                }
            }
        }
        chosen = "";
        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass !== confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }

    function UpdateFirQuestions(div_id, idfirquestions, quesionNo, question) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idfirquestions").val(idfirquestions);
            $(this).find("#uQuestionNo").val(quesionNo);
            $(this).find("#uQuestion").val(question);
        });
    }

</script>