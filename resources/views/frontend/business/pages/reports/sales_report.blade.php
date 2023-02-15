@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Sales Report'}} 
@endsection
@section('content')

    <div class="dashborad-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Business Reports</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="row br-top-bar">
                <div class="col-md-6">
                    <div class="input-group br-fc">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select</option>
                            <option value="1">Last Week</option>
                            <option value="2">Last Month</option>
                            <option value="3">Last Year</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 ta-right" style="display:none">
                    <a href="#" class="btn-download"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/icon-download.png') }}">Download</a>
                    <a href="#" class="btn-print"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/chart/icon-print.png') }}">Print</a>
                </div>
            </div>

            <div class="sales-tab">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-sku-tab" data-bs-toggle="pill" data-bs-target="#pills-sku" type="button" role="tab" aria-controls="pills-sku" aria-selected="false">SKU Number</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-category-tab" data-bs-toggle="pill" data-bs-target="#pills-category" type="button" role="tab" aria-controls="pills-category" aria-selected="false">Category</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-commission-tab" data-bs-toggle="pill" data-bs-target="#pills-commission" type="button" role="tab" aria-controls="pills-commission" aria-selected="false">Commission</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Payment Method</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-carrier-tab" data-bs-toggle="pill" data-bs-target="#pills-carrier" type="button" role="tab" aria-controls="pills-carrier" aria-selected="false">Carrier</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false">Customer</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-gmv-tab" data-bs-toggle="pill" data-bs-target="#pills-gmv" type="button" role="tab" aria-controls="pills-gmv" aria-selected="false">GMV</button>
                      </li>
                  </ul>
                </div>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
    
    
                        <div class="row sales">
                            <div class="col-md-4">
                                <div class="total-sales">
                                    <p>Total Sales</p>
                                    <h3>80K {{env('CURRENCY_TAG')}}</h3>
                                    <span><img src="assets/images/img/credit-icon.png" alt="Credit Icon">7.5%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="total-sales">
                                    <p>Net Sales</p>
                                    <h3>65K {{env('CURRENCY_TAG')}}</h3>
                                    <span><img src="assets/images/img/credit-icon.png" alt="Credit Icon">28.87%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="total-sales orders">
                                    <p>Orders</p>
                                    <h3>217</h3>
                                    <span><img src="assets/images/img/debit-icon.png" alt="Credit Icon">28.87%</span>
                                </div>
                            </div>
                        </div>
            
                        <div class="row pb-4">
                            <div class="col-md-4">
                                <div class="customer-sec">
                                    <p>New Customers</p>
                                    <div class="bottom-line"></div>
                                    <div class="customer-detail">
                                        <div><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/profile-pic.png') }}"></div>
                                        <div class="customer-name">
                                            <p>Naimesh K. Patel</p>
                                            <span>naimesh@gmail.com</span>
                                        </div>
                                    </div>
                                    <div class="customer-detail">
                                        <div><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/profile-pic.png') }}"></div>
                                        <div class="customer-name">
                                            <p>Janak D. Desai</p>
                                            <span>Janak@gmail.com</span>
                                        </div>
                                    </div>
                                    <div class="customer-detail">
                                        <div><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/profile-pic.png') }}"></div>
                                        <div class="customer-name">
                                            <p>KK.Shah</p>
                                            <span>kkshah@gmail.com</span>
                                        </div>
                                    </div>
                                    <div class="customer-detail bt">
                                        <div><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/profile-pic.png') }}"></div>
                                        <div class="customer-name">
                                            <p>Monika Shah</p>
                                            <span>monika@gmail.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="customer-sec product">
                                    <p>Product Sales</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Sales</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Iphone</td>
                                                <td>245</td>
                                                <td>45</td>
                                                <td>$2,235</td>
                                                <td class="in-stock">In Stock</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Television</td>
                                                <td>75</td>
                                                <td>0</td>
                                                <td>$3,456</td>
                                                <td class="out-stock">Out Stock</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Refrigerator</td>
                                                <td>584</td>
                                                <td>13</td>
                                                <td>$829</td>
                                                <td class="in-stock">In Stock</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Microwave Oven</td>
                                                <td>134</td>
                                                <td>0</td>
                                                <td>$410</td>
                                                <td class="out-stock">Out Stock</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Mouse</td>
                                                <td>435</td>
                                                <td>11</td>
                                                <td>$9,026</td>
                                                <td class="in-stock">In Stock</td>
                                            </tr>
                                            <tr class="last-product">
                                                <td scope="row">Computer</td>
                                                <td>245</td>
                                                <td>0</td>
                                                <td>$2,235</td>
                                                <td class="out-stock">Out Stock</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
            
            
                        <div class="row">
                            <div class="col-md-8">
                                <section class="customer-sec chart">
                                    <div class="column is-12">
                                        <div class="income-main-part">
                                            <h3 class="title-store">
                                                Store Staticts
                                            </h3>
                                            <div class="expense-sec">
                                                <div class="total-income">
                                                    <div class="gray-box"></div>
                                                    <p>Total Income</p>
                                                </div>
                                                <div class="total-expense">
                                                    <div class="blue-box"></div>
                                                    <p>Total Expense</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="salsechart"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-4">
                                <section class="customer-sec chart salse-rc">
                                    <p>Top Selling Categories</p>
                                    <div class="chartcategories">
                                        <div class="sales-part">
                                            <h3>20.5k</h3>
                                            <p>Sales monthly</p>
                                        </div>
                                        <div id="chartcategories"></div>
                                    </div>
                                    <ul class="tsc-legend">
                                        <li class="cgreen">
                                            <h5><i></i>Women dress</h5>
                                        </li>
                                        <li class="cpurple">
                                            <h5><i></i>Men Scarf</h5>
                                        </li>
                                        <li class="cgrey">
                                            <h5><i></i>Other</h5>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
            
    
                    </div>
                    <div class="tab-pane fade" id="pills-sku" role="tabpanel" aria-labelledby="pills-sku-tab">
    
    
                        <div class="row sales">
                            <div class="col-md-4">
                                <div class="total-sales">
                                    <p>Total Products</p>
                                    <h3>250</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="total-sales">
                                    <p>Stock</p>
                                    <h3>3000</h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="total-sales orders">
                                    <p>Sold</p>
                                    <h3>1700</h3>
                                </div>
                            </div>
                        </div>
            
                        <div class="row pb-4">
                         
                            <div class="col-md-12">
                                <div class="customer-sec product">
                                    <p>Product Listing</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">SKU No.</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Sold</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">SKU001</td>
                                                <td>Iphone</td>
                                                <td>245</td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">SKU002</td>
                                                <td>Television</td>
                                                <td>650</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">SKU003</td>
                                                <td>Refrigerator</td>
                                                <td>584</td>
                                                <td>250</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">SKU004</td>
                                                <td>Microwave Oven</td>
                                                <td>134</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">SKU005</td>
                                                <td>Mouse</td>
                                                <td>435</td>
                                                <td>300</td>
                                            </tr>
                                            <tr class="last-product">
                                                <td scope="row">SKU006</td>
                                                <td>Computer</td>
                                                <td>245</td>
                                                <td>350</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <div class="tab-pane fade" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab">
    
                        <div class="row pb-4">
                         
                            <div class="col-md-12">
                                <div class="customer-sec product">
                                    <p>Category</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Electronics</td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Fashion</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Home & Garden</td>
                                                <td>650</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Toy, Games & Hobbies</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Vehicles</td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Furniture</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Mobiles & Tablates</td>
                                                <td>350</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Books & Magazines</td>
                                                <td>650</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Auto Parts</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Bicycles & More</td>
                                                <td>200</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
    
                    </div>
                    <div class="tab-pane fade" id="pills-commission" role="tabpanel" aria-labelledby="pills-commission-tab">
    
                        <div class="row pb-4">
                         
                            <div class="col-md-12">
                                <div class="customer-sec product">
                                    <p>Commission</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Percentage(%)</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Iphone</td>
                                                <td>10%</td>
                                                <td>5000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Television</td>
                                                <td>20%</td>
                                                <td>10,000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Refrigerator</td>
                                                <td>9%</td>
                                                <td>15000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Microwave Oven</td>
                                                <td>5%</td>
                                                <td>5000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Mouse</td>
                                                <td>8%</td>
                                                <td>2000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Computer</td>
                                                <td>6%</td>
                                                <td>2500 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Mobile</td>
                                                <td>25%</td>
                                                <td>10000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
    
    
                    </div>
                    <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
    
    
                        <div class="row pb-4">
                         
                            <div class="col-md-12">
                                <div class="customer-sec product">
                                    <p>Payment Method</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Payment Method</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Iphone</td>
                                                <td>COD, Credit Card, Debit Card</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Television</td>
                                                <td>Credit Card, Debit Card</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Refrigerator</td>
                                                <td>COD, Debit Card</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Microwave Oven</td>
                                                <td>Debit Card</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Mouse</td>
                                                <td>COD</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Computer</td>
                                                <td>COD, Debit Card</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Mobile</td>
                                                <td>Credit Card, Debit Card</td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <div class="tab-pane fade" id="pills-carrier" role="tabpanel" aria-labelledby="pills-carrier-tab">
    
                        <div class="row pb-4">
                         
                            <div class="col-md-12">
                                <div class="customer-sec product">
                                    <p>Carrier</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Company Name</th>
                                                <th scope="col">Logo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Blue Dart</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">DTDC</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Delhivery Courier</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">FedEx</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">DHL</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Ekart Logistics</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Professional</td>
                                                <td><img src="../business-flow/assets/images/img/fedex.png"></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
    
    
    
                    </div>
                    <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
    
                        <div class="row pb-4">
                         
                            <div class="col-md-12">
                                <div class="customer-sec product">
                                    <p>Customer</p>
                                    <div class="bottom-line"></div>
                                    <table class="table product-sales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Number</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Customer Address</th>
                                                <th scope="col">Mobile No.</th>
                                                <th scope="col">Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">OD0001</td>
                                                <td>Gerardo E. Manchester</td>
                                                <td>Ajman</td>
                                                <td>812-788-1048</td>
                                                <td>1300 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">OD0002</td>
                                                <td>Stephen L. Wilford</td>
                                                <td>Khor Fakkan</td>
                                                <td>812-788-1048</td>
                                                <td>1200 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">OD0003</td>
                                                <td>Edwin J. Wilker</td>
                                                <td>Kalba</td>
                                                <td>812-788-1048</td>
                                                <td>800 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">OD0004</td>
                                                <td>Rodger S. Oles</td>
                                                <td>Madinat Zayed</td>
                                                <td>812-788-1048</td>
                                                <td>5000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">OD0005</td>
                                                <td>Terry K. Mix</td>
                                                <td>Jebel Ali</td>
                                                <td>812-788-1048</td>
                                                <td>2000 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">OD0006</td>
                                                <td>Greg N. Monk</td>
                                                <td>Ar-Rams</td>
                                                <td>812-788-1048</td>
                                                <td>3600 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">OD0007</td>
                                                <td>Kasi P. Macdonald</td>
                                                <td>Hatta</td>
                                                <td>812-788-1048</td>
                                                <td>2400 {{env('CURRENCY_TAG')}}</td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    
    
                    </div>
                    <div class="tab-pane fade" id="pills-gmv" role="tabpanel" aria-labelledby="pills-gmv-tab">...</div>
                  </div>

    
        </div>
    </div>

    <div class="try-tejarg-app-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
                </div>
                <div class="col-md-7">
                    <div class="mo-application">
                        <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                        <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img
                                src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection