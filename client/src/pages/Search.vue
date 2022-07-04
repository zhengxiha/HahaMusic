<template>
    <div class="search-container">
         <songlist-table></songlist-table>
    </div>
    
</template>
<script>
import SonglistTable from "../components/SonglistTable.vue";
export default {
    components: {
    SonglistTable,
  },

  
}
</script>
<style scoped>
.search-container {
  min-height: 440px;
  width: 90%;
  /* background-color: rgb(231, 230, 222); */
  margin: auto;
  padding: 10px;
}
</style>