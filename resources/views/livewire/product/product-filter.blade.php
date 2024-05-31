
<div class="col-lg-4 col-md-12">
    <div class="woocommerce-widget-area">
        <div class="woocommerce-widget collections-list-widget">
            <h3 class="woocommerce-widget-title">{{__('messages.Categories')}}</h3>

            <ul class="collections-list-row">
                @foreach($categories as $category)
                    <li class="{{ $selectedCategory == $category->id ? 'active' : '' }}">
                        <a href="#" wire:click.prevent="selectCategory({{ $category->id }})"><span></span> {{ $category->name }}</a>

                    </li>
                @endforeach
            </ul>
        </div>

        <div class="woocommerce-widget brands-list-widget">
            <h3 class="woocommerce-widget-title">{{__('messages.Brands')}}</h3>

            <ul class="brands-list-row">
                @foreach($brands as $brand)
                    <li class="{{ $selectedBrand == $brand->id ? 'active' : '' }}">
                        <a href="#" wire:click.prevent="selectBrand({{ $brand->id }})"
                        ><span></span> {{ $brand->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="woocommerce-widget aside-trending-widget">
            <div class="aside-trending-products">
                <img src="assets/img/offer-bg.jpg" alt="image" />

                <div class="category">
                    <h3>Courses here</h3>
                    <span>Spring/Summer 2021 Collection</span>
                </div>
                <a href="#" class="link-btn"></a>
            </div>
        </div>
    </div>
</div>
