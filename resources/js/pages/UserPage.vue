template>
    <div>
        <h1>User name: {{ userName }}</h1>
		<!--<p @click="loadName">load name</p>-->
    </div>
</template>

<script>
export default {
    name: "UserPage",
    data() {
        return {
            userName: null,
        };
    },
	/*methods: {
        loadName() {
			//this.userName = '123321';
			//console.log(this.$route.params);
			this.userName = this.$route.params.name;
		},
    },*/
	//чтобы этот параметр он записывал прямо в свойство
	//В mounted мы можем добавить какие то действия, которые будут происходить тогда, когда у нас компонента только только загружается
    mounted() { //mounted срабатывает каждый раз при загрузки компоненты
        //this.loadName();
        this.userName = this.$route.params.name;
    },
}
</script>

<style scoped>
</style>