</main>
<footer class="py-12 mt-auto  bg-brown">
    <div class="container flex flex-wrap justify-between px-5 mx-auto">
        <p class="my-1 mr-5 text-sm text-white">
            &copy; <?= date('Y') ?> – <a href="https://www.mua.cas.cz/">Masarykův ústav a Archiv AV ČR, v.&nbsp;v.&nbsp;i.</a>, <a href="https://www.flu.cas.cz/">Filosofický ústav AV ČR, v.&nbsp;v.&nbsp;i.</a>, <a href="https://www.lib.cas.cz/">Knihovna AV ČR, v.&nbsp;v.&nbsp;i.</a>
        </p>
        <p class="my-1 text-sm text-white">
            <?= get_encoded_mailto_link('') ?>
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
