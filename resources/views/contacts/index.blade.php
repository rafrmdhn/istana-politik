@extends('layouts.main')

@section('container')
    <!-- Breadcumb Area Start -->
    <div class="breadcumb-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breacumb-content d-flex align-items-center justify-content-between">
                        <h3 class="font-pt mb-0">Contact</h3>
                        <p class="editorial-post-date text-dark mb-0">28 November 2017</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area End -->

    <section class="gazette-contact-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="gazette-heading">
                        <h4 class="font-bold">address</h4>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!-- Contact Form -->
                    <form action="{{ route('contact.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="contact-name" placeholder="Enter Your Full Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class="help-block text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="contact-email" placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <p class="help-block text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="telp" class="form-control" id="contact-telp" placeholder="No. Telp" value="{{ old('telp') }}" required>
                                    @error('telp')
                                        <p class="help-block text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" id="contact-subject" placeholder="Subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <p class="help-block text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="help-block text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn contact-btn">SUBMIT <i class="fas fa-angle-right ml-2"></i></button>
                    </form>
                </div>
                <div class="col-12 col-md-4">
                    <div class="gazette-heading">
                        <h4 class="font-bold">address</h4>
                    </div>
                    <div class="contact-address-info mb-50">
                        <p>Residence One BSD, Jl. Raya Serpong Kilometer 7, Jelupang, Kec. Serpong Utara, Kota Tangerang Selatan, Banten 15310 <br> Phone: +62 851 7512 3014 (Jaya) <br> Email: partnership@fypmedia.id</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
