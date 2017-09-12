<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Faqs/addfaqs" class="form validate-form animated fadeIn">

                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <legend>View Post Visit Plan</legend>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Entry No</th>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Mobile #</th>
                                        <th>Telephone #</th>
                                        <th>Email ID</th>
                                        <th>Business Name</th>
                                        <th>Business Address</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <?php // print_r($visit_post); ?>

                                <tbody id="shwallcomplaints">

                                    <?php foreach ($visit_post as $val) { ?>
                                        <tr>
                                            <td><?= $val['idvisitplanpost'] ?></td>
                                            <td><?= $val['CustomerName'] ?></td>
                                            <td><?= $val['Address'] ?></td>
                                            <td><?= $val['Mobile'] ?></td>
                                            <td><?= $val['Telephone'] ?></td>
                                            <td><?= $val['Email'] ?></td>
                                            <td><?= $val['Businessname'] ?></td>
                                            <td><?= $val['Businessaddress'] ?></td>
                                            <td><a href="<?= base_url() ?>index.php/Visitplanpost/index/<?= $val['idvisitplanpost'] ?>">Edit</a></td>
                                        </tr>
                                    <?php } ?> 

                                </tbody>
                            </table>
                        </div>         
                    </fieldset>       
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