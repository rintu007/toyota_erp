<div id="wrapper">
    <div id="content">
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <div>
                <?= $Response ?>
            </div>
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/ordermode/index" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Order Mode</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Order Mode</label>
                            <input type="text" name="OrderMode" data-validation="required">
                        </div>
                        <div>
                            <label>Code</label>
                            <input type="text" name="Code" data-validation="required">
                        </div>
                        <div>
                            <label>Timeline</label>
                            <input type="text" name="Timeline" value="0" data-validation="">&nbsp;&nbsp;&nbsp;Day(s)
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Order Mode">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Order Mode List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Order Mode</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Order Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Order Mode</th>
                                    <th width="15%">Timeline (Day(s))</th>
                                    <th width="15%">Code</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <?//= $pagination; ?><!--</li>-->
                                                <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($OrderMode as $AllOrderModes) {
                                    $idOrderMode = $AllOrderModes['id'];
                                    ?>
                                    <tr>
                                        <td class="tbl-count"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllOrderModes['Title'] ?></td>
                                        <td class="tbl-code"><?= $AllOrderModes['Timeline'] ?></td>
                                        <td class="tbl-code"><?= $AllOrderModes['Code'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="OrderModePopup('detail', '<?= $idOrderMode ?>', '<?= $AllOrderModes['Title'] ?>', '<?= $AllOrderModes['Timeline'] ?>', '<?= $AllOrderModes['Code'] ?>')">Edit</a>
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
<!-- Edit Party Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/ordermode/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Id Order Mode</label>
            <input type="text" name="id" id="id" data-validation="required">
        </div>
        <div>
            <label>Order Mode</label>
            <input type="text" name="OrderMode" id="OrderMode" data-validation="required">
        </div>
        <div>
            <label>Timeline</label>
            <input type="text" name="Timeline" id="Timeline" value="0" style="width: 200px;" data-validation="">&nbsp;&nbsp;&nbsp;Day(s)
        </div>
        <div>
            <label>Code</label>
            <input type="text" name="Code" id="Code" data-validation="required">
        </div>      
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Order Mode">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/ordermode/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var count = 1;
                        var items = "";
                        $.each(a, function(i, val) {
                            items += "<tr><td class='tbl-count'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Title + "</td>\n\
                            <td class='tbl-code'>" + val.Timeline + "</td>\n\
                            <td class='tbl-code'>" + val.Code + "</td>\n\
<td><a style='cursor: pointer;' onClick=OrderModePopup('detail','" + val.id + "','" + val.Title + "','" + val.Timeline + "','" + val.Code + "')> Edit </a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>");
                }
            }
        });
    });

    function validationform() {
        var WareHouse = $('#Warehouse').val();
        if (WareHouse === "Select Warehouse") {
            $(".error-warehouse").show();
            return false;
        } else {
            $(".error-warehouse").hide();
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

    function OrderModePopup(div_id, id, Name, Timeline, Code) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            //                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#id").val(id);
            $(this).find("#OrderMode").val(Name);
            $(this).find("#Timeline").val(Timeline);
            $(this).find("#Code").val(Code);
        });
    }

</script>