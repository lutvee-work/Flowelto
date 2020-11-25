@yield('test')
<div class="col-md-8">
    <img src="images/{{$p->image}}" width="400" height="400" alt="">
    <a href="{{url('/'.$p->id.'/product')}}">{{$p->name}}</a>
</div>