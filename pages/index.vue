<template>
    <section id="page-index" class="bg-[#f3f4f8] default-font">
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
      // const runTime = useRuntimeConfig();
      // const responseData = $fetch(runTime.public.apiBase + '/project_settings');
      //
      // console.log(responseData);
    },
    methods: {

    },
}
</script>

<style scoped>
    .default-font {
        font-family: Poppins, San-serif;
    }
</style>