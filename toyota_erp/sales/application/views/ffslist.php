<div id="wrapper">
    <div id="content">
        <?php
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
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>FFS List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="">Gate Pass</th>
                                    <th width="">Date</th>
                                    <th width="">Through</th>
                                    <th width="">Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($gpf as $row) {
								
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $row['GatePassNumber'] ?></td>
                                        <td class="tbl-date"><?= $row['GatePassDate'] ?></td>
                                        <td class="tbl-date"><?= $row['Through'] ?></td>
                                        <td class="tbl-color"><?= $row['Company'] ?></td>

                                        <td>
                                            <?php if($row['idffs']){?>
                                        <?php if($row['close']){?>
                                                    <button class=""><a href="<?=site_url("index.php/ffs/view_ffs/").'/'.$row['idffs']?>">View FFS</a></button>

                                                <?php } else{?>
                                                    <button class=""><a href="<?=site_url("index.php/ffs/edit_ffs/").'/'.$row['idffs']?>">Update FFS</a></button>

                                                <?php } }else{?>

                                                <button class=""><a href="<?=site_url("index.php/ffs/create_ffs/").'/'.$row['idGatePass']?>">Create FFS</a></button>
                                                <?php
                                            }?>
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

<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/pbo/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var items = [];
                        var count = 1;
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerName + "</td><td>" + val.Date + "</td>\n\
<td>" + val.Variants + "</td><td>" + val.ColorName + "</td><td>" + val.Cellphone + "</td>\n\
<td><a href='<?= base_url() ?>index.php/quotation/index/" + val.IdResourceBook + "'>Quotation</a> / <a style='cursor: pointer;' onClick=rbPopup('detail','" + val.IdResourceBook + "')>Lost Sale</a> / <a href='<?= base_url() ?>/index.php/resourcebook/update/" + val.IdResourceBook + "'>Edit</a></td></tr>"
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'>No Data Found</td><td style='border: 0px'></td><td style='border: 0px'></td>");
                }
            }
        });
    });
</script>
