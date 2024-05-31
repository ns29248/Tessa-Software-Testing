@extends('layouts.master')

@section('content')

    <!-- Start Page Title -->
    <div class="page-title-area">
      <div class="container">
        <div class="page-title-content">
          <h2>{{$product->name}}</h2>
          <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Products Details</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Page Title -->

    <!-- Start Product Details Area -->
    <section class="product-details-area pt-100 pb-70">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-12">
            <div class="products-details-image">
              <ul class="products-details-image-slides">
                <li>
                    <img src="{{ asset('storage/images/'.$product->image->name) }}" alt="image" />
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-7 col-md-12">
            <div class="products-details-desc">
              <h3>{{$product->name}}</h3>

              <div class="price">
                <span class="new-price">{{$product->price}} den</span>
              </div>

              <ul class="products-info">
                <li>
                    <span>Brand:</span> <a href="#">{{$product->brand->name}}</a></li>
                <li>
                  <span>Availability:</span> <a href="#">{{$product->quantity}}</a>
                </li>
                <li><span>Products Type:</span> <a href="#">{{$product->category->name}}</a></li>
              </ul>

              <!--
              <div class="products-color-switch">
                <span>Color:</span>

                <ul>
                  <li><a href="#" title="Black" class="color-black"></a></li>
                  <li><a href="#" title="White" class="color-white"></a></li>
                  <li class="active">
                    <a href="#" title="Green" class="color-green"></a>
                  </li>
                  <li>
                    <a
                      href="#"
                      title="Yellow Green"
                      class="color-yellowgreen"
                    ></a>
                  </li>
                  <li><a href="#" title="Teal" class="color-teal"></a></li>
                </ul>
              </div>
-->

              <div class="products-info-btn">
                <ul class="products-info">
                    <li>
                        <a
                            href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#productsShippingModal"
                        ><i class="bx bxs-truck"></i> Shipping</a
                        >
                    </li>
                    <li>
                        <a href="contact.html"
                        ><i class="bx bx-envelope"></i> Ask about this products</a
                        >
                    </li>
                </ul>

              </div>

              <div class="products-add-to-cart"wire:key="{{$product->id}}" >
                  <livewire:cart.add-to-cart :product_id="$product->id" />


              </div>

              <div class="wishlist-compare-btn">
                <a href="#" class="optional-btn"
                  ><i class="bx bx-heart"></i> Add to Wishlist</a
                >
              </div>

              <div class="buy-checkbox-btn">
                <div class="item">
                  <input class="inp-cbx" id="cbx" type="checkbox" />
                  <label class="cbx" for="cbx">
                  </label>
                </div>

                <div class="item">
                  <a href="#" class="default-btn">Buy it now!</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tab products-details-tab">
          <ul class="tabs">
            <li>
              <a href="#">
                <div class="dot"></div>
                Description
              </a>
            </li>
            <li>
              <a href="#">
                <div class="dot"></div>
                Shipping
              </a>
            </li>

            <li>
              <a href="#">
                <div class="dot"></div>
                Why Buy From Us
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tabs-item">
              <div class="products-details-tab-content">
                <p>
                    {{$product->description}}
                </p>

                <div class="row">

                </div>
              </div>
            </div>

            <div class="tabs-item">
              <div class="products-details-tab-content">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>Shipping</td>
                        <td>This item is shiped all over Macedonia</td>
                      </tr>

                      <tr>
                        <td>Delivery</td>
                        <td>
                          Will usually ship within 2-5 bussiness days.
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="tabs-item">
              <div class="products-details-tab-content">
                <p>Here are 5 more great reasons to buy from us:</p>

                <ol>
                  <li>
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s.
                  </li>
                  <li>
                    Lorem Ipsum has been the industry's standard dummy text ever
                    since the 1500s.
                  </li>
                  <li>
                    When an unknown printer took a galley of type and scrambled
                    it to make a type specimen book.
                  </li>
                  <li>
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry.
                  </li>
                  <li>
                    When an unknown printer took a galley of type and scrambled
                    it to make a type specimen book.
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="products-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Our Shop</span>
                <h2>Related Products</h2>
            </div>

            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="products-box">
                            <div class="products-image">
                                <a href="{{ route('showProduct', $relatedProduct->id) }}">
                                    <img src="{{ asset('storage/images/'.$relatedProduct->image->name) }}" class="main-image" alt="image" width="416" height="496.7">
                                    <img src="{{ asset('storage/images/'.$relatedProduct->image->name) }}" class="hover-image" alt="image" width="416" height="496.7">
                                </a>

                                <div class="products-button">
                                    <ul>
                                        <li>
                                            @livewire('wishlist', ['product_id' => $relatedProduct->id])
                                        </li>

                                        <li>
                                            <div class="quick-view-btn">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                    <i class='bx bx-search-alt'></i>
                                                    <span class="tooltip-label">Quick View</span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="products-content">
                                <span class="category">{{$relatedProduct->category->name}}</span>
                                <h3><a href="{{ route('showProduct', $relatedProduct->id) }}">{{$relatedProduct->brand->name. '   ' .$relatedProduct->name}}</a></h3>
                                <div class="price">
                                    @if(auth()->check() && auth()->user()->role == 2)
                                        <span class="new-price">{{ $relatedProduct->stylist_price }}den</span>
                                    @elseif($relatedProduct->sale()->active()->exists())
                                        <span class="old-price">${{ $relatedProduct->price }}</span>
                                        <span class="new-price">${{ $relatedProduct->sale->sale_price }}</span>
                                    @else
                                        <span class="new-price">{{ $relatedProduct->price }}den</span>
                                    @endif
                                </div>
                                <input type="hidden" value="{{$relatedProduct->id}}" class="prod_id">
                                @livewire('add-to-cart', ['product_id' => $relatedProduct->id])
                            </div>
                            @if($relatedProduct->sale()->active()->exists())
                                <span class="products-discount">
                            <span>
                                Sale!
                            </span>
                        </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- End Product Details Area -->
@endsection
