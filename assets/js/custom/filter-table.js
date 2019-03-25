/* global axios globals Vue lodash VueRouter */

if (document.getElementById('letters')) {
    const _ = lodash
    const Home = { template: '<div></div>' }
    const Letter = { template: '<div></div>' }

    const router = new VueRouter({
        mode: 'hash',
        base: globals.home,
        routes: [
            {
                path: '/',
                component: Home,
                name: 'home',
            },
            {
                path: '/letter/:id/:y/:m/:d',
                component: Letter,
                name: 'letter',
            },
        ],
    })

    Vue.use(VueRouter)

    Vue.component('letter-detail', {
        props: {
            letter: {
                type: Object,
                required: true,
            },
        },

        template: `
        <div class="letter-single">
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

    `,
    })

    Vue.component('filter-table', {
        props: {
            letters: {
                type: Array,
                required: true,
            },
        },
        data: function() {
            return {
                sort: false,
            }
        },
        methods: {
            sortBy: function(val) {
                this.sort = val
                this.$root.sort = val
            },
        },
        template: `
        <table class="table table-bordered table-hover table-striped filter-table">
    <thead>
        <tr>
            <th>
                Detail
            </th>
            <th @click="sortBy('date')" :class="{sorted: sort == 'date'}">
                Date
            </th>
            <th @click="sortBy('author')" :class="{sorted: sort == 'author'}">
                Author
            </th>
            <th @click="sortBy('recipient')" :class="{sorted: sort == 'recipient'}">
                Recipient
            </th>
            <th @click="sortBy('origin')" :class="{sorted: sort == 'origin'}">
                Origin
            </th>
            <th @click="sortBy('dest')" :class="{sorted: sort == 'dest'}">
                Destination
            </th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(row, index) in letters" :key="index">
            <td>
                <router-link
                    :to="{ name: 'letter', params: { id: row.l_no, y: row.year ? row.year : '0000', m: row.month ? row.month : '00', d: row.day ? row.day : '00' }}"
                    :class="'underlined'"
                >
                {{ row.l_no }}
                </router-link>
            </td>
            <td data-date="">
                {{ row.year + '/' + row.month + '/' + row.day }}
            </td>
            <td>
                <span v-html="row.author.replace(/;/g, '<br>')"></span>
            </td>
            <td>
                <span v-html="row.recipient.replace(/;/g, '<br>')"></span>
            </td>
            <td>
                <span v-html="row.origin.replace(/;/g, '<br>')"></span>
            </td>
            <td>
                <span v-html="row.dest.replace(/;/g, '<br>')"></span>
            </td>
        </tr>
    </tbody>
</table>
        `,
    })

    Vue.component('filter-lists', {
        props: {
            letters: {
                type: Array,
                required: true,
            },
            activeFilter: {
                type: Object,
                required: true,
            },
        },

        template: `
        <div>
        <filter-list :title="'Author'" :letters="letters" :filter-type="'author'" :active-filters="activeFilter">
            </filter-list>

            <filter-list :title="'Recipient'" :letters="letters" :filter-type="'recipient'" :active-filters="activeFilter">
            </filter-list>

            <filter-list :title="'Origin'" :letters="letters" :filter-type="'origin'" :active-filters="activeFilter">
            </filter-list>

            <filter-list :title="'Destination'" :letters="letters" :filter-type="'dest'" :active-filters="activeFilter">
            </filter-list>
        </div>

    `,
    })

    Vue.component('filter-list', {
        props: {
            letters: {
                type: Array,
                required: true,
            },
            filterType: {
                type: String,
                required: true,
            },
            activeFilters: {
                type: Object,
                required: true,
            },
            title: {
                type: String,
                required: true,
            },
        },

        template: `
        <div class="filter pb-3">
        <p class="filter-title mb-2">
            {{ title }}
        </p>
        <ul class="list-unstyled filter-list">
        <li
            v-for="item in items"
            v-show="item[0]"
            @click="toggle(item[0]);"
            :key="item[0]"
            :class="{ active : activeFilters[filterType] == item[0]}"
        >
            {{ item[0] }} ({{ item[1] }})
        </li>
    </ul>
        </filter-list>
    </div>

    `,
        computed: {
            items: function() {
                return this.getCountedData(this.letters, this.filterType)
            },
        },
        methods: {
            toggle: function(item) {
                let filterType = this.filterType
                this.$root.toggleFilter(filterType, item)
            },

            getCountedData: function(data, keyName) {
                let names = []
                Object.keys(data).map(key => {
                    names.push(data[key][keyName].split(';'))
                })
                names = [].concat.apply([], names)

                let counted = names.reduce(function(prev, cur) {
                    prev[cur] = (prev[cur] || 0) + 1
                    return prev
                }, {})

                let sortable = []
                for (let element in counted) {
                    sortable.push([element, counted[element]])
                }

                let result = sortable.sort(function(a, b) {
                    return b[1] - a[1]
                })

                return result
            },
        },
    })

    new Vue({
        router,
        el: '#letters',
        data: {
            unfilteredData: [],
            error: false,
            loading: true,
            activeFilter: {},
            letter: null,
            letterErr: false,
            sort: false,
        },

        computed: {
            filteredData: function() {
                let data = this.filterData()
                data = this.sortData(data, this.sort)
                return data
            },
        },

        methods: {
            isInArray: function(value, array) {
                return array.indexOf(value) > -1
            },
            getData: function() {
                let self = this
                axios
                    .get(globals.url)
                    .then(function(response) {
                        self.unfilteredData = normaliseData(response.data)
                        self.loading = false
                    })
                    .catch(function() {
                        self.loading = false
                        self.error = globals.error
                    })
            },
            getSingleLetter: function() {
                let self = this
                if (this.$route.name != 'letter') {
                    return
                }
                self.letter = null

                let lNo = String(this.$route.params.id)
                let lYear = String(this.$route.params.y)
                let lMonth = String(this.$route.params.m)
                let lDay = String(this.$route.params.d)

                lYear = lYear != '0000' ? lYear : ''
                lMonth = lMonth != '00' ? lMonth : ''
                lDay = lDay != '00' ? lDay : ''
                // { 'l_no': lNo, 'year': lYear, 'm': lMonth, 'd': lDay }
                let letter = _.find(this.unfilteredData, {
                    l_no: lNo,
                    year: lYear,
                })

                if (typeof letter === 'undefined') {
                    axios.get(globals.url).then(function(response) {
                        let letter = _.find(normaliseData(response.data), {
                            l_no: lNo,
                            year: lYear,
                        })
                        self.letter = letter
                    })
                } else {
                    self.letter = letter
                }

                if (typeof self.letter === 'undefined') {
                    console.log('undefined letter')
                    self.letterErr = globals.notLoaded
                } else {
                    console.log('defined letter')
                    self.letterErr = false
                }
                return
            },

            filterData: function() {
                let self = this
                let filter = self.activeFilter
                let result = self.unfilteredData.filter(function(item) {
                    for (let key in filter) {
                        let filterKey = filter[key]
                        let itemArr = item[key].split(';')

                        if (item[key] === undefined) {
                            return false
                        }

                        if (!self.isInArray(filterKey, itemArr)) {
                            return false
                        }
                    }
                    return true
                })
                return result
            },

            sortData: function(data, key) {
                let self = this
                self.$forceUpdate()

                if (key == 'date') {
                    return data.sort(function(a, b) {
                        a = self.dateToTimeStamp(a.day, a.month, a.year)
                        b = self.dateToTimeStamp(b.day, b.month, b.year)
                        return a - b
                    })
                }
                let sorted = _.orderBy(data, key)
                return sorted
            },

            toggleFilter: function(key, value) {
                if (
                    this.activeFilter[key] == undefined ||
                    this.activeFilter[key] != value
                ) {
                    Vue.set(this.activeFilter, key, value)
                } else {
                    Vue.delete(this.activeFilter, key)
                }
            },

            dateToTimeStamp: function(day, month, year) {
                day = day != '' ? day : 31
                month = month != '' ? month : 12
                month = month > 12 ? 12 : month
                year = year != '' ? year : new Date().getFullYear()
                let newDate = month + '/' + day + '/' + year
                return new Date(newDate).getTime()
            },
        },
        watch: {
            $route: 'getSingleLetter',
        },
        created() {
            this.getSingleLetter()
        },
        mounted() {
            this.getData()
            this.$root.$on('toggle', e => {
                console.log(e)
            })
        },
    })
}

function normaliseData(data) {
    let normalisedData = []
    let dl = data.length
    for (let i = 0; i < dl; i++) {
        normalisedData.push(data[i])
        normalisedData[i]['l_no'] = String(data[i].l_no)
        normalisedData[i]['year'] = String(data[i].year)
        normalisedData[i]['month'] = String(data[i].month)
        normalisedData[i]['day'] = String(data[i].day)
    }
    return normalisedData
}
