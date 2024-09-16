<template>
    <!--  FILTER BUTTONS FOR TAGS  -->
    <section class="px-4 py-4 mx-5 grid grid-cols-5 gap-2">
        <div class="mt-2">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" v-model="nameFilter" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Search Name..." />
            </div>
        </div>
    </section>
    <!--  LINKS ARE SHOWN BELOW  -->

    <section class="px-3 py-3 mx-5 grid grid-cols-1 gap-2 items-center justify-center" v-if="filteredPokemon.length">
        <div class="grid grid-cols-4 gap-4">
            <div class="px-3 py-3 font-normal bg-gray-300 rounded-lg" v-for="pokemon in filteredPokemon" :li>
                <h3 class="mb-2 text-2xl font-semibold leading-snug">
                    <a :href="'/' + pokemon.name">{{ pokemon.name }}</a>
                </h3>
            </div>
        </div>
    </section>
    <section class="px-4 py-4 mx-5 grid grid-cols-1 gap-4 items-center justify-center" v-else>
        <h2>No Pokemon found matching name</h2>
    </section>
</template>

<script setup>
import axios from "axios";
import { ref, computed } from "vue";

const pokemon = ref([]);
const filteredPokemon = computed(() => {
    if (!nameFilter.value.trim()) {
        return pokemon.value;
    }
    return pokemon.value.filter(pokemon =>
        pokemon.name.toLowerCase().includes(nameFilter.value.trim().toLowerCase())
    );
});
const nameFilter = ref('');

/*
    Retrieve the data from the API, and store the data in 2 locations.
    Links, which is used by later filter logic, and filteredLinks which is used to render within the view.
    We populate the filtered links here for default as we have not modified anything
 */
const getList = async () => {
    try {
        const data = await axios.get("/api/pokedex");
        pokemon.value = data.data;
        filteredPokemon.value = data.data;
    } catch (error) {
        // Do something with the error
        console.log(error);
    }
};

getList();
</script>
