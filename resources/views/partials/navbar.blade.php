<div class="bottom-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="main-menu">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#gazetteMenu" aria-controls="gazetteMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>
                        <div class="collapse navbar-collapse" id="gazetteMenu">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home') }}">Home</span></a>
                                </li>
                                @foreach ($allowedCategories as $category)
                                    <li class="nav-item {{ Request::is('category/' . Str::slug($category)) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('categories.show', $category) }}">{{ $category }}</a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                            </ul>
                            <!-- Search Form -->
                            <div class="header-search-form mr-auto">
                                <form action="#">
                                    <input type="search" placeholder="Input your keyword then press enter..." id="search" name="search">
                                    <input class="d-none" type="submit" value="submit">
                                </form>
                            </div>
                            <!-- Search btn -->
                            <div id="searchbtn">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
