import Choices from 'choices.js'

window.ajaxChoices = function (data) {
    return {
        initSelect: () => {
            const select = new Choices(data.element, {
                removeItemButton: true,
                searchResultLimit: 10,
                duplicateItemsAllowed: false,
                noChoicesText: '',
            })

            data.element.addEventListener(
                'search',
                debounce(
                    this,
                    (e) => {
                        fetch(data.url + encodeURIComponent(e.detail.value))
                            .then((response) => {
                                return response.json()
                            })
                            .then((json) => {
                                select.clearChoices()
                                select.setChoices(
                                    json.map((item) => {
                                        item.value = item.id
                                        return item
                                    })
                                )
                            })
                    },
                    300
                )
            )
        },
    }
}

window.filterTable = function (params) {
    return {
        formData: {},
        loading: false,
        pagination: {},
        items: [],
        meta: {},
        error: '',
        submit() {
            this.fetchData(this.prepareQuery())
        },
        fetchData(url) {
            const self = this
            self.loading = true
            fetch(params.ajaxUrl + encodeURIComponent(url))
                .then((response) => {
                    if (response.ok) {
                        return response.json()
                    }
                    throw new Error('Something went wrong')
                })
                .then((json) => {
                    self.items = json.data.data
                    self.pagination = json.data.links
                    self.meta = json.data.meta
                })
                .catch(() => {
                    self.items = []
                    self.pagination = {}
                    self.meta = {}
                    self.error = 'Something went wrong'
                })
                .then(() => {
                    self.loading = false
                })
        },
        paginatedUrl(pagedUrl) {
            if (!pagedUrl) {
                return ''
            }

            const newUrl = new URL(this.prepareQuery())

            newUrl.searchParams.append(
                'page',
                new URL(pagedUrl).searchParams.get('page')
            )

            return newUrl.href
        },
        prepareQuery() {
            const self = this

            const queryString = Object.keys(self.formData)
                .map((key) => {
                    if (key === 'after' || key === 'before') {
                        return (
                            key + '=' + parseInt(self.formData[key]) + '-01-01'
                        )
                    }

                    return key + '=' + parseInt(self.formData[key].value)
                })
                .join('&')

            return (
                new URL(params.url) +
                'api/letters/?basic=1&limit=15&' +
                queryString
            )
        },
    }
}

function debounce(context, func, timeout = 300) {
    let timer
    return (...args) => {
        clearTimeout(timer)
        timer = setTimeout(() => {
            func.apply(context, args)
        }, timeout)
    }
}
