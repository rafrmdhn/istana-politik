<style>
    :root{
        --logo-size: 45px;
        --light-gray: #cfcfcf;
        --container-w: 1200px;
    }

    .logo{
        font-family: "Playfair Display", serif;
        font-size: var(--logo-size);
        letter-spacing: .05em;
        text-transform: uppercase;
        color:#111;
        line-height:1;
        white-space: nowrap;
    }
    .logo a{ text-decoration:none; color:inherit; }
    .logo .the{ color:#ff0303; font-weight:700; margin-right:.15em; }
    .logo .name{ font-weight:900; color:#000; }

    .header-advert-area{
        display: flex;
        justify-content: flex-end;
        align-items: center;
        min-height: 90px;
        overflow: hidden;
    }

    .header-advert-area img{
        display: block;
        max-width: 100%;
        height: auto;
        object-fit: contain;
    }

    .header-advert-area iframe{
        display: block;
        max-width: 100%;
        width: 100%;
        height: 90px;
        border: 0;
    }

    @media (max-width: 1200px){
        :root{ --logo-size: 38px; }
    }

    @media (max-width: 992px){
        :root{ --logo-size: 28px; }
        .header-advert-area{
            justify-content: center;
            min-height: 60px;
            margin-top: 8px;
        }
        .header-advert-area iframe{ height: 60px; }
    }
    @media (max-width: 768px){
        :root{ --logo-size: 64px; }

    }
    @media (max-width: 576px){
        :root{ --logo-size: 34px; }
    }
</style>
<div class="middle-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <!-- Logo Area -->
            <div class="col-12 col-md-4">
                <div class="logo logo-area">
                    <a href="{{ route('home') }}">
                        <span class="the">ISTANA</span><span class="name">POLITIK</span>
                    </a>
                </div>
            </div>
            <!-- Header Advert Area -->
            <div class="col-12 col-md-8">
                <div class="header-advert-area">
                    <a href="#"><img src="{{ asset('img/top-advert.png') }}" alt="header-add"></a>
                </div>
            </div>
        </div>
    </div>
</div>
