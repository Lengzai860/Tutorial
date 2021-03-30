@extends('admin.layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Profile Details:{{ Auth::guard('admin')->user()->name }}</h4>
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Name:</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->name }}"disabled>

                                    <label for="">Email:</label>
                                    <input type="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}"disabled>
                                </div>
                                <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
