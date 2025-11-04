<footer class="footer-area bg-img background-overlay pt-5" style="background-image: url('{{ asset('img/istana-negara.jpeg') }}');">
    <div class="container pb-5">
        <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="mb-4 text-uppercase font-weight-bold text-white">Contact Us</h5>
                <p class="mb-2"><i class="fa fa-map mr-2"></i>
                    Residence One BSD, Jl. Raya Serpong Kilometer 7, Jelupang, Kec. Serpong Utara,<br>
                    Kota Tangerang Selatan, Banten 15310
                </p>
                <p class="mb-2"><i class="fa fa-phone mr-2"></i> +62 851 7512 3014 (Jaya)</p>
                <p class="mb-4"><i class="fa fa-envelope mr-2"></i> partnership@fypmedia.id</p>

                <h6 class="text-uppercase font-weight-bold mb-3 text-white">Ikuti Kami</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-secondary btn-sm rounded-circle mr-2" href="https://www.tiktok.com/@fypmedia.id" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a class="btn btn-secondary btn-sm rounded-circle mr-2" href="https://www.instagram.com/fypmedia.id" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="btn btn-secondary btn-sm rounded-circle mr-2" href="https://www.linkedin.com/company/fypgroup/" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="btn btn-secondary btn-sm rounded-circle" href="https://www.youtube.com/@fypmediaid" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="mb-4 text-uppercase font-weight-bold text-white">Category</h5>
                <div class="d-flex flex-wrap">
                    @foreach($categories ?? [] as $category)
                        <a href="{{ route('categories.show', $category) }}"
                           class="text-capitalize btn btn-sm btn-outline-light m-1">
                           {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Berita Populer --}}
            <div class="col-lg-4 col-md-12 mb-4">
                <h5 class="mb-4 text-uppercase font-weight-bold text-white">Popular</h5>
                @foreach($popular ?? [] as $item)
                    <div class="mb-3">
                        <div class="small mb-1">
                            <a class="text-danger font-weight-bold" href="{{ route('categories.show', $item->category->slug) }}">
                                {{ $item->category->name }}
                            </a>
                            <span class="text-muted ml-2">
                                {{ \Carbon\Carbon::parse($item->tanggal_posting)->format('d M Y') }}
                            </span>
                        </div>
                        <a href="{{ route('articles.show', $item->slug) }}" class="text-light">
                            {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="container-fluid text-center py-3" style="background: #111;">
        <p class="m-0">
            &copy; <script>document.write(new Date().getFullYear());</script>
            <strong>Istana Politik</strong>. All Rights Reserved.
            | Develop by <a href="https://fypmedia.id" class="text-danger" target="_blank">FYP Media</a>
        </p>
    </div>
</footer>
