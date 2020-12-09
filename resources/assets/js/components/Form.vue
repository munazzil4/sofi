<template>
    <div>
        <div class="alert alert-success" v-if="saved">
            <strong>Success!</strong> Inserted data successfully added.
        </div>

        <div class="well well-sm" id="formfill">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <fieldset>
                    <legend class="text-center">Book insert</legend>
					
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="isbn">isbn</label>
                        <div class="col-md-9" :class="{'has-error': errors.isbn}">
                            <input id="isbn"
                                   v-model="books.isbn"
                                   type="text"
                                   placeholder="Your isbn"
                                   class="form-control" >
                            <span v-if="errors.isbn" class="help-block text-danger">{{ errors.isbn[0] }}</span>
                        </div>
                    </div>
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="title">title</label>
                        <div class="col-md-9" :class="{'has-error': errors.title}">
                            <input id="title"
                                   v-model="books.title"
                                   type="text"
                                   placeholder="Your title"
                                   class="form-control">
                            <span v-if="errors.title" class="help-block text-danger">{{ errors.title[0] }}</span>
                        </div>
                    </div>
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="price">price</label>
                        <div class="col-md-9" :class="{'has-error': errors.price}">
                            <input id="price"
                                   v-model="books.price"
                                   type="text"
                                   placeholder="Your price"
                                   class="form-control">
                            <span v-if="errors.price" class="help-block text-danger">{{ errors.price[0] }}</span>
                        </div>
                    </div>
					  <div class="form-group">
                        <label class="col-md-3 control-label" for="description">description</label>
                        <div class="col-md-9" :class="{'has-error': errors.description}">
                            <textarea id="description"
                                   v-model="books.description"
                                   type="text"
                                   placeholder="Your description"
								   rows="5"
                                   class="form-control" ></textarea>
                            <span v-if="errors.description" class="help-block text-danger">{{ errors.description[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                errors: [],
                saved: false,
                books: {					
					isbn:null,
                    title: null,
					price:null,
					description:null
                }
            };
        },
        methods: {
            onSubmit() {
                this.saved = false;
                axios.post('api/books', this.books)
				.then(({data}) => this.setSuccessMessage())
                    .catch(({response}) => this.setErrors(response));          
            },
			
            setErrors(response) {
                this.errors = response.data.errors;
            },
			
            setSuccessMessage() {
                this.reset();
                this.saved = true;
            },
			
            reset() {
                this.errors = [];
                this.books = {isbn:null,title:null,price:null,description:null};
            }
        }
    }
</script>
