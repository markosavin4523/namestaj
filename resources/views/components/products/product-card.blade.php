@props(['p'])
<div class="col-6 col-lg-4 col-xl-3 p-2">
    <a class="product text-black d-flex flex-column" href="{{ route('product.show',[
                            "category"=>$p->category->parent->slug,
                            "subcategory"=>$p->category->slug,
                            "product"=>$p->slug]
                        )}}">
        <div class="product_img position-relative" style="background-image:url('{{asset($p->image_path)}}')">
            <x-products.like-button :p="$p"/>
        </div>
        <span class="product_name fs-5">
            {{ $p->name  }}
        </span>
        <div class="product_dimension">
            <span class="bg-white-color rounded-pill border px-1">
                <i class="bi bi-arrows-vertical"></i>{{ $p->dimension->height  }}
            </span>
            <span class="bg-white-color rounded-pill border px-1 mx-1">
                <i class="bi bi-arrows"></i>{{ $p->dimension->width  }}
            </span>
            <span class="bg-white-color rounded-pill border px-1">
                <i class="bi bi-arrows-vertical rotate45"></i>{{ $p->dimension->depth  }}
            </span>
        </div>
        <span class="product-price mt-1">
            RSD {{ $p->price }}
        </span>
    </a>
</div>
