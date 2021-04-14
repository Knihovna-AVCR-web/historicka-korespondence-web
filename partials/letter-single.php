<h1 class="mb-6 text-3xl">
    <?= $letter['name'] ?>
</h1>

<h2 class="text-lg font-bold">Dates</h2>
<table class="w-full mb-10 text-sm">
    <tbody>
        <tr class="align-baseline border-t border-b border-gray-200">
            <td class="w-1/5 py-2">
                Letter date
            </td>
            <td class="py-2">
                <?php
                echo custom_format_date($letter['date_day'], $letter['date_month'], $letter['date_year']);
                if ($letter['date_is_range']) {
                    echo ' – ' . custom_format_date($letter['range_day'], $letter['range_month'], $letter['range_year']);
                }
                ?>
                <?php if ($letter['date_uncertain']) : ?>
                    <small class="block pl-3"><em>Uncertain date</em></small>
                <?php endif; ?>
                <?php if ($letter['date_inferred']) : ?>
                    <small class="block pl-3"><em>Inferred date</em></small>
                <?php endif; ?>
                <?php if ($letter['date_approximate']) : ?>
                    <small class="block pl-3"><em>Approximate date</em></small>
                <?php endif; ?>
            </td>
        </tr>
        <?php if ($letter['date_marked']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Date as marked
                </td>
                <td class="py-2">
                    <?= $letter['date_marked']; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['date_note']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Notes on date
                </td>
                <td class="py-2">
                    <?= $letter['date_note']; ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2 class="text-lg font-bold">People</h2>
<table class="w-full mb-10 text-sm">
    <tbody>
        <?php if (!empty($letter['l_author'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Author</td>
                <td class="py-2">
                    <ul class="list-disc list-inside">
                        <?php foreach ($letter['l_author'] as $author) : ?>
                            <?= format_letter_object($author, 'li'); ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($letter['author_uncertain']) : ?>
                        <small class="block pl-3"><em>Uncertain author</em></small>
                    <?php endif; ?>
                    <?php if ($letter['author_inferred']) : ?>
                        <small class="block pl-3"><em>Inferred author</em></small>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['author_note']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Notes on author
                </td>
                <td class="py-2">
                    <?= $letter['author_note']; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($letter['recipient'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Recipient</td>
                <td class="py-2">
                    <ul class="list-disc list-inside">
                        <?php foreach ($letter['recipient'] as $recipient) : ?>
                            <?= format_letter_object($recipient, 'li'); ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($letter['recipient_uncertain']) : ?>
                        <small class="block pl-3"><em>Uncertain recipient</em></small>
                    <?php endif; ?>
                    <?php if ($letter['recipient_inferred']) : ?>
                        <small class="block pl-3"><em>Inferred recipient</em></small>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['recipient_notes']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Notes on recipient
                </td>
                <td class="py-2">
                    <?= $letter['recipient_notes']; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($letter['people_mentioned'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">Mentioned people</td>
                <td class="py-2">
                    <ul class="list-disc list-inside">
                        <?php foreach ($letter['people_mentioned'] as $person) : ?>
                            <li class="mb-1">
                                <?= $person['name']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['people_mentioned_notes']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Notes on mentioned people
                </td>
                <td class="py-2">
                    <?= $letter['people_mentioned_notes']; ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2 class="text-lg font-bold">Places</h2>
<table class="w-full mb-10 text-sm">
    <tbody>
        <?php if (!empty($letter['origin'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Origin</td>
                <td class="py-2">
                    <ul class="list-disc list-inside">
                        <?php foreach ($letter['origin'] as $origin) : ?>
                            <?= format_letter_object($origin, 'li'); ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($letter['origin_uncertain']) : ?>
                        <small class="block pl-3"><em>Uncertain origin</em></small>
                    <?php endif; ?>
                    <?php if ($letter['origin_inferred']) : ?>
                        <small class="block pl-3"><em>Inferred origin</em></small>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['origin_note']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Notes on origin
                </td>
                <td class="py-2">
                    <?= $letter['origin_note']; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($letter['dest'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Destination</td>
                <td class="py-2">
                    <ul class="list-disc list-inside">
                        <?php foreach ($letter['dest'] as $destination) : ?>
                            <?= format_letter_object($destination, 'li'); ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($letter['dest_uncertain']) : ?>
                        <small class="block pl-3"><em>Uncertain destination</em></small>
                    <?php endif; ?>
                    <?php if ($letter['dest_inferred']) : ?>
                        <small class="block pl-3"><em>Inferred destination</em></small>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['dest_note']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    Notes on destination
                </td>
                <td class="py-2">
                    <?= $letter['dest_note']; ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2 class="text-lg font-bold">Content</h2>
<table class="w-full mb-10 text-sm">
    <tbody>
        <?php if ($letter['abstract']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Abstract</td>
                <td class="py-2"><?= $letter['abstract']; ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['incipit']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Incipit</td>
                <td class="py-2"><?= $letter['incipit']; ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['explicit']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Explicit</td>
                <td class="py-2"><?= $letter['explicit']; ?></td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($letter['languages'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Languages</td>
                <td class="py-2">
                    <ul class="list-disc list-inside">
                        <?php foreach ($letter['languages'] as $lang) : ?>
                            <li class="mb-1">
                                <?= $lang; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($letter['keywords'])) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">Keywords</td>
                <td class="py-2">
                    <?php foreach (array_values($letter['keywords']) as $kw) : ?>
                        <li class="mb-1">
                            <?= $kw['name']; ?>
                        </li>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php if ($letter['notes_public']) : ?>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="w-1/5 py-2">Notes on letter</td>
                <td class="py-2"><?= $letter['notes_public']; ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2 class="text-lg font-bold">Repositories and versions</h2>
<?php foreach ($letter['copies'] as $c) : ?>
    <table class="w-full mb-10 text-sm">
        <tbody>
            <?php if ($c['l_number']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Letter number</td>
                    <td class="py-2"><?= $c['l_number']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['repository']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Repository</td>
                    <td class="py-2"><?= $c['repository']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['archive']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Archive</td>
                    <td class="py-2"><?= $c['archive']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['collection']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Collection</td>
                    <td class="py-2"><?= $c['collection']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['signature']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Signature</td>
                    <td class="py-2"><?= $c['signature']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['location_note']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Note on location</td>
                    <td class="py-2"><?= $c['location_note']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['type']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Document type</td>
                    <td class="py-2"><?= $c['type']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['preservation']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Preservation</td>
                    <td class="py-2"><?= $c['preservation']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['copy']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Type of copy</td>
                    <td class="py-2"><?= $c['copy']; ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($c['manifestation_notes']) : ?>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">Notes on nanifestation</td>
                    <td class="py-2"><?= $c['manifestation_notes']; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php endforeach; ?>

<?php if (!empty($letter['related_resources'])) : ?>
    <h2 class="text-lg font-bold">Related resources</h2>
    <table class="w-full mb-10 text-sm">
        <tbody>
            <tr class="align-baseline border-t border-b border-gray-200">
                <td class="py-2">
                    <?php foreach ($letter['related_resources'] as $resource) : ?>
                        <li class="mb-1">
                            <?php if (!empty($resource['link'])) : ?>
                                <a href="<?= $resource['link']; ?>" target="_blank">
                                    <?= $resource['title']; ?>
                                </a>
                            <?php else : ?>
                                <?= $resource['title']; ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<div class="flex flex-wrap mb-6 -m-x-1 gallery">
    <?php foreach ($letter['images'] as $img) : ?>
        <a href="<?= $img['img']['large']; ?>" data-caption="<?= $img['description']; ?>">
            <img data-src="<?= $img['img']['thumb']; ?>" class="w-32 h-auto m-1 lazy shadow" alt="<?= $img['description']; ?>">
        </a>
    <?php endforeach; ?>
</div>
