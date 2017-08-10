<div class="feildwrap" id="divtblallcomplaints">  

<?php print_r($allinquiries) ?>
    
    
<fieldset>
                        <legend>Inquiry</legend>
                        <div class="btn-block-wrap dg" id="shwinqra">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="05%">SNo</th>
                                        <th width="10%">Comp#</th>
                                        <th width="5%">Reg.Date</th>
                                        <th width="5%">Attender</th>
                                        <th width="5%">Customer</th>
                                        <th width="8%">Contact</th>
                                        <th width="5%">VOC</th>
                                        <th width="8%">RelatedTo</th>
                                        <th width="5%">Type</th>
                                        <th width="10%">Variant</th>
                                        <th width="5%">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="14">
                                    </tr>
                                </tfoot>   
                                <tbody id="shwallcomplaints">
                                    <?php
                                    $count = 1;
                                    $allinquiries = json_decode($allinquiries);
                                   
                                    foreach ($allinquiries as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name="complaintsno"><?= $count++ ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintPadNumber ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRegDate . ', ' . $key->ComplaintRegTime ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->AttenderName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerCellphone ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VoiceOfCustomer ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->FCR ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                          
                                            <td><a href="#divactiontaken" onClick="rolePopup('detail', '<?= $key->ComplaintID ?>')">Feedback</a></td>
                                            <?php
                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
</div>

  <!-- Edit Role Pop UP -->
            <div style="width: 800px;height: 400px" class="feildwrap  popup popup-detail">
                <form action="<?= base_url() ?>index.php/Message/updatecomplaintfeedback" method="POST" class="form animated fadeIn">
                    <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none">
                        <label>Id</label>
                        <input  readonly type="text" id="idcomplaint" name="compid">
                    </div><br>
                    <!--                    <div class="feildwrap" style="margin-left: 10px;">
                                            <h5>FeedBack</h5>
                                        </div>-->
                    <div class="feildwrap" style="margin-left: 40px;margin-top: 20px">
                        <textarea id="fbcomplaint" name="compfeedback" style="margin: 0px; width: 724px; height: 300px;" placeholder="Write FeedBack to this Complaint" data-validation="required"></textarea>
                    </div><br><br>
                    <div class="feildwrap" style="margin-left: 720px;">
                        <input type="submit" class="btn" value="OK">
                    </div>
                </form>
            </div>

<script>

    function rolePopup(div_id, idcomplaint) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//            var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $('#idcomplaint').val(idcomplaint);

        });
    }
    
    
 </script>   