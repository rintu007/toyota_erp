<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">


            <form class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Dashboard</legend>
                    <div class="feildwrap">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>
                                            <b> Service Part(s) For Dispatch :</b>
                                        </span>
                                    </td>
                                    <td>[
                                        <span style="font-weight: bold;">

                                            <?php
                                            if ($Requests > 0 || $Requests != "") {
                                                echo '<strong>' . $Requests . '</Strong>';
                                            } else {
                                                echo "No Complaint(s) to Give FeedBack ";
                                            }
                                            ?>

                                        </span>]
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!--redirect(base_url() . "index.php/login/logout");-->
<!--redirect(base_url() . "index.php/login/logout");-->