<template>
    <div>
        <h2>
            {{ title }}
        </h2>
        <!--<User :user="users[0]" text="some text...."></User>-->
        <!--<User v-for="(user, index) in users" :user="user" text="some text...." v-bind:key="index"></User>-->
        <!--<User v-for="(user, index) in users" :user="user" text="some text...." v-bind:key="index"/>-->
        <user-card v-for="(user, index) in users" :user="user" text="some text...." v-bind:key="index"/>
		<!--<user-card
            v-for="(user, index) in users"
            :user="user"
            text="some text...."
            v-bind:key="index"
			v-if="user.role !== 'admin'"
        />-->
		<!--<user-card
            v-for="(user, index) in users"
            :user="user"
            text="some text...."
            v-bind:key="index"
			v-show="user.role !== 'admin'"
        />-->
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
                    last_name: 'Davydov',
                    role: 'admin'
                },
                {
                    name: 'Dmitriy',
                    last_name: 'Ivanov',
                    role: 'manager'
                },
                {
                    name: 'Alex',
                    last_name: 'Petrov',
                    role: 'client'
                },
                {
                    name: 'Ivan',
                    last_name: 'Sidorov',
                    role: 'client'
                },
                {
                    name: 'Fedor',
                    last_name: 'Sidorov',
                    role: 'manager'
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