<div id="body">
    <h3 align="center">Add Customer</h3>
    <div id="infoMessage"><?= $message ?></div>
    <?php echo form_open("customer/index"); ?>
    <table width="394" border="1" cellpadding="0" cellspacing="2" align="center">
        <tr>
            <td width="130" align="right" bgcolor="#FFFFFF">Customer Name: </td>
            <td><?php echo form_input($customerName); ?></td>
        </tr>
        <tr>
            <td width="130" align="right" bgcolor="#FFFFFF">Father Name: </td>
            <td><?php echo form_input($fatherName); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Address Details:</td>
            <td><?php echo form_input($address); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">City:</td>
            <td><?php echo form_input($city); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Province:</td>
            <td><?php echo form_input($province); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">CNIC Number:</td>
            <td><?php echo form_input($cnicNumber); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">NTN Number:</td>
            <td><?php echo form_input($ntnNumber); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Telephone:</td>
            <td><?php echo form_input($telePhone); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Cellphone:</td>
            <td><?php echo form_input($cellPhone); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Email:</td>
            <td><?php echo form_input($email); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Customer Type:</td>
            <td><?php echo form_input($customerType); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">Created Date:</td>
            <td><?php echo form_input($createdDate); ?></td>
        </tr>
        <tr>
            <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
            <td><?php echo form_submit('submit', 'Add Customer'); ?>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>