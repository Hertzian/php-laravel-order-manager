<div class="card-body">
    @if (count($errors) >0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger mt-2">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if (session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif

    {{-- @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif --}}
</div>