@extends('template.main')
@section('title', 'Shoping Cart')
@section('content')
@php
    $msg = Session::get('error');
@endphp
<div class="row justify-content-center">
    <div class="col-xl-5">
        <div class="card o-hidden border-0 shadow-lg my-5 ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><strong>Login <span style="color: orange">Shoping Cart</span></strong></h1>
                            </div>
                            <div style="padding: 20px">
                                <form class="user" action="{{ route('auth-login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control"
                                            id="email" name="email" placeholder="xyz@mail.com">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control"
                                            id="password" name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" id="login" class="btn btn-secondary btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let err = "{{ $msg }}";
        // console.log(err);
        const toastMixin = Swal.mixin({
            toast: true,
            icon: "success",
            title: "General Title",
            animation: false,
            position: "top-right",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        
        if (err) {
            toastMixin.fire({
                icon: "warning",
                title: err,
            });
        }
    </script>
@endsection