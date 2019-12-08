<?php

/*
Template Name: Letter detail
*/

$question_icon =  get_template_directory_uri() . '/assets/icons/question-mark.svg';

get_header();

the_post();

?>


<h1 class="my-5 mx-3">
    Soupis korespondence
</h1>

<div class="row main-content mb-5" id="letter-preview">

    <div class="col-md-3">
        <a :href="globals.home" class="text-primary h3 d-block mb-3">Back to search</a>
    </div>

    <div class="col-md-9">
        <div class="loading mb-5" v-if="loading && !error">
            Loading...
        </div>

        <div v-if="error" class="error alert alert-warning mb-5">
            <span>{{ globals.error }}</span>
        </div>

        <div class="letter-single" v-if="!loading && !error">
            <h3>{{ title }}</h3>
            <div class="my-5">
                <h5>Dates</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">
                                Letter date
                            </td>
                            <td>
                                <span>
                                    {{ day ? day : '?' }}. {{ month ? month : '?'}}. {{ year ? year : '????' }}
                                </span>
                                <span v-if="date_is_range">
                                    – {{ day2 ? day2 : '?' }}. {{ month2 ? month2 : '?'}}. {{ year2 ? year2 : '????' }}
                                </span>

                                <span v-if="date_uncertain" class="d-block">
                                    <small><em>Uncertain date</em></small>
                                </span>

                                <span v-if="date_inferred" class="d-block">
                                    <small><em>Inferred date</em></small>
                                </span>

                                <span v-if="date_approximate" class="d-block">
                                    <small><em>Approximate date</em></small>
                                </span>
                            </td>
                        </tr>
                        <tr v-if="date_marked">
                            <td>
                                Date as marked
                            </td>
                            <td>
                                {{ date_marked }}
                            </td>
                        </tr>
                        <tr v-if="date_note">
                            <td>
                                Notes on date
                            </td>
                            <td>
                                {{ date_note }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-5">
                <h5>People</h5>
                <table class="table">
                    <tbody>
                        <tr v-if="author.length > 0">
                            <td style="width: 20%;">Author</td>
                            <td>
                                <span v-for="a in author" class="d-block">
                                    <span v-if="a.marked.length > 0">
                                        {{ a.marked }}
                                        <span v-if="a.marked != a.title" class="badge badge-pill badge-secondary pointer" :title="a.title">
                                            ?
                                        </span>
                                    </span>
                                    <span v-else>
                                        {{ a.title }}
                                    </span>
                                </span>
                                <span v-if="author_uncertain" class="d-block">
                                    <small><em>Uncertain author</em></small>
                                </span>
                                <span v-if="author_inferred" class="d-block">
                                    <small><em>Inferred author</em></small>
                                </span>
                            </td>
                        </tr>
                        <tr v-if="author_note">
                            <td>
                                Notes on author
                            </td>
                            <td>
                                {{ author_note }}
                            </td>
                        </tr>
                        <tr v-if="recipient.length > 0">
                            <td>Recipient</td>
                            <td>
                                <span v-for="r in recipient" class="d-block">
                                    <span v-if="r.marked.length > 0">
                                        {{ r.marked }}
                                        <span v-if="r.marked != r.title" class="badge badge-pill badge-secondary pointer" :title="r.title">
                                            ?
                                        </span>
                                    </span>
                                    <span v-else>
                                        {{ r.title }}
                                    </span>
                                </span>
                                <span v-if="recipient_uncertain" class="d-block">
                                    <small><em>Uncertain recipient</em></small>
                                </span>
                                <span v-if="recipient_inferred" class="d-block">
                                    <small><em>Inferred recipient</em></small>
                                </span>
                            </td>
                        </tr>
                        <tr v-if="recipient_notes">
                            <td>
                                Notes on recipient
                            </td>
                            <td>
                                {{ recipient_notes }}
                            </td>
                        </tr>
                        <tr v-if="mentioned.length > 0">
                            <td>Mentioned people</td>
                            <td>
                                <span v-for="m in mentioned" class="d-block"> {{ m }}</span>
                            </td>
                        </tr>
                        <tr v-if="people_mentioned_notes">
                            <td>Notes on mentioned people</td>
                            <td>{{ people_mentioned_notes }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-5">
                <h5>Places</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Origin</td>
                            <td>
                                <span v-for="o in origin" class="d-block">
                                    <span v-if="o.marked.length > 0">
                                        {{ o.marked }}
                                        <span v-if="o.marked != o.title" class="badge badge-pill badge-secondary pointer" :title="o.title">
                                            ?
                                        </span>
                                    </span>
                                    <span v-else>
                                        {{ o.title }}
                                    </span>
                                </span>
                                <span class="d-block" v-if="origin_uncertain">
                                    <small><em>Uncertain origin</em></small>
                                </span>
                                <span class="d-block" v-if="origin_inferred">
                                    <small><em>Inferred origin</em></small>
                                </span>
                            </td>
                        </tr>
                        <tr v-if="origin_note">
                            <td>Notes on origin</td>
                            <td>
                                {{ origin_note }}
                            </td>
                        </tr>
                        <tr>
                            <td>Destination</td>
                            <td>
                                <span v-for="d in destination" class="d-block">
                                    <span v-if="d.marked.length > 0">
                                        {{ d.marked }}
                                        <span v-if="d.marked != d.title" class="badge badge-pill badge-secondary pointer" :title="d.title">
                                            ?
                                        </span>
                                    </span>
                                    <span v-else>
                                        {{ d.title }}
                                    </span>
                                </span>
                                <span class="d-block" v-if="dest_uncertain">
                                    <small><em>Uncertain destination</em></small>
                                </span>
                                <span class="d-block" v-if="dest_inferred">
                                    <small><em>Inferred destination</em></small>
                                </span>
                            </td>
                        </tr>
                        <tr v-if="dest_note">
                            <td>Notes on destination</td>
                            <td>
                                {{ dest_note }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-5">
                <h5>Content</h5>
                <table class="table">
                    <tbody>
                        <tr v-if="abstract">
                            <td style="width: 20%;">Abstract</td>
                            <td>{{ abstract }}</td>
                        </tr>
                        <tr v-if="incipit">
                            <td style="width: 20%;">Incipit</td>
                            <td v-html="incipit"></td>
                        </tr>
                        <tr v-if="explicit">
                            <td style="width: 20%;">Explicit</td>
                            <td v-html="explicit"></td>
                        </tr>
                        <tr v-if="languages.length > 0">
                            <td style="width: 20%;">Languages</td>
                            <td>
                                <span v-for="lang in languages" class="d-block">
                                    {{ lang }}
                                </span>
                            </td>
                        </tr>
                        <tr v-if="keywords.length > 0">
                            <td>Keywords</td>
                            <td>
                                <span v-for="keyword in keywords" class="d-block">
                                    {{ keyword }}
                                </span>
                            </td>
                        </tr>
                        <tr v-if="notes_public">
                            <td>Notes on letter</td>
                            <td>{{ notes_public }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-5">
                <h5>Repositories and versions</h5>
                <table class="table">
                    <tbody>
                        <tr v-if="l_number">
                            <td style="width: 20%;">
                                Letter number
                            </td>
                            <td>
                                {{ l_number }}
                            </td>
                        </tr>
                        <tr v-if="repository">
                            <td style="width: 20%;">
                                Repository
                            </td>
                            <td>
                                {{ repository }}
                            </td>
                        </tr>
                        <tr v-if="archive">
                            <td style="width: 20%;">
                                Archive
                            </td>
                            <td>
                                {{ archive }}
                            </td>
                        </tr>
                        <tr v-if="collection">
                            <td style="width: 20%;">
                                Collection
                            </td>
                            <td>
                                {{ collection }}
                            </td>
                        </tr>
                        <tr v-if="signature">
                            <td style="width: 20%;">
                                Signature
                            </td>
                            <td>
                                {{ signature }}
                            </td>
                        </tr>
                        <tr v-if="location_note">
                            <td style="width: 20%;">
                                Note on location
                            </td>
                            <td>
                                {{ location_note }}
                            </td>
                        </tr>
                        <tr v-if="document_type">
                            <td style="width: 20%;">
                                Document type
                            </td>
                            <td>
                                {{ document_type }}
                            </td>
                        </tr>
                        <tr v-if="preservation">
                            <td style="width: 20%;">
                                Preservation
                            </td>
                            <td>
                                {{ preservation }}
                            </td>
                        </tr>
                        <tr v-if="copy">
                            <td style="width: 20%;">
                                Type of copy
                            </td>
                            <td>
                                {{ copy }}
                            </td>
                        </tr>
                        <tr v-if="manifestation_notes">
                            <td style="width: 20%;">
                                Notes on nanifestation
                            </td>
                            <td>
                                {{ manifestation_notes }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="Object.keys(related_resources).length > 0" class="mb-5">
                <h5>Related resources</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <a v-for="rr in related_resources" :href="rr.link" target="_blank">
                                    {{ rr.title }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="gallery" class="mb-5 d-flex flex-wrap" v-if="images">
                <div v-for="i in images">
                    <a :href="i.img.large" :data-caption="i.description">
                        <figure class="figure">
                            <img :src="i.img.thumb" class="figure-img img-thumbnail" :alt="i.description" style="width:150px;max-width:150px">
                            <figcaption class="figure-caption">{{ i.description }}</figcaption>
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php

get_footer();


?>
