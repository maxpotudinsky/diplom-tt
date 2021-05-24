@foreach($breadcrumbs as $breadcrumb )
    @if($breadcrumb['url'] != null)
        <li class="breadcrumb-item "><a href="{{$breadcrumb['url']}}">{{$breadcrumb['name']}}</a></li>
    @else
        <li class="breadcrumb-item ">{{$breadcrumb['name']}}</li>
    @endif

@endforeach
