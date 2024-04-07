<template>
    <div class="container grid lg:grid-cols-2 md:grid-cols-1 gap-4 mx-auto">
        <div class="py-16">
            <SideInfoComponent></SideInfoComponent>
        </div>
        <div class="py-16">
            <FormComponent></FormComponent>
        </div>
    </div>
</template>

<script lang="ts">
import FormComponent from "~/components/formComponent/FormComponent.vue";

export default {
    name: "WrapperComponent",
    components: {FormComponent},
    data() {
        return {
        }
    },
    mounted() {

    },
    methods: {

    },
}
</script>

<style scoped>

</style>