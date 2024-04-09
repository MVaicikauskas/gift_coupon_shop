<template>
    <nav class="bg-white py-4 shadow-xl px-10">
        <div class="container flex flex-wrap sm:flex-nowrap justify-between mx-auto items-center">
            <div class="text-[#acaeb0] sm:w-1/3 py-3 text-left">
                <a href="#" class="flex hover:font-medium">
                    <span class="my-auto pb-0.5 pr-2.5">
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">-->
<!--                            <path d="M4 12H20M4 12L8 8M4 12L8 16" stroke="#acaeb0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                        </svg>-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="13">
                            <image width="14" height="13" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAANCAYAAACZ3F9/AAAAAXNSR0IArs4c6QAAAKxJREFUKFOV0rsRwyAMBuCfijqzxCPEI2SF3NExRkqZhrNX8AjJCMksqWkgJx/4cPw4RSXiOwkJhY0wxpy895+tXDlTv0lGWusHgIGIhj28gBUCETWiijUKIbTiVq21L64gQXxvatVa2wM4S9EEM7oBeAM4nGT9ZoaMeqXUGGNkLIrSKuN7jLF1zonwvI7c8lWKF3v8B69+TsaXEEJztMsVLOtJKT27rhv3JvUFa5VX3RQYtZgAAAAASUVORK5CYII=" data-name="icon-arrow-left"/>
                        </svg>
                    </span>
                    <span class="text-nowrap text-base">{{ 'Grįžti į el. parduotuvę' }}</span>
                </a>
            </div>
            <div class="w-full sm:w-1/3 py-3 sm:text-center text-[#363636]">
                <h3 class="text-3xl font-bold">{{ '- LOGO -' }}</h3>
            </div>
            <div class="w-full sm:w-1/3 py-3 sm:text-right">
                <LanguageComponent></LanguageComponent>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
import LanguageComponent from "~/components/languageComponent/LanguageComponent.vue";

export default {
    name: "NavbarComponent",
    components: {LanguageComponent},
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