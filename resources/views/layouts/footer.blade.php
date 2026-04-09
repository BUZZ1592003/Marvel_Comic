<footer class="site-footer">
    <div class="container footer-grid">
        <section>
            <h3>Marvel Vault</h3>
            <p>A fandom-first platform for collectors, readers, and continuity nerds. Curated with craft, not algorithm noise.</p>
        </section>

        <section>
            <h4>Community</h4>
            <a href="{{ route('characters.index') }}">Character Atlas</a>
            <a href="{{ route('series.index') }}">Universe Threads</a>
            <a href="{{ route('comics.index') }}">New This Week</a>
        </section>

        <section>
            <h4>Collector Feed</h4>
            <p>Get weekly notes on key issues, first appearances, and event tie-ins.</p>
            <form class="footer-newsletter" action="#" method="post">
                <input type="email" placeholder="you@comicverse.com" aria-label="Email">
                <button type="submit">Subscribe</button>
            </form>
        </section>

        <section>
            <h4>Follow</h4>
            <div class="social-row">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="Discord"><i class="fab fa-discord"></i></a>
            </div>
            <small>&copy; {{ now()->year }} Marvel Vault. Crafted for readers.</small>
        </section>
    </div>
</footer>
