/* global Tabulator ajaxUrl lettersSuffix */

var table

if (document.getElementById('letters')) {
    table = new Tabulator('#letters-table', {
        ajaxResponse: function (url, params, response) {
            document.getElementById('letters-filter').classList.remove('d-none')
            return response
        },
        columns: [
            {
                field: 'id',
                headerFilter: 'input',
                title: 'id',
            },
            {
                field: 'sig',
                formatter: 'textarea',
                headerFilter: 'input',
                title: 'Signature',
            },
        ],
        dataFiltered: function (filters, rows) {
            document.getElementById('search-count').innerHTML = rows.length
        },
        dataLoaded: function (data) {
            document.getElementById('total-count').innerHTML = data.length
        },
        footerElement:
            '<span>Showing <span id="search-count"></span> items from <span id="total-count"></span> total items</span>',
        layout: 'fitColumns',
        maxHeight: '100%',
        pagination: 'local',
        paginationSize: 25,
        selectable: false,
        tooltips: true,
    })

    table.setData(ajaxUrl + '/?action=index_hiko_letters&type=' + lettersSuffix)
}
