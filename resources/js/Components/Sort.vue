<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";

const props = defineProps(["sort_fields", "sort_directions", "url"]);

let selectedField = ref(null);
let selectedDirection = ref(null);

onMounted(() => {
    selectedField.value = Object.values(props.sort_fields)[0];
    selectedDirection.value = Object.values(props.sort_directions)[0];
});

const sortBy = (e) => {
    selectedField.value = e.target.value;
    Inertia.get(
        props.url,
        {
            sort_field: e.target.value,
            sort_direction: selectedDirection.value,
        },
        {
            preserveState: true,
        }
    );
};

const orderBy = (e) => {
    selectedDirection.value = e.target.value;
    Inertia.get(
        props.url,
        {
            sort_field: selectedField.value,
            sort_direction: e.target.value,
        },
        {
            preserveState: true,
        }
    );
};
</script>

<template>
    <div class="mb-4 flex flex-row">
        <div class="w-full md:w-1/4 p-3 flex flex-col">
            <label for="sorting">Sort By</label>
            <select
                @change="sortBy"
                name="sortBy"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
                <option
                    v-for="(field, index) in sort_fields"
                    :key="field"
                    :value="field"
                    :selected="selectedField"
                >
                    {{ index }}
                </option>
            </select>
        </div>

        <div class="w-full md:w-1/4 p-3 flex flex-col">
            <label for="ordering">Order By</label>
            <select
                @change="orderBy"
                name="orderBy"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
                <option
                    v-for="(direction, index) in sort_directions"
                    :key="direction"
                    :value="direction"
                    :selected="selectedDirection"
                >
                    {{ index }}
                </option>
            </select>
        </div>
    </div>
</template>
