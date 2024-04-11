<template>
    <div class="w-100 p-8 sm:p-0 xl:p-0 lg:p-0 sm:py-10 xl:py-10 lg:py-10 sm:pr-20 xl:pr-20 lg:pr-20">
        <h1 class="text-4xl font-semibold text-left">{{ 'Dovanų kuponas' }}</h1>
        <div class="text-left mt-7">
            <span class="text-lg">{{ 'Nežinote, ką padovanoti savo artimajam?' }}</span><br>
            <span class="text-lg">{{ 'Dovanų kuponas - tai puiki dovana ir puikus sprendimas dvejojantiems ką išrinkti!' }}</span>
        </div>
        <div class="flex mt-8 gap-8 flex-wrap">
            <button class="text-[#6269ed] bg-inherit font-medium text-[15px] flex flex-nowrap">
                <span data-icon="&#xe91d;" class="pr-2 pt-0.5 text-[20px]"></span>
                <span class="text-nowrap my-auto">{{ 'Svarbi informacija' }}</span>
            </button>
            <button class="text-[#6269ed] bg-inherit font-medium text-[15px] flex flex-nowrap">
                <span data-icon="&#xe91e;" class="pr-2 text-[22px]"></span>
                <span class="text-nowrap my-auto">{{ 'Kupono pavyzdys' }}</span>
            </button>
        </div>
        <div class="mt-[77px]">
            <div class="flex mb-[10px]">
                <span data-icon="&#xe91a;" class="text-[64px] text-[#cbcdcf] mr-8"></span>
                <div class="my-auto">
                    <h1 class="text-base font-semibold pb-1">{{ 'Puiki dovana' }}</h1>
                    <span class="text-[#808082] text-sm">{{ 'Dovanų kuponas, tai universali dovana, kuri pradžiugins kiekvieną!' }}</span>
                </div>
            </div>
            <div class="flex mb-[10px]">
                <span data-icon="&#xe91b;" class="text-[64px] text-[#cbcdcf] mr-8"></span>
                <div class="my-auto">
                    <h1 class="text-base font-semibold pb-1">{{ 'Pasirinkimo laivė' }}</h1>
                    <p class="text-[#808082] text-sm">{{ 'Neturite idėjų ką padovanoti? Suteikite džiaugsmą dovanos gavėjui išsirinkti pačiam!' }}</p>
                </div>
            </div>
            <div class="flex mb-[10px]">
                <span data-icon="&#xe91c;" class="text-[64px] text-[#cbcdcf] mr-8"></span>
                <div class="my-auto">
                    <h1 class="text-base font-semibold pb-1">{{ 'Sutaupykite laiko' }}</h1>
                    <p class="text-[#808082] text-sm">{{ 'Tai patogu ir paprasta, užtruksite vos kelias minutes.' }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "SideInfoComponent"
})
</script>

<style scoped>

</style>