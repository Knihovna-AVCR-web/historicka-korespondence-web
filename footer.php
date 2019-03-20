<div class="row mt-5 py-5 bg-dark-500 footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto" style="max-width:100%">
                <small>Copyright © <?= date('Y') ?> – <a href="https://www.mua.cas.cz/" class="text-white">Masarykův ústav a Archiv AV ČR, v. v. i.</a>, <a href="https://www.flu.cas.cz/" class="text-white">Filosofický ústav AV ČR, v. v. i.</a>, <a href="https://www.lib.cas.cz/" class="text-white">Knihovna AV ČR, v. v. i.</a></small>
            </div>
            <div class="col-auto" style="max-width:100%">
                <small>
                    <?= get_encoded_mailto_link('text-white') ?>
                </small>
            </div>
        </div>
    </div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
