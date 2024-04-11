<template>
    <div class="w-100 bg-white rounded-xl py-9 px-12">
        <template v-if="step === 1">
            <h1 class="text-3xl font-semibold text-center">{{ 'Pirkti dovanų kuponą' }}</h1>
            <h3 class="text-2xl mx-auto font-light text-center mt-1.5">{{ 'Tik 3 paprasti žingsniai!' }}</h3>

            <ol class="mx-auto mt-6 flex md:w-7/12 sm:w-8/12 lg:px-4 md:px-2 sm:px-1 max-w-lg items-center justify-between">
                <li class="flex w-full items-center">
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-[23px] w-[23px] shrink-0 items-center justify-center rounded-full"
                              :class="{'bg-[#6269ed]': step >= 1, 'bg-[#e5e7ea]': step < 1}"></span>
                        <div class="absolute top-0 mt-[42px] w-32 text-center font-semibold text-xs"
                             :class="{'text-black': step >= 1, 'text-[#acacac]': step < 1}">
                            {{ 'Duomenys' }}
                        </div>
                    </div>
                    <div class="flex-auto border-t-4"
                         :class="{'border-[#6269ed]': step >= 2, 'border-[#e5e7ea]': step < 2}"></div>
                </li>
                <li class="flex w-full items-center">
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-[23px] w-[23px] shrink-0 items-center justify-center rounded-full"
                              :class="{'bg-[#6269ed]': step >= 2, 'bg-[#e5e7ea]': step < 2}"></span>
                        <div class="absolute top-0 mt-[42px] w-32 text-center font-semibold text-xs"
                             :class="{'text-black': step >= 2, 'text-[#acacac]': step < 2}">
                            {{ 'Pristatymas' }}
                        </div>
                    </div>
                    <div class="flex-auto border-t-4"
                         :class="{'border-[#6269ed]': step > 2, 'border-[#e5e7ea]': step <= 2}"></div>
                </li>
                <li>
                    <div class="relative flex flex-col items-center">
                        <span
                            class="flex h-[23px] w-[23px] shrink-0 items-center justify-center rounded-full bg-[#e5e7ea]"
                            :class="{'bg-[#6269ed]': step >= 3, 'bg-[#e5e7ea]': step < 3}"></span>
                        <div class="absolute top-0 mt-[42px] w-32 text-center font-semibold text-xs"
                             :class="{'text-black': step >= 3, 'text-[#acacac]': step < 3}">
                            {{ 'Apmokėjimas' }}
                        </div>
                    </div>
                </li>
            </ol>

            <div class="mt-20 grid grid-cols-1">
                <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4 my-3.5">
                    <div>
                        <label for="name" class="mb-1 text-sm block font-semibold">{{ 'Gavėjo vardas' }}</label>
                        <input id="name" type='text' placeholder='Įveskite gavėjo vardą'
                               class="p-[17px] h-[53px] text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed] placeholder:text-sm"/>
                    </div>
                    <div>
                        <label for="select-button" class="mb-1 text-sm block font-semibold">
                            {{ 'Kupono vertė' }}
                            <span class="font-normal text-[13px] text-black">{{ '(minimali vertė: 20 Eur)' }}</span>
                        </label>
                        <div class="relative">
                            <button @click="toggle" :class="{'border border-2 border-[#6269ed]': selectOpen}" id="select-button"
                                    class="flex w-full h-[53px] items-center text-sm justify-between rounded-md bg-white ring-1 ring-gray-200 p-[16px]">
                                <span>{{ purchase.value + ' €' }}</span>
                                <template v-if="!selectOpen">
                                    <span data-icon="&#xe909;" class="pr-2 text-[12px]"></span>
                                </template>
                                <template v-if="selectOpen">
                                    <span data-icon="&#xe908;" class="pr-2 text-[12px]"></span>
                                </template>
                            </button>

                            <ul class="z-2 absolute mt-1 w-full rounded bg-gray-50 ring-1 ring-gray-300" id="select-menu"
                                v-show="selectOpen">
                                <li class="cursor-pointer select-none text-sm p-2 hover:bg-gray-200"
                                    :class="{'bg-blue-200 disabled': purchase.value === 20}" @click="chooseValue(20)">
                                    {{ '20 €' }}
                                </li>
                                <li class="cursor-pointer select-none text-sm p-2 hover:bg-gray-200"
                                    :class="{'bg-blue-200': purchase.value === 30}" @click="chooseValue(30)">
                                    {{ '30 €' }}
                                </li>
                                <li class="cursor-pointer select-none text-sm p-2 hover:bg-gray-200"
                                    :class="{'bg-blue-200': purchase.value === 40}" @click="chooseValue(40)">
                                    {{ '40 €' }}
                                </li>
                                <li class="cursor-pointer select-none text-sm p-2 hover:bg-gray-200"
                                    :class="{'bg-blue-200': purchase.value === 50}" @click="chooseValue(50)">
                                    {{ '50 €' }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="my-3.5">
                    <label for="email" class="mb-1 text-sm block font-semibold">{{ 'Jūsų el.paštas' }}</label>
                    <input type='text' placeholder='Įveskite savo el.paštą' id="email"
                           class="p-[17px] h-[53px] text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed] placeholder:text-sm"/>
                </div>

                <div class="my-3.5">
                    <label class="mb-1 text-sm block font-semibold" for="textarea">
                        <div class="flex justify-between">
                            <span>{{ 'Palinkėjimas' }}</span>
                            <span class="font-normal">{{ 'Liko simbolių: ' }}<b>{{ leftSymbols }}</b></span>
                        </div>
                    </label>
                    <textarea type='text' placeholder='Palinkėjimo tekstas' id="textarea"
                              class="p-[17px] h-28 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed] placeholder:text-sm"/>
                </div>

                <div class="flex mb-4 mt-2">
                    <input type="checkbox" class="hidden peer" id="custom"/>
                    <label
                        for="custom"
                        class="relative my-auto flex h-[23px] cursor-pointer pl-6 select-none text-slate-400
                        before:absolute before:left-0 before:flex before:h-[23px] before:w-[23px]
                        before:items-center before:justify-center before:rounded-md before:border
                        before:border-gray-400 before:bg-white before:transition-[background-color]
                        before:duration-300 before:ease-in before:content-['']
                        peer-checked:before:bg-white peer-checked:before:text-black
                        peer-checked:before:content-['✓'] peer-checked:before:font-bold
                        peer-checked:before:transition-[background-color] peer-checked:before:duration-300 peer-checked:before:ease-in"
                    ></label>
                    <label class="text-sm my-auto font-normal ml-2" for="custom">
                        {{ 'Sutinku su ' }}
                        <a href="#" class="border-b border-b-black hover:text-[#6269ed]">{{ 'Taisyklėmis' }}</a>
                        {{ ' ir ' }}
                        <a href="#" class="border-b border-b-black hover:text-[#6269ed]">{{ 'Privatumo politika' }}</a>
                    </label>
                </div>

                <div class="flex items-center justify-between flex-wrap sm:flex-nowrap mb-[14px] mt-[3px]">
                    <div class="text-base md:w-1/3 sm:w-full mt-4">
                        <a href="#" class="text-[#707070] group flex">
                            <span data-icon="&#xe916;" class="mr-2 group-hover:font-semibold text-[15px]"></span>
                            <span class="font-medium text-[15px] group-hover:font-semibold">{{ ' Atgal' }}</span>
                        </a>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex md:justify-end sm:justify-start mt-4 pr-5">
                            <button
                                class="py-3 px-4 bg-[#e5e7ea] text-[#6269ed] text-[15px] font-medium rounded-lg flex">
                                <span data-icon="&#xe91e;" class="mr-1 my-auto text-[22px]"></span>
                                <span class="text-nowrap my-auto">{{ 'Kupono peržiūra' }}</span>
                            </button>
                        </div>
                        <div class="flex md:justify-end sm:justify-start mt-4">
                            <button
                                class="py-3 pl-8 pr-6 bg-[#6269ed] text-[#e5e7ea] text-center text-[15px] font-medium rounded-lg flex">
                                <span class="my-auto">
                                    {{ 'Toliau' }}
                                </span>
                                <span data-icon="&#xe907;" class="ml-1 my-auto text-[11px]"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import LanguageComponent from "~/components/languageComponent/LanguageComponent.vue";

export default defineComponent({
    name: "FormComponent",
    components: {LanguageComponent},
    data() {
        return {
            step: <number>1,
            leftSymbols: <number>150,
            purchase: {
                name: <string | null>null,
                value: <number>20,
                email: <string | null>null,
                wish: <string | null>null,
                acceptTermsPolicy: <boolean>false,
                design: <number | null>null,
            },
            selectOpen: <boolean>false,
        }
    },
    mounted() {
        const selectButton = document.getElementById('select-button');
        const selectMenu = document.getElementById('select-menu');


        // Close the dropdown when clicking outside of it
        window.addEventListener('click', (event) => {
            if (!selectButton.contains(event.target) && !selectMenu.contains(event.target)) {
                // selectMenu.classList.add('hidden');
                this.selectOpen = false;
            }
        });
    },
    methods: {
        /**
         * @return void
         */
        toggle(): void {
            this.selectOpen = !this.selectOpen;
        },

        /**
         * @param {Number} value
         * @return void
         */
        chooseValue(value: number): void {
            this.purchase.value = value;
            this.selectOpen = false;
        },
    },
})
</script>

<style scoped>

</style>