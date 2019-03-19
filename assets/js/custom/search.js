/*global homeUrl */

let menuSearch = document.querySelector('.main-menu .icon-search')
if (document.body.contains(menuSearch)) {
    let ddMenu = `
        <div class="dropdown-menu dropdown-menu-right py-0" id="dd-searchToggle" aria-labelledby="searchToggle" style="border: 0;">
            <form class="form-inline my-0" method="get" action="${homeUrl}">
                <input class="form-control form-control-sm" type="search" name="s">
            </form>
        </div>
    `
    menuSearch.id = 'searchToggle'
    menuSearch.classList.add('dropdown-toggle')
    menuSearch.parentNode.classList.add('dropdown')
    menuSearch.parentNode.style.outline = 0

    menuSearch.insertAdjacentHTML('afterend', ddMenu)
    menuSearch.addEventListener('click', function(e) {
        e.preventDefault()
        let el = this
        if (!el.parentNode.classList.contains('show')) {
            el.parentNode.classList.add('show')
            document.querySelector('#dd-searchToggle').classList.add('show')
            menuSearch.parentNode.querySelector('input[type="search"]').focus()
        } else {
            el.parentNode.classList.remove('show')
            document.querySelector('#dd-searchToggle').classList.remove('show')
        }
    })
}
