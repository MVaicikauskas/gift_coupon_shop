<template>
    <div class="relative inline-block text-left">
        <button id="dropdown-button" class="inline-flex justify-center w-full py-2 text-sm font-medium text-gray-700 bg-inherit rounded-md">
            <img class="object-cover h-6 w-6 rounded-full my-auto" :src="'https://flagcdn.com/w40/' + locale + '.png'" :alt="locale">
            <span class="font-medium truncate text-lg pl-2 my-auto">{{ locale.toUpperCase() }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 ml-1 mr-1 my-auto" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <div id="dropdown-menu" class="hidden origin-top-center absolute left-0 sm:left-auto sm:right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                <template v-for="lang in langs" :key="lang.locale">
                    <a class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer text-center" role="menuitem" @click="selectLang(lang.locale)">
                        <img class="object-cover h-6 w-6 rounded-full" :src="'https://flagcdn.com/w40/' + lang.locale + '.png'" :alt="locale">
                        <span class="font-medium truncate max-w-[7.5rem] my-auto pl-2">{{ lang.name }}</span>
                    </a>
                </template>
            </div>
        </div>
    </div>
</template>


<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "LanguageComponent",
    data() {
        return {
            locale: <string>'lt',
            langs: {
                lt: {
                    name: 'Lietuvių',
                    locale: 'lt',
                },
                en: {
                    name: 'English',
                    locale: 'gb',
                },
            },
            isDropDownOpen: <boolean>false,
            dropdownMenu: <any>null,
        }
    },
    mounted() {
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Toggle the dropdown when the button is clicked
        dropdownButton.addEventListener('click', this.toggleDropdown);

        // Close the dropdown when clicking outside of it
        window.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                this.isDropDownOpen = false;
            }
        });
    },
    methods: {
        /**
         * @param {String} lang
         * @return void
         */
        selectLang(lang: string): void {
            this.locale = lang;
            this.toggleDropdown()
        },

        /**
         * @return void
         */
        toggleDropdown(): void {
            this.isDropDownOpen = !this.isDropDownOpen;
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }
    },
})
</script>

<style scoped>

</style>