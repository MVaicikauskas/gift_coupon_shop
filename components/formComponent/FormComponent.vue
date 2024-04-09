<template>
    <div class="w-100 bg-white rounded-xl py-9 px-12">
        <template v-if="step === 1">
            <h1 class="text-4xl font-semibold text-center">{{ 'Pirkti dovanų kuponą' }}</h1>
            <h2 class="text-3xl text-center mt-1.5">{{ 'Tik 3 paprasti žingsniai!' }}</h2>

            <ol class="mx-auto mt-8 flex lg:w-6/12 md:w-11/12 sm:w-full lg:px-4 md:px-2 sm:px-1 max-w-lg items-center justify-between">
                <li class="flex w-full items-center">
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-[23px] w-[23px] shrink-0 items-center justify-center rounded-full"
                              :class="{'bg-[#6269ed]': step >= 1, 'bg-[#e5e7ea]': step < 1}"></span>
                        <div class="absolute top-0 mt-8 w-32 text-center font-semibold text-base"
                             :class="{'text-black': step >= 1, 'text-[#acacac]': step < 1}">
                            {{ 'Duomenys' }}
                        </div>
                    </div>
                    <div class="flex-auto border-t-4" :class="{'border-[#6269ed]': step >= 2, 'border-[#e5e7ea]': step < 2}"></div>
                </li>
                <li class="flex w-full items-center">
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-[23px] w-[23px] shrink-0 items-center justify-center rounded-full"
                              :class="{'bg-[#6269ed]': step >= 2, 'bg-[#e5e7ea]': step < 2}"></span>
                        <div class="absolute top-0 mt-8 w-32 text-center font-semibold text-base"
                             :class="{'text-black': step >= 2, 'text-[#acacac]': step < 2}">
                            {{ 'Pristatymas' }}
                        </div>
                    </div>
                    <div class="flex-auto border-t-4" :class="{'border-[#6269ed]': step > 2, 'border-[#e5e7ea]': step <= 2}"></div>
                </li>
                <li>
                    <div class="relative flex flex-col items-center">
                        <span class="flex h-[23px] w-[23px] shrink-0 items-center justify-center rounded-full bg-[#e5e7ea]"
                              :class="{'bg-[#6269ed]': step >= 3, 'bg-[#e5e7ea]': step < 3}"></span>
                        <div class="absolute top-0 mt-8 w-32 text-center font-semibold text-base"
                             :class="{'text-black': step >= 3, 'text-[#acacac]': step < 3}">
                            {{ 'Apmokėjimas' }}
                        </div>
                    </div>
                </li>
            </ol>

            <div class="mt-20 grid grid-cols-1">
                <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4 my-3.5">
                    <div>
                        <label for="name" class="mb-1 text-[18.667px] block font-medium">{{ 'Gavėjo vardas' }}</label>
                        <input id="name" type='text' placeholder='Įveskite gavėjo vardą'
                               class="px-4 py-3 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed] placeholder:text-[18.667px]" />
                    </div>
                    <div>
                        <label for="value" class="mb-1 text-[18.667px] block font-medium">
                            {{ 'Kupono vertė' }}
                            <span class="font-medium text-black ps-1">{{ '(minimali vertė 20 Eur)' }}</span>
                        </label>
                        <select id="value" class="bg-white border border-gray-200 text-base rounded-md focus:border-[#6269ed] focus:border-2 block w-full px-4 py-3 placeholder:text-[18.667px]">
                            <option value="20" selected class="text-black text-lg">{{ '20 €' }}</option>
                            <option value="30" class="text-black text-lg">{{ '30 €' }}</option>
                            <option value="40" class="text-black text-lg">{{ '40 €' }}</option>
                            <option value="50" class="text-black text-lg">{{ '50 €' }}</option>
                        </select>
                    </div>
                </div>

                <div class="my-3.5">
                    <label for="email" class="mb-1 text-[18.667px] block font-medium">{{ 'Jūsų el.paštas' }}</label>
                    <input type='text' placeholder='Įveskite savo el.paštą' id="email"
                           class="py-3 px-4 h-12 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed] placeholder:text-[18.667px]" />
                </div>

                <div class="my-3.5">
                    <label class="mb-1 text-[18.667px] block font-medium" for="textarea">
                        <div class="flex justify-between">
                            <span>{{ 'Palinkėjimas' }}</span>
                            <span class="font-normal">{{ 'Liko simbolių: ' }}<b>{{ leftSymbols }}</b></span>
                        </div>
                    </label>
                    <textarea type='text' placeholder='Palinkėjimo tekstas' id="textarea"
                           class="px-4 py-3 h-28 text-base rounded-md bg-white border border-gray-200 w-full outline-[#6269ed] placeholder:text-[18.667px]" />
                </div>

                <div class="flex mb-4 mt-2">
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
                    <label class="text-[18.667px] font-normal ml-2" for="custom">
                        {{ 'Sutinku su ' }}
                        <a href="#" class="border-b border-b-black hover:text-[#6269ed]">{{ 'Taisyklėmis' }}</a>
                        {{ ' ir ' }}
                        <a href="#" class="border-b border-b-black hover:text-[#6269ed]">{{ 'Privatumo politika' }}</a>
                    </label>
                </div>

                <div class="flex items-center justify-between flex-wrap sm:flex-nowrap mb-3">
                    <div class="text-base md:w-1/3 sm:w-full mt-4">
                        <a href="#" class="text-[#707070] group flex">
                            <span class="mt-2 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="13">
                                    <image width="16" height="13" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAANCAYAAACgu+4kAAAAAXNSR0IArs4c6QAAALRJREFUOE9jZMACMjMzBdnZ2Xf///+/c+LEiauxqYGJMaJLwjSDxH/+/Ok6ffr090QbQKpmkMEoLigoKNjNwMBg/O/fP9dJkyadxWczhhcKCgpmMjAwhJKiGe4CqOa0////VzAxMRFlM9QF9xgLCwtd/v//D3I6yQBkITgM8vPzyxkZGTv+//8fRija0G2BByJFYQAzlRxDMBISqYZgGAByDSw9MDIymvT3998jOiXCFJKSFwBnGmVHpPZ/bQAAAABJRU5ErkJggg==" data-name="icon-arrow-left"/>
                                </svg>
                            </span>
                            <span class="font-medium text-xl group-hover:font-semibold">{{ ' Atgal' }}</span>
                        </a>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex md:justify-end sm:justify-start mt-4 pr-5">
                            <button class="py-3 px-4 bg-[#e5e7ea] text-[#6269ed] text-xl font-medium rounded-lg flex">
                                <span class="pr-1 my-auto">
                                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="23" viewBox="18 15 22 23">
                                       <image width="22" height="23" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAXCAYAAAAP6L+eAAAAAXNSR0IArs4c6QAAAdJJREFUSEvdlcFtwjAUhn+3UunRMAIdAUYII8ChlxIORZ4ARoAJLDgQeumhjAAjlBHKCMVH6AFXfxIjkwZIxK2WEIjY/3vvf99zxLMy1QfgFbetzVzLhS8hQmWWABoA1jdoBwJozbRcOQ0KWwt0shHLBAmV+bTAYq7l+EQ4G62MKPeyagus/pFwV5m2uEJItuRCVrwo0xBAcMXjP2h1lRkw4JuWR7JiKso0Lxs8K1iaCg7SIzCxQBvAJv2Q/6oAFjug/67lNlc4VIYTODmZIGA803JIVvm/AIb+IKRnRgwUadnMFe4pUz8kGR0XS6XvbOoeaPpZuU205w7gkAwdy4U8DpX5AjCOtJyea2yoDCsNIi2f4sqyzWP0e6C6A9YuO+7ZA7W8bF2gFNWPSEvxRzjjMT2Lo1PYHTiXcU+ZwALLXOG08+w012amJbtP4W8L9C9dVGRZAINIy1quFXkZpf7VIy1bec+ZUAUgNatIy35h4fQgG7jYA0Pf6/RZfKf7fShEBTNIkaLAlgNxSL7rSPDkYPD3tFTGrnz3GvPvE3L+A0wrSQBOZsyye4McwS57yfv7Par6oqfMyAKDooK0YaZl58Kg8FoYxTCTwaLCPoaXzvwCEcc573bfdK8AAAAASUVORK5CYII=" data-name="icon-document-preview" transform="translate(18 15)"/>
                                   </svg>
                                </span>
                                <span class="text-nowrap my-auto">{{ 'Kupono peržiūra' }}</span>
                            </button>
                        </div>
                        <div class="flex md:justify-end sm:justify-start mt-4">
                            <button class="py-3 pl-8 pr-6 bg-[#6269ed] text-[#e5e7ea] text-center text-xl font-medium rounded-lg flex">
                                <span class="my-auto">
                                    {{ 'Toliau' }}
                                </span>
                                <span class="pr-1 pt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24" fill="none">
                                        <path d="M9.71069 18.2929C10.1012 18.6834 10.7344 18.6834 11.1249 18.2929L16.0123 13.4006C16.7927 12.6195 16.7924 11.3537 16.0117 10.5729L11.1213 5.68254C10.7308 5.29202 10.0976 5.29202 9.70708 5.68254C9.31655 6.07307 9.31655 6.70623 9.70708 7.09676L13.8927 11.2824C14.2833 11.6729 14.2833 12.3061 13.8927 12.6966L9.71069 16.8787C9.32016 17.2692 9.32016 17.9023 9.71069 18.2929Z" fill="#e5e7ea"/>
                                    </svg>
                                </span>
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