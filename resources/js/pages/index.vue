<template>
<div class="flex flex-wrap">
      <!-- <h1 class="text-2xl">Shorten Your URL</h1> -->
    <div class="w-full p-4">
        <button class="float-right px-1 py-2 bg-yellow-700 rounded shadow w-32 text-white" @click="openModal">New URL</button>
    </div>
    <div class="w-full flex">

        <left-bar @urlSelected="showDetails" :allItems="items" :data="items.data"/>
        <right-bar :data="selectedItem" @deleteItem="destroy" />
      
     </div>
     <transition name="fade">
         <create-modal :show="modalOpen" @closeModal="modalOpen = false" :items="items.data"/>
     </transition>   
  
</div>
    
 
 
  
</template>

<script>
import LeftBar from "../components/index/leftBar";
import RightBar from "../components/index/rightBar";
import CreateModal from "../components/index/createModal";
export default {
    middleware:"auth",
    components:{LeftBar,RightBar,CreateModal},
    data()
    {
    
        
        return{
                modalOpen:false,
           form:{
            title:"",
            original_url : "",
            },
           
            errors: {},
            selectedItem: null,
            items: {data:[]}
        }
    },
    mounted(){
        this.fetchData(this.$route.query.page);
        Event.$on("prevPage", this.prev);
        Event.$on("nextPage", this.next);

    },
    methods:{
      
        destroy(item)
        {
            if(confirm("Are you sure?")){
                axios.delete(`url/${item.shorten_url}`).then(() => {
               this.items.data= this.items.data.filter(i => i.id !== item.id);
               this.$notify({message:"URL Deleted Successfully", type:"danger"});
            });         
            }
          
        },
        fetchData(page=1)
        {
           
            axios.get(`/url?page=${page}`).then(res => {
                this.items = res.data;
            }).catch(e => {

            });
        },
   
    showDetails(item)
    {
        this.selectedItem = item;
    },
    openModal()
    {
        this.modalOpen = true;
    },
       next(){
           if(this.items.current_page == this.items.last_page) return;
        let nextPageNumber = this.items.current_page +1;
        console.log(nextPageNumber);
        this.fetchData(nextPageNumber);
        this.$router.replace({query: {page:nextPageNumber}});
    },
    prev()
    {
    let prevPageNumber = this.items.current_page -1;
        if(prevPageNumber == 0) return;
        this.fetchData(prevPageNumber);
        this.$router.replace({query: {page:prevPageNumber}});
    }
    }
};
</script>

<style>

</style>