<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/partsrequistion_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form method="" class="form animated fadeIn" onsubmit="return false">
                <div class="feildwrap">   
                    <fieldset>
                        <legend>Parts Update</legend> 
                        <div class="feildwrap" style="width: 800px;">
                            <div id="partsdispatched" style="width: 700px;">
                                <?php
                                if ($Dispatched == 0) {
                                    if ($RemainingQty > 0) {
                                        ?>                              
                                        <label style="font-size: larger;font-weight: bold;width:400px;">
                                            Request of Parts to Dispatched to Part's Department [ <?php echo $RemainingQty; ?> ]
                                        </label>
                                        <span>View Detail at Requested Parts Tab</span>
                                    <?php } else {
                                        ?>
                                        <label style="font-size: larger;font-weight: bold;width:400px;">Request of Parts to Dispatched to Part's Department [ <?php echo $Dispatched; ?> ]</label>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <label style="font-size: larger;font-weight: bold;width:400px;">
                                        <b>Request of Parts to Dispatched to Part's Department [ <?php echo $Dispatched; ?> ]</b>
                                    </label>
                                    <span>View Detail at Requested Parts Tab</span>
                                </div>
                            <?php } ?>
                            <br><div id="partsreceived" style="margin-left: 0px;width:700px;">
                                <?php
                                if ($Received == 0) {
                                    ?>                              
                                    <label style="font-size: larger;font-weight: bold;width:400px;">
                                        <b>Request of Parts to Received From Part's Department [ <?php echo $Received; ?> ]</b>                                        
                                    </label>

                                <?php } else { ?>
                                    <label style="font-size: larger;font-weight: bold;width:400px;">
                                        <b>Request of Parts to Received From Part's Department [ <?php echo $Received; ?> ]</b>
                                    </label>
                                    <span>View Detail at Received Parts Tab</span>
                                </div>
                            <?php } ?>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>


