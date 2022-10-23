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
    <div class="w-full">
        <label for="sorting">Sort By</label>
        <select @change="sortBy" name="sortBy">
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

    <div>
        <label for="ordering">Order By</label>
        <select @change="orderBy" name="orderBy">
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
</template>
