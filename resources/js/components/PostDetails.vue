<template>
    <div >
              <!-- Post Content Column -->
      <div class="col-lg-8">

<!-- Title -->
<h1 class="mt-4">{{ this.post.title }}</h1>

<!-- Author -->
<p class=" alert alert-info" style="width: fit-content;
padding: 5px;
color: #142d31;" >{{ this.post.category.name }}
</p>

<hr>

<!-- Date/Time -->
<p>Posted on <strong class="badge badge-primary p-1">{{ this.post.added_at }}</strong>
    <span class="float-right"><strong class="badge badge-info p-1">22</strong> comments</span></p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" :src="'img/'+this.post.image" style="width:900px;max-height:300px" alt="">

<hr>

<!-- Post Content -->
<p class="lead">{{ this.post.body }}</p>





<!-- Comments Form -->
<div class="card my-4">
  <h5 class="card-header">Leave a Comment:</h5>
  <div class="card-body">
    <form>
      <div class="form-group">
        <textarea class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<!-- Single Comment -->
<div class="media mb-4" v-for="comment in this.post.comments" :key="comment.id">
  <img class="d-flex mr-3 rounded-circle" :src="'img/'+comment.user.profile_img" alt="">
  <div class="media-body">
    <h5 class="mt-0">{{ comment.user.name }}</h5>
{{ comment.body }}
</div>
</div>

<!-- Comment with nested comments -->


</div>
    </div>
</template>

<script>
    export default {
       data(){
        return{
            post:''
        }
       },
       created(){
        this.getPost()
       },
       methods:{
        getPost(){
            axios.get('/api/post/'+this.$route.params.slug).then(res=>{
                this.post=res.data

                console.log(this.post)
            })
        }
       },
       mounted(){
        console.log(this.$route.params.slug)
       }

    }
</script>
