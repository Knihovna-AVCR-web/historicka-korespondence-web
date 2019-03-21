<table class="table table-bordered table-hover table-striped filter-table" v-if="['home'].indexOf($route.name) > -1">
    <thead>
        <tr>
            <th @click="sort = 'l_no'" :class="{sorted: sort == 'l_no'}">
                Letter Number
            </th>
            <th @click="sort = 'date'" :class="{sorted: sort == 'date'}">
                Date
            </th>
            <th @click="sort = 'author'" :class="{sorted: sort == 'author'}">
                Author
            </th>
            <th @click="sort = 'recipient'" :class="{sorted: sort == 'recipient'}">
                Recipient
            </th>
            <th @click="sort = 'origin'" :class="{sorted: sort == 'origin'}">
                Origin
            </th>
            <th @click="sort = 'dest'" :class="{sorted: sort == 'dest'}">
                Destination
            </th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(row, index) in filteredData" :key="index">
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
