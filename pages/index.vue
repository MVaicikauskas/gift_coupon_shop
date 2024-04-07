<template>
    <section id="page-index" class="bg-[#f3f4f8]">
        <NavbarComponent></NavbarComponent>
        <WrapperComponent></WrapperComponent>
        <FaqComponent></FaqComponent>
        <FooterComponent></FooterComponent>
    </section>
</template>

<script lang="ts">
import NavbarComponent from "~/components/navbarComponent/NavbarComponent.vue";
import WrapperComponent from "~/components/wrapperComponent/WrapperComponent.vue";
import FooterComponent from "~/components/footerComponent/FooterComponent.vue";
import FaqComponent from "~/components/faqComponent/FaqComponent.vue";
export default {
    name: "index",
    components: {FaqComponent, FooterComponent, WrapperComponent, NavbarComponent},
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