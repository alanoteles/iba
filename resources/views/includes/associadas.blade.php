<div class="content">
    <div class="container">
        <section class="beh-associadas ">
            <div class="col-md-12">
                <h2 class="subtitle-area">
                    <span class="hidden-xs">{{trans('interface.conheca_nossas')}} </span>{{trans('interface.associadas')}}
                    <a href="" data-route="/associadas" class="btn-mais pull-right">
                        <span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}
                    </a>
                </h2>
            </div>
            <div class="itens">
                @if(count($associadas) > 0)
                <?php  //$associadas = (!empty($associadas) && count($associadas) >= 3) ? $associadas->random(3) : '';  ?>
                @foreach($associadas as $associada)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="" data-route="/associadas" class="item">
                            @if($associada->images['image'] != '')
                                <img src="{{ url('/') .'/uploads/associadas/' . $associada->images['image'] }}">
                            @else
                                <img src="{{ url('/') .'/images/img-associada-default.jpg'}}">
                                <h4>{{$associada->acronym}}</h4>
                            @endif
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </section>
    </div>
</div>