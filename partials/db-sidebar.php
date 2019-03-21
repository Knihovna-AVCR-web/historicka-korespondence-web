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
        <ul class="list-unstyled filter-list">
            <li
                v-for="author in getAuthours"
                :key="author[0]"
                @click="toggleFilter('author', author[0]);"
                :class="{ active : filter.author == author[0]}"
            >
                {{ author[0] }} ({{ author[1] }})
            </li>
        </ul>
    </div>

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Recipient
        </p>
        <ul class="list-unstyled filter-list">
            <li
                v-for="recipient in getRecipients"
                @click="toggleFilter('recipient', recipient[0]);"
                :key="recipient[0]"
                :class="{ active : filter.recipient == recipient[0]}"
            >
            {{ recipient[0] }} ({{ recipient[1] }})
            </li>
        </ul>
    </div>

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Origin
        </p>
        <ul class="list-unstyled filter-list">
            <li
                v-for="origin in getOrigins"
                :key="origin[0]"
                @click="toggleFilter('origin', origin[0]);"
                :class="{ active : filter.origin == origin[0]}"
                >
                    {{ origin[0] }} ({{ origin[1] }})
            </li>
        </ul>
    </div>

    <div class="filter pb-3">
        <p class="filter-title mb-2">
            Destination
        </p>
        <ul class="list-unstyled filter-list">
            <li
                v-for="dest in getDests"
                @click="toggleFilter('dest', dest[0]);"
                :key="dest[0]"
                :class="{ active : dest.origin == dest[0]}"
            >
                {{ dest[0] }} ({{ dest[1] }})
            </li>
        </ul>
    </div>

</div>
