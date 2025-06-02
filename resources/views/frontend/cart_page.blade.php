@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')

    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Shop Cart</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart Page</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    
    <!-- Shop Cart Page Section start here -->		            
    <div class="shop-cart padding-tb">
        <div class="container">
            <div class="section-wrapper">
                <div class="cart-top">
                    <table>
                        <thead>
                            <tr>
                                <th class="cat-product">Product</th>
                                <th class="cat-price">Price</th>
                                <th class="cat-quantity">Quantity</th>
                                <th class="cat-toprice">Total</th>
                                <th class="cat-edit">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product-item cat-product">
                                    <div class="p-thumb">
                                        <a href="#"><img src="assets/images/shop/01.jpg" alt="product"></a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#">Product Text Here</a>
                                    </div>
                                </td>
                                <td class="cat-price">$250</td>
                                <td class="cat-quantity">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="3">
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </td>
                                <td class="cat-toprice">$750</td>
                                <td class="cat-edit">
                                    <a href="#"><img src="assets/images/shop/del.png" alt="product"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-item cat-product">
                                    <div class="p-thumb">
                                        <a href="#"><img src="assets/images/shop/02.jpg" alt="product"></a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#">Product Text Here</a>
                                    </div>
                                </td>
                                <td class="cat-price">$250</td>
                                <td class="cat-quantity">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </td>
                                <td class="cat-toprice">$500</td>
                                <td class="cat-edit">
                                    <a href="#"><img src="assets/images/shop/del.png" alt="product"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-item cat-product">
                                    <div class="p-thumb">
                                        <a href="#"><img src="assets/images/shop/03.jpg" alt="product"></a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#">Product Text Here</a>
                                    </div>
                                </td>
                                <td class="cat-price">$50</td>
                                <td class="cat-quantity">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </td>
                                <td class="cat-toprice">$100</td>
                                <td class="cat-edit">
                                    <a href="#"><img src="assets/images/shop/del.png" alt="product"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-item cat-product">
                                    <div class="p-thumb">
                                        <a href="#"><img src="assets/images/shop/04.jpg" alt="product"></a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#">Product Text Here</a>
                                    </div>
                                </td>
                                <td class="cat-price">$100</td>
                                <td class="cat-quantity">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </td>
                                <td class="cat-toprice">$200</td>
                                <td class="cat-edit">
                                    <a href="#"><img src="assets/images/shop/del.png" alt="product"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-item cat-product">
                                    <div class="p-thumb">
                                        <a href="#"><img src="assets/images/shop/05.jpg" alt="product"></a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#">Product Text Here</a>
                                    </div>
                                </td>
                                <td class="cat-price">$200</td>
                                <td class="cat-quantity">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </td>
                                <td class="cat-toprice">$400</td>
                                <td class="cat-edit">
                                    <a href="#"><img src="assets/images/shop/del.png" alt="product"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart-bottom">
                    <div class="cart-checkout-box">
                        <form class="coupon" action="/">
                            <input type="text" name="coupon" placeholder="Coupon Code..." class="cart-page-input-text">
                            <input type="submit" value="Apply Coupon">
                        </form>
                        <form class="cart-checkout" action="/">
                            <input type="submit" value="Update Cart">
                            <input type="submit" value="Proceed to Checkout">
                        </form>
                    </div>
                    <div class="shiping-box">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="calculate-shiping">
                                    <h3>Calculate Shipping</h3>
                                    <div class="outline-select">
                                        <select>
                                            <option value="volvo">United Kingdom (UK)</option>
                                            <option value="saab">Bangladesh</option>
                                            <option value="saab">Pakisthan</option>
                                            <option value="saab">India</option>
                                            <option value="saab">Nepal</option>
                                        </select>
                                        <span class="select-icon"><i class="icofont-rounded-down"></i></span>
                                    </div>
                                    <div class="outline-select shipping-select">
                                        <select>
                                            <option value="volvo">State/Country</option>
                                            <option value="saab">Dhaka</option>
                                            <option value="saab">Benkok</option>
                                            <option value="saab">Kolkata</option>
                                            <option value="saab">Kapasia</option>
                                        </select>
                                        <span class="select-icon"><i class="icofont-rounded-down"></i></span>
                                    </div>
                                    <input type="text" name="coupon" placeholder="Postcode/ZIP" class="cart-page-input-text"/>	
                                    <button type="submit">Update Total</button>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="cart-overview">
                                    <h3>Cart Totals</h3>
                                    <ul class="lab-ul">
                                        <li>
                                            <span class="pull-left">Cart Subtotal</span>
                                            <p class="pull-right">$ 0.00</p>
                                        </li>
                                        <li>
                                            <span class="pull-left">Shipping and Handling</span>
                                            <p class="pull-right">Free Shipping</p>
                                        </li>
                                        <li>
                                            <span class="pull-left">Order Total</span>
                                            <p class="pull-right">$ 2940.00</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Cart Page Section ending here -->

    @endsection
