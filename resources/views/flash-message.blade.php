@if (request()->session()->exists('success'))
    <div class="d-flex align-items-center gap-2 alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check"></i>
        {{ request()->session()->pull('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (request()->session()->exists('message'))
    <div class="d-flex align-items-center gap-2 alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ request()->session()->pull('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (request()->session()->exists('update'))
    <div class="d-flex align-items-center gap-2 alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check"></i>
        {{ request()->session()->pull('update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (request()->session()->exists('moved'))
    <div class="d-flex align-items-center gap-2 alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i>
        {{ request()->session()->pull('moved')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif