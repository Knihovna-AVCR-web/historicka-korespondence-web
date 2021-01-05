/* global ajaxUrl homeUrl lettersSuffix letterType */

import SlimSelect from 'slim-select'

import Tabulator from 'tabulator-tables'

var table, selectAuthor, selectRecipient, selectOrigin, selectDestination

const from = document.getElementById('from-year')
const to = document.getElementById('to-year')

function getTimestampFromDate(year, month, day) {
    let d = new Date()
    d.setFullYear(year ? year : 0, month ? month - 1 : 0, day ? day : 1)
    return d.getTime()
}

function listLetterMultiData(data) {
    if (!Array.isArray(data)) {
        return data
    }

    let list = ''
    data.forEach((author) => {
        list += `<li>${author}</li>`
    })

    return `<ul class="list-unstyled mb-0">${list}</ul>`
}

function sortLetterMultiData(aData, bData) {
    let a = aData // if is string
    let b = bData // if is string

    if (!aData) {
        a = ''
    } else if (Array.isArray(aData) && aData[0]) {
        a = aData[0]
    }

    if (!bData) {
        b = ''
    } else if (Array.isArray(bData) && bData[0]) {
        b = bData[0]
    }

    return a.localeCompare(b)
}

function countData(data, filtered) {
    let authors = {}
    let recipients = {}
    let origins = {}
    let destinations = {}
    let years = []

    data.map((item) => {
        if (filtered) {
            item = item.getData()
        }

        authors = countDataDimension(authors, item.aut)
        recipients = countDataDimension(recipients, item.rec)
        origins = countDataDimension(origins, item.ori)
        destinations = countDataDimension(destinations, item.des)

        let year = parseInt(item.yy)
        if (year != 0) {
            years.push(year)
        }
    })

    return {
        authors: authors,
        recipients: recipients,
        origins: origins,
        destinations: destinations,
        years: { min: Math.min(...years), max: Math.max(...years) },
    }
}

function countDataDimension(resultData, row) {
    if (!row || row == 'null') {
        return resultData
    }

    if (Array.isArray(row)) {
        row.forEach((r) => {
            if (!resultData.hasOwnProperty(r)) {
                resultData[r] = 1
            } else {
                resultData[r]++
            }
        })
    } else {
        if (!resultData.hasOwnProperty(row)) {
            resultData[row] = 1
        } else {
            resultData[row]++
        }
    }

    return resultData
}

function updateSelects(data, filtered) {
    const counted = countData(data, filtered)
    selectAuthor.setData(createSelectData(counted.authors))
    selectRecipient.setData(createSelectData(counted.recipients))
    selectOrigin.setData(createSelectData(counted.origins))
    selectDestination.setData(createSelectData(counted.destinations))

    if (!filtered) {
        updateYearsFilter(counted.years)
    }

    if (!table) {
        return
    }

    table.getFilters().forEach((currentFilter) => {
        if (currentFilter.field == 'aut') {
            setSingleSelectByFilter(selectAuthor, currentFilter)
        }

        if (currentFilter.field == 'rec') {
            setSingleSelectByFilter(selectRecipient, currentFilter)
        }

        if (currentFilter.field == 'ori') {
            setSingleSelectByFilter(selectOrigin, currentFilter)
        }

        if (currentFilter.field == 'des') {
            setSingleSelectByFilter(selectDestination, currentFilter)
        }
    })
}

function updateYearsFilter(years) {
    from.setAttribute('min', years.min)
    to.setAttribute('min', years.min)
    from.setAttribute('max', years.max)
    to.setAttribute('max', years.max)

    from.setAttribute('placeholder', 'Min.' + years.min)
    to.setAttribute('placeholder', 'Max.' + years.max)
}

function setSingleSelectByFilter(select, currentFilter) {
    select.setData([
        select.data.data.find((item) => {
            return item.value == currentFilter.value
        }),
    ])
}

function createSelectData(data) {
    let result = []

    data = Object.entries(data)

    data.sort((a, b) => {
        return b[1] - a[1]
    })

    result.push({ placeholder: true, text: '', value: '' })

    data.forEach((item) => {
        result.push({
            text: item[0] + ' (' + item[1] + ')',
            value: item[0],
        })
    })

    return result
}

function setSelects() {
    selectAuthor = new SlimSelect({
        allowDeselect: true,
        onChange: (info) => {
            updateFilters(info.value, 'aut')
        },
        select: '#author',
    })

    selectRecipient = new SlimSelect({
        allowDeselect: true,
        onChange: (info) => {
            updateFilters(info.value, 'rec')
        },
        select: '#recipient',
    })

    selectOrigin = new SlimSelect({
        allowDeselect: true,
        onChange: (info) => {
            updateFilters(info.value, 'ori')
        },
        select: '#origin',
    })

    selectDestination = new SlimSelect({
        allowDeselect: true,
        onChange: (info) => {
            updateFilters(info.value, 'des')
        },
        select: '#destination',
    })
}

function updateFilters(filterValue, filterName) {
    table.getFilters().forEach((currentFilter) => {
        if (currentFilter.field == filterName) {
            table.removeFilter(
                currentFilter.field,
                currentFilter.type,
                currentFilter.value
            )
        }
    })

    if (filterValue && filterValue != 'undefined') {
        table.addFilter(filterName, 'like', filterValue)
    }
}

function filterByYears() {
    table.getFilters().forEach((currentFilter) => {
        if (currentFilter.field == 'yy') {
            table.removeFilter(
                currentFilter.field,
                currentFilter.type,
                currentFilter.value
            )
        }
    })

    let fromYear = parseInt(from.value)
    let toYear = parseInt(to.value)

    if (Number.isInteger(fromYear) && Number.isInteger(toYear)) {
        let range = []
        for (let i = fromYear; i <= toYear; i++) {
            range.push(i)
        }

        table.addFilter('yy', 'in', range)
    } else if (Number.isInteger(fromYear)) {
        table.addFilter('yy', '>=', fromYear)
    } else if (Number.isInteger(toYear)) {
        table.addFilter('yy', '<=', toYear)
    }
}

function verifyCache() {
    const cachedDate = sessionStorage[lettersSuffix + '-date']
    const interval = 600000 // 10 minutes

    if (!cachedDate) {
        return false
    }

    return cachedDate > Date.now() - interval
}

if (document.getElementById('letters')) {
    setSelects()

    from.addEventListener('change', filterByYears)
    to.addEventListener('change', filterByYears)

    table = new Tabulator('#letters-table', {
        ajaxResponse: function (url, params, response) {
            sessionStorage.setItem(
                lettersSuffix + '-letters',
                JSON.stringify(response)
            )

            sessionStorage.setItem(lettersSuffix + '-date', Date.now())

            return response
        },
        columns: [
            {
                field: 'id',
                formatter: function (cell) {
                    const id = cell.getValue()
                    return `<a href="${homeUrl}browse/letter/?type=${letterType}&id=${id}" target="_blank">Detail</a>`
                },
                frozen: true,
                headerSort: false,
                title: '',
                width: 54,
            },
            {
                field: 'sig',
                formatter: 'textarea',
                title: 'Signature',
            },
            {
                field: 'date',
                formatter: 'textarea',
                mutator: function (value, data) {
                    let year = data.yy && data.yy != 0 ? data.yy : '?'
                    let month = data.mm && data.mm != 0 ? data.mm : '?'
                    let day = data.dd && data.dd != 0 ? data.dd : '?'

                    if (year == '?' && month == '?' && day == '?') {
                        return '?'
                    }

                    return `${year}/${month}/${day}`
                },
                sorter: function (a, b, aRow, bRow) {
                    let aRowData = aRow.getData()
                    let bRowData = bRow.getData()

                    a = getTimestampFromDate(
                        aRowData.yy,
                        aRowData.mm,
                        aRowData.dd
                    )

                    b = getTimestampFromDate(
                        bRowData.yy,
                        bRowData.mm,
                        bRowData.dd
                    )

                    return a - b
                },
                title: 'Date',
            },
            {
                field: 'yy',
                mutator: function (value) {
                    return value ? parseInt(value) : 0
                },
                visible: false,
                title: 'Year',
            },
            {
                field: 'aut',
                formatter: function (cell) {
                    cell.getElement().style.whiteSpace = 'normal'
                    return listLetterMultiData(cell.getValue())
                },
                sorter: function (a, b) {
                    return sortLetterMultiData(a, b)
                },
                title: 'Author',
                variableHeight: true,
            },
            {
                field: 'rec',
                formatter: function (cell) {
                    cell.getElement().style.whiteSpace = 'normal'
                    return listLetterMultiData(cell.getValue())
                },
                sorter: function (a, b) {
                    return sortLetterMultiData(a, b)
                },
                title: 'Recipient',
                variableHeight: true,
            },
            {
                field: 'ori',
                formatter: function (cell) {
                    cell.getElement().style.whiteSpace = 'normal'
                    return listLetterMultiData(cell.getValue())
                },
                sorter: function (a, b) {
                    return sortLetterMultiData(a, b)
                },
                title: 'Origin',
                variableHeight: true,
            },
            {
                field: 'des',
                formatter: function (cell) {
                    cell.getElement().style.whiteSpace = 'normal'
                    return listLetterMultiData(cell.getValue())
                },
                sorter: function (a, b) {
                    return sortLetterMultiData(a, b)
                },
                title: 'Destination',
                variableHeight: true,
            },
        ],
        dataFiltered: function (filters, rows) {
            document.getElementById('search-count').innerHTML = rows.length
            updateSelects(rows, true)
        },
        dataLoaded: function (data) {
            document.getElementById('letters-filter').classList.remove('none')
            document.getElementById('counter').classList.remove('none')
            document.getElementById('total-count').innerHTML = data.length
            updateSelects(data, false)
        },
        initialSort: [{ column: 'date', dir: 'desc' }],
        layout: 'fitColumns',
        maxHeight: '100%',
        pagination: 'local',
        paginationSize: 15,
        resizableColumns: false,
        selectable: false,
        tooltips: true,
    })

    if (verifyCache()) {
        table.setData(
            JSON.parse(sessionStorage.getItem(lettersSuffix + '-letters'))
        )
    } else {
        table.setData(
            ajaxUrl + '/?action=index_hiko_letters&type=' + lettersSuffix
        )
    }
}
