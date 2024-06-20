
<nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-2 pb-3">
    <div class="container">

        <a class="navbar-brand mt-2" href="/"><img class="" src="{{ asset('img/gv-light.png') }}" alt="" width="100%"
                height="26"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">

            <ul class="navbar-nav mx-auto mt-3 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="fw-bold nav-link {{ $title === 'Home' ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="fw-bold nav-link {{ $title === 'Get Started' ? 'active' : '' }}" href="{{ route('register') }}">Get Started</a>
                </li>
                <li class="nav-item">
                    <a class="fw-bold nav-link {{ $title === 'Support' ? 'active' : '' }}" href="#footer">Support</a>
                </li>
            </ul>

            <a href="{{ route('login') }}" class="btn rounded-pill mt-3 text-dark" role="button" style="background-color: #FFFFFF"><small
                    class="fw-normal px-4">Login</small>
            </a>

        </div>
    </div>
</nav>
