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
        'studenti' => 'https://studenti.historicka-korespondence.cz',
        'ucenci' => 'https://ucenci.historicka-korespondence.cz',
        'musil' => 'https://musil.historicka-korespondence.cz',
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
        $data = \App\getContent($this->url . '/api/letter/' . $letter . '?media=1');

        if ($data === false) {
            $this->metadata['error'] = __('Dopis nebyl nalezen.', 'hiko');
            return;
        }

        $this->metadata['letter'] = json_decode($data, true)['data'];
        $this->metadata['dbUrl'] = $this->url;
    }

    protected function loadDB()
    {
        $this->selectData();
        $this->metadata['searchUrl'] = $this->url;
    }

    protected function selectData()
    {
        $select = [
            'author' => [
                'type' => 'identity',
            ],
            'recipient' => [
                'type' => 'identity',
            ],
            'origin' => [
                'type' => 'place',
            ],
            'destination' => [
                'type' => 'place',
            ],
            'keyword' => [
                'type' => 'keyword',
            ],
        ];

        $this->metadata['select'] = collect($select)
            ->map(function ($item, $key) {
                return [
                    'label' => ucfirst($key),
                    'type' => $item['type'],
                    'searchUrl' => $this->url . '/api/facets?model=' . $item['type'] . '&query=',
                    'role' => $key,
                ];
            })
            ->toArray();
    }
}
