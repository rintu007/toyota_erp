
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
                <form class="form animated fadeIn"  action="<?=site_url('index.php/Appointment/index')?>" method="post">
                <fieldset>
                    <legend>Appointment List</legend>
                    <div class="feildwrap">
                        <div class="">
                            <label>Customer Name</label>
                            <input type="text" data-validation="" name="CustomerName"
                                   value="<?= isset($_POST['CustomerName']) ? $_POST['CustomerName'] : '' ?>"
                                   placeholder="Search By CustomerName">
                        </div>
<!--                        <div class="">-->
<!--                            <label>Start Time</label>-->
<!--                            <input type="text" data-validation="" name="StartTime"-->
<!--                                   value="--><?//= isset($_POST['StartTime']) ? $_POST['StartTime'] : '' ?><!--"-->
<!--                                   placeholder="Search By StartTime">-->
<!--                        </div>-->
<!--                        <div class="">-->
<!--                            <label>End Time</label>-->
<!--                            <input type="text" data-validation="" name="EndTime"-->
<!--                                   value="--><?//= isset($_POST['EndTime']) ? $_POST['EndTime'] : '' ?><!--"-->
<!--                                   placeholder="Search By EndTime">-->
<!--                        </div>-->
                        <div class="">
                            <label>Appointment Date</label>
                            <input type="text" data-validation="" name="AppointmentDate" class="date"
                                   value="<?= isset($_POST['AppointmentDate']) ? $_POST['AppointmentDate'] : '' ?>"
                                   placeholder="Search By AppointmentDate">
                        </div>
                        <div>
                            <label>Bay</label>
                            <select name="idBay">
                                <option>Select Bay</option>
                                <?php
                                foreach ($bay as $AllBays) {

                                    ?>
                                    <option
                                          <?=  isset($_POST['idBay'])?(($_POST['idBay']== $AllBays['key'])?' selected':''):'';?>
                                            value="<?= $AllBays['key'] ?>"><?= $AllBays['label'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div style="margin-left: 105px;">
                            <input type="submit" value="search" class="btn">

                        </div>
                    </div>

                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="">S No.</th>
                                    <th width="">CustomerName</th>
                                    <th width="">BayName</th>
                                    <th width="">StartTime</th>
                                    <th width="">EndTime</th>
                                    <th width="">AppointmentDate</th>
                                    <th width="">RegistrationNumber</th>
                                    <th width="">ExtendTime</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="finalResult">
                                <?php
//                                $count = 1;
                                foreach ($appintments as $row) {

                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $page++ ?></td>
                                        <td class="tbl-variants"><?= $row['CustomerName'] ?></td>
                                        <td class="tbl-variants"><?= $row['BayName'] ?></td>
                                        <td class="tbl-variants"><?= $row['StartTime'] ?></td>
                                        <td class="tbl-name"><?= $row['EndTime'] ?></td>
                                        <td class="tbl-date"><?= $row['AppointmentDate'] ?></td>
                                        <td class="tbl-color"><?= $row['RegistrationNumber'] ?></td>
                                        <td class="tbl-phone"><?= ($row['ExtendTime']) ?></td>
                                        <td class="tbl-phone"><a href="<?=site_url(('index.php/Appointment/indec').'/'.$row['idAppointment'])?>">Ro</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                            <tr>

                                <td colspan="15">
                                    <div id="paging">
                                        <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                            Total : <?php echo $counts ?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="15">
                                    <div id="paging">
                                        <ul>
                                            <?php echo $links ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

