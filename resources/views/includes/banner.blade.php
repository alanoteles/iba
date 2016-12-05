<div class="content">
    <div class="container">
        <section class="beh-banner col-md-12">
            @if(isset($banners))
                <figure><a href=""><img src="/uploads/banners/{{  ($banners[0]->position == 'h1') ? $banners[0]->banner->image : $banners[1]->banner->image  }}"></a></figure>
            @endif
        </section>
    </div>
</div>