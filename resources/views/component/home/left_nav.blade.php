<div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-heading">项目</div>
        <div class="list-group text-nowrap" style="overflow: hidden">
            <a href="{{ route('home') }}" class="list-group-item @if(request()->path() == 'home') active @endif">个人主页</a>
            <a href="{{ route('home.crosswords') }}" class="list-group-item @if(request()->path() == 'home/crosswords') active @endif">填字游戏</a>
        </div>
    </div>
</div>