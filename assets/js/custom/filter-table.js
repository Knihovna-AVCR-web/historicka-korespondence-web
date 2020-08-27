/* global axios globals Vue lodash */

if (document.getElementById('letters')) {
    const _ = lodash

    Vue.component('filter-table', {
        props: {
            letters: {
                type: Array,
                required: true,
            },
        },
        data: function () {
            return {
                sort: false,
                url: globals.home + 'letter/',
            }
        },
        computed: {},
        methods: {
            sortBy: function (val) {
                this.sort = val
                this.$root.sort = val
            },
            haveImages: function (data) {
                if (data == null) {
                    return false
                }

                if (Array.isArray(data) && data[0] == null) {
                    return false
                }

                return true
            },
        },
        template: `
        <table class="table table-bordered table-hover table-striped filter-table">
        <thead>
        <tr>
            <th></th>
            <th>
                Signature
            </th>
            <th @click="sortBy('date')" :class="{sorted: sort == 'date'}">
                Date
            </th>
            <th @click="sortBy('aut')" :class="{sorted: sort == 'aut'}">
                Author
            </th>
            <th @click="sortBy('rec')" :class="{sorted: sort == 'rec'}">
                Recipient
            </th>
            <th @click="sortBy('ori')" :class="{sorted: sort == 'ori'}">
                Origin
            </th>
            <th @click="sortBy('des')" :class="{sorted: sort == 'des'}">
                Destination
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(row, index) in letters" :key="index">
        <td>
            <a :href="url + row.id" target="_blank">
                Detail
            </a>
            <div v-if="haveImages(row.images)">
                <small>(attachments)</small>
            </div>
        </td>
        <td>
            {{ row.sig }}
        </td>
        <td data-date="">
            {{ row.yy + '/' + row.mm + '/' + row.dd }}
        </td>
        <td>
            <div v-if="typeof row.aut === 'string'" v-html="row.aut"></div>
            <div v-else>
                <div v-for="r in row.aut" v-html="r"></div>
            </div>
        </td>
        <td>
            <div v-if="typeof row.rec === 'string'" v-html="row.rec"></div>
            <div v-else>
                <div v-for="r in row.rec" v-html="r"></div>
            </div>
        </td>
        <td>
            <div v-if="typeof row.ori === 'string'" v-html="row.ori"></div>
            <div v-else>
                <div v-for="r in row.ori" v-html="r"></div>
            </div>
        </td>
        <td>
            <div v-if="typeof row.des === 'string'" v-html="row.des"></div>
            <div v-else>
                <div v-for="r in row.des" v-html="r"></div>
            </div>
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
            <filter-list :title="'Author'" :letters="letters" :filter-type="'aut'" :active-filters="activeFilter">
            </filter-list>

            <filter-list :title="'Recipient'" :letters="letters" :filter-type="'rec'" :active-filters="activeFilter">
            </filter-list>

            <filter-list :title="'Origin'" :letters="letters" :filter-type="'ori'" :active-filters="activeFilter">
            </filter-list>

            <filter-list :title="'Destination'" :letters="letters" :filter-type="'des'" :active-filters="activeFilter">
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
        </div>

    `,
        computed: {
            items: function () {
                return this.getCountedData(this.letters, this.filterType)
            },
        },
        methods: {
            toggle: function (item) {
                let filterType = this.filterType
                this.$root.toggleFilter(filterType, item)
            },

            getCountedData: function (data, keyName) {
                let names = []
                Object.keys(data).map((key) => {
                    let nameEl = data[key][keyName]
                    if (Array.isArray(nameEl)) {
                        for (let i = 0; i < nameEl.length; i++) {
                            if (nameEl != 'null' && nameEl != null) {
                                names.push(nameEl[i])
                            }
                        }
                    } else {
                        if (nameEl != 'null' && nameEl != null) {
                            names.push(nameEl)
                        }
                    }
                })

                names = [].concat.apply([], names)

                let counted = names.reduce(function (prev, cur) {
                    prev[cur] = (prev[cur] || 0) + 1
                    return prev
                }, {})

                let sortable = []
                for (let element in counted) {
                    sortable.push([element, counted[element]])
                }

                let result = sortable.sort(function (a, b) {
                    return b[1] - a[1]
                })

                return result
            },
        },
    })

    new Vue({
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
            filteredData: function () {
                let data = this.filterData()
                data = this.sortData(data, this.sort)
                return data
            },
        },

        methods: {
            isInArray: function (value, array) {
                return array.indexOf(value) > -1
            },

            getData: function (sessionName) {
                let self = this
                let sessionData = sessionStorage.getItem(sessionName)

                if (sessionData !== null) {
                    self.unfilteredData = JSON.parse(sessionData)
                    self.loading = false
                    return
                }

                axios
                    .get(globals.url)
                    .then(function (response) {
                        let normalisedData = normaliseData(response.data)
                        self.unfilteredData = normalisedData
                        sessionStorage.setItem(
                            sessionName,
                            JSON.stringify(normalisedData)
                        )
                    })
                    .catch(function (e) {
                        console.log(e)
                        self.error = globals.error
                    })
                    .then(() => {
                        self.loading = false
                    })
            },

            filterData: function () {
                let self = this
                let filter = self.activeFilter
                let result = self.unfilteredData.filter(function (item) {
                    for (let key in filter) {
                        let filterKey = filter[key]

                        if (item[key] === undefined) {
                            return false
                        }

                        let itemArr = []
                        if (Array.isArray(item[key])) {
                            itemArr = item[key]
                        } else {
                            itemArr = [item[key]]
                        }

                        if (!self.isInArray(filterKey, itemArr)) {
                            return false
                        }
                    }
                    return true
                })
                return result
            },

            sortData: function (data, key) {
                let self = this
                self.$forceUpdate()

                if (key == 'date') {
                    return data.sort(function (a, b) {
                        a = self.dateToTimeStamp(a.day, a.month, a.year)
                        b = self.dateToTimeStamp(b.day, b.month, b.year)
                        return a - b
                    })
                }
                return _.orderBy(data, key)
            },

            toggleFilter: function (key, value) {
                let activeKey = this.activeFilter[key]
                if (activeKey == undefined || activeKey != value) {
                    Vue.set(this.activeFilter, key, value)
                } else {
                    Vue.delete(this.activeFilter, key)
                }
            },

            dateToTimeStamp: function (day, month, year) {
                day = day != '' && day != '0' ? day : 1
                month = month != '' && month != '0' ? month : 1
                year =
                    year != '' && year != '0' ? year : new Date().getFullYear()

                let newDate = month + '/' + day + '/' + year

                return new Date(newDate).getTime()
            },
        },

        mounted() {
            this.getData('blekastad')
        },
    })
}

function normaliseData(data) {
    let normalisedData = []
    let dl = data.length
    for (let i = 0; i < dl; i++) {
        normalisedData.push(data[i])
        normalisedData[i]['year'] = String(data[i].yy)
        normalisedData[i]['month'] = String(data[i].mm)
        normalisedData[i]['day'] = String(data[i].dd)
    }

    return normalisedData
}
