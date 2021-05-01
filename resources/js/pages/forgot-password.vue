<template>
   <div class="p-3 flex justify-center">
        <div class="w-1/2 py-10 flex flex-wrap justify-center border rounded">
            <h1 class="text-3xl w-full text-center"> Send Password Link</h1>
               <form class="flex flex-wrap justify-center p-2" @submit.prevent="submit">
                <div class="py-2 w-full"> 
                    <input type="email" placeholder="Your Email" v-model="form.email" class="p-2 w-full rounded border shadow"/>
                </div>
                <span v-if="errors.email" class="text-xs text-red-500">{{errors.email[0]}}</span>
                <div class="py-2 w-full"> 
                    <input type="submit" value="Send Link" class="px-3 py-2 text-white w-full bg-blue-500 rounded border shadow" />
                </div>
                
                
            

            </form>
        </div>    
  </div>
</template>

<script>
export default {
    data(){
        return{
             form:{
                email:""
               
             
            },
              errors: {}
        };
    },
    methods:{
        submit(){
            axios.post("password/email",this.form)
            .then(res => {
                this.$notify({message:res.data.message});
            })
            .catch(e=>  this.errors = e.response.data.errors
            );

        }
    }
}
</script>

<style>

</style>