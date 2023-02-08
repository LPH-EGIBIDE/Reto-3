<div class="row">
    <div class="errors mb-3 col-12">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>¡Error!</strong> {{ $error }}
                </div>
            @endforeach
        @endif
        @if (session('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>¡Éxito!</strong> {{ session('message') }}
            </div>
        @endif
    </div>
</div>
