<template>
      <div class="p-3 flex justify-center">
        <div class="w-1/2 py-10 flex flex-wrap justify-center border rounded">
            <h1 class="text-3xl w-full text-center"> Reset Your Password</h1>
            <form class="flex flex-wrap justify-center p-2" @submit.prevent="submit">
                <div class="py-2 w-full"> 
                    <input type="email" placeholder="Your Email" v-model="form.email" class="p-2 w-full rounded border shadow"/>
                </div>
                <div class="py-2 w-full">  
                    <input type="password" placeholder="*******" v-model="form.password" class="p-2 w-full rounded border shadow" />
                </div>
                     <div class="py-2 w-full">  
                    <input type="password" placeholder="Confirm Password" v-model="form.password_confirmation" class="p-2 w-full rounded border shadow" />
                </div>
              
                <div class="py-2 w-full"> 
                    <input type="submit" value="Reset Now" class="px-3 py-2 text-white w-full bg-blue-500 rounded border shadow" />
                </div>
                
                
            

            </form>
        </div>
    </div>
</template>

<script>
export default {
    middleware:"guest",
    data(){
        return{
            form:{
                email:"",
                password:"",
                password_confirmation:"",
                token:""
            }
        };
    },
    mounted()
    {
        this.form.email = this.$route.query.email;
        this.form.token = this.$route.params.token;
    },
    methods:
    {
        submit(){
            axios.post("/password/reset",this.form)
            .then(res => {
                window.location ="/";
            })
            
        }
    }
}
</script>

<style>

</style>