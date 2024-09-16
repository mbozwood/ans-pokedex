<template>
    <div class="pt-6 pl-6">
        <button type="button" class=" rounded text-white bg-blue-600 hover:bg-blue-800 px-2.5 py-2.5" @click="$router.go(-1)">Home</button>
    </div>
    <div class="py-2 pl-6">
        <h2 class="text-xl font-medium">{{ pokemon.name }}</h2>
    </div>
    <div class="py-2 pl-6 max-w-2xl">
        <img v-if="pokemon.sprites['front_default']" :src="pokemon.sprites['front_default']" />
    </div>
    <div class="py-2 pl-6">
        <h3 class="text-lg font-light">Species: {{ pokemon.species.name }}</h3>
        <h3 class="text-lg font-light">Height: {{ pokemon.height }}</h3>
        <h3 class="text-lg font-light">Weight: {{ pokemon.weight }}</h3>
    </div>
    <div class="py-2 pl-6">
        <h3 class="text-lg font-light">Abilities:</h3>
        <ul>
            <li v-for="ability in pokemon.abilities">
                <p>{{ ability.ability.name }}</p>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";

const route = useRoute();

const pokemon = ref({});

const getPokemon = async () => {
    try {
        const data = await axios.get("/api/pokedex/" + route.params.name);
        pokemon.value = data.data;
    } catch (error) {
        // Do something with the error
        console.log(error);
    }
};
getPokemon();
</script>

