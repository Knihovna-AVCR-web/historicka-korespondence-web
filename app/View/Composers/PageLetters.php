<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PageLetters extends Composer
{
    protected $url;
    protected $metadata = [];
    protected $databases = [
        'blekastad' => 'https://blekastad.historicka-korespondence.cz',
        'tgm' => 'https://tgm.historicka-korespondence.cz',
        'sachs' => 'https://sachs.historicka-korespondence.cz',
        'polanus' => 'https://polanus.historicka-korespondence.cz',
    ];

    public function __construct()
    {
        $database = carbon_get_post_meta(get_the_ID(), 'db');

        if (!isset($this->databases[$database])) {
            echo view('404')->render();
            exit();
        }

        $this->url = $this->databases[$database];

        if (isset($_GET['letter'])) {
            $this->loadLetter($_GET['letter']);
        } else {
            $this->loadDB();
        }
    }

    public function with()
    {
        return $this->metadata;
    }

    protected function loadLetter($letter)
    {
        $url = @file_get_contents($this->url . '/api/letter/' . $letter . '?media=1');

        if ($url === false) {
            $this->metadata['error'] = __('Dopis nebyl nalezen.', 'hiko');
            return;
        }

        $this->metadata['letter'] = json_decode($url, true)['data'];

    }

    protected function loadDB()
    {

    }
}
