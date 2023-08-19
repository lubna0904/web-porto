@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($error->all() as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif