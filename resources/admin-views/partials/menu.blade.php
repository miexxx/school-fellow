@if(true)
    @if(!isset($item['children']))
        <li>
            @if(url()->isValidUrl($item['uri']))
                <a href="{{ $item['uri'] }}" target="_blank">
            @elseif(!empty($item['uri']))
                <a href="/{{ $item['uri'] }}">
            @else
                <a href="#" target="_blank">
            @endif
                    <i class="fa {{$item['icon']}}"></i>
                    <span>{{$item['title']}}</span>
                </a>
        </li>
    @else
        <li class="treeview">
            <a href="#">
                <i class="fa {{$item['icon']}}"></i>
                <span>{{$item['title']}}</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($item['children'] as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </li>
    @endif
@endif