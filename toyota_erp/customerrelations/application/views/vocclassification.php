<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin') {
            include 'include/cr_leftmenu.php';
        } else {
            if ($data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint' || $data['Role'] == 'Executive Inquiry') {
                include 'include/cr_leftsubmenu.php';
            }
        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <legend>VOC Classification</legend>
                        <div>
                            <label>Filter by Relatedto</label>
                            <input type="text" name="relatedto" id="filterby"
                                   placeholder="Product / Sales / Service / Body&Parts">    
                        </div>
                    </fieldset>
                </div><br>
                <fieldset>
                    <legend>VOC Classification</legend><br><br>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="1%">SNo</th>
                                    <th width="5%">Related to</th>
                                    <th width="5%">Detail's Code</th>
                                    <th width="25%">Detail's Description</th>
                                    <th width="05%">Process Code</th>
                                    <th width="25%">Process Description</th>
                                    <th width="5%">SubProcess Code</th>
                                    <th width="25%">SubProcess Description</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="9">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="shwallvoc">
                                <?php
                                $count = 1;
                                $classificationlist = json_decode($classificationlist);
                                foreach ($classificationlist as $key) {
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $key->Relatedto ?></td>
                                        <td class="tbl-name"><?= $key->ContactDetailCode ?></td>
                                        <td style="text-align: left" class="tbl-name"><?= $key->ContactDetailsDescription ?></td>
                                        <td class="tbl-name"><?= $key->SaleProcessCode ?></td>
                                        <td style="text-align: left" class="tbl-name"><?= $key->SaleProcessDescription ?></td>
                                        <td class="tbl-name"><?= $key->Code ?></td>
                                        <td style="text-align: left" class="tbl-name"><?= $key->Description ?></td>
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
<script>
    $(document).ready(function() {
        $('#isshowdepart').hide();
    });

    $idcrroute = 0;
    function updateroute(val) {

        $idcrroute = val;
        $('#addroutes').hide();
        $('#updateformroute').show();
    }

    $("#updateformroute").submit(function() {
        console.log('ok');
        var formData = $('#updateformroute').serialize();
        formData += "&idcrroute=" + $idcrroute;
        $.ajax({
            url: "<?= base_url() ?>index.php/Route/updateroutes",
            type: "POST",
            data: formData,
            success: function(data) {
                location.reload();
            },
            error: function(data) {

            }
        });
        return false;
    });

    function showdeparts() {
        $("#isshowdepart").toggle();
        $(".isroutesname").toggle();
    }

    $('#filterby').keyup(function() {
        var filterby = $('#filterby').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Vocclassification/servicegetfilteredvocclassification",
            type: "POST",
            data: {relatedto: filterby},
            dataType: "json",
            success: function(data) {
                console.log(data);
//                if (data !== "null")
//                {
//                    var parseddata = JSON.parse(data);
                if (data.length > 0) {
                    console.log('agaya');
//                        console.log(parseddata);
                    var count = 1;
                    var items = [];
                    $.each(data, function(i, val) {
                        items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.Relatedto + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ContactDetailCode + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ContactDetailsDescription + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.SaleProcessCode + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.SaleProcessDescription + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.Code + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.Description + "</td></tr>";
                    });
                    $('#shwallvoc').html(items);
                }
                else {
                    console.log('elseblock');
                    $("#shwallvoc").html("<td></td><td></td><td></td><td></td><td><label style='border: 0px;margin-left:10px'><b>No Classification Exist</b<</label></td><td></td><td></td><td></td>");
                }
            }, error: function() {
                console.log('error');
            }
        });
    });

</script>