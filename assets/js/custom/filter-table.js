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

    Vue.component('button-counter', {
        data: function() {
            return {
                count: 0,
            }
        },
        template:
            '<button v-on:click="count++">You clicked me {{ count }} times.</button>',
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
        },

        template: `
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
            sort: false,
            activeFilter: {},
            letter: null,
            letterErr: false,
        },

        computed: {
            filteredData: function() {
                let data = this.filterData()
                data = this.sortData(data, this.sort)
                return data
            },
        },

        methods: {
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
                let filter = this.activeFilter
                let result = this.unfilteredData.filter(function(item) {
                    for (let key in filter) {
                        let filterKey = filter[key]
                        let itemArr = item[key].split(';')

                        if (item[key] === undefined) {
                            return false
                        }

                        if (!isInArray(filterKey, itemArr)) {
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

function isInArray(value, array) {
    return array.indexOf(value) > -1
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
