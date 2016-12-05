<div class="beh-associadaslist pull-left ">
    <div class="col-md-12 "><h1 class="title-page">{{ucfirst(trans('interface.associadas'))}}</h1></div>
    <div class="itens">
        @foreach($associadas as $associada)
            <div class="col-md-4 col-sm-4">
                <div class="item">
                    <a href="" data-route="/associadas-detalhe/{{ $associada->id }}">
                        <figure>
                            @if($associada->images['image'] != '')
                                <img src="{{ url('/') .'/uploads/associadas/' . $associada->images['image'] }}">
                            @else
                                <img src="{{ url('/') .'/images/img-associada-default.jpg'}}">
                            @endif
                        </figure>
                        <h3 class="associadas"><strong>{{ $associada->acronym }}</strong>{{ str_limit($associada->name,85,'...')}}</h3>
                        <p class="description">{{ $associada->summary }}</p>
                    </a>
                    <div class="links">
                        <a href="http://{{ $associada->url }}" class="btn-site pull-left" target="_blank">{{trans('interface.visite_o_site')}}</a>
                        <a href="" data-route="/associadas-detalhe/{{ $associada->id }}" class="btn-mais pull-right"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>