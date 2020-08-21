var app = new Vue({
    el: '#app',
    data: {
        topics: [],
    },
    mounted: function(){
        this.getAllTopics();
    },
    methods: {
        getAllTopics(){
            axios.get('http://localhost/MACRO/main.php?show')
                .then(function(response){
                    app.topics = response.data.topics
                })
                .catch(error => console.log(error));
        }
    }
});
