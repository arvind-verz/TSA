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
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h5 style="color: #03336a;">Technogenous</h5>
                            </td>
                            
                            <td>
                                Invoice #: 00129<br>
                                Created: November 2, 2018
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
                                From: Technogenous<br>
                                6, Ram mandir shopping center,<br>
                                Sanjan, Gujarat - 396150 - INDIA
                            </td>
                            
                            <td>
                                To: Pinakin Engineers and Contractors<br>
                                Plot No:3715 A/2, 4th Phase,<br>
                                Near Fair tech, G.I.D.C,<br>
                                Vapi, Gujarat, India<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Product
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Website Development
                </td>
                
                <td>
                    Rs.9400.00
                </td>
            </tr>

            <tr class="item">
                <td>
                    Digital Marketing
                </td>
                
                <td>
                    Rs.10000.00
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Hosting (1 Year)
                </td>
                
                <td>
                    Rs.2000.00
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Domain (1 year)
                </td>
                
                <td>
                    Rs.600.00
                </td>
            </tr>

            <tr class="item last">
                <td>
                    Maintainance (1 Year)
                </td>
                
                <td>
                    Rs.3000.00
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: 25000.00
                </td>
            </tr>
        </table>
        <div style="margin-top: 20px;">
            <p style="color: skyblue;">Thank you for your business!</p>
        </div>
    </div>