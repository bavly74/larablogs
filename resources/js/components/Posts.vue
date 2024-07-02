<template>
    <div class="">
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
    </div>
</template>

<script>
    export default {
        data(){
            return{
                posts:[]
            }
        },
        methods:{
            getPosts(){
                axios.get('api/posts').then(
                    res=>{
                        this.posts=res.data;
                        console.log(this.posts)
                    }
                ).then(err=>console.log(err));
            }
        },
        mounted() {
            this.getPosts();
        }
    }
</script>
