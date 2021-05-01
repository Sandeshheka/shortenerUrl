<template>
    <div>
        <bridge-notify />
        <app-header/>

        <div class="min-h-screen">
            <router-view></router-view>
            <!-- <Index/> -->
        </div>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from "./components/Layouts/header";
import AppFooter from "./components/Layouts/footer";
// import Index from "./pages/index";

export default {
    components: {AppHeader,AppFooter}
};
</script>

<style>

</style>