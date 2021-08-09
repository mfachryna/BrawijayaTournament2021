<!--    navbar-->
<div class="container-fluid utama">
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light utam">
            <a href="{{route('beranda')}}" class="navbar-brand utam">
                <img src="{{url('/frontend/homepage/images/Asset%202@4x%20(1).png')}}" height="100px" alt="logo-bt">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navb">
                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav mr-auto ml-2">
                    <li class="nav-item mx-md-2"><a href="{{route('beranda')}}"
                            class="nav-link {{Route::currentRouteName() == 'beranda' ? 'active': ''}}">BERANDA</a></li>
                    <li class="nav-item mx-md-2"><a href="{{route('berita')}}"
                            class="nav-link {{Route::currentRouteName() == 'berita' ? 'active': ''}}">BERITA</a></li>
                    <!-- li class="nav-item mx-md-2"><a href="{{route('jadwal')}}"
                            class="nav-link {{Route::currentRouteName() == 'jadwal' ? 'active': ''}}">JADWAL</a></li-->
                    <!-- li class="nav-item mx-md-2"><a href="{{route('klasemen')}}"
                            class="nav-link {{Route::currentRouteName() == 'klasemen' ? 'active': ''}}">KLASEMEN</a>
                    </li -->

                    <li class="nav-item mx-md-2"><a href="{{route('galeri')}}"
                            class="nav-link {{Route::currentRouteName() == 'galeri' ? 'active': ''}}">GALERI</a></li>
                    <li class="nav-item mx-md-2"><a href="{{route('about')}}"
                            class="nav-link {{Route::currentRouteName() == 'about' ? 'active': ''}}">TENTANG KAMI</a>
                    </li>
                    <li class="nav-item mx-md-2"><a
                            href="https://drive.google.com/drive/folders/1TAvBt8lFnFxlPsIwRKz5LqnDFPCK2uda"
                            class="nav-link">BUKU PEDOMAN</a>
                    </li>
                    @if (Route::has('login'))

                    @auth
                    <li class="nav-item mx-md-2"><a href="{{ url('/dashboard') }}" class="nav-link">DASHBOARD</a></li>
                    @else
                    <li class="nav-item mx-md-2"><a href="{{route('login')}}" class="nav-link">MASUK</a></li>

                    @if (Route::has('register'))
                    <li class="nav-item mx-md-2"><a href="{{route('register')}}" class="nav-link">DAFTAR</a></li>
                    @endif
                    @endauth

                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
