<?php

//Enter the headings of the excel columns
$contents = "\t, \t, \t, \t, \t,\t,\t ,\t, \t,\t,Toyota Western Motors,  \t,\t,\t, \t,\t, \t,\t,\t, \t, \t, \t\n";
$contents .= "\t, \t, \t, \t, \t,\t,\t ,\t, \t,Daily Report:," . date('d/m/Y') . ", \t,\t,\t, \t,\t, \t,\t,\t, \t, \t, \t\n";
$contents .= "\t, \t, \t, \t, \t,1st Contact,\t ,\t, \t,\t,Contact Type,  Mode Of Payment,\t,\t, Prospect Customer,\t, \t,Follow-Ups,\t, If Sale Made:, \t, \t\n";
$contents .= "<b>S No.</b>, Date, Salesman, Time Consumed, Phone, Walk-in, Email, Contact Person , Company Name, Variant Interested, Office/Mobile, Cash, Lease/Finance, Hot, Warm, Cold, 7 Days, 14 Days, 21 Days, Color, Lost Sale Reason, Remarks\n";

//Mysql query to get records from datanbase
//You can customize the query to filter from particular date and month etc...Which will depends your database structure.
//$user_query = mysql_query('SELECT
//car_resource_book.Date,
//car_user_profile.FullName,
//car_resource_book.TimeConsumed,
//car_contact_type.ContactType,
//car_customer.CustomerName,
//car_variants.Variants,
//car_customer.Cellphone,
//car_mode_payment.PaymentType,
//car_customer_status.StatusType,
//car_followup_status.FollowupType,
//car_color.ColorName,
//car_color.ColorName,
//car_lost_sale.Reason,
//car_resource_book.Remarks,
//car_customer.CompanyName,
//car_customer.OfficeNumber
//FROM
//car_resource_book
//LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
//LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
//LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
//LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
//LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
//LEFT JOIN car_lost_sale ON car_lost_sale.IdResourceBook = car_resource_book.IdResourceBook
//LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
//LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
//LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
//');
//While loop to fetch the records
$count = 1;
//while ($row = mysql_fetch_assoc($user_query)) {
//print_r($AllData);
foreach ($AllData as $row) {
    $contents.=$count++ . ",";
    $contents.=$row['Date'] . ",";
    $contents.=$row['FullName'] . ",";
    $contents.=$row['TimeConsumed'] . ",";
    //Contact Type
    if ($row['ContactType'] == 'Walk-in') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['ContactType'] == 'Email') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['ContactType'] == 'Telephone') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    $contents.=$row['CustomerName'] . ",";
    $contents.=$row['CompanyName'] . ",";
    $contents.=$row['Variants'] . ",";
    $contents.=$row['OfficeNumber'] . ",";
    //Payment Mode
    if ($row['PaymentType'] == 'Cash') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['PaymentType'] == 'Financing') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    //Customer Status
    if ($row['StatusType'] == 'Hot') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['StatusType'] == 'Warm') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['StatusType'] == 'Cold') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    //Follow up
    if ($row['FollowupType'] == '7 Days') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['FollowupType'] == '14 Days') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    if ($row['FollowupType'] == '21 Days') {
        $contents.="Yes" . ",";
    } else {
        $contents.="-" . ",";
    }
    $contents.=$row['ColorName'] . ",";
    $contents.=$row['Reason'] . ",";
    $contents.=$row['Remarks'] . "\n";
}

// remove html and php tags etc.
$contents = strip_tags($contents);
//header to make force download the file

print $contents;
header("Content-Disposition: attachment; filename=Toyota-DMS-" . date('d-m-y') . ".csv");
