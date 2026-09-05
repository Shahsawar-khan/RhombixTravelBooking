<footer class="travel-footer">

    <div class="footer-container">


        <!-- Brand -->
        <div class="footer-brand">

            <a href="{{ route('home') }}" class="footer-logo">

                <span class="footer-logo-mark">
                    ✈
                </span>

                <span>
                    Travel<span>Ease</span>
                </span>

            </a>

            <p>
                Discover amazing destinations, explore unforgettable
                experiences, and make every journey memorable.
            </p>

            <div class="footer-socials">

                <a href="#" aria-label="Facebook">
                    f
                </a>

                <a href="#" aria-label="Instagram">
                    ◎
                </a>

                <a href="#" aria-label="Twitter">
                    𝕏
                </a>

            </div>

        </div>


        <!-- Explore -->
        <div class="footer-column">

            <h4>Explore</h4>

            <a href="{{ route('home') }}">
                Home
            </a>

            <a href="{{ route('destinations.index') }}">
                Destinations
            </a>

            <a href="#packages">
                Travel Packages
            </a>

            <a href="#">
                Popular Tours
            </a>

        </div>


        <!-- Support -->
        <div class="footer-column">

            <h4>Support</h4>

            <a href="#">
                Help Center
            </a>

            <a href="#">
                Contact Us
            </a>

            <a href="#">
                FAQs
            </a>

            <a href="#">
                Terms & Conditions
            </a>

        </div>


        <!-- Account -->
        <div class="footer-column">

            <h4>Account</h4>

            @auth

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a href="{{ route('profile.edit') }}">
                    My Profile
                </a>

            @else

                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}">
                    Create Account
                </a>

            @endauth

        </div>


    </div>


    <!-- Footer Bottom -->
    <div class="footer-bottom">

        <div class="footer-bottom-container">

            <p>
                © {{ date('Y') }} TravelEase. All rights reserved.
            </p>

            <div class="footer-bottom-links">

                <a href="#">
                    Privacy Policy
                </a>

                <a href="#">
                    Terms
                </a>

            </div>

        </div>

    </div>

</footer>