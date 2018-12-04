<li class="dd-item" data-id="{{ $branch[$keyName] }}">
    <div class="dd-handle">
        {{--{!! $branchCallback($branch) !!}--}}
        <i class="fa {{ $branch['icon'] }}"></i>
        &nbsp;
        <strong>{{ $branch['title'] }}</strong>
        &nbsp;
        &nbsp;
        &nbsp;
        <span class="pull-right dd-nodrag">
            <a href="{{ route($editRoute, [$branch[$keyName]]) }}"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0);" data-id="{{ $branch[$keyName] }}" class="grid-row-delete"><i class="fa fa-trash"></i></a>
        </span>
    </div>
    @if(isset($branch['children']))
        <ol class="dd-list">
            @foreach($branch['children'] as $branch)
                @include($branchView, $branch)
            @endforeach
        </ol>
    @endif
</li>