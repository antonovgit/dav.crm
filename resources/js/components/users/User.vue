<template>
    <div>
        <!--<h2>{{ user.name }} {{ user.last_name }}</h2>-->
        <!--<h2 :class="user.role">{{ user.name }} {{ user.last_name }}</h2>-->
        <!--<h2 :class="['top-'+user.role]">{{ user.name }} {{ user.last_name }}</h2>-->
		<h2 :class="getClass(user.role)">{{ user.name }} {{ user.last_name }}</h2>
        <p>{{ text }}</p>
		<!--<small>{{ user.role }}</small>-->
		<template v-if="user.role === 'client'">
            <small>{{ user.role }}</small>
        </template>
        <template v-else>
            <p>{{ user.role }}</p>
        </template>
		<router-link :to="'/users/' + user.name">User's page</router-link>
    </div>
</template>

<script>
export default {
    //Для того чтобы сказать компоненте какие параметры можно будет указать на входе, будем использовать свойство props
	props: ['user', 'text'],
    name: "User",
    methods: {
        getClass(role) {
            return 'top-'+role;
        }
    }
}
</script>

<style scoped>
.top-admin {
    color: green;
}
.top-manager {
    color: blue;
}
.top-client {
    color: red;
}
</style>