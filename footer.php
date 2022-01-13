</main>
<footer class="py-12 mt-auto bg-brown">
    <div class="container flex flex-wrap justify-between px-5 mx-auto">
        <p class="my-1 mr-5 text-sm text-white">
            &copy; <?= date('Y') ?> – <a href="https://www.mua.cas.cz/" class="hover:underline">Masarykův ústav a Archiv AV ČR, v.&nbsp;v.&nbsp;i.</a>, <a href="https://www.flu.cas.cz/" class="hover:underline">Filosofický ústav AV ČR, v.&nbsp;v.&nbsp;i.</a>, <a href="https://www.lib.cas.cz/" class="hover:underline">Knihovna AV ČR, v.&nbsp;v.&nbsp;i.</a>
        </p>
        <div class="text-sm text-white">
            <p class="my-1">
                <?= get_encoded_mailto_link('hover:underline') ?>
            </p>
            <p>
                <?= do_shortcode('[cookies-button text="Cookies"]') ?>
            </p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
