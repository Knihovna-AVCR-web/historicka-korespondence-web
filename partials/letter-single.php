<div class="letter-single">
    <h1 class="h3">
        <?= $letter['name'] ?>
    </h1>
    <div class="my-5">
        <h5>Dates</h5>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 20%;">
                        Letter date
                    </td>
                    <td>
                        <?php
                        echo custom_format_date($letter['date_day'], $letter['date_month'], $letter['date_year']);
                        if ($letter['date_is_range']) {
                            echo ' – ' . custom_format_date($letter['range_day'], $letter['range_month'], $letter['range_year']);
                        }
                        ?>
                        <?php if ($letter['date_uncertain']) : ?>
                            <small class="d-block"><em>Uncertain date</em></small>
                        <?php endif; ?>
                        <?php if ($letter['date_inferred']) : ?>
                            <small class="d-block"><em>Inferred date</em></small>
                        <?php endif; ?>
                        <?php if ($letter['date_approximate']) : ?>
                            <small class="d-block"><em>Approximate date</em></small>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if ($letter['date_marked']) : ?>
                    <td>
                        Date as marked
                    </td>
                    <td>
                        <?= $letter['date_marked']; ?>
                    </td>
                <?php endif; ?>
                <?php if ($letter['date_note']) : ?>
                    <td>
                        Notes on date
                    </td>
                    <td>
                        <?= $letter['date_note']; ?>
                    </td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mb-5">
        <h5>People</h5>
        <table class="table">
            <tbody>
                <?php if (!empty($letter['l_author'])) : ?>
                    <tr>
                        <td style="width: 20%;">Author</td>
                        <td>
                            <ul class="pl-2">
                                <?php foreach ($letter['l_author'] as $authorID => $authorName) : ?>
                                    <?= format_letter_object(get_letter_object_meta($authorID, $authorName, $letter['authors_meta']), 'li'); ?>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($letter['author_uncertain']) : ?>
                                <small class="d-block"><em>Uncertain author</em></small>
                            <?php endif; ?>
                            <?php if ($letter['author_inferred']) : ?>
                                <small class="d-block"><em>Inferred author</em></small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['author_note']) : ?>
                    <td>
                        Notes on author
                    </td>
                    <td>
                        <?= $letter['author_note']; ?>
                    </td>
                <?php endif; ?>
                <?php if (!empty($letter['recipient'])) : ?>
                    <tr>
                        <td style="width: 20%;">Recipient</td>
                        <td>
                            <ul class="pl-2">
                                <?php foreach ($letter['recipient'] as $recipientID => $recipientName) : ?>
                                    <?= format_letter_object(get_letter_object_meta($recipientID, $recipientName, $letter['authors_meta']), 'li'); ?>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($letter['recipient_uncertain']) : ?>
                                <small class="d-block"><em>Uncertain recipient</em></small>
                            <?php endif; ?>
                            <?php if ($letter['recipient_inferred']) : ?>
                                <small class="d-block"><em>Inferred recipient</em></small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['recipient_notes']) : ?>
                    <td>
                        Notes on recipient
                    </td>
                    <td>
                        <?= $letter['recipient_notes']; ?>
                    </td>
                <?php endif; ?>
                <?php if (!empty($letter['people_mentioned'])) : ?>
                    <tr>
                        <td>Mentioned people</td>
                        <td>
                            <ul class="pl-2">
                                <?php foreach ($letter['people_mentioned'] as $person) : ?>
                                    <li class="mb-1">
                                        <?= $person; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['people_mentioned_notes']) : ?>
                    <td>
                        Notes on mentioned people
                    </td>
                    <td>
                        <?= $letter['people_mentioned_notes']; ?>
                    </td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mb-5">
        <h5>Places</h5>
        <table class="table">
            <tbody>
                <?php if (!empty($letter['origin'])) : ?>
                    <tr>
                        <td style="width: 20%;">Origin</td>
                        <td>
                            <ul class="pl-2">
                                <?php foreach ($letter['origin'] as $originID => $originName) : ?>
                                    <?= format_letter_object(get_letter_object_meta($originID, $originName, $letter['places_meta'], 'origin'), 'li'); ?>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($letter['origin_uncertain']) : ?>
                                <small class="d-block"><em>Uncertain origin</em></small>
                            <?php endif; ?>
                            <?php if ($letter['origin_inferred']) : ?>
                                <small class="d-block"><em>Inferred origin</em></small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['origin_note']) : ?>
                    <td>
                        Notes on origin
                    </td>
                    <td>
                        <?= $letter['origin_note']; ?>
                    </td>
                <?php endif; ?>
                <?php if (!empty($letter['dest'])) : ?>
                    <tr>
                        <td style="width: 20%;">Destination</td>
                        <td>
                            <ul class="pl-2">
                                <?php foreach ($letter['dest'] as $destinationID => $destinationName) : ?>
                                    <?= format_letter_object(get_letter_object_meta($destinationID, $destinationName, $letter['places_meta'], 'destination'), 'li'); ?>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($letter['dest_uncertain']) : ?>
                                <small class="d-block"><em>Uncertain destination</em></small>
                            <?php endif; ?>
                            <?php if ($letter['dest_inferred']) : ?>
                                <small class="d-block"><em>Inferred destination</em></small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['dest_note']) : ?>
                    <td>
                        Notes on destination
                    </td>
                    <td>
                        <?= $letter['dest_note']; ?>
                    </td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mb-5">
        <h5>Content</h5>
        <table class="table">
            <tbody>
                <?php if ($letter['abstract']) : ?>
                    <tr>
                        <td style="width: 20%;">Abstract</td>
                        <td><?= $letter['abstract']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['incipit']) : ?>
                    <tr>
                        <td style="width: 20%;">Incipit</td>
                        <td><?= $letter['incipit']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['explicit']) : ?>
                    <tr>
                        <td style="width: 20%;">Explicit</td>
                        <td><?= $letter['explicit']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($letter['languages'])) : ?>
                    <td style="width: 20%;">Languages</td>
                    <td>
                        <ul class="pl-2">
                            <?php foreach (explode(';', $letter['languages']) as $lang) : ?>
                                <li class="mb-1">
                                    <?= $lang; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                <?php endif; ?>
                <?php if (!empty($letter['keywords'])) : ?>
                    <tr>
                        <td>Keywords</td>
                        <td>
                            <?php foreach (array_values($letter['keywords']) as $kw) : ?>
                                <li class="mb-1">
                                    <?= $kw; ?>
                                </li>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['notes_public']) : ?>
                    <tr>
                        <td style="width: 20%;">Notes on letter</td>
                        <td><?= $letter['notes_public']; ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mb-5">
        <h5>Repositories and versions</h5>
        <table class="table">
            <tbody>
                <?php if ($letter['l_number']) : ?>
                    <tr>
                        <td style="width: 20%;">Letter number</td>
                        <td><?= $letter['l_number']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['repository']) : ?>
                    <tr>
                        <td style="width: 20%;">Repository</td>
                        <td><?= $letter['repository']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['archive']) : ?>
                    <tr>
                        <td style="width: 20%;">Archive</td>
                        <td><?= $letter['archive']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['collection']) : ?>
                    <tr>
                        <td style="width: 20%;">Collection</td>
                        <td><?= $letter['collection']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['signature']) : ?>
                    <tr>
                        <td style="width: 20%;">Signature</td>
                        <td><?= $letter['signature']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['location_note']) : ?>
                    <tr>
                        <td style="width: 20%;">Note on location</td>
                        <td><?= $letter['location_note']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['document_type']['type']) : ?>
                    <tr>
                        <td style="width: 20%;">Document type</td>
                        <td><?= $letter['document_type']['type']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['document_type']['preservation']) : ?>
                    <tr>
                        <td style="width: 20%;">Preservation</td>
                        <td><?= $letter['document_type']['preservation']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['document_type']['copy']) : ?>
                    <tr>
                        <td style="width: 20%;">Type of copy</td>
                        <td><?= $letter['document_type']['copy']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($letter['manifestation_notes']) : ?>
                    <tr>
                        <td style="width: 20%;">Notes on nanifestation</td>
                        <td><?= $letter['manifestation_notes']; ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($letter['related_resources'])) : ?>
        <div class="mb-5">
            <h5>Related resources</h5>
            <table class="table">
                <tbody>
                    <tr>
                        <td>
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
        </div>
    <?php endif; ?>
    <?php if (!empty($letter['images'])) : ?>
        <div class="mb-5 d-flex flex-wrap gallery">
            <?php foreach ($letter['images'] as $img) : ?>
                <figure class="figure m-1">
                    <a href="<?= $img['img']['large']; ?>">
                        <img data-src="<?= $img['img']['thumb']; ?>" class="lazy figure-img img-thumbnail" alt="<?= $img['description']; ?>" style="width:150px;max-width:150px">
                    </a>
                    <figcaption class="figure-caption"><?= $img['description']; ?></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
