<footer class="footer bgf">
    <div class="container">
        <nav class="pull-left">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ isset($prefix) ? route('admin'):route('home') }}">
                        {{__('Home')}}
                    </a>
                </li>
            </ul>
        </nav>
        <div class="social-area pull-right">
            <a class="btn btn-social btn-facebook btn-simple">
                <i class="fab fa-facebook-square"></i>
            </a>
        </div>
        <div class="copyright">
            @ Make 2019
        </div>
    </div>
</footer>
