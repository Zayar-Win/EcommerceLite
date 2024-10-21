<template>
  <h1 class="text-3xl font-semibold mt-5 mb-10">Sort Products</h1>
  <form 
  @submit.prevent="handleSubmit"
  >
    <div class="border-[1px] border-black/10 rounded-lg p-5 grid grid-cols-4 gap-3">
      <div
        v-for="(item, index) in selectedProducts"
        :key="index"
        class="draggable-item"
        @click="() =>{ 
          open = true;
          currentSelectedProductIndex = index;
        }"
        draggable="true"
        v-if="selectedProducts.length"
        @dragstart="onDragStart(index)"
        @dragover.prevent
        @drop="onDrop(index)"
      >
      <div v-if="item" class="flex items-center relative justify-center rounded-lg flex-col h-[180px] cursor-pointer">
        <div class="absolute w-[30px] h-[30px] flex items-center justify-center border-[1px] border-black rounded-full top-0 right-0  translate-y-[-50%] translate-x-[50%] bg-white z-[100]">
          <Close @click="(e) => {
            e.stopPropagation();
            selectedProducts.splice(index,1)
          }" />
        </div>
        <img :src="item?.images[0].url" class="w-[100px] h-[100px] " />
        <p class="font-medium text-xl mt-2">{{ item?.name }}</p>
      </div>
          <div v-else class="flex items-center justify-center rounded-lg flex-col h-[180px] cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <p>Add Product</p>
          </div>
      </div>
      <div v-if="selectedProducts?.length < 8" class="h-full items-center flex">
        <div
        @click="() => {
          if(selectedProducts.length < 8){
            selectedProducts.push(null)
          }
        }"
      >
        <!-- {{ item }} -->
          <div class="flex items-center justify-center rounded-lg flex-col h-[50px] border-[1px] border-[#ccc] w-[50px] cursor-pointer">
            <i class="fa-solid fa-plus"></i>
          </div>
      </div>
      </div>
    </div>

    <div class="w-full flex mt-5 justify-end">
    <FormButton
        type="submit"
        :disabled="selectedProducts.length == 0"
    >
        Done
    </FormButton>
  </div>
  </form>
    <Modal :open="open" @closeModal="closeModal" class="overflow-visible"can-close-backdrop>
      <div class="h-[200px]">
      <h1 class="text-xl text-black font-semibold mt-5 mb-3">Add Product</h1>
      <multiselect 
      class="block w-full p-0  rounded-md font-semibold text-sm text-primary bg-gray-00 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true" 
       :options="options" 
       v-model="selectedProduct"
       :custom-label="productName" 
       placeholder="Select one" 
       label="name"
      track-by="name"></multiselect>
    </div>
    </Modal>
  </template>
  
  <script>
import FormButton from '@/Components/Atoms/FormButton.vue';
import Modal from '@/Components/Atoms/Modal.vue';
import Multiselect from 'vue-multiselect';
import { router } from '@inertiajs/vue3';
import Close from '@/assets/icons/Close.vue';
import "vue-multiselect/dist/vue-multiselect.css";

  export default {
    components : {
      Modal,
      Multiselect,
      FormButton,
      Close
    },
    props : {
      products : {
        type : Array
      },
      orderedProducts : {
        type : Array
      }
    },
    data() {
      return {
        draggedIndex: null,
        open : false,
        selectedProduct : null,
        currentSelectedProductIndex : null,
        selectedProducts: this.orderedProducts,
        options : []
      };
    },
    watch:{
      selectedProduct(){
        this.selectedProducts[this.currentSelectedProductIndex] = this.selectedProduct
        this.options = this.products.filter(product => !this.selectedProducts.find(selectedProduct => selectedProduct?.id == product?.id))
      }
    },
    methods: {
      onDragStart(index) {
        this.draggedIndex = index;
      },
      onDrop(index) {
        // Swap the dragged item with the target item
        const draggedItem = this.selectedProducts[this.draggedIndex];
        this.selectedProducts.splice(this.draggedIndex, 1);
        this.selectedProducts.splice(index, 0, draggedItem);
        this.draggedIndex = null; // Reset dragged index
      },
      closeModal(){
        this.open  = false;
      },
      productName ({name}) {
        return `${name}`
      },
      handleSubmit(){
        router.post(route('admin.products.sort'),{selectedProducts:this.selectedProducts})
      }
    },
    mounted() {
      this.options = this.products
    },
    
  };
  </script>
  
  <style>
  .draggable-item {
    padding: 10px;
    margin-bottom: 5px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    border-radius: 10px;;
    cursor: grab;
  }
  </style>
  