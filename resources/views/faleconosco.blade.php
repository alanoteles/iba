@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render() !!}
@endsection


@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-left">

                @if(isset($enviado))

                    @include('includes.faleconosco_enviado')

                @else

                    @include('includes.faleconosco_formulario')

                @endif

            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">
                @include('includes.faleconosco_endereco')
            </aside>
        </div>
    </div>

    <div class="content">
        <section class="beh-googlemaps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3839.211263996421!2d-47.885483667280454!3d-15.792810502568123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x935a3ae1fec97839%3A0xf9039e82ee228f2d!2sInstituto+Brasileiro+do+Algod%C3%A3o!5e0!3m2!1spt-BR!2sbr!4v1458825303936" frameborder="0" style="border:0" allowfullscreen></iframe>
        </section>

    </div>
@endsection


@section('banner')

    @include('includes.banner')

@endsection


@section('associadas')

    @include('includes.associadas')

@endsection