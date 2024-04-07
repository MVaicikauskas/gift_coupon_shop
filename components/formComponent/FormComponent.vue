<template>
    <div class="w-100 bg-white rounded-xl p-12">
        <template v-if="step === 1">
            <h1 class="text-3xl font-semibold text-center">{{ 'Pirkti dovanų kuponą' }}</h1>
            <h2 class="text-2xl text-center mt-2">{{ 'Tik 3 paprasti žingsniai!' }}</h2>

            <ol class="mx-auto mt-8 flex lg:w-5/12 md:w-11/12 sm:w-full lg:px-4 md:px-2 sm:px-1 max-w-lg items-center justify-between">
                <li class="flex w-full items-center">
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full"
                              :class="{'bg-[#6269ed]': step >= 1, 'bg-[#e5e7ea]': step < 1}"></span>
                        <div class="absolute top-0 mt-8 w-32 text-center font-semibold"
                             :class="{'text-black': step >= 1, 'text-[#acacac]': step < 1}">
                            {{ 'Duomenys' }}
                        </div>
                    </div>
                    <div class="flex-auto border-t-4" :class="{'border-[#6269ed]': step >= 2, 'border-[#e5e7ea]': step < 2}"></div>
                </li>
                <li class="flex w-full items-center">
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full"
                              :class="{'bg-[#6269ed]': step >= 2, 'bg-[#e5e7ea]': step < 2}"></span>
                        <div class="absolute top-0 mt-8 w-32 text-center font-semibold"
                             :class="{'text-black': step >= 2, 'text-[#acacac]': step < 2}">
                            {{ 'Pristatymas' }}
                        </div>
                    </div>
                    <div class="flex-auto border-t-4" :class="{'border-[#6269ed]': step > 2, 'border-[#e5e7ea]': step <= 2}"></div>
                </li>
                <li>
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#e5e7ea]"
                              :class="{'bg-[#6269ed]': step >= 3, 'bg-[#e5e7ea]': step < 3}"></span>
                        <div class="absolute top-0 mt-8 w-32 text-center font-semibold"
                             :class="{'text-black': step >= 3, 'text-[#acacac]': step < 3}">
                            {{ 'Apmokėjimas' }}
                        </div>
                    </div>
                </li>
            </ol>

            <div class="mt-20 grid grid-cols-1">
                <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4 my-4">
                    <div>
                        <label for="name" class="mb-1 text-base block font-semibold">{{ 'Gavėjo vardas' }}</label>
                        <input id="name" type='text' placeholder='Įveskite gavėjo vardą'
                               class="px-4 py-3 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed]" />
                    </div>
                    <div>
                        <label for="value" class="mb-1 text-base block font-semibold">
                            {{ 'Kupono vertė' }}
                            <span class="font-normal text-black ps-1">{{ '(minimali vertė 20 Eur)' }}</span>
                        </label>
                        <select id="value" class="bg-white border border-gray-200 text-base rounded-md focus:border-[#6269ed] focus:border-2 block w-full px-4 py-3">
                            <option value="20" selected class="text-black">{{ '20 €' }}</option>
                            <option value="30" class="text-black">{{ '30 €' }}</option>
                            <option value="40" class="text-black">{{ '40 €' }}</option>
                            <option value="50" class="text-black">{{ '50 €' }}</option>
                        </select>
                    </div>
                </div>

                <div class="my-4">
                    <label for="email" class="mb-1 text-base block font-semibold">{{ 'Jūsų el.paštas' }}</label>
                    <input type='text' placeholder='Įveskite savo el.paštą' id="email"
                           class="px-4 py-3 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed]" />
                </div>

                <div class="my-4">
                    <label class="mb-1 text-base block font-semibold" for="textarea">
                        <div class="flex justify-between">
                            <span>{{ 'Palinkėjimas' }}</span>
                            <span class="font-normal">{{ 'Liko simbolių: ' }}<b>{{ leftSymbols }}</b></span>
                        </div>
                    </label>
                    <textarea type='text' placeholder='Palinkėjimo tekstas' id="textarea"
                           class="px-4 py-3 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed]" />
                </div>

                <div class="flex mb-4">
                    <input type="checkbox" class="hidden peer" id="custom" />
                    <label
                        for="custom"
                        class="relative my-auto flex h-5 cursor-pointer pl-6 select-none text-slate-400
                        before:absolute before:left-0 before:flex before:h-5 before:w-5
                        before:items-center before:justify-center before:rounded-md before:border
                        before:border-gray-400 before:bg-white before:transition-[background-color]
                        before:duration-300 before:ease-in before:content-['']
                        peer-checked:before:bg-white peer-checked:before:text-black
                        peer-checked:before:content-['✓'] peer-checked:before:font-bold
                        peer-checked:before:transition-[background-color] peer-checked:before:duration-300 peer-checked:before:ease-in"
                    ></label>
                    <label class="text-base ml-2" for="custom">
                        {{ 'Sutinku su ' }}
                        <a href="#" class="border-b border-b-black hover:font-semibold">{{ 'Taisyklėmis' }}</a>
                        {{ ' ir ' }}
                        <a href="#" class="border-b border-b-black hover:font-semibold">{{ 'Privatumo politika' }}</a>
                    </label>
                </div>

                <div class="flex items-center justify-between flex-wrap sm:flex-nowrap">
                    <div class="text-base md:w-1/3 sm:w-full mt-4">
                        <a href="#" class="text-[#acaeb0] group flex">
                            <span class="mt-0.5 pr-1 group-hover:mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 12H20M4 12L8 8M4 12L8 16" stroke="#acaeb0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="font-medium group-hover:text-lg">{{ ' Atgal' }}</span>
                        </a>
                    </div>
                    <div class="md:w-1/3 sm:w-full flex md:justify-end sm:justify-start mt-4">
                        <button class="py-3 px-4 bg-[#e5e7ea] text-[#6269ed] font-medium rounded-lg flex">
                            <span class="pr-1">
                                <svg width="25" height="25" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M43.018 42.784L39.118 38.872C40.0361 36.9533 40.2461 34.7717 39.711 32.713C39.1759 30.6544 37.93 28.8513 36.1938 27.6225C34.4576 26.3937 32.3428 25.8184 30.2234 25.9983C28.1039 26.1783 26.1164 27.1018 24.6121 28.6057C23.1079 30.1096 22.1839 32.0969 22.0034 34.2163C21.823 36.3357 22.3978 38.4507 23.6262 40.1872C24.8545 41.9237 26.6574 43.1699 28.7159 43.7055C30.7744 44.2411 32.956 44.0316 34.875 43.114L38.786 47.014C39.0639 47.2921 39.3939 47.5128 39.7572 47.6634C40.1204 47.814 40.5097 47.8916 40.9029 47.8917C41.2961 47.8919 41.6855 47.8146 42.0489 47.6642C42.4122 47.5139 42.7424 47.2934 43.0205 47.0155C43.2986 46.7376 43.5193 46.4075 43.6699 46.0443C43.8205 45.6811 43.8981 45.2918 43.8982 44.8986C43.8984 44.5053 43.8211 44.116 43.6707 43.7526C43.5204 43.3893 43.2999 43.0591 43.022 42.781L43.018 42.784ZM26.05 39.95C25.0711 38.971 24.4045 37.7237 24.1345 36.3659C23.8644 35.008 24.0031 33.6006 24.5329 32.3216C25.0627 31.0425 25.96 29.9493 27.1111 29.1802C28.2622 28.411 29.6156 28.0005 31 28.0005C32.3844 28.0005 33.7378 28.411 34.8889 29.1802C36.04 29.9493 36.9373 31.0425 37.4671 32.3216C37.9969 33.6006 38.1356 35.008 37.8656 36.3659C37.5955 37.7237 36.9289 38.971 35.95 39.95C34.6363 41.2612 32.8561 41.9976 31 41.9976C29.1439 41.9976 27.3637 41.2612 26.05 39.95V39.95ZM41.6 45.6C41.4128 45.785 41.1602 45.8888 40.897 45.8888C40.6338 45.8888 40.3812 45.785 40.194 45.6L36.613 42.027C37.1383 41.6133 37.613 41.139 38.027 40.614L41.6 44.2C41.6927 44.2921 41.7663 44.4016 41.8165 44.5223C41.8667 44.6429 41.8925 44.7723 41.8925 44.903C41.8925 45.0337 41.8667 45.1631 41.8165 45.2837C41.7663 45.4044 41.6927 45.5139 41.6 45.606V45.6Z" fill="#6269ed"></path>
                                <path d="M25 44H12C11.2044 44 10.4413 43.6839 9.87868 43.1213C9.31607 42.5587 9 41.7956 9 41V6.99999C9 6.20434 9.31607 5.44128 9.87868 4.87867C10.4413 4.31606 11.2044 3.99999 12 3.99999H29.38C29.5884 4.00053 29.7963 4.02298 30 4.06699V9.99999C30 10.7956 30.3161 11.5587 30.8787 12.1213C31.4413 12.6839 32.2044 13 33 13H38.923C38.9724 13.2135 38.9982 13.4318 39 13.651V27C39 27.2652 39.1054 27.5196 39.2929 27.7071C39.4804 27.8946 39.7348 28 40 28C40.2652 28 40.5196 27.8946 40.7071 27.7071C40.8946 27.5196 41 27.2652 41 27V13.651C41.0014 12.9962 40.8734 12.3476 40.6236 11.7424C40.3737 11.1371 40.0069 10.5871 39.544 10.124L32.924 3.47299C32.4606 3.00458 31.9085 2.6331 31.3001 2.38021C30.6916 2.12732 30.0389 1.99807 29.38 1.99999H12C10.6744 2.00158 9.40356 2.52887 8.46622 3.46621C7.52888 4.40355 7.00159 5.6744 7 6.99999V41C7.00159 42.3256 7.52888 43.5964 8.46622 44.5338C9.40356 45.4711 10.6744 45.9984 12 46H25C25.2652 46 25.5196 45.8946 25.7071 45.7071C25.8946 45.5196 26 45.2652 26 45C26 44.7348 25.8946 44.4804 25.7071 44.2929C25.5196 44.1053 25.2652 44 25 44ZM37.594 11H33C32.7348 11 32.4804 10.8946 32.2929 10.7071C32.1054 10.5196 32 10.2652 32 9.99999V5.37999L37.594 11Z" fill="#6269ed"></path>
                                <path d="M14 13H25C25.2652 13 25.5196 12.8946 25.7071 12.7071C25.8946 12.5196 26 12.2652 26 12C26 11.7348 25.8946 11.4804 25.7071 11.2929C25.5196 11.1054 25.2652 11 25 11H14C13.7348 11 13.4804 11.1054 13.2929 11.2929C13.1054 11.4804 13 11.7348 13 12C13 12.2652 13.1054 12.5196 13.2929 12.7071C13.4804 12.8946 13.7348 13 14 13V13Z" fill="#6269ed"></path>
                                <path d="M34 17H17C16.7348 17 16.4804 17.1054 16.2929 17.2929C16.1054 17.4804 16 17.7348 16 18C16 18.2652 16.1054 18.5196 16.2929 18.7071C16.4804 18.8946 16.7348 19 17 19H34C34.2652 19 34.5196 18.8946 34.7071 18.7071C34.8946 18.5196 35 18.2652 35 18C35 17.7348 34.8946 17.4804 34.7071 17.2929C34.5196 17.1054 34.2652 17 34 17Z" fill="#6269ed"></path>
                                <path d="M35 23C35 22.7348 34.8946 22.4804 34.7071 22.2929C34.5196 22.1054 34.2652 22 34 22H14C13.7348 22 13.4804 22.1054 13.2929 22.2929C13.1054 22.4804 13 22.7348 13 23C13 23.2652 13.1054 23.5196 13.2929 23.7071C13.4804 23.8946 13.7348 24 14 24H34C34.2652 24 34.5196 23.8946 34.7071 23.7071C34.8946 23.5196 35 23.2652 35 23Z" fill="#6269ed"></path>
                                <path d="M21 28C21 27.7348 20.8946 27.4804 20.7071 27.2929C20.5196 27.1054 20.2652 27 20 27H14C13.7348 27 13.4804 27.1054 13.2929 27.2929C13.1054 27.4804 13 27.7348 13 28C13 28.2652 13.1054 28.5196 13.2929 28.7071C13.4804 28.8946 13.7348 29 14 29H20C20.2652 29 20.5196 28.8946 20.7071 28.7071C20.8946 28.5196 21 28.2652 21 28Z" fill="#6269ed"></path>
                                <path d="M14 34H18C18.2652 34 18.5196 33.8946 18.7071 33.7071C18.8946 33.5196 19 33.2652 19 33C19 32.7348 18.8946 32.4804 18.7071 32.2929C18.5196 32.1054 18.2652 32 18 32H14C13.7348 32 13.4804 32.1054 13.2929 32.2929C13.1054 32.4804 13 32.7348 13 33C13 33.2652 13.1054 33.5196 13.2929 33.7071C13.4804 33.8946 13.7348 34 14 34V34Z" fill="#6269ed"></path>
                                <path d="M14 39H19C19.2652 39 19.5196 38.8946 19.7071 38.7071C19.8946 38.5196 20 38.2652 20 38C20 37.7348 19.8946 37.4804 19.7071 37.2929C19.5196 37.1054 19.2652 37 19 37H14C13.7348 37 13.4804 37.1054 13.2929 37.2929C13.1054 37.4804 13 37.7348 13 38C13 38.2652 13.1054 38.5196 13.2929 38.7071C13.4804 38.8946 13.7348 39 14 39V39Z" fill="#6269ed"></path>
                                <path d="M31 38C30.2044 38 29.4413 37.6839 28.8787 37.1213C28.3161 36.5587 28 35.7956 28 35C28 34.7348 27.8946 34.4804 27.7071 34.2929C27.5196 34.1054 27.2652 34 27 34C26.7348 34 26.4804 34.1054 26.2929 34.2929C26.1054 34.4804 26 34.7348 26 35C26.0016 36.3256 26.5289 37.5964 27.4662 38.5338C28.4036 39.4711 29.6744 39.9984 31 40C31.2652 40 31.5196 39.8946 31.7071 39.7071C31.8946 39.5196 32 39.2652 32 39C32 38.7348 31.8946 38.4804 31.7071 38.2929C31.5196 38.1054 31.2652 38 31 38Z" fill="#6269ed"></path>
                                </svg>
                            </span>
                            <span class="text-nowrap">{{ 'Kupono peržiūra' }}</span>
                        </button>
                    </div>
                    <div class="md:w-1/3 sm:w-full flex md:justify-end sm:justify-start mt-4">
                        <button class="py-3 pl-8 pr-6 bg-[#6269ed] text-[#e5e7ea] text-center font-medium rounded-lg flex">
                            {{ 'Toliau' }}
                            <span class="pr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24" fill="none">
                                    <path d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z" fill="#e5e7ea"/>
                                </svg>
                            </span>
                        </button>
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
        }
    },
    mounted() {

    },
    methods: {

    },
})
</script>

<style scoped>

</style>