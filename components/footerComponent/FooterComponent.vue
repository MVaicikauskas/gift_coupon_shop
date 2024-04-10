<template>
    <footer class="text-[#acaeb0] py-7">
        <div class="container mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full sm:w-1/2 grid place-items-start md:mb-0 mb-8">
                <p class="text-[13px] font-normal">{{ '©2024 UAB "Įmonė". Visos teisės saugomos.' }}</p>
            </div>
            <div class="w-full sm:w-1/2 flex flex-nowrap place-items-start sm:place-items-end md:mb-0 mb-8">
                <span class="text-[13px] font-normal text-nowrap w-full text-end pr-5">{{ 'Sprendimas: '}}</span>
                <img class="" src="../../assets/media/SK%20logo.png">
            </div>
        </div>
    </footer>
</template>

<script lang="ts">
export default {
    name: "FooterComponent",
    components: {},
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