@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show">
        {{session('warning')}}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-info text-muted alert-dismissible fade show">
        {{session('success')}}
    </div>
@endif
