@extends('frontend.includes.main') @section('contents')

<section id="order_detail">
    <div class="container">
        <p class="mt-5 mb-4 text-white">
            <strong> Order Received. </strong> Thank !!! Your Order has been received
        </p>
        <div class="d-flex">
            <div class="col-sm-8 box-shadow-white p-5">
                <div class="row">
                    <div class="col">
                        <div>
                            <p>
                                <strong>Ref Id: </strong>
                                faldfjaslk;dfjasld;fj
                            </p>
                            <p>
                                <strong>Payment Method : </strong>Cash On
                                Delivery
                            </p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Product A</td>
                                    <td>$10.00</td>
                                </tr>
                                <tr>
                                    <td>Product B</td>
                                    <td>$20.00</td>
                                </tr>
                                <tr>
                                    <td>Product C</td>
                                    <td>$15.00</td>
                                </tr>

                                <tr>
                                    <td>Product A</td>
                                    <td>$10.00</td>
                                </tr>
                                <tr>
                                    <td>Product B</td>
                                    <td>$20.00</td>
                                </tr>
                                <tr>
                                    <td>Product C</td>
                                    <td>$15.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Subtotal</th>
                                    <td>$45.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">Delivery Charge</th>
                                    <td>$5.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">VAT (10%)</th>
                                    <td>$5.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total</th>
                                    <td>$55.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 box-shadow-white">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Order Code</td>
                            <td>416546521635</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>2020/20/00</td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td>$15.00</td>
                        </tr>
                        <tr>
                            <td>Delivery Charge</td>
                            <td>$10.00</td>
                        </tr>
                        <tr>
                            <td>VAT Charge</td>
                            <td>$20.00</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>$15.00</td>
                        </tr>

                        <tr>
                            <td>Method Payment</td>
                            <td>Cash On Delivery</td>
                        </tr>

                        <tr style="border: none; border-style: none;">
                            <td style="border: none; border-style: none;">
                                <button><a href="">Download Invoice</a></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
