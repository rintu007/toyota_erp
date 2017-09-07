<style>
    .inpt-table {
        width: 95% !important;
        border: none !important;
    }
</style>
<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($this->session->flashdata('message')) {
            ?>
            <div>
                <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                    <?= $this->session->flashdata('message') ?>
                </h1>
            </div>
        <?php } ?>


        <div class="right-pnel">

            <div id="searchform" class="feildwrap">
                <form action="" class="form validate-form animated fadeIn has-validation-callback">
                    <fieldset>
                        <legend>
                            Documents Requests From Sales
                        </legend>
                        <div class="btn-block-wrap datagrid" id="shwcompat">


                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ChasisNo</th>
                                    <th>EngineNo</th>
                                    <th>RegistrationNumber</th>
                                    <th>STATUS</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php
                                $count = 1;
                                foreach ($data as $val) { ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= $val['ChasisNo'] ?></td>
                                        <td><?= $val['EngineNo'] ?></td>
                                        <td><?= $val['RegistrationNumber'] ?></td>
                                        <td><?= $val['status'] ?></td>
                                        <td onclick="getData(<?= $val['id'] ?>)"><a>View</a></td>
                                        <th>
                                            <?php if($val['status']!='CLOSED')
                                            {?>
                                            <a href="<?=site_url('index.php/documentreceive/dispatch_request_view/'.$val['idDispatch'])?>" class="btn">Dispatch</a>
                                            <?php }?>
                                        </th>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-9">
                            <!--                    --><?php //echo $pagination; ?>
                        </div>
                    </fieldset>

                </form>

            </div>
        </div>
    </div>
</div>
<div style="width: 400px;" class="feildwrap  popup popup-detail">
    <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
        <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="margin-left: 25px;width: 0px;">
            <fieldset style="min-width: 250px;">
                <legend>Documents</legend>
                <div class="feildwrap">
                    <table class="dataTable" >
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Document</td>
                            <td>STATUS</td>
                        </tr>
                        </thead>
                        <tbody id="myTable">

                        </tbody>


                    </table>
                </div>
            </fieldset>
        </div><br>
    </form>
</div>
<script>
    var a;
    function showpopup()
    {
        $('.popup-detail').bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {


        });
    }
    function requestdoc(elem, action, iddcoc) {
        a = elem
        console.log(a)

//        $(a).removeClass('btn')
        $('.docs').prop('checked', false)
        var idDispatch = $("#idDispatch").val();

        $.ajax({
            url: "<?= base_url() ?>/index.php/Documentreceive/sales_request_insert",
            type: "POST",
            data: {
                idDispatch: idDispatch,
                iddocument: iddcoc,
                action: action
            },
            success: function (data) {
                $(a).html('Request ' + action)
                $(a).prop('disabled', true)

            }
        });
    };

    function getData(id)
    {
        var html = ''
        $.ajax({
            url: "<?= base_url() ?>index.php/documentreceive/getRequestedDocument",
            type: "POST",
            data: {
                idDispatch: id
            },
            success: function (data) {
                a = JSON.parse(data);
                var html ='';
                $(a).each(function(i,v) {
                    html+= '<tr><td>'+(i+1)+'</td>'+
                        '<td>'+(v.documentname)+'</td>'+
                        '<td>'+(v.status)+'</td>'
                })
                html += '</tr>'
                $('#myTable').html(html)



                showpopup()


            }
        });
    }
</script>



