<template>
  <div class="right-0 left-0 flex justify-center fixed" v-if="show">
        <div class="absolute rounded border-2 p-1 shadow-xl bg-white">
          <div class="w-full h-full rounded border p-4">
             <form @submit.prevent="submit" class="p-4">
               <h1 class="text-center font-bold">Shorten Your URL</h1>
                <div class="my-1 flex-col">
                    <div>
                          <input type="text" placeholder="Please Give Titile" class="p-2 border rounded-md shadow-md w-64" v-model="form.title"/>
                    </div>
                    
                      <span v-if="errors.title" class="text-xs text-red-500">{{errors.title[0]}}</span>
                </div>
                <div class="my-1 flex-col">
                  <div>
                      <input type="text" placeholder="Please Place Your Long URL" class="p-2 border rounded-md shadow-md w-64" v-model="form.original_url"/>
                  </div>
                      
                      <span v-if="errors.original_url" class="text-xs text-red-500">{{errors.original_url[0]}}</span>
                </div>
              
            <i @click="close" class="fas fa-times-circle text-red-400 cursor-pointer float-left my-0"></i>
                <i @click="submit" class="fas fa-paper-plane text-green-400 cursor-pointer float-right my-0"></i>
            </form>
          </div>
    
        </div>
  </div>

       
</template>

<script>
export default {
  props:["show", "items"],
  data()
  {
    return{
      
      form:{
            title:"",
            original_url : "",
            },
            errors: {},
    }
  },

  methods:{
      close()
      {
        this.errors ={};
        this.$emit("closeModal");
      },
      submit() {
            // if(this.form.original_url == "") return;
            axios.post("/url", this.form).then(res => {
                this.form.title = "";
                this.form.original_url = "";
                this.close();
                
                this.items.unshift(res.data);
                this.$notify({   message: "Yeah! You have Created New URL 😍"});
                
            }).catch((e)=> {
             
              this.errors =e.response.data.errors;
            });

        }
    
  }
}
</script>

<style>

</style>