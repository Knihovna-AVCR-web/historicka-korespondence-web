<?php

namespace App;

function assets()
{
    $assets = json_decode(
        file_get_contents(get_template_directory() . '/public/mix-manifest.json'),
        true
    );

    return collect($assets)
        ->map(function ($asset) {
            return get_template_directory_uri() . '/public' . $asset;
        })
        ->toArray();
}

function imageUrl($fileName)
{
    return get_template_directory_uri() . '/public/images/' . $fileName;
}

function nonbreakingSpaces($content)
{
    $content = str_replace(
        [
            ' k ', ' K ',
            ' o ', ' O ',
            ' s ', ' S ',
            ' u ', ' U ',
            ' v ', ' V ',
            ' z ', ' Z ',
            ' 7 ',
        ],
        [
            ' k&nbsp;', ' K&nbsp;',
            ' o&nbsp;', ' O&nbsp;',
            ' s&nbsp;', ' S&nbsp;',
            ' u&nbsp;', ' U&nbsp;',
            ' v&nbsp;', ' V&nbsp;',
            ' z&nbsp;', ' Z&nbsp;',
            ' 7&nbsp;',
        ],
        $content
    );

    return $content;
}

function stringToASCII($string)
{
    $output = '';
    $length = strlen($string);

    for ($i = 0; $i < $length; $i++) {
        $output .= '&#' . ord($string[$i]) . ';';
    }

    return $output;
}

function mailtoLink($email, $classes)
{
    $email = stringToASCII($email);
    $mailto = stringToASCII('mailto:') . $email;

    ob_start(); ?>
    <a href="<?= $mailto; ?>" class="<?= $classes; ?>">
        <?= $email; ?>
    </a>
    <?php return ob_get_clean();
}
