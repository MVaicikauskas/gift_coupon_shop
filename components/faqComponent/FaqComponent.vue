<template>
    <div class="container p-12 bg-white">
        <div class="text-center">
            <h1 class="text-base text-[#969696] font-semibold pb-3">{{ 'D.U.K' }}</h1>
            <h2 class="text-4xl font-semibold">{{ 'Svarbi informacija' }}</h2>
        </div>

        <div class="mx-auto w-full sm:w-1/2 lg mt-12">
            <div class="group flex flex-col px-[21px] rounded-lg bg-[#f3f4f8]" tabindex="1">
                <div class="flex cursor-pointer list-none items-center justify-between py-4 text-lg font-medium text-secondary-900 group-open:text-primary-500">
                    <span class="font-semibold text-lg">{{ 'Svarbu žinoti!' }}</span>
                    <span data-icon="&#xe922;" class="block text-[16px] text-[#656bed] group-focus:hidden"></span>
                    <span data-icon="&#xe923;" class="text-[16px] text-[#656bed] hidden group-focus:block"></span>
                </div>
                <div class="hidden h-auto max-h-0 items-center opacity-0 transition-all group-focus:block group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000 pb-[21px] text-secondary-500 text-sm pr-8">
                    {{'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}
                </div>
            </div>
            <div class="group flex flex-col px-[21px] cursor-pointer rounded-lg bg-[#f3f4f8] mt-2" tabindex="2">
                <div class="flex gap-4 cursor-pointer list-none items-center justify-between py-4 text-lg font-medium text-secondary-900 group-open:text-primary-500">
                    <span class="font-semibold text-lg">{{ 'Kur galima išleisti dovanų kuponą?' }}</span>
                    <span data-icon="&#xe922;" class="block text-[16px] text-[#656bed] group-focus:hidden"></span>
                    <span data-icon="&#xe923;" class="text-[16px] text-[#656bed] hidden group-focus:block"></span>
                </div>
                <div class="hidden h-auto max-h-0 items-center opacity-0 transition-all group-focus:block group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000 pb-[21px]  text-secondary-500 text-sm pr-8">
                    {{'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}
                </div>
            </div>
            <div class="group flex flex-col px-[21px] cursor-pointer rounded-lg bg-[#f3f4f8] mt-2" tabindex="3">
                <div class="flex gap-4 cursor-pointer list-none items-center justify-between py-4 text-lg font-medium text-secondary-900 group-open:text-primary-500">
                    <span class="font-semibold text-lg">{{
                            'Noriu atšaukti docanų kuponą - ką turėčiau daryti?'
                        }}</span>
                    <span data-icon="&#xe922;" class="block text-[16px] text-[#656bed] group-focus:hidden"></span>
                    <span data-icon="&#xe923;" class="text-[16px] text-[#656bed] hidden group-focus:block"></span>
                </div>
                <div class="hidden h-auto max-h-0 items-center opacity-0 transition-all group-focus:block group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000 pb-[21px]  text-secondary-500 text-sm pr-8">
                    {{'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}
                </div>
            </div>
            <div class="group flex flex-col px-[21px] cursor-pointer rounded-lg bg-[#f3f4f8] mt-2" tabindex="4">
                <div class="flex gap-4 cursor-pointer list-none items-center justify-between py-4 text-lg font-medium text-secondary-900 group-open:text-primary-500">
                    <span class="font-semibold text-lg">{{ 'Kaip pritaikyti dovanų kupono kodą?' }}</span>
                    <span data-icon="&#xe922;" class="block text-[16px] text-[#656bed] group-focus:hidden"></span>
                    <span data-icon="&#xe923;" class="text-[16px] text-[#656bed] hidden group-focus:block"></span>
                </div>
                <div class="hidden h-auto max-h-0 items-center opacity-0 transition-all group-focus:block group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000 pb-[21px]  text-secondary-500 text-sm pr-8">
                    {{'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}
                </div>
            </div>
            <div class="group flex flex-col px-[21px] cursor-pointer rounded-lg bg-[#f3f4f8] mt-2" tabindex="5">
                <div class="flex gap-4 cursor-pointer list-none items-center justify-between py-4 text-lg font-medium text-secondary-900 group-open:text-primary-500">
                    <span class="font-semibold text-lg">{{ 'Kiek galioja "Įmonė" dovanų kuponas?' }}</span>
                    <span data-icon="&#xe922;" class="block text-[16px] text-[#656bed] group-focus:hidden"></span>
                    <span data-icon="&#xe923;" class="text-[16px] text-[#656bed] hidden group-focus:block"></span>
                </div>
                <div class="hidden h-auto max-h-0 items-center opacity-0 transition-all group-focus:block group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000 pb-[21px]  text-secondary-500 text-sm pr-8">
                    {{'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    name: "FaqComponent",
    components: {},
    data() {
        return {}
    },
    mounted() {
        const accordionHeader = document.querySelectorAll(".accordion-header");
        accordionHeader.forEach((header) => {
            header.addEventListener("click", function () {
                const accordionContent = header.parentElement.querySelector(".accordion-content");
                let accordionMaxHeight = accordionContent.style.maxHeight;

                // Condition handling
                if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
                    accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
                    header.querySelector(".fas").classList.remove("fa-plus");
                    header.querySelector(".fas").classList.add("fa-minus");
                    header.parentElement.classList.add("bg-indigo-50");
                } else {
                    accordionContent.style.maxHeight = `0px`;
                    header.querySelector(".fas").classList.add("fa-plus");
                    header.querySelector(".fas").classList.remove("fa-minus");
                    header.parentElement.classList.remove("bg-indigo-50");
                }
            });
        });
    },
    methods: {},
}
</script>

<style scoped>
.accordion-content {
    transition: max-height 0.3s ease-out, padding 0.3s ease;
}
</style>