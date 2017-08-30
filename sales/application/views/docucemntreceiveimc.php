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
        if($this->session->flashdata('message')){
        ?>
        <div>
            <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                <?= $this->session->flashdata('message')?>
            </h1>
        </div>
        <?php } ?>


        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/documentreceive/receive_from_imc" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Documents Receive From IMC</legend>
                        <div>
                            <label for="">Select Car</label>
                            <select name="idDispatch" id="idDispatch" data-validation="required">
                                <option value="">--Select--</option>
                                <?php foreach ($dispatch as $row){
                                    ?>
                                    <option value="<?=$row['idDispatch']?>"><?=$row['ChasisNo']?></option>

                                <?php } ?>
                            </select>

                        </div>
                        <br>
                        <?php foreach ($docs as $row){
                            ?>
                            <div>
                                <label for="<?=$row['iddocument']?>"><?=$row['documentname']?></label>
                                <input type="checkbox" class="docs" name="iddocument[]" value="<?=$row['iddocument']?>" id="doc_<?=$row['iddocument']?>" />
                            </div>

                        <?php
                        }?>
                        <br>
                        <div >
                            <input type="submit" value="Receive" class="btn" >
                        </div>
                    </fieldset>
                </div>



            </form>
        </div>
    </div>
</div>


<script>
    $("#idDispatch").change(function () {
        $('.docs').prop('checked',false)
        var idDispatch = $("#idDispatch").val();

        $.ajax({
            url: "<?= base_url() ?>index.php/Documentreceive/getDocumentreceive",
            type: "POST",
            data: {
                idDispatch: idDispatch
            },
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a);
                if (a.length > 0) {
                    $.each(a, function (i, val) {

                        $('#doc_'+val.iddocument).prop('checked',true)
//                        items += "<option value='" + val.idvisitplan + "'>" + val.idvisitplan + "</option>";
                    });

                }
            }
        });
    });
</script>
