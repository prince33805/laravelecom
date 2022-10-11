<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($product as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details', $product->id) }}" class="option1">
                                    View Product
                                </a>
                                <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1"><br>
                                    <input type="submit" class="option2" value="Add to Cart">
                                </form>

                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->name }}
                            </h5>
                            <div class="row" style="margin-right:0rem">
                                <h6 style="text-decoration:line-through;">
                                    ${{ $product->product_price }}
                                </h6>
                                <h6 style="color: red">
                                    ${{ $product->discount_price }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-box">
            <a href={{url('products')}}>
                View All products
            </a>
        </div>
    </div>
</section>
