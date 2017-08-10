<table width="700" border="0" align="center">
    <tr>
        <td><h2>All Customer</h2></td>
    </tr>
    <tr>
        <td><div id="infoMessage"><?= $message; ?></div></td>
    </tr>
</table>

<form name="frmproduct" method="post">
    <input type="hidden" name="rid" />
    <input type="hidden" name="command" />
    <table width="700" align="center">
        <tr>
            <th width="150"><strong>Customer Name</strong></th>
            <th><strong>Father Name</strong></th>
            <th><strong>Address</strong></th>
            <th><strong>City</strong></th>
            <th><strong>Province</strong></th>
            <th><strong>CNIC Number</strong></th>
            <th><strong>NTN Number</strong></th>
            <th><strong>Telephone</strong></th>
            <th><strong>Cellphone</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>View</strong></th>
            <th><strong>Edit</strong></th>
            <th><strong>Delete</strong></th>
        </tr>
        <?php
        foreach ($customers as $customer) {
            $customerID = $customer['Id'];
            ?>
            <tr>
                <td><?php echo $customer['CustomerName'] ?></td>
                <td><?php echo $customer['FatherName'] ?></td>
                <td><?php echo $customer['AddressDetails'] ?></td>
                <td><?php echo $customer['City'] ?></td>
                <td><?php echo $customer['Province'] ?></td>
                <td><?php echo $customer['Cnic'] ?></td>
                <td><?php echo $customer['Ntn'] ?></td>
                <td><?php echo $customer['Telephone'] ?></td>
                <td><?php echo $customer['Cellphone'] ?></td>
                <td><?php echo $customer['Email'] ?></td>
                <td><a href='edit_customer/<?= $customerID ?>'>Edit</a></td>
                <td>
                    <?php
                    echo anchor('index.php/manage_products/delete_product/' . $product_id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>