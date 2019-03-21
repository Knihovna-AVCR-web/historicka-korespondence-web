<div class="letter-single" v-if="['letter'].indexOf($route.name) > -1 && letter && !letterErr">
    <h3>
        {{ letter.day ? letter.day : '?' }}. {{ letter.month ? letter.month : '?'}}. {{ letter.year ? letter.year : '?' }}:&#32;
        {{ letter.author ? letter.author.replace(/;/g, ', ') : '' }} {{ letter.origin ? '(' + letter.origin.replace(/;/g, ', ') + ')' : '' }}&#32;
        {{ letter.recipient ? '&rarr; ' : ''}}
        {{ letter.recipient ? letter.recipient.replace(/;/g, ', ') : '' }} {{ letter.dest ? '(' + letter.dest.replace(/;/g, ', ') + ')' : '' }}
    </h3>

    <div class="my-5">
        <h5>Dates</h5>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 20%">Letter date</td>
                    <td>
                        {{ letter.day ? letter.day : '?' }}. {{ letter.month ? letter.month : '?'}}. {{ letter.year ? letter.year : '????' }}
                        <span v-if="letter.date_uncertain">
                            <br>
                            <small>(Date uncertain>)</small>
                        </span>
                    </td>
                </tr>
                <tr v-if="letter.date_notes">
                    <td>Notes</td>
                    <td>{{ letter.date_notes }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        <h5>People</h5>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 20%">Author</td>
                    <td>
                        <span v-html="letter.author.replace(/;/g, '<br>')"></span>
                        <span v-if="letter.author_uncertain">
                            <br>
                            <small>(Author uncertain)</small>
                        </span>
                        <span v-if="letter.author_inferred">
                            <br>
                            <small>(Author inferred)</small>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Recipient</td>
                    <td>
                        <span v-html="letter.recipient.replace(/;/g, '<br>')"></span>
                        <span v-if="letter.recipient_uncertain">
                            <br>
                            <small>(Recipient uncertain)</small>
                        </span>
                        <span v-if="letter.recipient_inferred">
                            <br>
                            <small>(Recipient inferred)</small>
                        </span>
                    </td>
                </tr>
                <tr v-if="letter.people_mentioned">
                    <td>People mentioned</td>
                    <td>
                        <ul class="list-unstyled">
                            <li v-for="person in letter.people_mentioned.split(';')">
                                {{ person }}
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        <h5>Places</h5>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 20%">
                        Origin
                    </td>
                    <td>
                        <span v-html="letter.origin.replace(/;/g, '<br>')"></span>
                        <span v-if="letter.origin_uncertain">
                            <br>
                            <small>(Origin uncertain)</small>
                        </span>
                        <span v-if="letter.origin_inferred">
                            <br>
                            <small>(Origin inferred)</small>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Destination</td>
                    <td>
                        <span v-html="letter.dest.replace(/;/g, '<br>')"></span>
                        <span v-if="letter.dest_uncertain">
                            <br>
                            <small>(Destination uncertain)</small>
                        </span>
                        <span v-if="letter.dest_inferred">
                            <br>
                            <small>(Destination inferred)</small>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        <h5>Content</h5>
        <table class="table">
            <tbody>
                <tr v-if="letter.abstract">
                    <td>Abstract</td>
                    <td>{{ letter.abstract }}</td>
                </tr>
                <tr v-if="letter.keywords">
                    <td>Keywords</td>
                    <td>
                        <ul class="list-unstyled">
                            <li v-for="kw in letter.keywords.split(';')">
                                {{ kw }}
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%">Languages</td>
                    <td>
                        <span v-html="letter.lang.replace(/;/g, ', ')"></span>
                    </td>
                </tr>
                <tr v-if="letter.incipit">
                    <td>Incipit</td>
                    <td>{{ letter.incipit }}</td>
                </tr>
                <tr v-if="letter.explicit">
                    <td>Explicit</td>
                    <td>{{ letter.explicit }}</td>
                </tr>

                <tr v-if="letter.notes_public">
                    <td>Note</td>
                    <td>
                        {{ letter.notes_public }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
