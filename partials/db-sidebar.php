<router-link
    to="/"
    v-if="['letter'].indexOf($route.name) > -1"
    :class="'router-link-active text-primary h3 d-block mb-3'"
>
    Back to results
</router-link>

<div class="filters" v-if="['home'].indexOf($route.name) > -1">

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Author
        </p>
        <filter-list
            :letters="filteredData"
            :filter-type="'author'"
            :active-filters="activeFilter"
        >
        </filter-list>

    </div>

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Recipient
        </p>
        <filter-list
            :letters="filteredData"
            :filter-type="'recipient'"
            :active-filters="activeFilter"
        >
        </filter-list>
    </div>

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Origin
        </p>
        <filter-list
            :letters="filteredData"
            :filter-type="'origin'"
            :active-filters="activeFilter"
        >
        </filter-list>
    </div>

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Destination
        </p>
        <filter-list
            :letters="filteredData"
            :filter-type="'dest'"
            :active-filters="activeFilter"
        >
        </filter-list>
    </div>

</div>
