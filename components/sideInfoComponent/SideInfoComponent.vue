<template>
    <div class="w-100 p-8 xl:lg:p-0 xl:lg:py-10 xl:lg:pr-24">
        <h1 class="text-5xl font-semibold text-left">{{ 'Dovanų kuponas' }}</h1>
        <div class="text-left mt-7">
            <span class="text-lg">{{ 'Nežinote, ką padovanoti savo artimajam?' }}</span><br>
            <span class="text-lg">{{ 'Dovanų kuponas - tai puiki dovana ir puikus sprendimas dvejojantiems ką išrinkti!' }}</span>
        </div>
        <div class="flex mt-8 gap-8 flex-wrap">
            <button class="text-[#6269ed] bg-inherit font-medium text-lg flex flex-nowrap">
                <span class="pr-2 my-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="21">
                        <image width="20" height="21" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAVCAYAAABG1c6oAAAAAXNSR0IArs4c6QAAAc9JREFUOE+1lU9SwjAYxV9YqMvUI8AR8AhwBFy40bKAyQngCHKCjF1Q3biQI9gjyBHkCJKluKDOSxOm1KS40M6w4Evzy/v+5FUg8oyV6e6BkQC6qH58NiWw6QCrpZab0FbRDBJUAjMAk9hhLp4JYNEEHwFTZQi5B5AAKEog+wKKZy23hNwok5wBA1EdNgDA+DzXMvOHH4AO9sCXBHC91LJoUzhWZlACL+7wqYda4K0y/Q7wRtgeGD5puT6Rrl12+14J3QNX3GeBqTIMDnwwUFeWAUst5821mpgi13IonHQCs1zLaUhZqswH47mWl5F1lmoigKFIlfF/erFRYOedwuCouMl4pygCWbsk17LXMpPRlP2eVBkCtwSWHBHmHwO6d5jyj7mtAW0f/gXIgq//SGGfCq3UE+mwLKdStqUTd8rMRHXdDtPerOWpGvpbVgJzwft5DtgOxTr9iznk/mQH9GzXaiqDw902h36Oqe5Ry0XdHDiP/bYbEyiFvRSuqVdcPwBd6mwQoYXzuqDjuOtKz6SFrXfA0Fvc0aASegHMnMHyQLpHsa98Dx0gKSsID6WaxSew8LAjhfV0aq49cn5XXyZ8FXLrKLAJr39TYgbi93wDDg32cTE27YMAAAAASUVORK5CYII=" data-name="icon-info"/>
                    </svg>
                </span>
                <span class="text-nowrap my-auto">{{ 'Svarbi informacija' }}</span>
            </button>
            <button class="text-[#6269ed] bg-inherit font-medium text-lg flex flex-nowrap">
                <span class="pr-2 my-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="23">
                        <image width="22" height="23" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAXCAYAAAAP6L+eAAAAAXNSR0IArs4c6QAAAdJJREFUSEvdlcFtwjAUhn+3UunRMAIdAUYII8ChlxIORZ4ARoAJLDgQeumhjAAjlBHKCMVH6AFXfxIjkwZIxK2WEIjY/3vvf99zxLMy1QfgFbetzVzLhS8hQmWWABoA1jdoBwJozbRcOQ0KWwt0shHLBAmV+bTAYq7l+EQ4G62MKPeyagus/pFwV5m2uEJItuRCVrwo0xBAcMXjP2h1lRkw4JuWR7JiKso0Lxs8K1iaCg7SIzCxQBvAJv2Q/6oAFjug/67lNlc4VIYTODmZIGA803JIVvm/AIb+IKRnRgwUadnMFe4pUz8kGR0XS6XvbOoeaPpZuU205w7gkAwdy4U8DpX5AjCOtJyea2yoDCsNIi2f4sqyzWP0e6C6A9YuO+7ZA7W8bF2gFNWPSEvxRzjjMT2Lo1PYHTiXcU+ZwALLXOG08+w012amJbtP4W8L9C9dVGRZAINIy1quFXkZpf7VIy1bec+ZUAUgNatIy35h4fQgG7jYA0Pf6/RZfKf7fShEBTNIkaLAlgNxSL7rSPDkYPD3tFTGrnz3GvPvE3L+A0wrSQBOZsyye4McwS57yfv7Par6oqfMyAKDooK0YaZl58Kg8FoYxTCTwaLCPoaXzvwCEcc573bfdK8AAAAASUVORK5CYII=" data-name="icon-document-preview"/>
                    </svg>
                </span>
                <span class="text-nowrap my-auto">{{ 'Kupono pavyzdys' }}</span>
            </button>
        </div>
        <div class="mt-24">
            <div class="flex mb-12">
                <div class="text-5xl pr-2 text-[#cbcdcf] my-auto mr-8">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="3 0 64 64">
                            <image width="64" height="64" xlink:href="data:image/png;base64,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" data-name="icon-gift" transform="translate(3)"/>
                        </svg>
                    </span>
                </div>
                <div>
                    <h1 class="text-lg font-semibold pb-1">{{ 'Puiki dovana' }}</h1>
                    <span class="text-[#808082] text-base">{{ 'Dovanų kuponas, tai universali dovana, kuri pradžiugins kiekvieną!' }}</span>
                </div>
            </div>
            <div class="flex mb-12">
                <div class="text-5xl pr-2 text-[#cbcdcf] my-auto mr-8">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="68" height="64" viewBox="0 115 68 64">
                        <image width="68" height="64" xlink:href="data:image/png;base64,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" data-name="icon-person-happy" transform="translate(0 115)"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-semibold pb-1">{{ 'Pasirinkimo laivė' }}</h1>
                    <p class="text-[#808082] text-base">{{ 'Neturite idėjų ką padovanoti? Suteikite džiaugsmą dovanos gavėjui išsirinkti pačiam!' }}</p>
                </div>
            </div>
            <div class="flex mb-12">
                <div class="text-5xl pr-2 text-[#cbcdcf] my-auto mr-8">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="3 221 64 64">
                            <image width="64" height="64" xlink:href="data:image/png;base64,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" data-name="icon-stopwatch-hand" transform="translate(3 221)"/>
                        </svg>
                    </span>
                </div>
                <div>
                    <h1 class="text-lg font-semibold pb-1">{{ 'Sutaupykite laiko' }}</h1>
                    <p class="text-[#808082] text-base">{{ 'Tai patogu ir paprasta, užtruksite vos kelias minutes.' }}</p>
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