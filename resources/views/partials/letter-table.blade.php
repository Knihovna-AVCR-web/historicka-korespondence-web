<div class="w-full md:w-9/12">
    <template x-if="error">
        <p class="text-center text-red-700 uppercase" x-text="error"></p>
    </template>
    <template x-if="loading">
        <p class="text-center uppercase">Loading...</p>
    </template>
    <template x-if="Object.keys(meta).length > 0">
        <p class="mb-3 text-sm">
            Showing <span x-text="meta.total"></span> items from <span x-text="meta.total_unfiltered"></span> total
            items
        </p>
    </template>
    <template x-if="items.length > 0">
        <div class="overflow-x-auto border">
            <table class="min-w-full divide-y table-fixed divide-stone-200" :class="{ 'opacity-75': loading }">
                <thead class="bg-stone-200">
                    <tr>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                            Signature
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                            Date
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                            Author
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                            Recipient
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                            Origin
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase">
                            Destination
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-stone-200">
                    <template x-for="item in items" :key="item.uuid">
                        <tr class="text-sm hover:bg-stone-200 odd:bg-stone-100 ">
                            <td class="max-w-sm px-3 py-2">
                                <a :href="new URL(window.location.href).href.split('?')[0] + '?letter=' + item.uuid"
                                    class="text-red-700">
                                    Detail
                                </a>
                            </td>
                            <td class="max-w-sm px-3 py-2">
                                <ul>
                                    <template x-for="signature in item.signatures">
                                        <li x-text="signature"></li>
                                    </template>
                                </ul>
                            </td>
                            <td class="max-w-sm px-3 py-2" x-text="item.dates.date"></td>
                            <td class="max-w-sm px-3 py-2">
                                <ul>
                                    <template x-for="author in item.authors">
                                        <li x-text="author"></li>
                                    </template>
                                </ul>
                            </td>
                            <td class="max-w-sm px-3 py-2">
                                <ul>
                                    <template x-for="recipient in item.recipients">
                                        <li x-text="recipient"></li>
                                    </template>
                                </ul>
                            </td>
                            <td class="max-w-sm px-3 py-2">
                                <ul>
                                    <template x-for="origin in item.origins">
                                        <li x-text="origin"></li>
                                    </template>
                                </ul>
                            </td>
                            <td class="max-w-sm px-3 py-2">
                                <ul>
                                    <template x-for="destination in item.destinations">
                                        <li x-text="destination"></li>
                                    </template>
                                </ul>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </template>
    <template x-if="Object.keys(pagination).length > 0">
        <div>
            <ul class="flex flex-wrap mt-6">
                <li class="mr-3" x-show="pagination.first">
                    <button @click="fetchData(paginatedUrl(pagination.first))" class="text-red-700">
                        First page
                    </button>
                </li>
                <li class="mr-3" x-show="pagination.prev">
                    <button @click="fetchData(paginatedUrl(pagination.prev))" class="text-red-700">
                        Previous page
                    </button>
                </li>
                <li class="mr-3" x-show="pagination.next">
                    <button @click="fetchData(paginatedUrl(pagination.next))" class="text-red-700">
                        Next page
                    </button>
                </li>
                <li class="mr-3" x-show="pagination.last">
                    <button @click="fetchData(paginatedUrl(pagination.last))" class="text-red-700">
                        Last page
                    </button>
                </li>
            </ul>
            <p class="text-sm">
                (Current page <span x-text="meta.current_page"></span> of <span x-text="meta.last_page"></span>)
            </p>
        </div>
    </template>
</div>
