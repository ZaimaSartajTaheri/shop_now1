<style>
.checkout-progress-sidebar {
    border: 2px solid #151515;
    border-radius: 5px;
    padding: 20px;
    background-color: #151515;
}

.box-upper {
    background-color: #cc0000;
}

.box-header .content {
    margin: 20px 0 0 0;
    position: relative;

}

.box-header .content:before {
    position: absolute;
    content: '';
    top: -10px;
    height: 2px;
    width: 100%;
    background: #686868;
}

.box-header .content:after {
    position: absolute;
    content: '';
    height: 2px;
    width: 20%;
    background: #f12020;
    top: -10px;
}

.box-header .header {
    color: white;
}

.list-unstyled li {
    list-style-type: none;
}

.list-unstyled a {
    color: white;
}

.list-unstyled a:hover {
    text-decoration: none;
    color: #cc0000;
}
</style>
<div class="col-md-4 checkoutBox">
    <!-- checkout-progress-sidebar -->
    <div class="checkout-progress-sidebar ">
        <div class="panel-group">
            <div>
                <div class="box-header">
                    <h5 class="header">Your Checkout Progress</h5>
                    <div class="content">

                    </div>


                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li><a href="my-account.php">My Account</a></li>
                        <li><a href="bill-ship-addresses.php">Billing/Shipping Address</a></li>
                        <li><a href="">Order History</a></li>
                        <li><a href="">Payment Pending Order</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-progress-sidebar -->
</div>