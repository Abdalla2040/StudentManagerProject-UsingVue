<template>
    <div>
        <Login>
            <AuthHeader />
        </Login>
    </div>
</template>

<script>
import Login from '@/components/Login.vue';
import AuthHeader from '@/components/AuthHeader.vue';
export default {
    name: 'LoginViews',
    components: {
    Login,
    AuthHeader
  }
}
</script>