<style type="text/css">
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

/** RTL **/
.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
<?php
$result = get_student_details($invoice_data->student_id);
$item_details = json_decode($invoice_data->invoice_data);
?>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="<?php echo base_url('assets/images/img3.png'); ?>" style="width:100%; max-width:300px;">
                        </td>

                        <td>
                            Invoice #: <?php echo $invoice_data->invoice_no; ?><br>
                            Created: <?php echo date('M d, Y', strtotime($invoice_data->created_at)); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            The Science Academy Pte Ltd<br>
                            12345 Sunny Road<br>
                            Sunnyville, SG 12345
                        </td>

                        <td>
                            <?php echo $result['name']; ?><br>
                            <?php echo $result['email']; ?><br>
                            <?php echo $result['phone']; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- <tr class="heading">
            <td>
                Payment Method
            </td>

            <td>

            </td>
        </tr>

        <tr class="details">
            <td>
                Check
            </td>

            <td>
                1000
            </td>
        </tr> -->

        <tr class="heading">
            <td>
                Item
            </td>

            <td>
                Price
            </td>
        </tr>
        <?php
        $i = 0;
        foreach($item_details as $key => $value) {
        ?>
        <tr class="item last">
            <td>
                <?php echo ucwords(str_replace("_", " ", $key)); ?>
            </td>

            <td>
                <?php if($i!=0) {echo '$';}echo $value; ?>
            </td>
        </tr>
        <?php
        $i++;}
        ?>

        <tr class="total">
            <td></td>

            <td>
               Total Paid: <?php echo '$'.$invoice_data->invoice_amount; ?>
            </td>
        </tr>
    </table>
</div>
