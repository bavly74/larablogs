<template>
    <div class="row">


    <div class="col-md-8">
        <div class="media simple-post" v-for="post in posts" :key="post.id">
          <img class="mr-3" src="img/p1.jpg" alt="Generic placeholder image">
          <div class="media-body">
            <h4 class="mt-0">
                <!-- <a :href="'/post/'+post.slug">{{ post.title }}</a> -->
                <router-link :to="'/post/'+post.slug">{{ post.title }}</router-link>
            </h4>
            {{ post.body }}
            <ul class="list-inline list-unstyled d-flex post-info">
                  <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">{{ post.user.name }}</strong> </span></li>
                  <li>|</li>
                  <li><span><i class="fa fa-calendar"></i>{{ post.added_at }} </span></li>
                  <li>|</li>
                  <span><i class="fa fa-comment"></i> {{ post.comments }} comments</span>

            </ul>
          </div>
        </div>
        <nav aria-label="...">
          <ul class="pagination float-right">
            <li class="page-item disabled">
              <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
    </div>

    <div class="col-md-4">

<!-- Search Widget -->
<div class="card my-4">
  <h5 class="card-header">Search</h5>
  <div class="card-body">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">Go!</button>
      </span>
    </div>
  </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6">
        <ul class="list-unstyled mb-0">
          <li v-for="(category,index) in categories" :key="index">
            <a href="#">{{ category.name }}</a>
          </li>
        </ul>
      </div>

    </div>
  </div>
</div>


</div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                posts:[],
                categories:[]
            }
        },
        methods:{
            getPosts(){
                axios.get('api/posts').then(
                    res=>{
                        this.posts=res.data;
                        // console.log(this.posts)
                    }
                ).then(err=>console.log(err));
            },

            getCategories(){
                axios.get('api/categories').then(res=>{
                    this.categories=res.data;
                    console.log(this.categories)
                })
                .then(err=>console.log(err))
            }
        },
        mounted() {
            this.getPosts();
            this.getCategories();
        }
    }
</script>
