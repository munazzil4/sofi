<template>
    <div>         
        <div class="panel panel-default" v-for="book in books">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-user" ></span>
                <label >isbn</label> {{ book.isbn }}
            </div>
            <div class="panel-heading">
                <p>{{ book.title }}</p>
            </div>
			 <div class="panel-heading">
                <p>{{ book.price }}</p>
            </div>
			<div class="panel-body">
                <div class="col-md-2">
                    <div class="thumbnail">
                      <img :src="book.filename">
                    </div>
                </div>
			</div>	
        </div>
        
    </div>   
</template>
<script>    
        export default {
        data() {
            return {
                books: [],
                endpoint: 'api/books'
            };
        },
		created() {
            this.fetch();
        },
		
		methods: {
            fetch() {
                axios.get(this.endpoint)
                    .then(({data}) => {
                        this.books = data.data;                        
                    });
				}          
        }	
    }
</script>
