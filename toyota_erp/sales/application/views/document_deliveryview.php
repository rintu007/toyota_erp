<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        if($this->session->flashdata('message')){
            ?>
            <div>
                <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                    <?= $this->session->flashdata('message')?>
                </h1>
            </div>
        <?php } ?>

        <div class="right-pnel">

            
                
                 <div id="searchform" class="feildwrap">
                   
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                        <a href="<?=base_url()?>index.php/Documentdelivery/add"><button class="btn" type="button">ADD Document Delivery</button></a>
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ChasisNo</th>
                                        <th>EngineNo</th>
                                        <th>RegistrationNumber</th>
                                        <th>Received Documents</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                   
                                    <?php
                                    $count = 1;
                                    foreach($documentdelivery as $val) { ?>
                                        <tr>
                                            <td><?=$count++;?></td>
                                            <td><?=$val['ChasisNo']?></td>
                                            <td><?=$val['EngineNo']?></td>
                                            <td><?=$val['RegistrationNumber']?></td>
                                            <td><a href="<?=site_url('index.php/documentdelivery/edit/'.$val['iddocumentdelivery'])?>">View/Edit</a></td>
                                        </tr>
                                    <?php } ?>   
                                </tbody>
                            </table>
                        </div>  
                        <div class="col-md-9">
                                <?php echo $pagination; ?>
                        </div>             
                </div>
        </div>
    </div>
</div>
<div style="width: 250px;" class="feildwrap  popup popup-detail">
    <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
        <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="margin-left: 25px;width: 0px;">
            <fieldset style="min-width: 150px;">
                <legend>Documents</legend>
                <div class="feildwrap">
                    <table class="dataTable" >
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Document</td>
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

    function getData(idDispatch)
    {
        var html = ''
        $.ajax({
            url: "<?= base_url() ?>index.php/documentreceive/getDocumentreceive",
            type: "POST",
            data: {
                idDispatch: idDispatch
            },
            success: function (data) {
                a = JSON.parse(data);
                var html ='';
                $(a).each(function(i,v) {
                   html+= '<tr><td>'+(i+1)+'</td>'+
                    '<td>'+(v.documentname)+'</td>'
                })
                html += '</tr>'
                $('#myTable').html(html)



                showpopup()


            }
        });
    }
</script>
