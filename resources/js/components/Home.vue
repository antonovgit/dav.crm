<template>
    <div>
        <h2>
            {{ title }}
        </h2>
        <!--<User :user="users[0]" text="some text...."></User>-->
        <!--<User v-for="(user, index) in users" :user="user" text="some text...." v-bind:key="index"></User>-->
        <!--<User v-for="(user, index) in users" :user="user" text="some text...." v-bind:key="index"/>-->
        <user-card v-for="(user, index) in users" :user="user" text="some text...." v-bind:key="index"/>
    </div>
</template>

<script>
//import User from './User';
import User from './users/User';

export default {
    name: "Home",
	components: {
        //User,
        'user-card': User,  //говорю что компонент 'user-card' это User
    },
	data() {
        return {
            title: 'Crm Helpdesc',
            users: [
                {
                    name: 'Roman',
                    last_name: 'Davydov'
                },
                {
                    name: 'Dmitriy',
                    last_name: 'Ivanov'
                },
                {
                    name: 'Alex',
                    last_name: 'Petrov'
                },
            ],
            name: null,
        }
    },
	methods: {
        addUser() {
            this.users.push(this.name);
            //this.name = null;
			this.clearName();
        },
        clearName() {
            this.name = null;
        },
    },
}
</script>

<style scoped>

</style>