<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted } from 'vue';
import { ref } from 'vue'

const pagination = ref({
    page    : 1,
    per_page: 10,
    // tot_page: 10,
})

const breweries = ref([]);

onMounted(async () => {
    await authenticateSpa();

    // getPaginationData();
    getPage(1);
});

async function authenticateSpa(){
    await axios.get('/sanctum/csrf-cookie');
}

/* async function getPaginationData(){
    const { total } = await axios.get('https://api.openbrewerydb.org/v1/breweries/meta');
    pagination.tot_page = total;
} */

async function getPage(page){
    pagination.page = page;

    const url = new URL('https://api.openbrewerydb.org/v1/breweries');
    url.searchParams.set('page', pagination.value.page);
    url.searchParams.set('per_page', pagination.value.per_page);

    const results = await axios.get(url, { withCredentials: false });
    breweries.value = results;
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>website</th>
                                <th>phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="brewery in breweries" :key="brewery.id">
                                <td> {{ brewery.name }} </td>
                                <td> {{ brewery.website }} </td>
                                <td> {{ brewery.phone }} </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="inline-flex -space-x-px text-base h-10">
                            <li>
                                <span  class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</span>
                            </li>
                            <li v-if="pagination.page > 2">
                                <span  class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ pagination.page - 2 }}</span>
                            </li>
                            <li v-if="pagination.page > 1">
                                <span  class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ pagination.page - 1 }}</span>
                            </li>
                            <li>
                                <span  aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ pagination.page }}</span>
                            </li>
                            <li>
                                <span  class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ pagination.page + 1 }}</span>
                            </li>
                            <li>
                                <span  class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ pagination.page + 2 }}</span>
                            </li>
                            <li>
                                <span  class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
